
@extends('frontend.layouts.app')

@push('stylesheet')

@endpush

@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">{{$addressInfo['name']}}</li>
    </ul>
	<h3> Hello! {{$addressInfo['name']}}</h3>
	<hr class="soft"/>

	<div class="row">
		<div class="span4">
			<div class="well">
			<h5>Update your account info</h5><br/>
			Choose what you want to update.<br/><br/><br/>
			<form id="accountForm" action="{{url('/edit-address',$addressInfo['id'])}}" method="post">@csrf
			  <div class="control-group">
				<label class="control-label" for="name">Name</label>
				<div class="controls">
				  <input class="span3"  type="text" id="name" placeholder="Enter Name" name="name" value="{{$addressInfo['name']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="address">Address</label>
				<div class="controls">
				  <input class="span3"  type="text" id="address" placeholder="Enter address" name="address"value="{{$addressInfo['address']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="city">City</label>
				<div class="controls">
				  <input class="span3"  type="text" id="city" placeholder="Enter city" name="city" value="{{$addressInfo['city']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="state">State</label>
				<div class="controls">
				  <input class="span3"  type="text" id="state" placeholder="Enter state" name="state"value="{{$addressInfo['state']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="country">Country</label>
				<div class="controls">
                  <select class="span3" name="country" id="country">
                      <option >Select Country</option>
                      @foreach ($countries as $country)
                      <option value="{{$country['country_name']}}" @if ($country['country_name']==$addressInfo['country']) selected="" @endif >{{$country['country_name']}}</option>
                      @endforeach
                  </select>
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="pincode">Pincode</label>
				<div class="controls">
				  <input class="span3"  type="text" id="pincode" placeholder="Enter pincode" name="pincode" value="{{$addressInfo['pincode']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="Mobile">Mobile</label>
				<div class="controls">
				  <input class="span3"  type="mobile" id="mobile" placeholder="Enter Mobile" name="mobile"value="{{$addressInfo['mobile']}}">
				</div>
			  </div>
			  <div class="controls">
			  <button type="submit" class="btn block">Update Adreess Info</button>
			  </div>
			</form>
		</div>
		</div>
		</div>
	</div>

</div>
</div></div>
</div>
@endsection
