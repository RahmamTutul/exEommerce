@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Banner</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Cart value</li>
              </ol>
            </div>
          </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 m-auto">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Cart value</h3>
                </div>
                <form role="form" action="{{url('admin/other-settings',$otherSettings['id'])}}" method="POST">
                  @csrf
                  @method('post')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="discount">Title</label>
                            <input type="text" class="form-control" id="min" name="min" placeholder="Enter min cart value" value="{{$otherSettings['min_cart_value']}}">
                        </div>
                        <div class="form-group">
                            <label for="discount">Title</label>
                            <input type="text" class="form-control" id="min" name="max" placeholder="Enter min cart value" value="{{$otherSettings['max_cart_value']}}">
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


