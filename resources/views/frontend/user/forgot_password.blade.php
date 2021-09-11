
@extends('frontend.layouts.app')

@push('stylesheet')

@endpush

@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3> Login / Register</h3>
	<hr class="soft"/>

	<div class="row">
		<div class="span4">
			<div class="well">
			<h5>Forgot Password?</h5><br/>
			Enter enter your email to recover password.<br/><br/><br/>
			<form id="forgotPasswordForm" action="{{url('/forgot-password')}}" method="POST">@csrf
              <div class="control-group">
				<label class="control-label" for="email">E-mail address</label>
				<div class="controls">
				  <input class="span3"  type="Email" id="email" placeholder="Email" name="email">
				</div>
			   </div>
			  <div class="controls">
			  <button type="submit" class="btn block">Submit</button>
			  </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5> LOGIN </h5>
			<form id="loginForm" action="{{url('/login')}}" method="POST">@csrf
			  <div class="control-group">
				<label class="control-label" for="inputEmail1">Email</label>
				<div class="controls">
				  <input class="span3"  type="text" id="email" placeholder="Email" name="email">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
				  <input type="password" class="span3"  id="password" placeholder="Password" name="password">
				</div>
			  </div>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" class="btn">Sign in</button> <a href="{{url('forgot-password')}}">Forgot password?</a>
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
