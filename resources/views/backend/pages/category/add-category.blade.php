@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add category</li>
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
                  <h3 class="card-title">Add Category</h3>
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
                <form role="form" action="{{route('admin.createCategory')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('post')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Category Name</label>
                      <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name">
                    </div>
                    <div class="form-group">
                        <label>Select Section</label>
                        <select class="form-control select2" name="section_id" id="section_id" style="width: 100%;">
                            <option selected="selected">Select</option>
                            @foreach ($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div >
                           @include('backend.pages.category.append_categories_level')
                      </div>
                      <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" id="discount" name="category_discount" placeholder="Enter Category Name">
                      </div>
                      <div class="form-group">
                          <label>Category  Description</label>
                          <textarea class="form-control" rows="3" placeholder="Enter about category" name="description" id="description"></textarea>
                      </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Category Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="category_image" id="category_image">
                          <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label>Meta  Title</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Meta name" name="meta_title" id="meta_name"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta  Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Meta description" name="meta_description" id="meta_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Keywords</label>
                        <textarea class="form-control" rows="3" placeholder="Enter keta keywords" name="meta_keywords" id="meta_keywords"></textarea>
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


