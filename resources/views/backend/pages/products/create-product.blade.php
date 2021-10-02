@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Products</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Product</li>
              </ol>
            </div>
          </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header col-md-12">
                  <h3 class="card-title">Add Products</h3>
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
                <form role="form" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('post')
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                            <label>Select Category</label>
                            <select class="form-control select2" name="category_id" id="category_id" style="width: 100%;">
                                <option selected="selected">Select</option>
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
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product Name">
                          </div>
                          <div class="form-group">
                              <label for="name">Code</label>
                              <input type="number" class="form-control" id="product_code" name="product_code" placeholder="Enter product code">
                            </div>
                            <div class="form-group">
                              <label for="name">Color</label>
                              <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter product color">
                          </div>
                          <div class="form-group">
                              <label for="name">Price</label>
                              <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter product price">
                          </div>
                          <div class="form-group">
                              <label for="discount">wash Care</label>
                              <input type="text" class="form-control" id="wash_care" name="wash_care" placeholder="Enter Product wash care">
                          </div>
                          <div class="form-group">
                            <label>Is featured</label>
                            <select class="form-control select2" name="is_featured" id="is_featured" style="width: 100%;">
                                <option value="Yes" selected="selected">Yes</option>
                                <option value="No">No</option>

                            </select>
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
                      <div class="col-md-6 col-sm-12">
                         <div class="form-group">
                            <label>Select Brand</label>
                            <select class="form-control select2" name="brand" id="brand" style="width: 100%;">
                                <option selected="selected">Select</option>
                                @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                          </div>
                           <div class="form-group">
                            <label>Select Fabric</label>
                            <select class="form-control select2" name="fabric" id="fabric" style="width: 100%;">
                                <option selected="selected">Select</option>
                                @foreach ($fabricArray as $fabric)
                                <option>{{$fabric}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Select Occasion</label>
                            <select class="form-control select2" name="occasion" id="occasion" style="width: 100%;">
                                <option selected="selected">Select</option>
                                @foreach ($occasionArray as $occasion)
                                <option>{{$occasion}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Select Sleeve</label>
                            <select class="form-control select2" name="sleeve" id="sleeve" style="width: 100%;">
                                <option selected="selected">Select</option>
                                @foreach ($sleeveArray as $sleeve)
                                <option>{{$sleeve}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Select Pattern</label>
                            <select class="form-control select2" name="pattern" id="pattern" style="width: 100%;">
                                <option selected="selected">Select</option>
                                @foreach ($patternArray as $pattern)
                                <option>{{$pattern}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Select fitness</label>
                            <select class="form-control select2" name="fit" id="fit" style="width: 100%;">
                                <option selected="selected">Select</option>
                                @foreach ($fitArray as $fit)
                                <option>{{$fit}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                              <label for="discount">Discount (%)</label>
                              <input type="number" class="form-control" id="product_discount" name="product_discount" placeholder="Enter Product descount">
                          </div>
                          <div class="form-group">
                              <label for="discount">Weight</label>
                              <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter Product weight">
                          </div>
                          <div class="form-group">
                              <label>Product  Description</label>
                              <textarea class="form-control" rows="3" placeholder="Enter about product" name="product_description" id="product_description"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">Product Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="product_image" id="product_image">
                                <label class="custom-file-label" for="image">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputFile">Product Video</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="product_video" id="product_video">
                                  <label class="custom-file-label" for="video">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                  <span class="input-group-text" id="">Upload Video</span>
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer col-md-12 m-auto">
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
var uploadField = document.getElementById("product_video");

uploadField.onchange = function() {
    if(this.files[0].size > 1000){
       alert("File is too big!");
       this.value = "";
    };
};
@endsection


