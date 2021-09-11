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
                <li class="breadcrumb-item active">Add banner</li>
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
                  <h3 class="card-title">Add New Banner</h3>
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
                <form role="form" action="{{route('admin.store.banner')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('post')
                    <div class="card-body">
                    <div class="form-group">
                        <label for="discount">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Banner Title">
                    </div>
                        <div class="form-group">
                          <label for="discount">Link</label>
                          <input type="text" class="form-control" id="link" name="link" placeholder="Enter Link">
                      </div>
                        <div class="form-group">
                          <label for="discount">Alternative</label>
                          <input type="text" class="form-control" id="alt" name="alt" placeholder="Enter Banner Alt">
                      </div>
                      <label for="exampleInputFile">Banner Image</label>
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


