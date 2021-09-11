@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Edit Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit category</li>
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
                  <h3 class="card-title">Edit Category</h3>
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
                <form role="form" action="{{route('admin.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('post')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Category Name</label>
                      <input type="text" class="form-control" id="category_name" name="category_name" value="{{$category->category_name}}">
                    </div>
                    <div class="form-group">
                        <label>Select Section</label>
                        <select class="form-control select2" name="section_id" id="section_id" style="width: 100%;">
                            <option >Select</option>
                            @foreach ($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div id="appendCategoryLevel">
                           @include('backend.pages.category.append_categories_level')
                      </div>
                      <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" id="discount" name="category_discount" value="{{$category->category_discount}}">
                      </div>
                      <div class="form-group">
                          <label>Category  Description</label>
                          <textarea class="form-control" rows="3" name="description" id="description">{{$category->description}}</textarea>
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
                    @if (!empty($category->category_image))
                       <div class="mb-4">
                        <img height="200px" width="100%" src="{{asset('storage/images/admin/category/'.$category->category_image)}}" srcset="">

                        <a class="confirmDelete" name="Image" href="javascript:void(0)" record="category-image" recordid="{{$category->id}}">Delete Image</a>
                       </div>
                    @endif
                    <div class="form-group">
                        <label>Meta  Title</label>
                        <textarea class="form-control" rows="3" name="meta_title" id="meta_name" @if($category->meta_title==null) placeholder="Empty! Enter Data." @endif>{{$category->meta_title}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta  Description</label>
                        <textarea class="form-control" rows="3"  name="meta_description" id="meta_description"@if($category->meta_description==null) placeholder="Empty! Enter Data." @endif>{{$category->meta_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Keywords</label>
                        <textarea class="form-control" rows="3"name="meta_keywords" id="meta_keywords" @if($category->meta_keywords==null) placeholder="Empty! Enter Data." @endif>{{$category->meta_keywords}}</textarea>
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


