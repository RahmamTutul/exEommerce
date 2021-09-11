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
</div>
@endsection
<?php
Session::forget('grand_total');
Session::forget('order_id');
Session::forget('couponAmount');
Session::forget('getCartItems');
Session::forget('countCartItems');
?>
