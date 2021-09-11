@include('backend.layouts.app')

 @section('Content')
 <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Admin Settings</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Admin Settings</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 m-auto">
              <div class="card card-primary">
                <div class="card-header text-center">
                  <h3 class="card-title text-center">Change Information</h3>
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
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('admin.update.info')}}" method="POST" id="update-pswd" enctype="multipart/form-data">@csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Your Email</label>
                        <input  class="form-control" readonly value="{{$detail->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Your Role</label>
                        <input  class="form-control" readonly value="{{$detail->type}}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">Change Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$detail->name}}" placeholder="Enter your name to change">
                    </div> --}}
                    <div class="form-group">
                      <label for="name">Change Name</label>
                      <input type="text" class="form-control" name="name" id="name"value="{{$detail->name}}">
                    <div class="form-group">
                      <label for="phone">Change Mobile NO:</label>
                      <input type="number" class="form-control" name="phone" id="phone" value="{{$detail->mobile}}">
                    </div>
                    <div class="form-group">
                        <label for="new">Update Image</label><br>
                        <input type="file" name="image" id="image"><br>
                        <img style="height: 100px; width:100px; margin-top:30px" src="{{asset('storage/images/admin/profile/'.Auth::guard('admin')->user()->image)}}" alt="You have no profile picture!">
                      </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary mt-0">Submit</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
</div>
 @show



