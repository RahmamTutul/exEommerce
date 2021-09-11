<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\OrdersProducts;
use App\Models\Product;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function Checkout(Request $request){
        $userCartItems= Cart::Cart();

        if(count($userCartItems)== 0){
            Alert::error('Sorry!','Your have no item to checkout!');
            return redirect()->route('cart');
        }
        $deliveryAddresses = DeliveryAddress::DeliveryAddresses();

        foreach ($deliveryAddresses as $key => $value) {
           $shipping_charges = ShippingCharge::getShippingCharges($value['country']);
           $deliveryAddresses[$key]['shipping_charges'] = $shipping_charges;
        }
          $total=0;
         foreach ($userCartItems as $getCartItem) {
            $getPrice=Product::getAttrDiscount($getCartItem['product_id'],$getCartItem['size']);
            $total = $total + ($getPrice['final_price'] * $getCartItem['quantity']);
         }
        //  dd($total);
        if($request->isMethod('Post')){
          $data = $request->all();
        //   $request->validate([
        //       'address_id'=>'required',
        //       'payment_method'=>'required'
        //   ]);

          if($data['payment_gateway']=="COD"){
              $payment_method = "COD";
          }else{
            echo "Coming Soon!"; die;
            $payment_method = "Prepaid";
          }
        //   getting data from delivery address table
        $deliveryAddress = DeliveryAddress::where('id',$data['address_id'])->first()->toArray();

        // Get shipping charges
        $shippingCharge = ShippingCharge::getShippingCharges($deliveryAddress['country']);

        // Count grand total

        $grand_total = Session::get('grand_total') + $shippingCharge - Session::get('couponAmount');

        Session::put('grand_total',$grand_total);

        //   insert data into order table
        $order = New Order;
        $order->user_id = Auth::user()->id;
        $order->name = $deliveryAddress['name'];
        $order->address = $deliveryAddress['address'];
        $order->city = $deliveryAddress['city'];
        $order->state = $deliveryAddress['state'];
        $order->country = $deliveryAddress['country'];
        $order->pincode = $deliveryAddress['pincode'];
        $order->mobile = $deliveryAddress['mobile'];
        $order->email = Auth::user()->email;
        $order->shipping_charges =$shippingCharge;
        $order->coupon_code = Session::get('couponCode');
        $order->coupon_amount = Session::get('couponAmount');
        $order->order_status = "New";
        $order->payment_method = $payment_method;
        $order->payment_gateway = $data['payment_gateway'];
        $order->grand_total = $grand_total;
        // dd($order);die;
        $order->save();

        // Get last order id
        $order_id = DB::getPdo()->lastInsertId();

        // Get cart Items from this user
        $cartItems =Cart::where('user_id',Auth::user()->id)->get()->toArray();
        foreach ($cartItems as $key =>$cartItem) {
        //    Insert data into ordersProducts table
        $cart_products = New OrdersProducts;
        $cart_products->order_id = $order_id;
        $cart_products->user_id = Auth::user()->id;

        // Get products Details from products table

        $product_details = Product::select('product_code','product_name','product_color')->where('id',$cartItem['product_id'])->first()->toArray();

        $cart_products->product_id= $cartItem['product_id'];
        $cart_products->product_name= $product_details['product_name'];
        $cart_products->product_color= $product_details['product_color'];
        $cart_products->product_code= $product_details['product_code'];
        $cart_products->product_size= $cartItem['size'];
        $getDiscountedPrice = Product::getAttrDiscount($cartItem['product_id'],$cartItem['size']);
        $cart_products->product_price = $getDiscountedPrice['final_price'];
        $cart_products->product_qty = $cartItem['quantity'];
        // dd($cart_products);
        $cart_products->save();

        }
        // Insert Order Id in session
        Session::put('order_id',$order_id);

        if($data['payment_gateway']=="COD"){
            return redirect('/thanks');
        }elseif($data['payment_gateway']=="Paypal"){
            return redirect('paypal');
        }
        else{
          echo "Prepaid method will coming soon!"; die;
        }

        DB::commit();
        }

       return view('frontend.pages.checkout')->with(compact('userCartItems','deliveryAddresses','total'));
    }
    public function Thanks(){
        if (Session::has('order_id')) {
            // Delete cart Items from this user
            $order_id= Session::get('order_id');
            // $orderDetails= Order::with('orders_products')->where('id',$order_id)->first()->toArray();
            // $email = Auth::user()->email;
            // $massageData=[
            //     'email'=>$email,
            //     'name'=>Auth::user()->name,
            //     'order_id'=>$order_id,
            //     'orderDetails'=>$orderDetails,
            //     'grand_total'=>Session::get('grand_total'),
            // ];

            // Mail::send('frontend.emails.order',$massageData,function($massage) use($email){
            //     $massage->to($email)->subject('Yor Order has been placed!');
            // });
            $orderDetails= Order::where('id',Session::get('order_id'))->first()->toArray();
            $nameArr= explode('',$orderDetails['name']);
            Cart::where('user_id', Auth::user()->id)->delete();
            return view("frontend.pages.paypal")->with(compact('orderDetails','nameArr'));
        }else{
            return redirect('/all-cart');
        }

    }


}
