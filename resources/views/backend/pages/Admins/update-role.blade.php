@include('backend.layouts.app')

@section('css')

@endsection

@section('Content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Update role</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Admin/Subadmin Role</li>
              </ol>
            </div>
          </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">

            <div class="col-md-6 m-auto">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Change Admin/Sub-Admin permisssions</h3>
                </div>
                <form role="form" action="{{url('admin/change-role',$adminId)}}" method="POST">
                  @csrf
                  @method('post')
                    <div class="card-body">
                        @if (!empty($adminRole))
                        @foreach ($adminRole as $role)
                          @if ($role['module']=='categories')
                              @if ($role['view_access']==1)
                                  @php $viewChecked = "checked" @endphp
                              @else
                                  @php $viewChecked = "" @endphp
                              @endif
                          @endif
                          @if ($role['module']=='categories')
                              @if ($role['edit_access']==1)
                                  @php $editChecked = "checked" @endphp
                              @else
                                  @php $editChecked = "" @endphp
                              @endif
                          @endif
                          @if ($role['module']=='categories')
                              @if ($role['full_access']==1)
                                  @php $fullChecked = "checked" @endphp
                              @else
                                  @php $fullChecked = "" @endphp
                              @endif
                          @endif
                        @endforeach
                    @endif
                    <div class="form-group">
                        <label for="discount">Chategory Access</label> <br>
                        <input type="checkbox" name="categories[view]" value="1" @if (isset($viewChecked)) $viewChecked @endif> View access &nbsp; &nbsp;
                        <input type="checkbox" name="categories[edit]" value="1" @if (isset($editChecked)) $editChecked @endif> Edit access &nbsp; &nbsp;
                        <input type="checkbox" name="categories[full]" value="1" @if (isset($fullChecked)) $fullChecked @endif> Full access &nbsp; &nbsp;
                    </div>
                    @if (!empty($adminRole))
                        @foreach ($adminRole as $role)
                            @if ($role['module']=='products')
                                @if ($role['view_access']==1)
                                    @php $viewChecked = "checked" @endphp
                                @else
                                    @php $viewChecked = "" @endphp
                                @endif
                            @endif
                            @if ($role['module']=='products')
                                @if ($role['edit_access']==1)
                                    @php $editChecked = "checked" @endphp
                                @else
                                    @php $editChecked = "" @endphp
                                @endif
                            @endif
                            @if ($role['module']=='products')
                                @if ($role['full_access']==1)
                                    @php $fullChecked = "checked" @endphp
                                @else
                                    @php $fullChecked = "" @endphp
                                @endif
                            @endif
                        @endforeach
                    @endif
                    <div class="form-group">
                        <label for="discount">Product Access</label> <br>
                        <input type="checkbox" name="products[view]" value="1" @if (isset($viewChecked)) {{$viewChecked}} @endif> View access &nbsp; &nbsp;
                        <input type="checkbox" name="products[edit]" value="1" @if (isset($editChecked)) {{$editChecked}} @endif> Edit access &nbsp; &nbsp;
                        <input type="checkbox" name="products[full]" value="1" @if (isset($fullChecked)) {{$fullChecked}} @endif> Full access &nbsp; &nbsp;
                    </div>
                    @if (!empty($adminRole))
                        @foreach ($adminRole as $role)
                        @if ($role['module']=='coupons')
                            @if ($role['view_access']==1)
                                @php $viewChecked = "checked" @endphp
                            @else
                                @php $viewChecked = "" @endphp
                            @endif
                        @endif
                        @if ($role['module']=='coupons')
                            @if ($role['edit_access']==1)
                                @php $editChecked = "checked" @endphp
                            @else
                                @php $editChecked = "" @endphp
                            @endif
                        @endif
                        @if ($role['module']=='coupons')
                            @if ($role['full_access']==1)
                                @php $fullChecked = "checked" @endphp
                            @else
                                @php $fullChecked = "" @endphp
                            @endif
                        @endif
                        @endforeach
                    @endif
                    <div class="form-group">
                        <label for="discount">Coupons Access</label> <br>
                        <input type="checkbox" name="coupons[view]" value="1" @if (isset($viewChecked)) {{$viewChecked}} @endif> View access &nbsp; &nbsp;
                        <input type="checkbox" name="coupons[edit]" value="1" @if (isset($editChecked)) {{$editChecked}} @endif> Edit access &nbsp; &nbsp;
                        <input type="checkbox" name="coupons[full]" value="1" @if (isset($fullChecked)) {{$fullChecked}} @endif> Full access &nbsp; &nbsp;
                        </div>
                        @if (!empty($adminRole))
                            @foreach ($adminRole as $role)
                            @if ($role['module']=='orders')
                                @if ($role['view_access']==1)
                                    @php $viewChecked = "checked" @endphp
                                @else
                                    @php $viewChecked = "" @endphp
                                @endif
                            @endif
                            @if ($role['module']=='orders')
                                @if ($role['edit_access']==1)
                                    @php $editChecked = "checked" @endphp
                                @else
                                    @php $editChecked = "" @endphp
                                @endif
                            @endif
                            @if ($role['module']=='orders')
                                @if ($role['full_access']==1)
                                    @php $fullChecked = "checked" @endphp
                                @else
                                    @php $fullChecked = "" @endphp
                                @endif
                            @endif
                            @endforeach
                        @endif
                    <div class="form-group">
                        <label for="discount">Orders Access</label> <br>
                        <input type="checkbox" name="orders[view]" value="1" @if (isset($viewChecked)) {{$viewChecked}} @endif> View access &nbsp; &nbsp;
                        <input type="checkbox" name="orders[edit]" value="1" @if (isset($editChecked)) {{$editChecked}} @endif> Edit access &nbsp; &nbsp;
                        <input type="checkbox" name="orders[full]" value="1" @if (isset($fullChecked)) {{$fullChecked}} @endif> Full access &nbsp; &nbsp;
                    </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Change</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
</div>
@show

@section('script')

@endsection


