<?php
use App\Models\Product;
$total_price = 0;
?>
@extends('frontend.layouts.app')

@push('stylesheet')

@endpush

@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
    </ul>
    <h3> THANK YOU FOR YOUR ORDER!</h3>
    <div align="center">
        <h3>
            Your order has placed successfully!
        </h3>
        <p>Your order id ::{{Session::get('order_id')}} <br> You need to pay  {{Session::get('grand_total')}}/-</p>
    </div>
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="business" value="seller@designerfotos.com">
        <input type="hidden" name="item_name" value="hat">
        <input type="hidden" name="item_number" value="123">
        <input type="hidden" name="amount" value="15.00">
        <input type="hidden" name="first_name" value="John">
        <input type="hidden" name="last_name" value="Doe">
        <input type="hidden" name="address1" value="9 Elm Street">
        <input type="hidden" name="address2" value="Apt 5">
        <input type="hidden" name="city" value="Berwyn">
        <input type="hidden" name="state" value="PA">
        <input type="hidden" name="zip" value="19312">
        <input type="hidden" name="email" value="jdoe@zyzzyu.com">
        <input type="image"  name="submit"
          src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
          alt="PayPal - The safer, easier way to pay online">
    </form>
</div>
@endsection
<?php
Session::forget('grand_total');
Session::forget('order_id');
Session::forget('couponAmount');
Session::forget('getCartItems');
Session::forget('countCartItems');
?>
