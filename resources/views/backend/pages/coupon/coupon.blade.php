@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Coupons</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Coupons</a></li>
                <li class="breadcrumb-item active">Table</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <a class="btn btn-success btn-sm float-right" href="{{url('admin/coupon/create')}}">Add Coupon</a>
                  <h3 class="card-title">Coupons!</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th> ID</th>
                      <th>Code</th>
                      <th>Coupon type</th>
                      <th>Amount</th>
                      <th>Expire Date</th>
                      <th>Actions</th>
                      <th>Coupons Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                        <tr >
                            <td>{{$coupon->id}}</td>
                            <td>{{$coupon->coupon_code}}</td>
                            <td>{{$coupon->coupon_type}}</td>
                            <td>{{$coupon->amount}}
                                @if ($coupon->amount_type=='percentage')
                                &nbsp;%
                                 @else
                                 &nbsp;INR
                                @endif
                            </td>
                            <td>{{$coupon->expiry_date}}</td>
                            <td><a href="#" class="confirmDelete"  record="coupon" recordid="{{$coupon->id}}">Delete</a> | <a href="{{url('admin/coupon/edit',$coupon->id)}}"> Edit</a></td>
                            @if ($coupon->status== 1)
                            <td class="text-center"><a href="javascript:void(0)" class="updateCouponStatus" id="coupon-{{$coupon->id}}" coupon_id="{{$coupon->id}}"><i class="fas fa-toggle-on" status="Active"></i></a></td>
                            @else
                            <td class="text-center"><a href="javascript:void(0)" class="updateCouponStatus" id="coupon-{{$coupon->id}}" coupon_id="{{$coupon->id}}"><i class="fas fa-toggle-off" status="Disabled"></i></a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
</div>
@show




