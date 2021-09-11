@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Sections</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Sections</a></li>
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
                  <h3 class="card-title">Sections that carries categories!</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Section ID</th>
                      <th>Section Name</th>
                      <th>Section Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                        <tr >
                            <td>{{$section->id}}</td>
                            <td>{{$section->name}}</td>
                            @if ($section->status== 1)
                            <td class="text-center"><a href="javascript:void(0)" class="updateSectionStatus" id="section-{{$section->id}}" section_id="{{$section->id}}"><i class="fas fa-toggle-on" status="Active"></i></a></td>
                            @else
                            <td class="text-center"><a href="javascript:void(0)" class="updateSectionStatus" id="section-{{$section->id}}" section_id="{{$section->id}}"><i class="fas fa-toggle-off" status="Disabled"></i></a></td>
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




