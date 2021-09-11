@extends('frontend.layouts.app')

@push('stylesheet')

@endpush

@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small><span class="cartCountItems">{{  countCartItems()}}</span> Item(s) </small>]<a href="products.html" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>
    <div id="appendCartItem" >
         @include('frontend.pages.cart_ajax')
    </div>
    <table class="table table-bordered">
		<tbody>
		  <tr>
			<td>
                <form id="applyCoupon" method="post" action="javascript:void(0);" class="form-horizontal"  @if (Auth::check()) user="1" @endif>
                    @csrf
                    <div class="control-group">
                        <label class="control-label"><strong> COUPON CODE: </strong> </label>
                        <div class="controls">
                            <input type="text" name="code" id="code" class="input-medium" placeholder="Enter coupon CODE" required>
                            <button type="submit" class="btn"> ADD </button>
                        </div>
                    </div>
                </form>
			</td>
		  </tr>

		</tbody>
	</table>
	<a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<a href="{{url('/checkout')}}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>

</div>
</div></div>
@endsection
