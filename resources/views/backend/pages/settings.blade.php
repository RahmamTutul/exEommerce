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
                  <h3 class="card-title text-center">Change Password</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('admin.update.password')}}" method="POST">@csrf
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
                      <label for="exampleInputEmail1">Current Password</label>
                      <input type="password" class="form-control" name="current" id="current" placeholder="Enter Current Password">
                    <div class="form-group">
                      <label for="new">New Password</label>
                      <input type="password" class="form-control" name="new" id="new" placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                        <label for="new">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm New Password">
                      </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" id="submit" class="btn btn-primary mt-0">Submit</button>
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



