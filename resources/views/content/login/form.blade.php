@extends('wireframe')

@section('content')

<!-- Auth Index -->
<div class="container">
	<div class="row m-b-1">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 center-block">
			<h2 class="m-b-0">Thunder APIManager</h2>
			<p class="text-12">oauth2 for thunder apps</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 center-block white">
			<form action="/logging/in" method="post" class="form p-a-2">
				<input name="grant_type" value="password" type="hidden">
				<input name="key" value="{{ env('OAUTH_KEY', '') }}" type="hidden">
				<input name="secret" value="{{ env('OAUTH_SECRET', '') }}" type="hidden">
				<input name="HTTP_HOST" value="{{ env('OAUTH_HOST', '') }}" type="hidden">
				<fieldset class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" placeholder="examplegmail.com">
				</fieldset>
				<fieldset class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" placeholder="************">
				</fieldset>
				<input type="submit" value="Sign In" class="btn btn-primary btn-block">
			</form>
		</div>
	</div>
	<div class="row m-t-3 text-xs-center">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p class="text-muted text-12">&copy; 2016 Thunder Lab Indonesia</p>
		</div>
	</div>
</div>

<!-- End of Auth Index -->
@stop