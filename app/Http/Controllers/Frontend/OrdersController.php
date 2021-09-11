<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function Orders(){
      $orders = Order::with('orders_products')->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
    //   dd($orders);die;
      return view('frontend.pages.orders')->with(compact('orders'));
    }
    public function SingleOrder($id){
        $orders = Order::with('orders_products')->where('id',$id)->first()->toArray();
        return view('frontend.pages.single_order')->with(compact('orders'));
    }
}
