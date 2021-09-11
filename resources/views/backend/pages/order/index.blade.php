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
        <div class="row m-5">
            <div class="span8">
                 <table class="table table-striped table-bordered">
                     <tr>
                         <th>O. ID</th>
                         <th>Date</th>
                         <th>C.Name</th>
                         <th>C. Email</th>
                         <th>Products</th>
                         <th>O.Amount</th>
                         <th>O.Status</th>
                         <th>P. Method</th>
                         <th>Actions</th>
                     </tr>
                     @foreach ($orders as $order)
                     <tr>
                        <td>{{$order['id']}}</td>
                        <td>{{ date('d-m-y',strtotime($order['created_at'])) }}</td>
                        <td>{{$order['name']}}</td>
                        <td>{{$order['email']}}</td>
                        <td>
                            @foreach ($order['orders_products'] as $products)
                                {{$products['product_code']}} ({{$products['product_qty']}}) <br>
                            @endforeach
                        </td>
                        <td>{{$order['grand_total']}}</td>
                        <td>{{$order['order_status']}}</td>
                        <td>{{$order['payment_method']}}</td>
                        <td>
                           <a title="View Order Details "href="{{url('admin/order/view',$order['id'])}}"><i class="fas fa-eye"></i></a> &nbsp;
                           @if ($order['order_status']== 'Shipped' || $order['order_status']== 'Delivered')
                           <a title="View Order Invoice "href="{{url('admin/order/invoice',$order['id'])}}" target="blank"><i class="fas fa-print"></i></a>&nbsp;
                           <a title="View Order Invoice "href="{{url('admin/print/invoice',$order['id'])}}" target="blank"><i class="fas fa-file-pdf"></i></a>
                           @endif
                        </td>
                     </tr>
                     @endforeach
                 </table>
            </div>
          </div>
    </div>
</div>

@show




