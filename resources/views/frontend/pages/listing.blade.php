@extends('frontend.layouts.app')

@push('style-sheet')

@endpush
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{route('index')}}">Home</a> <span class="divider">/</span></li>
        <li class="active"><?php echo $categoryDetails['breadcrumbs']?></li>
    </ul>
    <h3> {{$categoryDetails['catDetails']['category_name']}}</h3>
    <hr class="soft"/>
    <p>
        {{$categoryDetails['catDetails']['description']}}
    </p>

    @if (!isset($_REQUEST['search']))
    <hr class="soft"/>
    <form name="sortProducts" id="sortProducts" class="form-horizontal span6">
        <input type="hidden" value="{{$url}}" name="url" id="url">
        <div class="control-group">
            <label class="control-label alignL">Sort By </label>
            <select name="sort" id="sort">
                <option value="">Select</option>
                <option value="latest_product" @if(isset($_GET['sort']) && $_GET['sort']=='latest_product') selected="" @endif>Latest Product</option>
                <option value="a_z" @if(isset($_GET['sort']) && $_GET['sort']=='a_z') selected="" @endif>Product name A - Z</option>
                <option value="z_a" @if(isset($_GET['sort']) && $_GET['sort']=='z_a') selected="" @endif>Priduct name Z - A</option>
                <option value="lowest_price" @if(isset($_GET['sort']) && $_GET['sort']=='lowest_price') selected="" @endif>Lowest Price first</option>
                <option value="height_price" @if(isset($_GET['sort']) && $_GET['sort']=='height_price') selected="" @endif>Height Price first</option>
            </select>
        </div>
    </form>
    @endif
    <br class="clr"/>
    <div class="tab-content">
        @include('frontend.pages.ajax_listing')
    </div>
    <a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
    @if (!isset($_REQUEST['search']))
    <div class="pagination">
        @if (isset($_GET['sort']) && !empty($_GET['sort']))
        {{$categoryProducts->appends(['sort' => $_GET['sort']])->links()}}
         @else
         {{ $categoryProducts->links() }}
        @endif
    </div>
    @endif
    <br class="clr"/>
</div>
</div>
</div>
@endsection

@push('script')

@endpush
