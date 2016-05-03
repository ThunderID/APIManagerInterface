@extends('desktop_v2.wireframe_full')

@section('content')
<div class="container">
	<div class="row m-b-1">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active p-x-2" href="{{ route('acls.index', ['id' => $page_datas->datas['id']]) }}">APPS</a>
				</li>
			</ul>
		</div>
	</div>
	{!! Form::open(['url' => route('acls.store', ['id' => $page_datas->datas['id']]), 'class' => 'form']) !!}
		<div class="row m-b-1">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<fieldset class="form-group">
					<label>Grant Id</label>
					{!! Form::text('grant_id', null, ['class' => 'form-control']) !!}
				</fieldset>				
				<fieldset class="form-group">
					<label>User Id</label>
					{!! Form::text('user_id', null, ['class' => 'form-control']) !!}
				</fieldset>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<fieldset class="form-group">
					<label>Grant Name</label>
					{!! Form::text('grant_name', null, ['class' => 'form-control']) !!}
				</fieldset>
				<fieldset class="form-group">
					<label>Client Id</label>
					{!! Form::text('client_id', null, ['class' => 'form-control']) !!}
				</fieldset>

			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				{!! Form::submit('Save', ['class' => 'btn btn-primary btn-md']) !!}
			</div>
		</div>
	{!! Form::close() !!}
</div>

<!-- End of Auth Index -->
@stop