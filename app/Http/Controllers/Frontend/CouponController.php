<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class CouponController extends Controller
{
    public function applyCoupon(Request $request){
          if($request->ajax()){
              $data= $request->all();
            //   Check for coupon is available or not
            $getCartItems=Cart::Cart();
            $couponCount = Coupon::where('coupon_code',$data['code'])->count();
            if($couponCount==0){
                $getCartItems=Cart::Cart();
                $countCartItems= countCartItems();
                Session::forget('getCartItems');
                Session::forget('countCartItems');
                return response()->json([
                    'status'=>false,
                    'massage'=>'Coupon is not valid!',
                    'countCartItems'=> $countCartItems,
                    'view'=>(String)View::make('frontend.pages.cart_ajax')->with(compact('getCartItems'))
                ]);
            }else{

                //Get Coupon details
                $couponDetails= Coupon::where('coupon_code',$data['code'])->first();

                // Check coupon is active or not

                if($couponDetails->status==0){
                     $massage= "This coupon is not available!";
                }
                //  Check coupon expiry date
                 $expiry_date =$couponDetails->expiry_date;
                //   find current date
                $current_date = date('Y-m-d');
                if($expiry_date < $current_date){
                    $massage ="Coupon has been expired!";
                }
                // Check coupon is multiple times or single time

                if($couponDetails->coupon_type== 'Single times'){
                    //    Check Orders table if the coupon code is already used or not
                    $couponDetails= Coupon::where(['coupon_code',$data['code'], 'user_id'=>Auth::user()->id])->count();
                    if($couponDetails>=1){
                        $massage ='Error! Coupon code is already used!';
                        Alert::success('Error!','Coupon code is already used!');
                        return redirect()->back();
                    }
                }
                // Check user is accessible for this coupon or not
                // first get all selected user for this coupon

                if(!empty($couponDetails->users)){
                $userArray = explode(",", $couponDetails->users);

                // Get users id for all selected users

                foreach($userArray as $key=> $user){
                    //  Get usr ID
                    $getUserId = User::select('id')->where('email', $user)->first()->toArray();
                    $userId[]= $getUserId['id'];

                }
            }
                // Check categories
                $categoryArray= explode(',',$couponDetails->categories);
                // Get cart items
                $cartItems = Cart::Cart();



                foreach($cartItems as $key=>$item){
                    $total_amount = 0;
                    if(!in_array($item['product']['category_id'], $categoryArray)){
                        $massage= "Coupon is not valid for this product!";
                    };

                    if(!empty($couponDetails->users)){
                        if(!in_array($item['user_id'], $userId)){
                            $massage= "This coupon is not for you!";
                        };
                    }
                   $attrprice =Product::getAttrDiscount($item['product_id'], $item['size']);
                   $total_amount = $total_amount + ($attrprice['final_price'] * $item['quantity']);
                }

                if(isset($massage)){
                    $getCartItems=Cart::Cart();
                    $countCartItems= countCartItems();
                    return response()->json([
                        'status'=>false,
                        'massage'=>$massage,
                        'countCartItems'=> $countCartItems,
                        'view'=>(String)View::make('frontend.pages.cart_ajax')->with(compact('getCartItems'))
                    ]);
                }else{
                    $massage = "Coupon is successfully applied!";

                    if($couponDetails->amount_type == "INR"){
                      $couponAmount = $couponDetails->amount;

                    }else{
                        $couponAmount = $total_amount * ($couponDetails->amount/100 );

                    }
                    $grandTotal =$total_amount- $couponAmount;
                    // Add coupon and amount in Session variable
                    Session::put("couponAmount",$couponAmount);
                    Session::put("couponCode",$data['code']);

                    $getCartItems=Cart::Cart();
                    $countCartItems= countCartItems();
                    return response()->json([
                        'status'=>true,
                        'couponAmount'=>$couponAmount,
                        'grandTotal'=>$grandTotal,
                        'massage'=>$massage,
                        'countCartItems'=> $countCartItems,
                        'view'=>(String)View::make('frontend.pages.cart_ajax')->with(compact('getCartItems'))
                    ]);
                    $massage ="Coupon successfully applied!";

                }
            }

          }
    }
}
