<?php use App\Models\Product; ?>
@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Customers Orders</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Orders</a></li>
                <li class="breadcrumb-item active">Orders Table</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
	<hr class="soft"/>
    <div class="row">
		<div class="span4 m-lg-4">
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
                     <td>{{$orders['grand_total']}} /=</td>
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
                    @if ($orders['coupon_code']=='')
                    <td>0 /= </td>
                    @else
                    <td>{{$orders['coupon_amount']}}</td>
                    @endif

                </tr>
                <tr>
                    <td>Payment Method</td>
                    <td>{{$orders['payment_method']}}</td>
                </tr>
             </table>
		</div>
        <div class="span4 m-lg-4">
            <table class="table table-striped table-bordered">
                <tr>
                   <td colspan="2">Delivery Address</td>
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
        <div class="span4 m-lg-4">
            <table class="table table-striped table-bordered">
                <tr>
                   <td colspan="2">User Details</td>
                </tr>
                <tr>
                    <td >Name</td>
                    <td>{{$userDetails['name']}}</td>
                 </tr>
                 <tr>
                    <td >Address</td>
                    <td>{{$userDetails['email']}}</td>
                 </tr>
                 <tr>
                    <td >Mobile</td>
                    <td>{{$userDetails['mobile']}}</td>
                 </tr>
            </table>

            <table class="table table-striped table-bordered">
                <tr>
                    <td>Status</td>
                    <td>
                       <form action="{{url('admin/update-order-status')}}" method="post"> @csrf
                           <input type="hidden" name="id" value="{{$orders['id']}}">
                            <select style="width: 181px" name="order_status" id="order_status" required>
                                <option >Select Option</option>
                                @foreach ($statuses as $status)
                                <option name="order_satus" value="{{$status['name']}}" >{{$status['name']}}</option>
                                @endforeach
                            </select> &nbsp; &nbsp; <br>
                            <input type="text" name="courier_name" id="courier_name" placeholder="Courier Name" class="my-2" value={{$orders['courier_name']}}> <br>
                            <input type="text" name="tracking_number" id="tracking_number" placeholder="Tacking Number"class="mb-2" value={{$orders['tracking_number']}}> <br>
                            <button type="submit" class="btn btn-outline-warning btn-sm">Update</button>
                       </form>
                    </td>
                </tr>
            </table>
            <table class="table table-striped table-bordered">
                <tr>
                   <td colspan="2"><strong>Order Logs</strong></td>
                </tr>
                 @foreach ($histories as $history)
                    <tr colspan="2">
                        <td >
                            <strong>{{$history['order_status']}}</strong><br>
                            {{date('F j, y | g:i, a',strtotime($history['created_at']))}}
                        </td>
                    </tr>
                 @endforeach
            </table>
        </div>
	<div class="row m-5">
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
</div>

@show




