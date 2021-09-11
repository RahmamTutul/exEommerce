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
		<li class="active"> CHECKOUT </li>
    </ul>
	<h3>  CHECKOUT [ <small><span class="cartCountItems">{{  countCartItems()}}</span> Item(s) </small>]<a href="products.html" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>

<form action="{{url('/checkout')}}" id="checkoutForm" name="checkoutForm" method="POST">
    @csrf
    <table class="table table-bordered">
        <tr>
            <td> <strong>Delivery Addresses |</strong> <a href="{{url('/add-delivery-address')}}">Add New</a></td>
        </tr>
		<tbody>
            @foreach ($deliveryAddresses as $deliveryAddress)
            <tr>
                <td>
                    <div class="control-group" style="float: left; margin-right:10px; margin-top:-2px">
                        <input type="radio" id="address{{$deliveryAddress['id']}}" name="address_id" value="{{$deliveryAddress['id']}}" shipping_charge= "{{$deliveryAddress['shipping_charges']}}" total_price ="{{$total}}" coupon_amount = {{Session::get('couponAmount')}}>
                    </div>
                    <div class="control-group">
                        <label class="control-label">{{$deliveryAddress['address']}},{{$deliveryAddress['city']}},{{$deliveryAddress['state']}},{{$deliveryAddress['country']}},
                    </div>
                </td>
                <td><a href="{{url('/edit-address',$deliveryAddress['id'])}}">Edit</a> | <a class="deleteAddress" href="{{url('/delete-address', $deliveryAddress['id'])}}">Delete</a></td>
              </tr>
            @endforeach
		</tbody>
	</table>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product</th>
            <th colspan="2">Description</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Discount</th>
            <th>Sub Total</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($userCartItems as $getCartItem)
                <?php $getPrice=Product::getAttrDiscount($getCartItem['product_id'],$getCartItem['size']) ?>
                <?php $total_price = $total_price + ($getPrice['final_price'] * $getCartItem['quantity']) ?>
            <tr>
                <td> <img width="60" src="{{asset('storage/images/admin/product/small/'.$getCartItem['product']['product_image'])}}" alt=""/></td>
                <td colspan="2">{{$getCartItem['product']['product_name']}} ({{$getCartItem['product']['product_code']}})<br/>Color : {{$getCartItem['product']['product_color']}}<br/>Size : {{$getCartItem['size']}}</td>
                <td>{{$getCartItem['quantity']}} </td>
                <td>Rs.{{ $getPrice['product_price'] * $getCartItem['quantity']}}</td>
                <td>Rs.{{ $getPrice['discount'] * $getCartItem['quantity']}}</td>
                <td>Rs.{{$getCartItem['quantity'] * $getPrice['final_price']}}</td>
            </tr>
            @endforeach

            <tr>
                <td colspan="6" style="text-align:right">Sub Total Price:	</td>
                <td>Rs. {{$total_price}}</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align:right">Coupon Discount:	</td>
                <td class="couponAmount">
                    @if (Session::has('couponAmount'))
                        Rs. {{Session::get('couponAmount')}}
                    @else
                        Rs. 0
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align:right">Shipping Charge:	</td>
                <td class="shippingCharge">Rs. 0</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align:right"><strong>TOTAL Rs.</strong></td>
                <td class="label label-important grand_total" style="display:block"> <strong class=" grandTotal"> Rs. {{$grand_total= $total_price -Session::get('couponAmount')}} </strong></td>
                <?php Session::put('grand_total',$grand_total)?>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered">
		<tbody>
		  <tr>
			<td>
                <div class="control-group">
                    <label class="control-label"><strong> PYMENT GATEWAY: </strong> </label>
                    <div class="controls">
                        <span>
                            <input type="radio" name="payment_gateway" id="COD" value="COD"> <strong>COD</strong> &nbsp; &nbsp;
                        </span>
                        <span>
                            <input type="radio" name="payment_gateway" id="Paypal" value="Paypal"><strong>Paypal</strong>
                        </span>

                    </div>
                </div>
			</td>
		  </tr>

		</tbody>
	</table>
	<a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Back to cart </a>
	<button type="submit"  class="btn btn-large pull-right">PLACE ORDER <i class="icon-arrow-right"></i></button>
</form>
</div>
</div></div>
@endsection
