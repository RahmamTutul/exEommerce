<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function Category(){
       return $this->belongsTo('App\Models\Category','category_id');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brands','brand_id');
     }
    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }
    public function attributes(){
        return $this->hasMany('App\Models\ProductAttribute');
    }
    public function images(){
        return $this->hasMany('App\Models\ProductImage');
    }
    public static function productFilter(){
        $productFilter['fabricArray']=array('Cotton','Polyester','Mixed','Wool');
        $productFilter['patternArray']=array('Checked','Plain','Printed','Self','Solid');
        $productFilter['fitArray']=array('Regular','Slim');
        $productFilter['sleeveArray']=array('full','half','sleeve less');
        $productFilter['occasionArray']=array('Casual','Formal');
        return $productFilter;
    }
    public static function getProductDiscount($product_id){
        $proDetails= Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first()->toArray();
         $catDetails= Category::select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();
         if($proDetails['product_discount']>0){
            $discount=$proDetails['product_price'] - ($proDetails['product_price'] * $proDetails['product_discount'] / 100);
         }else if($catDetails['category_discount']>0){
            $discount=$proDetails['product_price'] - ($proDetails['product_price'] * $catDetails['category_discount'] / 100);
         }else{
             $discount= 0;
         }
         return $discount;
    }
    public static function getAttrDiscount($product_id, $size){
        $proAttrDetails= ProductAttribute::select('price','size')->where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
        $proDetails= Product::select('product_discount','category_id')->where('id',$product_id)->first()->toArray();
        $catDetails= Category::select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();

        if($proDetails['product_discount']>0){
            $final_price=$proAttrDetails['price'] - ($proAttrDetails['price'] * $proDetails['product_discount'] / 100);
            $discount= $final_price- $proAttrDetails['price'];
         }else if($catDetails['category_discount']>0){
            $final_price=$proAttrDetails['price'] - ($proAttrDetails['price'] * $catDetails['category_discount'] / 100);
            $discount= $final_price- $proAttrDetails['price'];
         }else{
             $final_price = $proAttrDetails['price'];
             $discount= 0;
         }

         return array('product_price'=>$proAttrDetails['price'], 'final_price'=>$final_price, 'discount'=>$discount);
    }

    public static function getProductImage($product_id){
        $getProductImage = Product::select('product_image')->where('id',$product_id)->first()->toArray();
        return $getProductImage['product_image'];
    }

}
