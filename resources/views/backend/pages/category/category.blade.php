@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
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
                   <a class="btn btn-success btn-sm float-right" href="{{route('admin.AddCategory')}}">Add Category</a>
                  <h3 class="card-title">categories Table!</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category</th>
                      <th>Parent</th>
                      <th>Section</th>
                      <th>URL</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        @if (!isset($category->parentcategory->category_name))
                            <?php $parent_category="Root"; ?>
                        @else
                        <?php $parent_category= $category->parentcategory->category_name; ?>
                        @endif
                        <tr >
                            <td>{{$category->id}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$parent_category}}</td>
                            <td>{{$category->section->name}}</td>
                            <td>{{$category->url}}</td>
                            @if ($category->status== 1)
                            <td class="text-center"><a href="javascript:void(0)" class="updateCategoryStatus" id="catgeory-{{$category->id}}" category_id="{{$category->id}}"><i class="fas fa-toggle-on" status="Active"></i></a></td>
                            @else
                            <td class="text-center"><a href="javascript:void(0)" class="updateCategoryStatus" id="category-{{$category->id}}" category_id="{{$category->id}}"><i class="fas fa-toggle-off" status="Disabled"></i></a></td>
                            @endif
                            <td class="text-center">
                              <a href="{{route('admin.edit.category',$category->id)}}">Edit</a> |
                              <a href="javascript:void(0)" class="confirmDelete" record="category" recordid="{{$category->id}}">Delete</a>
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


