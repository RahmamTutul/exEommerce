@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Product Attributes!</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Attributes</li>
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
        <form action="{{route('product.store.attribute',$productData->id)}}" method="post">
            @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
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
                                <input type="text" id="size" name="size[]" placeholder="Size" required/>
                                <input type="number" id="price" name="price[]" placeholder="Price" required/>
                                <input type="number" id="sock" name="stock[]" placeholder="Stock" required/>
                                <input type="text" id="SKU" name="sku[]" placeholder="SKU" required/>
                                <a href="javascript:void(0);" class="add_button" title="Add field">ADD</a>
                            </div>

                        </div>
                        <div class="col-md-5">
                        @if (!empty($productData->product_image))
                          <img style="height: 200px; width:150px; border-radius: 5px "  src="{{asset('storage/images/admin/product/medium/'.$productData->product_image)}}" alt="" srcset="">
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
                    <h3 class="card-title">{{$productData->product_name}}'s Attribute Table! </h3>
                  </div>
                  <!-- /.card-header -->
                  <form action="{{route('product.update.attribute',$productData->id)}}" method="post">
                   @csrf
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Size</th>
                        <th>SKU</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Delete</th>
                      </tr>
                      </thead>
                      <tbody>
                          @foreach ($productData['attributes'] as $attributes)
                            <input style="display: none" type="number" name=attrId[] value="{{$attributes->id}}">
                            <tr >
                                <td>{{$attributes->product_id}}</td>
                                <td>{{$attributes->size}}</td>
                                <td>{{$attributes->sku}}</td>
                                <td>
                                   <input type="number" name="stock[]" value="{{$attributes->stock}}" required>
                                </td>
                                <td>
                                   <input type="number" name="price[]" value="{{$attributes->price}}" required>
                                </td>
                                @if ($attributes->status==1)
                                    <td class="text-center"><a href="javascript:void(0)"  class="updateAttributeStatus" id="attribute-{{$attributes->id}}" attribute_id="{{$attributes->id}}">Active</a></td>
                                @else
                                    <td class="text-center"><a href="javascript:void(0)" class="updateAttributeStatus" id="attribute-{{$attributes->id}}" attribute_id="{{$attributes->id}}">Disabled</a></td>
                                @endif
                                <td class="text-center">
                                    <a style="font-size: 1.2rem" title="Delete attributes" href="javascript:void(0)" class="deleteProduct" record="attribute" recordid="{{$attributes->id}}"><i class="fas fa-trash text-danger"></i></a> &nbsp;
                                </td>
                            </tr>
                          @endforeach
                      </tfoot>
                    </table>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Cahange Attributes</button>
                  </div>
                </form>
                  <!-- /.card-body -->
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


