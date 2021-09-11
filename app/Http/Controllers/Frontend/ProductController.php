<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    public function listing(Request $request){
        Paginator::useBootstrap();
        if($request->ajax()){
          $data=$request->all();
        //   echo "<pre>";print_r($data); die;
          $url=$data['url'];
          $categoryCount=Category::where('url',$url)->count();
          if($categoryCount>0){
               $categoryDetails= Category::catDetails($url);
               $categoryProducts=Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);

                // Filter sidebar option
                if(isset($data['fabric']) && !empty($data['fabric'])){
                    $categoryProducts->whereIn('products.fabric',$data['fabric']);
                }
                 //If sleeve  Filter is selected
                 if(isset($data['sleeve']) && !empty($data['sleeve'])){
                    $categoryProducts->whereIn('products.sleeve',$data['sleeve']);
                }
                 //If pattern  Filter is selected
                 if(isset($data['pattern']) && !empty($data['pattern'])){
                    $categoryProducts->whereIn('products.pattern',$data['pattern']);
                }
                 //If fit  Filter is selected
                 if(isset($data['fit']) && !empty($data['fit'])){
                    $categoryProducts->whereIn('products.fit',$data['fit']);
                }
                 //If occasion  Filter is selected
                 if(isset($data['occasion']) && !empty($data['occasion'])){
                    $categoryProducts->whereIn('products.occasion',$data['occasion']);
                }
          //   // Filtering product with character
            if(isset($data['sort']) && !empty($data['sort'])){
                if($data['sort']=='latest_product'){
                    $categoryProducts->orderBy('id','Desc');
                }else if($data['sort']=='a_z'){
                    $categoryProducts->orderBy('product_name','Asc');
                }
                else if($data['sort']=='z_a'){
                    $categoryProducts->orderBy('product_name','Desc');
                }
                else if($data['sort']=='lowest_price'){
                    $categoryProducts->orderBy('product_price','Asc');
                }
                else if($data['sort']=='height_price'){
                    $categoryProducts->orderBy('product_name','Desc');
                }
            }else{
                $categoryProducts->orderBy('id','Desc');
            }
            $categoryProducts=$categoryProducts->paginate(3);

           // end filter product with loading


               return view('frontend.pages.ajax_listing')->with(compact('categoryDetails','categoryProducts','url'));
          }else{
              abort('404');
          }
        }else{
            $url=Route::getFacadeRoot()->current()->uri();
            $categoryCount=Category::where('url',$url)->count();
            // Search Products
            if(isset($_REQUEST['search']) && !empty($_REQUEST['search'])){
                $search_product = $_REQUEST['search'];
                $categoryDetails['breadcrumbs']= $search_product;
                $categoryDetails['catDetails']['category_name']=$search_product;
                $categoryDetails['catDetails']['description'] = "Search results for " . $search_product;
                $categoryProducts= Product::with('brand')->where(function($query)use($search_product){
                    $query->where('product_name','like', '%'.$search_product.'%')
                    ->orWhere('product_code','like', '%'.$search_product.'%')
                    ->orWhere('product_color','like', '%'.$search_product.'%')
                    ->orWhere('product_description','like', '%'.$search_product.'%');
                })->where('status',1);
                $categoryProducts=$categoryProducts->get();
                $page_name="Search";
                return view('frontend.pages.listing')->with(compact('categoryDetails','categoryProducts','page_name'));
             }
            else if($categoryCount>0){

                $productFilter = Product::productFilter();
                $fabricArray=$productFilter['fabricArray'];
                $patternArray=$productFilter['patternArray'];
                $fitArray=$productFilter['fitArray'];
                $occasionArray=$productFilter['occasionArray'];
                $sleeveArray=$productFilter['sleeveArray'];
                $categoryDetails= Category::catDetails($url);
                $categoryProducts=Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);
                $categoryProducts=$categoryProducts->paginate(3);
                $page_name="listing";
                return view('frontend.pages.listing')->with(compact('categoryDetails','categoryProducts','url','fabricArray','patternArray','fitArray','occasionArray','sleeveArray','page_name'));
            }else{
                abort('404');
            }
        }

    }

    public function singleProduct($id){
        $productData=Product::with(['category','brand','images','attributes'=>function($query){
           $query->where('status',1);
        }])->find($id)->toArray();

        $attribute=ProductAttribute::where('product_id',$id)->sum('stock');
        // dd($productData);
        $relatedProducts=Product::where('id','!=', $id)->limit(3)->inRandomOrder()->get()->toArray();
        // dd($relatedProducts);
        return view('frontend.pages.single_product')->with(compact('productData','attribute','relatedProducts'));
    }
    public function getProductPrice(Request $request){
        if($request->ajax()){
        $data=$request->all();
        $getAttrDiscount= Product::getAttrDiscount($data['product_id'],$data['size']);
        return $getAttrDiscount;
        // return response(json_decode($getProductPrice));
        }
    }

}
