@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Shipping Charges</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Shipping Charges</a></li>
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
                  <h3 class="card-title">Shippping Charges!</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Country</th>
                      <th>1 To 500g</th>
                      <th>To 1000g</th>
                      <th>To 2000g</th>
                      <th>To 3000g</th>
                      <th>To 4000g</th>
                      <th>To 5000g</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($shipping_charges as $charge)
                        <tr >
                            <td>{{$charge['id']}}</td>
                            <td>{{$charge['country']}}</td>
                            <td>INR {{$charge['0_500g']}}</td>
                            <td>INR {{$charge['501_1000g']}}</td>
                            <td>INR {{$charge['1001_2000g']}}</td>
                            <td>INR {{$charge['2001_3000g']}}</td>
                            <td>INR {{$charge['3001_4000g']}}</td>
                            <td>INR {{$charge['above_5000g']}}</td>
                            @if ($charge['status']== 1)
                            <td class="text-center"><a href="javascript:void(0)" class="updateShippingStatus" id="shipping-{{$charge['id']}}" shipping_id="{{$charge['id']}}"><i class="fas fa-toggle-on" status="Active"></i></a></td>
                            @else
                            <td class="text-center"><a href="javascript:void(0)" class="updateShippingStatus" id="shipping-{{$charge['id']}}" shipping_id="{{$charge['id']}}"><i class="fas fa-toggle-off" status="Disabled"></i></a></td>
                            @endif
                            <td><a href="{{url('admin/shipping/edit',$charge['id'])}}"> Edit</a></td>

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




