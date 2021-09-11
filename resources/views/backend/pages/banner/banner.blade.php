@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Banners</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Banners</a></li>
                <li class="breadcrumb-item active">Table</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <a class="btn btn-success btn-sm float-right" href="{{route('admin.create.banner')}}">Add Banner Image</a>
                  <h3 class="card-title">Banners!</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Banners ID</th>
                      <th>Banners Title</th>
                      <th>Banners Image</th>
                      <th>Actions</th>
                      <th>Banners Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                        <tr >
                            <td>{{$banner->id}}</td>
                            <td>{{$banner->title}}</td>
                            <td><img style="height: 60px; width:130px" src="{{asset('storage/images/admin/banner/'.$banner->image)}}" alt="{{$banner->alt}}"></td>
                            <td><a href="#" class="confirmDelete"  record="banner" recordid="{{$banner->id}}">Delete</a> | <a href="{{route('admin.edit.banner',$banner->id)}}"> Edit</a></td>
                            @if ($banner->status== 1)
                            <td class="text-center"><a href="javascript:void(0)" class="updateBannerStatus" id="banner-{{$banner->id}}" banner_id="{{$banner->id}}"><i class="fas fa-toggle-on" status="Active"></i></a></td>
                            @else
                            <td class="text-center"><a href="javascript:void(0)" class="updateBannerStatus" id="banner-{{$banner->id}}" banner_id="{{$banner->id}}"><i class="fas fa-toggle-off" status="Disabled"></i></a></td>
                            @endif
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
@show




