<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    public static function Cart(){
        if(Auth::check()){
            $getCartItems =Cart::with(['product'=>function($query){
                $query->select('id','category_id','product_name','product_code','product_image','product_color');
            }])->where(['user_id'=>Auth::user()->id])->latest()->get()->toArray();
        }else{
            $getCartItems =Cart::with(['product'=>function($query){
                $query->select('id','category_id','product_name','product_code','product_image','product_color');
            }])->where(['session_id'=>Session::get('session_id')])->latest()->get()->toArray();
        }
        return $getCartItems;
    }
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public static function productAttribute($product_id, $size){
        $getAttribute= ProductAttribute::select('price')->where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
        return $getAttribute['price'];
    }
}
