@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Products</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Products v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 ">
              <div class="card">
                <div class="card-header">
                   <a class="btn btn-success btn-sm float-right" href="{{route('product.create')}}">Add product</a>
                  <h3 class="card-title">Products Table!</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Section</th>
                      <th>Code</th>
                      <th>Image</th>
                      <th>Color</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            @if (!isset($product->Category->category_name))
                                <?php $categoryName="Root"; ?>
                            @else
                            <?php $categoryName= $product->Category->category_name; ?>
                            @endif
                        <tr >
                            <td>{{$product->id}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$categoryName}}</td>
                            <td>{{$product->section->name}}</td>
                            <td>{{$product->product_code}}</td>

                            <td>
                                @if (!empty($product->product_image))
                                <img style="height:50px" width="70px" src="{{asset('storage/images/admin/product/small/'.$product->product_image)}}"srcset="">
                                @else
                                No Image
                                @endif
                            </td>

                            <td>{{$product->product_color}}</td>
                            @if ($product->status== 1)
                            <td class="text-center"><a href="javascript:void(0)" class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}">Active</a></td>
                            @else
                            <td class="text-center"><a href="javascript:void(0)" class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}">Make Active</a></td>
                            @endif
                            <td class="text-center">
                              <a title="Add/Edit attributes" href="{{route('product.add.attribute',$product->id)}}"><i class="fas fa-plus"></i></a> &nbsp;
                              <a title="Add Product image" href="{{route('product.add.image',$product->id)}}"><i class="fas fa-plus-circle"></i></a> &nbsp;
                              <a title="Edit Products "href="{{route('product.edit',$product->id)}}"><i class="fas fa-edit"></i></a> &nbsp;
                              <a title="Delete Products" href="javascript:void(0)" class="confirmDelete" record="product" recordid="{{$product->id}}"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                        @endforeach
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
</div>
@enssection

@section('script')

@endsection


