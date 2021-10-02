@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Admins/Subadmins</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Admins</a></li>
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
                    <a class="btn btn-success btn-sm float-right" href="{{url('admin/add-admin')}}">Add Admin / Sub admin</a>
                  <h3 class="card-title">Admins/Subadmins</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($allAdmins as $allAdmin)
                        <tr >
                            <td>{{$allAdmin->id}}</td>
                            <td>{{$allAdmin->name}}</td>
                            <td>{{$allAdmin->mobile}}</td>
                            <td>{{$allAdmin->email}}</td>
                            <td>{{$allAdmin->type}}</td>
                            <td class="text-center">
                            @if ($allAdmin->type!="superadmin")
                            <a  href="{{url('admin/change-role',$allAdmin->id)}}"><i class="fas fa-lock" title="Change Role"></i></a> |
                            @if ($allAdmin->status== 1)
                                <a class="updateAdminStatus" id="admin-{{$allAdmin->id}}" Admin_id="{{$allAdmin->id}}" href="javascript:void(0)" title="Change status"><i class="fas fa-toggle-on" status="Active"></i></a>
                            @else
                                <a class="updateAdminStatus" id="admin-{{$allAdmin->id}}" Admin_id="{{$allAdmin->id}}"  href="javascript:void(0)" title="Change status"><i class="fas fa-toggle-off" status="Disabled"></i></a>
                            @endif
                            @endif
                            </td>
                            <td>
                            @if ($allAdmin->type!="superadmin")
                            <a href="#" class="confirmDelete"  record="banner" recordid="{{$allAdmin->id}}">Delete</a> | <a href="{{url('admin/edit-admin',$allAdmin->id)}}"> Edit</a>
                            @endif
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
@show




