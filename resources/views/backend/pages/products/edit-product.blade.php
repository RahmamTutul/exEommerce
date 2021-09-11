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
                <li class="breadcrumb-item active">Edit Product</li>
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
                  <h3 class="card-title">Edit Products</h3>
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
                <form role="form" action="{{route('product.update',$productData->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('post')
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                            <label>Select Category</label>
                            <select class="form-control select2" name="category_id" id="category_id" style="width: 100%;">
                                @foreach ($categories as $section)
                                <optgroup label="{{$section['name']}}">
                                    @foreach ($section['categories'] as $category)
                                        <option value="{{$category['id']}}" @if ($category['id']=$productData->category_id) selected="selected" @endif >
                                        &nbsp;&nbsp; -->{{$category['category_name']}}</option>
                                        @foreach ($category['sub_categories'] as $sub)
                                        <option value="{{$sub['id']}}" @if ($category['id']=$productData->category_id) selected="selected" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->{{$sub['category_name']}}</option>
                                        @endforeach
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product Name" value="{{$productData->product_name}}">
                          </div>
                          <div class="form-group">
                              <label for="name">Code</label>
                              <input type="number" class="form-control" id="product_code" name="product_code" placeholder="Enter product code" value="{{$productData->product_code}}">
                            </div>
                            <div class="form-group">
                              <label for="name">Color</label>
                              <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter product color" value="{{$productData->product_color}}">
                          </div>
                          <div class="form-group">
                              <label for="name">Price</label>
                              <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter product price" value="{{$productData->product_price}}">
                          </div>
                          <div class="form-group">
                              <label for="discount">wash Care</label>
                              <input type="text" class="form-control" id="wash_care" name="wash_care" placeholder="Enter Product wash care" value="{{$productData->wash_care}}">
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
                              <textarea class="form-control" rows="3" placeholder="Enter Meta name" name="meta_title" id="meta_name">{{$productData->meta_title}}</textarea>
                          </div>
                          <div class="form-group">
                            <label>Meta  Description</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Meta description" name="meta_description" id="meta_description">{{$productData->meta_description}}</textarea>
                          </div>
                          <div class="form-group">
                              <label>Meta Keywords</label>
                              <textarea class="form-control" rows="3" placeholder="Enter keta keywords" name="meta_keywords" id="meta_keywords">{{$productData->meta_keywords}}</textarea>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Select Brand</label>
                                <select class="form-control select2" name="brnad" id="brand" style="width: 100%;">
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}" @if ($brand->id=$productData->brand_id) selected="selected" @endif>{{$brand['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                           <div class="form-group">
                            <label>Select Fabric</label>
                            <select class="form-control select2" name="fabric" id="fabric" style="width: 100%;">
                                @foreach ($fabricArray as $fabric)
                                <option @if ($fabric==$productData->fabric) selected="selected" @endif>{{$fabric}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <select class="form-control select2" name="occasion" id="occasion" style="width: 100%;">
                                @foreach ($occasionArray as $occasion)
                                <option  @if ($occasion==$productData->occasion) selected="selected" @endif>{{$occasion}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Select Sleeve</label>
                            <select class="form-control select2" name="sleeve" id="sleeve" style="width: 100%;">
                                @foreach ($sleeveArray as $sleeve)
                                <option  @if ($sleeve==$productData->sleeve) selected="selected" @endif>{{$sleeve}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Select Pattern</label>
                            <select class="form-control select2" name="pattern" id="pattern" style="width: 100%;">
                                @foreach ($patternArray as $pattern)
                                <option @if ($pattern==$productData->pattern) selected="selected" @endif>{{$pattern}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Select fitness</label>
                            <select class="form-control select2" name="fit" id="fit" style="width: 100%;">
                                @foreach ($fitArray as $fit)
                                <option @if ($fit==$productData->fit) selected="selected" @endif>{{$fit}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                              <label for="discount">Discount (%)</label>
                              <input type="number" class="form-control" id="product_discount" name="product_discount" placeholder="Enter Product descount" value="{{$productData->product_discount}}">
                          </div>
                          <div class="form-group">
                              <label for="discount">Weight</label>
                              <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter Product weight" value="{{$productData->product_weight}}">
                          </div>
                          <div class="form-group">
                              <label>Product  Description</label>
                              <textarea class="form-control" rows="3" placeholder="Enter about product" name="product_description" id="product_description">{{$productData->product_description}}</textarea>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">Change Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="product_image" id="product_image" value="{{$productData->product_image}}">
                                <label class="custom-file-label" for="image">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                              </div>
                            </div>
                          </div>
                          @if (!empty($productData->product_image))
                          <img style="height: 80px; width:100px; border-radius: 5px "  src="{{asset('storage/images/admin/product/small/'.$productData->product_image)}}" alt="" srcset="">
                          <a href="javascript:void(0)" class="deleteProduct" record="product-image" recordid="{{$productData->id}}">Delete Image</a>
                          @endif
                          <div class="form-group">
                              <label for="exampleInputFile">Change Video</label>
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
                          @if (!empty($productData->product_video))
                              <a href="{{asset('storage/video/product_video/'.$productData->product_video)}}" download="">Download</a>  &nbsp; || &nbsp;
                              <a href="javascript:void(0)" class="deleteProduct" record="product-video" recordid="{{$productData->id}}">Delete </a>
                          @endif
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

@endsection


