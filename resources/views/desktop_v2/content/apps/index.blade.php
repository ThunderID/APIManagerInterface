@extends('desktop_v2.wireframe_full')

@section('content')
<div class="container">
	<div class="row m-b-1">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link p-x-2" href="{{route('apps.index')}}">APPS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active p-x-2" href="{{route('acl.index')}}">ACL</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="row m-b-1">
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
			<input type="input" class="form-control" name="q" placeholder="Searching...">
		</div>
		<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 text-xs-right">
			<a href="{{ route('apps.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Add New Apps</a>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table">
				<tbody>
					@foreach($page_datas->datas['apps']['data'] as $key => $value)
						<tr>
							<th scope="row">{{$key + 1}}</th>
							<td>{{$value['name']}}</td>
							<td>{{$value['domain']}}</td>
							<td>
								@foreach($value['grants'] as $key2 => $value2)
									@if($value2['name']!='owned')
										{{$value2['name']}}
										<span class="font-size-10">scopes</span>
										<br/>
									@endif
								@endforeach
							</td>
							<td class="text-xs-right">
								<a href="{{route('acls.index', ['client_id' => $value['id']])}}" class="btn btn-secondary white-hover-text btn-sm">ACL</a>
								<a href="" class="btn btn-secondary white-hover-text btn-sm">Edit</a>
								<a href="" class="btn btn-secondary white-hover-text btn-sm">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
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