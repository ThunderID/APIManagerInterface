@extends('desktop_v2.wireframe_blank')

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
			{!! Form::open(['url' => route('auth.postLogin'), 'class' => 'form p-a-2']) !!}
				<fieldset class="form-group">
					<label>Username</label>
					{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'example']) !!}
				</fieldset>
				<fieldset class="form-group">
					<label>Password</label>
					{!! Form::password('password', ['class' => 'form-control', 'placeholder' => '********']) !!}
				</fieldset>
				{!! Form::submit('Sign In', ['class' => 'btn btn-primary btn-block']) !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- End of Auth Index -->
@stop