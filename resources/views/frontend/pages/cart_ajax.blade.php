<?php
use App\Models\Product;
$total_price = 0;
?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Product</th>
        <th colspan="2">Description</th>
        <th>Quantity/Update</th>
        <th>Unit Price</th>
        <th>Discount</th>
        <th>Sub Total</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($getCartItems as $getCartItem)
            <?php $getPrice=Product::getAttrDiscount($getCartItem['product_id'],$getCartItem['size']) ?>
            <?php $total_price = $total_price + ($getPrice['final_price'] * $getCartItem['quantity']) ?>
        <tr>
            <td> <img width="60" src="{{asset('storage/images/admin/product/small/'.$getCartItem['product']['product_image'])}}" alt=""/></td>
            <td colspan="2">{{$getCartItem['product']['product_name']}} ({{$getCartItem['product']['product_code']}})<br/>Color : {{$getCartItem['product']['product_color']}}<br/>Size : {{$getCartItem['size']}}</td>
            <td>
            <div class="input-append">
                <input class="span1" style="max-width:34px" value="{{$getCartItem['quantity']}}" id="appendedInputButtons" size="16" type="text">
                <button class="btn btnItemUpdate qtyMinus" type="button" data-cartid="{{$getCartItem['id']}}"><i class="icon-minus"></i></button>
                <button class="btn btnItemUpdate qtyPlus" type="button" data-cartid="{{$getCartItem['id']}}"><i class="icon-plus"></i></button>
                <button class="btn btn-danger btnItemDelete" type="button"  data-cartid="{{$getCartItem['id']}}"><i class="icon-remove icon-white"></i>
                </button>
            </div>
            </td>
            <td>Rs.{{ $getPrice['product_price'] * $getCartItem['quantity']}}</td>
            <td>Rs.{{ $getPrice['discount'] * $getCartItem['quantity']}}</td>
            <td>Rs.{{$getCartItem['quantity'] * $getPrice['final_price']}}</td>
        </tr>
        @endforeach

        <tr>
            <td colspan="6" style="text-align:right">Grand Total Price:	</td>
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
            <td colspan="6" style="text-align:right"><strong>TOTAL Rs.</strong></td>
            <td class="label label-important" style="display:block"> <strong class=" grandTotal"> Rs. {{$total_price- Session::get('couponAmount')}} </strong></td>
        </tr>
    </tbody>
</table>
