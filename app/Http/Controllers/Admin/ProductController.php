<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{
    public function index(){
        $products= Product::with(['Category'])->get();
        // echo "<pre>"; print_r($products); die;
        return view('backend.pages.products.product-index')
        ->with('products',$products);
    }

    public function updateProductsStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Product::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);
         }
    }

    public function createProduct(){
        $fabricArray=array('Cotton','Polyester','Mixed','Wool');
        $patternArray=array('Checked','Plain','Printed','Self','Solid');
        $fitArray=array('Regular','Slim');
        $sleeveArray=array('full','half','sleeve less');
        $occasionArray=array('Casual','Formal');
        $categories=Section::with('categories')->get();
        $brands=Brands::where('status',1)->get();
        $categories= json_decode(json_encode($categories),true);
        return view('backend.pages.products.create-product')->with(compact('fabricArray','patternArray','fitArray','occasionArray','sleeveArray','brands'))
        ->with('categories',$categories);
    }

   public function storeProducts(Request $request){
       $request->validate([
           'product_name'=>'required',
           'category_id'=>'required',
           'product_code'=>'required',
           'product_color'=>'required',
           'product_price'=>'required',
           'product_image'=>'required',
           'product_description'=>'required',

       ]);
       $url =Str::slug($request->product_name);
       $data= new Product();
       if($request->hasFile('product_image'))
       {

        $image=$request->file('product_image');
        $currentDate=Carbon::now()->toDateString();
        $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();

        // if(!Storage::disk('public')->exists('images/admin/product'))
        // {
        //    Storage::disk('public')->makeDirectory('images/admin/product');
        // }
        // if(!Storage::disk('public')->exists('images/admin/product/medium'))
        // {
        //    Storage::disk('public')->makeDirectory('images/admin/product/medium');
        // }
        // if(!Storage::disk('public')->exists('images/admin/product/small'))
        // {
        //    Storage::disk('public')->makeDirectory('images/admin/product/small');
        // }

        $productImage = Image::make($image)->resize(1040,1200)->stream();
        $MediumProductImage = Image::make($image)->resize(520,600)->stream();
        $SmallProductImage = Image::make($image)->resize(260,300)->stream();


        Storage::disk('public')->put('images/admin/product/main/'.$imageName,$productImage);
        Storage::disk('public')->put('images/admin/product/medium/'.$imageName,$MediumProductImage);
        Storage::disk('public')->put('images/admin/product/small/'.$imageName,$SmallProductImage);
       }else{
           $imageName= "default.png";
       }


       if($request->hasFile('product_video'))
       {

        $video=$request->file('product_video');
        $currentDate=Carbon::now()->toDateString();
        $videoName=$currentDate.'-'.uniqid().'-'.$video->getClientOriginalExtension();
        $video->move('storage/video/product_video/',$videoName);
        $data->product_video=$videoName;
       }else{
           $videoName= "default.mp4";
       }


      $categoryDetails=Category::find($request['category_id']);
      $data->section_id=$categoryDetails['section_id'];
      $data->category_id=$request->category_id;
      $data->product_name=$request->product_name;
      $data->product_price=$request->product_price;
      $data->product_code=$request->product_code;
      $data->product_color=$request->product_color;
      $data->wash_care=$request->wash_care;
      $data->meta_title=$request->meta_title;
      $data->meta_description=$request->meta_description;
      $data->meta_keywords=$request->meta_keywords;
      $data->fabric=$request->fabric;
      $data->occasion=$request->occasion;
      $data->sleeve=$request->sleeve;
      $data->pattern=$request->pattern;
      $data->fit=$request->fit;
      $data->brand_id=$request->brand;
      $data->url=$url;
      $data->product_discount=$request->product_discount;
      $data->product_weight=$request->product_weight;
      $data->product_description=$request->product_description;
      $data->product_image=$imageName;
      $data->is_featured=$request->is_featured;
      $data->status=1;
      $data->save();
      Alert::success('Success!','Product updated successfully!');
      return redirect()->route('product.index');


   }
   public function editProduct($id){

       $productFilter = Product::productFilter();
       $fabricArray=$productFilter['fabricArray'];
       $patternArray=$productFilter['patternArray'];
       $fitArray=$productFilter['fitArray'];
       $occasionArray=$productFilter['occasionArray'];
       $sleeveArray=$productFilter['sleeveArray'];
       $productData=Product::find($id);
       $categories=Section::with('categories')->get();
       $brands=Brands::where('status',1)->get();
       $categories= json_decode(json_encode($categories),true);
       return view('backend.pages.products.edit-product')->with(compact('productData', 'categories','fabricArray','patternArray','fitArray','occasionArray','sleeveArray','brands') );
   }
    public function updateProducts(Request $request,$id){
        $data= Product::find($id);
        $request->validate([
            'product_name'=>'required',
            'category_id'=>'required',
            'product_code'=>'required',
            'product_color'=>'required',
            'product_price'=>'required',
            'product_description'=>'required',

        ]);
        $url =Str::slug($request->product_name);
        if($request->hasFile('product_image'))
        {

         $image=$request->file('product_image');
         $currentDate=Carbon::now()->toDateString();
         $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();
         if(Storage::disk('public')->exists('images/admin/product/main/'.$data->product_image))
         {
            Storage::disk('public')->delete('images/admin/product/main/'.$data->product_image);
         }
         if(Storage::disk('public')->exists('images/admin/product/medium/'.$data->product_image))
         {
            Storage::disk('public')->delete('images/admin/product/medium/'.$data->product_image);
         }
         if(Storage::disk('public')->exists('images/admin/product/small/'.$data->product_image))
         {
            Storage::disk('public')->delete('images/admin/product/small/'.$data->product_image);
         }
         $productImage = Image::make($image)->resize(1040,1200)->stream();
         $MediumProductImage = Image::make($image)->resize(520,600)->stream();
         $SmallProductImage = Image::make($image)->resize(260,300)->stream();


         Storage::disk('public')->put('images/admin/product/main/'.$imageName,$productImage);
         Storage::disk('public')->put('images/admin/product/medium/'.$imageName,$MediumProductImage);
         Storage::disk('public')->put('images/admin/product/small/'.$imageName,$SmallProductImage);
        }else{
            $imageName= $data->product_image;
        }


        if($request->hasFile('product_video'))
        {
            if(Storage::disk('public')->exists('video/product_video/'.$data->product_video))
            {
                Storage::disk('public')->delete('video/product_video/'.$data->product_video);
            }
            $video=$request->file('product_video');
            $currentDate=Carbon::now()->toDateString();
            $videoName=$currentDate.'-'.uniqid().'-'.$video->getClientOriginalExtension();
            $video->move('storage/video/product_video/',$videoName);
            $data->product_video=$videoName;
        }else{
            $videoName= "default.mp4";
        }


        $categoryDetails=Category::find($request['category_id']);
        $data->section_id=$categoryDetails['section_id'];
        $data->category_id=$request->category_id;
        $data->product_name=$request->product_name;
        $data->product_price=$request->product_price;
        $data->product_code=$request->product_code;
        $data->product_color=$request->product_color;
        $data->wash_care=$request->wash_care;
        $data->meta_title=$request->meta_title;
        $data->meta_description=$request->meta_description;
        $data->meta_keywords=$request->meta_keywords;
        $data->fabric=$request->fabric;
        $data->occasion=$request->occasion;
        $data->sleeve=$request->sleeve;
        $data->pattern=$request->pattern;
        $data->fit=$request->fit;
        $data->brand_id=$request->brand;
        $data->url=$url;
        $data->product_discount=$request->product_discount;
        $data->product_weight=$request->product_weight;
        $data->product_description=$request->product_description;
        $data->product_image=$imageName;
        $data->is_featured=$request->is_featured;
        $data->status=1;
        $data->save();
        Alert::success('Success!','Product updated successfully!');
        return redirect()->route('product.index');

    }
    public function destroyProduct($id){
        $work=Product::find($id);
           if(Storage::disk('public')->exists('images/admin/product/main/'.$work->product_image))
            {
               Storage::disk('public')->delete('images/admin/product/main/'.$work->product_image);
            }
            if(Storage::disk('public')->exists('images/admin/product/medium/'.$work->product_image))
            {
               Storage::disk('public')->delete('images/admin/product/medium/'.$work->product_image);
            }
            if(Storage::disk('public')->exists('images/admin/product/small/'.$work->product_image))
            {
               Storage::disk('public')->delete('images/admin/product/'.$work->product_image);
            }

            $work->delete();
            Alert::success('Success!','Product deleted successfully!');
            return redirect()->route('product.index');
    }
    public function DeleteProductImage($id){
        $data= Product::find($id);

        if(Storage::disk('public')->exists('images/admin/product/main/'.$data->product_image))
        {
           Storage::disk('public')->delete('images/admin/product/main/'.$data->product_image);
        }
        if(Storage::disk('public')->exists('images/admin/product/medium/'.$data->product_image))
        {
           Storage::disk('public')->delete('images/admin/product/medium/'.$data->product_image);
        }
        if(Storage::disk('public')->exists('images/admin/product/small/'.$data->product_image))
        {
           Storage::disk('public')->delete('images/admin/product/small/'.$data->product_image);
        }
        Product::where('id',$id)->update(['product_image'=>'']);
        Alert::success('Success!','Product Image Deleted!');
        return redirect()->back();
    }

    public function DeleteProductVideo($id){
        $data= Product::find($id);

        $videoPath='storage/video/product_video/';

        if(fileExists($videoPath.$data->product_video)){
            unlink($videoPath.$data->product_video);
        }
        Product::where('id',$id)->update(['product_video'=>'']);
        Alert::success('Success!','Product Video Deleted!');
        return redirect()->back();
     }
}
