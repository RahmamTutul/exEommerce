@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Admin</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit admin</li>
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
                  <h3 class="card-title">Update Admin / Subadmin</h3>
                </div>
                <form role="form" action="{{url('admin/edit-admin',$adminInfo->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('post')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Admin/Subadmin Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{$adminInfo->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="discount">Email</label>
                        <input type="text" class="form-control" id="discount" name="email" value="{{$adminInfo->email}}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile"value="{{$adminInfo->mobile}}" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control select2" name="type" id="type" style="width: 100%;" required>
                            <option value="admin"  >Admin</option>
                            <option value="subadmin">Sub-Admin</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="discount">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Update password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Admin/Subadmin Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="image" id="image">
                          <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                        </div>
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


