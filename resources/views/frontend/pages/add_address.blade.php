
@extends('frontend.layouts.app')

@push('stylesheet')

@endpush

@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">{{$userData['name']}}</li>
    </ul>
	<h3> Hello! {{$userData['name']}}</h3>
	<hr class="soft"/>

	<div class="row  m-auto">
		<div class="span6">
			<div class="well">
			<h5>Add New Address</h5><br/>
			Add your delivery info.<br/><br/><br/>
			<form id="AddDeliveriInfoForm" action="{{url('/add-delivery-address')}}" method="post">@csrf
			  <div class="control-group">
				<label class="control-label" for="name">Name</label>
				<div class="controls">
				  <input class="span3"  type="text" id="name" placeholder="Enter Name" name="name" @if(isset($userData['name'])) value="{{$userData['name']}}" @else value="{{old('name')}}" @endif required >
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="address">Address</label>
				<div class="controls">
				  <input class="span3"  type="text" id="address" placeholder="Enter address" name="address"  @if(isset($userData['address'])) value="{{$userData['address']}}" @else value="{{old('name')}}" @endif required>
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="city">City</label>
				<div class="controls">
				  <input class="span3"  type="text" id="city" placeholder="Enter city" name="city"  @if(isset($userData['city'])) value="{{$userData['city']}}" @else value="{{old('name')}}" @endif required>
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="state">State</label>
				<div class="controls">
				  <input class="span3"  type="text" id="state" placeholder="Enter state" name="state"  @if(isset($userData['state'])) value="{{$userData['state']}}" @else value="{{old('state')}}" @endif required>
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="country">Country</label>
				<div class="controls">
                  <select class="span3" name="country" id="country">
                      <option >Select Country</option>
                      @foreach ($countries as $country)
                      <option>{{$country['country_name']}}</option>
                      @endforeach
                  </select>
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="pincode">Pincode</label>
				<div class="controls">
				  <input class="span3"  type="text" id="pincode" placeholder="Enter pincode" name="pincode"  @if(isset($userData['pincode'])) value="{{$userData['pincode']}}" @else value="{{old('pincode')}}" @endif required>
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="Mobile">Mobile</label>
				<div class="controls">
				  <input class="span3"  type="mobile" id="mobile" placeholder="Enter Mobile" name="mobile"  @if(isset($userData['mobile'])) value="{{$userData['mobile']}}" @else value="{{old('mobile')}}" @endif required>
				</div>
			  </div>
			  <div class="controls">
			  <button type="submit" class="btn block">Submit</button>
			  </div>
			</form>
		</div>
		</div>
	</div>

</div>
</div></div>
</div>
@endsection
