@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Brands</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Brands</a></li>
                <li class="breadcrumb-item active">Table</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 m-auto">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Add Brands</h3>
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
              <form role="form" action="{{route('admin.brands.store')}}" method="POST">
                @csrf
                @method('post')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Brand Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Brand Name">
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-warning">Submit</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">All Brands!</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{route('admin.brands.update')}}" method="POST">
                @csrf
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Brands ID</th>
                      <th>Brands Name</th>
                      <th>Brands Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                        <tr >
                            <input style="display: none;" name="id[]" id="id" type="number" value="{{$brand->id}}" >
                            <td>{{$brand->id}}</td>
                            <td><input type="text" name="name[]" id="name" value="{{$brand->name}}" required></td>
                            @if ($brand->status== 1)
                            <td class="text-center"><a style="font-size: 1.5rem" href="javascript:void(0)" class="updateBrandStatus" id="brands-{{$brand->id}}" brands_id="{{$brand->id}}"><i class=" fas fa-toggle-on text-success" status="Active"></i></a></td>
                            @else
                            <td class="text-center"><a style="font-size: 1.5rem" href="javascript:void(0)" class="updateBrandStatus" id="brands-{{$brand->id}}" brands_id="{{$brand->id}}"><i class=" fas fa-toggle-off text-danger" status="Disable"></i></a></td>
                            @endif
                            <td class="text-center"><a href="javascript:void(0)" class="confirmDelete" record="brands" recordid="{{$brand->id}}" >Delete</a> </td>
                          </tr>
                        @endforeach
                    </tfoot>
                  </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
        <!-- /.container-fluid -->
      </section>
</div>
@show




