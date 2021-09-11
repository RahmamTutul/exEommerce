@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Coupon</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Charge</li>
              </ol>
            </div>
          </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-6 m-auto">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Shipping Charage</h3>
                </div>
                @if (count($errors) > 0)
                  <div class = "alert text-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                  </div>
                 @endif
                <form role="form" action="{{url('admin/shipping/edit/'.$shipping_charges['id'])}}" method="POST">
                  @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="coupon_type">Country Name</label><br>
                            <input type="" class="form-control"   name="country" value="{{$shipping_charges['country']}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="coupon_type">Shipping Charge (0-500g)</label><br>
                            <input type="" class="form-control"  name="0_500g" @if (!empty($shipping_charges['0_500g'])) value="{{$shipping_charges['0_500g']}}" @else value="{{old('0_500g')}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="coupon_type">Shipping Charge (501-1000g)</label><br>
                            <input type="" class="form-control"  name="501_1000g" @if (!empty($shipping_charges['501_1000g'])) value="{{$shipping_charges['501_1000g']}}" @else value="{{old('501_1000g')}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="coupon_type">Shipping Charge (1001-2000g)</label><br>
                            <input type="" class="form-control"  name="1001_2000g" @if (!empty($shipping_charges['1001_2000g'])) value="{{$shipping_charges['1001_2000g']}}" @else value="{{old('1001_2000g')}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="coupon_type">Shipping Charge (2001-3000g)</label><br>
                            <input type="" class="form-control"  name="2001_3000g" @if (!empty($shipping_charges['2001_3000g'])) value="{{$shipping_charges['2001_3000g']}}" @else value="{{old('2001_3000g')}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="coupon_type">Shipping Charge (3001-4000g)</label><br>
                            <input type="" class="form-control"  name="3001_4000g" @if (!empty($shipping_charges['3001_4000g'])) value="{{$shipping_charges['3001_4000g']}}" @else value="{{old('3001_4000g')}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="coupon_type">Shipping Charge (Above 5000g)</label><br>
                            <input type="" class="form-control"  name="above_5000g" @if (!empty($shipping_charges['above_5000g'])) value="{{$shipping_charges['above_5000g']}}" @else value="{{old('above_5000g')}}" @endif>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
</div>
@show

@section('script')

@endsection


