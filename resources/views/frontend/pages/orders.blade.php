
@extends('frontend.layouts.app')

@push('stylesheet')

@endpush

@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">lOrders</li>
    </ul>
	<h3>Your Orders</h3>
	<hr class="soft"/>

	<div class="row">
		<div class="span8">
             <table class="table table-striped table-bordered">
                 <tr>
                     <th>Order ID</th>
                     <th>Order Products</th>
                     <th>Payment Method</th>
                     <th>Total Cost</th>
                     <th>Created On</th>
                     <th>Details</th>
                 </tr>
                 @foreach ($orders as $order)
                 <tr>
                    <td>{{$order['id']}}</td>
                    <td>
                        @foreach ($order['orders_products'] as $products)
                            {{$products['product_code']}} <br>
                        @endforeach
                    </td>
                    <td>{{$order['payment_method']}}</td>
                    <td>{{$order['grand_total']}}</td>
                    <td>{{ date('d-m-y',strtotime($order['created_at'])) }}</td>
                    <td><a href="{{url('single_order/'.$order['id'])}}">#View details</a></td>
                 </tr>
                 @endforeach
             </table>
		</div>
	</div>

</div>
@endsection
