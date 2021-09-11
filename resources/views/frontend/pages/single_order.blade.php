<?php use App\Models\Product; ?>
@extends('frontend.layouts.app')

@push('stylesheet')

@endpush

@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
		<li class="active">Order details</li>
    </ul>
	<h3>Your Order details</h3>
	<hr class="soft"/>
    <div class="row">
		<div class="span4">
             <table class="table table-striped table-bordered">
                 <tr>
                    <td colspan="2"><strong>Order Details</strong></td>
                 </tr>
                 <tr>
                     <td>Order Date</td>
                     <td>{{ date('d-m-y',strtotime($orders['created_at'])) }}</td>
                 </tr>
                 <tr>
                    <td>Order Status</td>
                    <td>{{$orders['order_status']}}</td>
                </tr>
                <tr>
                     <td>Order Total</td>
                     <td>{{$orders['grand_total']}}</td>
                 </tr>
                 <tr>
                    <td>Shipping charges</td>
                    <td>INR {{$orders['shipping_charges']}}</td>
                </tr>
                <tr>
                    <td>Coupon Code</td>
                    <td>
                        @if ($orders['coupon_code']=='')
                            No coupon!
                        @else
                        {{$orders['coupon_code']}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Coupon Amount</td>
                    <td>{{$orders['coupon_amount']}}</td>
                </tr>
                <tr>
                    <td>Payment Method</td>
                    <td>{{$orders['payment_method']}}</td>
                </tr>
             </table>
		</div>
        <div class="span4">
            <table class="table table-striped table-bordered">
                <tr>
                   <td colspan="2">Delivery Address</td>
                </tr>
                <tr>
                    <td >Name</td>
                    <td>{{$orders['name']}}</td>
                 </tr>
                 <tr>
                    <td >Address</td>
                    <td>{{$orders['address']}}</td>
                 </tr>
                 <tr>
                    <td >City</td>
                    <td>{{$orders['city']}}</td>
                 </tr>
                 <tr>
                    <td >State</td>
                    <td>{{$orders['state']}}</td>
                 </tr>
                  <tr>
                    <td>Country</td>
                    <td>{{$orders['country']}}</td>
                 </tr>
                 <tr>
                    <td >Mobile</td>
                    <td>{{$orders['mobile']}}</td>
                 </tr>
                 <tr>
                    <td >Pincode</td>
                    <td>{{$orders['pincode']}}</td>
                 </tr>
            </table>
       </div>
	</div>
	<div class="row">
		<div class="span8">
             <table class="table table-striped table-bordered">
                 <tr>
                     <th>Product Image</th>
                     <th>Product Code</th>
                     <th>Order Name</th>
                     <th>Payment Size</th>
                     <th>Total Color</th>
                     <th>Created Qty</th>
                 </tr>
                 @foreach ($orders['orders_products'] as $order)
                 <tr>
                     <td>
                         <?php $image= Product::getProductImage($order['product_id']);?>
                        <a href="{{url('single-product/'.$order['product_id'])}}" target="__blank"> <img style="height: 60px; width:50px" src="{{asset('storage/images/admin/product/small/'.$image)}}"></a>
                    </td>
                    <td>{{$order['product_code']}}</td>
                    <td>{{$order['product_name']}}</td>
                    <td>{{$order['product_size']}}</td>
                    <td>{{ $order['product_color'] }}</td>
                    <td>{{$order['product_qty']}}</td>
                 </tr>
                 @endforeach
             </table>
		</div>
	</div>

</div>
@endsection
