
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

	<div class="row">
		<div class="span4">
			<div class="well">
			<h5>Update your account info</h5><br/>
			Choose what you want to update.<br/><br/><br/>
			<form id="accountForm" action="{{url('/my_account')}}" method="post">@csrf
			  <div class="control-group">
				<label class="control-label" for="name">Name</label>
				<div class="controls">
				  <input class="span3"  type="text" id="name" placeholder="Enter Name" name="name" value="{{$userData['name']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="address">Address</label>
				<div class="controls">
				  <input class="span3"  type="text" id="address" placeholder="Enter address" name="address"value="{{$userData['address']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="city">City</label>
				<div class="controls">
				  <input class="span3"  type="text" id="city" placeholder="Enter city" name="city" value="{{$userData['city']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="state">State</label>
				<div class="controls">
				  <input class="span3"  type="text" id="state" placeholder="Enter state" name="state"value="{{$userData['state']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="country">Country</label>
				<div class="controls">
                  <select class="span3" name="country" id="country">
                      <option >Select Country</option>
                      @foreach ($counties as $country)
                      <option value="{{$country['country_name']}}" @if ($country['country_name']==$userData['country']) selected="" @endif >{{$country['country_name']}}</option>
                      @endforeach
                  </select>
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="pincode">Pincode</label>
				<div class="controls">
				  <input class="span3"  type="text" id="pincode" placeholder="Enter pinCode" name="pinCode" value="{{$userData['pinCode']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="Mobile">Mobile</label>
				<div class="controls">
				  <input class="span3"  type="mobile" id="mobile" placeholder="Enter Mobile" name="mobile"value="{{$userData['mobile']}}">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="email">Email</label>
				<div class="controls">
				  <input class="span3" readonly value="{{$userData['email']}}">
				</div>
			  </div>
			  <div class="controls">
			  <button type="submit" class="btn block">Update Info</button>
			  </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>UPDATE PASSWORD</h5>
			<form id="updatePasswordForm" action="{{url('/update-user-password')}}" method="POST">@csrf
			  <div class="control-group">
				<label class="control-label" for="current">Current password</label>
				<div class="controls">
				  <input type="password" class="span3"  id="current" placeholder="Enter current password" name="current">
                  <br> <span id="pswd"></span>
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="new">New password</label>
				<div class="controls">
				  <input type="password" class="span3"  id="new" placeholder="Enter new password" name="new">
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="confirm">Confirm new password</label>
				<div class="controls">
				  <input type="password" class="span3"  id="confirm" placeholder="Confirm new password" name="confirm">
				</div>
			  </div>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" class="btn">Update</button>
                  <a href="{{url('forgot-password')}}">Forgot password?</a>
				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>

</div>
</div></div>
</div>
@endsection
