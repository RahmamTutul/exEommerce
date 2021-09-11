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
                <li class="breadcrumb-item active">Add Coupon</li>
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
                  <h3 class="card-title">Add New Coupon</h3>
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
                <form role="form" action="{{route('admin.store.coupon')}}" method="POST">
                  @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="discount">Coupon options</label><br>
                            <div class="form-control">
                                <span> <input type="radio" id="AutomaticCoupon" checked name="coupon_option" value="Automatic">&nbsp; Automatic</span> &nbsp; &nbsp;
                                <span> <input type="radio" id="ManualCoupon" name="coupon_option" value="Manual">&nbsp; Manual</span>
                            </div>
                        </div>
                        <div class="form-group" id="CouponField" style="display: none">
                            <label for="coupon_code">Coupon code</label>
                            <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Enter coupon code">
                        </div>
                        <div class="form-group">
                            <label for="coupon_type">Coupon type</label><br>
                            <div class="form-control">
                                <input type="radio"  name="coupon_type" checked value="Multiple times"><span> &nbsp; Multiple times</span> &nbsp; &nbsp;
                                <input type="radio"  name="coupon_type" value="single times"><span> &nbsp; Single</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amount_type">Amount type</label><br>
                            <div class="form-control">
                                <input type="radio"  name="amount_type" checked value="Percentage"><span> &nbsp; Percentage (%)</span> &nbsp; &nbsp;
                                <input type="radio" name="amount_type" value="INR"><span> &nbsp; INR(Tk)</span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="amount">Amount</label>
                          <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
                        </div>
                        <div class="form-group">
                            <label for="select_users">Select Users</label>
                            <select name="users[]" id="select_users" class="form-control select2" multiple>
                                <option value="">Select Users</option>
                                @foreach ($users as $user)
                                <option value="{{$user['email']}}">{{$user['email']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="expiry_date">Select Users</label>
                          <input type="date" class="form-control" id="expiry_date" name="expiry_date" placeholder="Enter expiry date" required>
                      </div>
                        <div class="form-group">
                            <label for="coupon_code">Select category</label>
                            <select class="form-control select2" name="categories[]" id="categories" style="width: 100%;" multiple required>
                                @foreach ($categories as $section)
                                <optgroup label="{{$section['name']}}">
                                    @foreach ($section['categories'] as $category)
                                        <option value="{{$category['id']}}">&nbsp;&nbsp; -->{{$category['category_name']}}</option>
                                        @foreach ($category['sub_categories'] as $sub)
                                        <option value="{{$sub['id']}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->{{$sub['category_name']}}</option>
                                        @endforeach
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
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


