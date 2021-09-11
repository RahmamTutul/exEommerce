@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Product Images!</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Images</li>
              </ol>
            </div>
          </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="row">
                    <div class="col-md-12">
                       <div class="card-header  bg-primary">
                          <h3 class="card-title">Product Details</h3>
                       </div>
                    </div>
                </div>
        <form action="{{route('product.store.image',$productData->id)}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="name">Product Name :</label> &nbsp; &nbsp; {{$productData->product_name}}
                            </div>
                            <div class="form-group">
                                <label for="name">Product Color :</label> &nbsp; &nbsp; {{$productData->product_color}}
                            </div>
                            <div class="form-group">
                                <label for="name">Product Code :</label> &nbsp; &nbsp; {{$productData->product_code}}
                            </div>
                            <div class="form-group field_wrapper">
                                <label for="exampleInputFile">Product Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="images[]" id="images" multiple>
                                    <label class="custom-file-label" for="image">Choose files</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                  </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-7">
                        @if (!empty($productData->product_image))
                          <img style="height: 170px; width:120px; border-radius: 5px "  src="{{asset('storage/images/admin/product/medium/'.$productData->product_image)}}" alt="" srcset="">
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
        <div class="container-fluid">
            <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">{{$productData->product_name}}'s Images! </h3>
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Images</th>
                        <th>Status</th>
                        <th>Delete</th>
                      </tr>
                      </thead>
                      <tbody>
                          @foreach ($productData['images'] as $image)
                            <input style="display: none" type="number" name=attrId[] value="{{$image->id}}">
                            <tr >
                                <td>{{$image->id}}</td>
                                <td class="text-center"><img style="height: 100px; width:70px; border-radius: 5px" src="{{asset('storage/images/admin/product/medium/'.$image->image)}}"></td>
                                @if ($image->status== 1)
                                <td class="text-center"><a href="javascript:void(0)" class="updateProductImages" id="image-{{$image->id}}" image_id="{{$image->id}}">Active</a></td>
                                @else
                                <td class="text-center"><a href="javascript:void(0)" class="updateProductImages" id="image-{{$image->id}}" image_id="{{$image->id}}">Disabled</a></td>
                                @endif
                                <td class="text-center">
                                    <a style="font-size: 1.2rem" title="Delete image" href="javascript:void(0)" class="deleteProduct" record="images" recordid="{{$image->id}}"><i class="fas fa-trash text-danger"></i></a> &nbsp;
                                </td>

                            </tr>
                          @endforeach
                      </tfoot>
                    </table>
                  </div>
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
      </section>
</div>
@show

@section('script')

@endsection


