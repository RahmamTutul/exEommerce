@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">CMS</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add CMS</li>
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
                  <h3 class="card-title">Add New CMS</h3>
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
                <form role="form" action="{{url('admin/cms/create')}}" method="POST">
                  @csrf
                    <div class="card-body">
                        <div class="form-group" id="CMSField">
                            <label for="CMS_code">Title</label>
                            <input type="text" class="form-control" id="CMS_code" name="title" placeholder="Enter page title">
                        </div>
                        <div class="form-group" id="CMSField">
                            <label for="CMS_code">URL</label>
                            <input type="text" class="form-control" id="CMS_code" name="url" placeholder="Enter page url">
                        </div>
                        <div class="form-group" id="CMSField">
                            <label for="CMS_code">Meta Title</label>
                            <input type="text" class="form-control" id="CMS_code" name="meta_title" placeholder="Enter meta title">
                        </div>
                        <div class="form-group" id="CMSField">
                            <label for="CMS_code">Meta keywords</label>
                            <input type="" class="form-control" id="CMS_code" name="meta_keywords" placeholder="Enter meta keywords">
                        </div>
                        <div class="form-group">
                          <label for="amount">Page description</label>
                          <textarea  class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="amount">Meta Descrition</label>
                            <textarea  class="form-control" name="meta_description"></textarea>
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


