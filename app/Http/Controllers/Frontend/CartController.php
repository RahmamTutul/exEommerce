<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductAttribute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function addToCart(Request $request){
       $data=$request->all();
       if($data['quantity']<=0){
        $data['quantity']=1;
       }
       $getProductAttribute=ProductAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first()->toArray();
       if( $getProductAttribute['stock']<$data['quantity']){
        Alert::error('Sorry!','Requested quantity are not available!');
        return redirect()->back();
       };

       $session_id=Session::get('session_id');
       if(empty($session_id)){
           $session_id= Session::getId();
           Session::put('session_id',$session_id);
       }
    //    Cart::insert(['session_id'=>$session_id,'quantity'=>$data['quantity'], 'product_id'=>$data['product_id'],'size'=>$data['size'],]);
    //    dd($data);

    // If user is logged in
    if(Auth::check()){
        $cartCount = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'user_id'=>Auth::user()->id])->count();
    }else{
        $cartCount = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>Session::get('session_id')])->count();
    }
    // Check if the cart item is already exist or not

    if($cartCount>0){
        Alert::error('Sorry!','Item already exist!');
        return redirect()->back();
    }
    if(Auth::check()){
        $user_id= Auth::user()->id;
    }else{
        $user_id= 0;
    }
      $cart = new Cart;
      $cart->session_id=$session_id;
      $cart->user_id=$user_id;
      $cart->product_id=$data['product_id'];
      $cart->size=$data['size'];
      $cart->quantity=$data['quantity'];
      $cart->save();
      Alert::success('Success!','Cart item added!');
      return redirect()->route('cart');
    }
    public function showCart(){
        $getCartItems=Cart::Cart();
        // dd($getCartItem);
        return view('frontend.pages.cart')->with(compact('getCartItems'));
    }
    public function UpdateCartItemQty(Request $request){
       if($request->ajax()){
           $data=$request->all();
           $cartDetails= Cart::find($data['cartId']);
           $availableStock = ProductAttribute::select('stock')->where(['product_id'=>$cartDetails['product_id'], 'size'=>$cartDetails['size'],'status'=>1])->first()->toArray();
        //    Check stock is available or not
           if( $data['qty'] > $availableStock['stock']){
               $getCartItems=Cart::Cart();
               return response()->json([
                   'status'=>false,
                   'view'=>(String)View::make('frontend.pages.cart_ajax')->with(compact('getCartItems'))
               ]);
           }

            Cart::where('id',$data['cartId'])->update(['quantity'=>$data['qty']]);
            $getCartItems=Cart::Cart();
            $countCartItems= countCartItems();
            return response()->json([
                    'status'=>true,
                    'countCartItems'=> $countCartItems,
                    'view'=>(String)View::make('frontend.pages.cart_ajax')->with(compact('getCartItems', 'countCartItems'))
                ]);
       }
    }

    public function DeleteCartItem(Request $request){
        if($request->ajax()){
           $data= $request->all();
           Cart::where('id',$data['cartId'])->delete();
           $getCartItems=Cart::Cart();
           return response()->json([
                'view'=>(String)View::make('frontend.pages.cart_ajax')->with(compact('getCartItems')),
            ]);
        }
    }
}
