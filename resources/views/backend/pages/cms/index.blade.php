@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">CMS Pages</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">CMS</a></li>
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
                    <a class="btn btn-success btn-sm float-right" href="{{url('admin/cms/create')}}">Add CMS</a>
                  <h3 class="card-title">CMS!</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Url</th>
                      <th>Created</th>
                      <th>Action</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($cmsInfos as $cmsInfo)
                        <tr>
                            <td>{{$cmsInfo['id']}}</td>
                            <td>{{$cmsInfo['title']}}</td>
                            <td>{{$cmsInfo['url']}}</td>
                            <td>{{$cmsInfo['created_at']}}</td>
                            <td><a href="#" class="confirmDelete"  record="cmsInfo" recordid="{{$cmsInfo['id']}}">Delete</a> | <a href="{{url('admin/cms/edit',$cmsInfo['id'])}}"> Edit</a></td>
                            @if ($cmsInfo['status']== 1)
                            <td class="text-center"><a href="javascript:void(0)" class="updateCmsStatus" id="cms-{{$cmsInfo['id']}}" cms_id="{{$cmsInfo['id']}}"><i class="fas fa-toggle-on" status="Active"></i></a></td>
                            @else
                            <td class="text-center"><a href="javascript:void(0)" class="updateCmsStatus" id="cms-{{$cmsInfo['id']}}" cms_id="{{$cmsInfo['id']}}"><i class="fas fa-toggle-off" status="Disabled"></i></a></td>
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
