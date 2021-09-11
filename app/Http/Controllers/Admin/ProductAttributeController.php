<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductAttributeController extends Controller
{
    public function AddAttribute($id){
       $productData= Product::select('id','product_name','product_code','product_color','product_image')->with('attributes')->find($id);
       return view('backend.pages.attribute.create-attribute')->with('productData',$productData);
    }
    public function StoreAttribute(Request $request, $id){
         $data= $request->all();

         foreach($data['sku'] as $key=>$value){
            if(!empty($value)){
                // Check repeated attribute sku
                $checkSku= ProductAttribute::where(['sku'=>$value])->count();
                if($checkSku > 0){
                    Alert::error('Error!',"SKU must be unique!");
                    return redirect()->back();
                }
                $checkSize= ProductAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                if($checkSize > 0){
                    Alert::error('Error!',"This size already exist!");
                    return redirect()->back();
                }
                $attributeData=new ProductAttribute();
                $attributeData->product_id=$id;
                $attributeData->size=$data['size'][$key];
                $attributeData->price=$data['price'][$key];
                $attributeData->stock=$data['stock'][$key];
                $attributeData->sku=$value;
                $attributeData->status=1;
                $attributeData->save();
            }
         }

         Alert::success('Success!',"New attribute added!");
         return redirect()->back();
    }


    public function UpdateAttribute(Request $request,$id){
       $data=$request->all();
       foreach($data['attrId'] as $key=>$value){
          if(!empty($value)){
             ProductAttribute::where(['id'=>$data['attrId'][$key]])->update(['price'=>$data['price'][$key], 'stock'=>$data['stock'][$key]]);
          }
       }
        Alert::success('Success!',"Attribute updated!");
        return redirect()->back();
    }



    public function DeleteAttribute($id){
        ProductAttribute::find($id)->delete();
        Alert::success('Success!',"Attribute deleted!");
        return redirect()->back();
    }



    public function updateAttributeStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            ProductAttribute::where('id',$data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'attribute_id'=>$data['attribute_id']]);
         }
    }

    public function AddProductImage($id){
        $data= Product::with('images')->select('id','product_name','product_code','product_color','product_image')->find($id);
        //   dd($data);
        //   $data=json_decode(json_encode($data));
        return view('backend.pages.products.add_images')->with('productData',$data);
    }
    public function storeProductImage(Request $request, $id){

       if($request->hasFile('images')){

            $images=$request->file('images');
            foreach($images as $key=>$image){

                $productImages= new ProductImage;
                $currentDate=Carbon::now()->toDateString();
                $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();
                $productImage = Image::make($image)->resize(1040,1200)->stream();
                $MediumProductImage = Image::make($image)->resize(520,600)->stream();
                $SmallProductImage = Image::make($image)->resize(260,300)->stream();

                Storage::disk('public')->put('images/admin/product/main/'.$imageName,$productImage);
                Storage::disk('public')->put('images/admin/product/medium/'.$imageName,$MediumProductImage);
                Storage::disk('public')->put('images/admin/product/small/'.$imageName,$SmallProductImage);
                $productImages->image=$imageName;
                $productImages->status=1;
                $productImages->product_id=$id;
                $productImages->save();

            }

        Alert::success('Success!',"Images Added!");
        return redirect()->back();
        }

    }

    public function updateImageStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            ProductImage::where('id',$data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'image_id'=>$data['image_id']]);
         }
    }
    public function DeleteProductImages($id){

            $data= ProductImage::find($id);
            if(Storage::disk('public')->exists('images/admin/product/main/'.$data->image))
            {
               Storage::disk('public')->delete('images/admin/product/main/'.$data->image);
            }
            if(Storage::disk('public')->exists('images/admin/product/medium/'.$data->image))
            {
               Storage::disk('public')->delete('images/admin/product/medium/'.$data->image);
            }
            if(Storage::disk('public')->exists('images/admin/product/small/'.$data->image))
            {
               Storage::disk('public')->delete('images/admin/product/small/'.$data->image);
            }
            $data->delete();
            Alert::success('Success!','Product Image Deleted!');
            return redirect()->back();
    }
}
