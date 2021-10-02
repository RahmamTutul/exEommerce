@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Retting And Reviews</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Retting And Reviews</a></li>
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
                    <a class="btn btn-success btn-sm float-right" href="{{url('admin/add-admin')}}">Retting And Reviews</a>
                  <h3 class="card-title">Retting And Reviews</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Product Name</th>
                      <th>User Email</th>
                      <th>Ratting</th>
                      <th>reviews</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($ratings as $rating)
                        <tr >
                            <td>{{$rating['id']}}</td>
                            <td>{{$rating['user']['name']}}</td>
                            <td>{{$rating['user']['email']}}</td>
                            <td>{{$rating['retting']}}</td>
                            <td>{{$rating['review']}}</td>
                            <td class="text-center">
                            @if ($rating['status']== 1)
                                <a class="updateRatingStatus" id="rating-{{$rating['id']}}" rating_id="{{$rating['id']}}" href="javascript:void(0)" title="Change status"><i class="fas fa-toggle-on" status="Active"></i></a>
                            @else
                                <a class="updateRatingStatus" id="rating-{{$rating['id']}}" rating_id="{{$rating['id']}}"  href="javascript:void(0)" title="Change status"><i class="fas fa-toggle-off" status="Disabled"></i></a> 
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




