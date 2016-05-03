@extends('desktop_v2.wireframe')

@section('content')
<div class="container">
	<div class="row m-b-1">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active p-x-2" href="{{route('apps.index')}}">APPS</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="row m-b-1">
		<div class="col-xs-12 col-sm-12 col-md-6">
			{!! Form::open(['url' => route('apps.index'), 'method' => 'GET', 'class' => 'form-inline']) !!}
				<input type="input" class="form-control" name="q" placeholder="Cari Aplikasi">
				<input type="submit" class="form-control" value="Cari">
			{!! Form::close() !!}

			@if(isset($page_datas->search))
				<small>Menampilkan pencarian "{{$page_datas->search}}"  <a href="{{route('apps.index')}}" class="link-black font-size-18"><i class="fa fa-close"></i></a></small>
			@endif
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 text-xs-right">
			<a href="{{route('apps.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Add New Apps</a>
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
										<small>
											<a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" 
												data-target="#scopes"
												data-title="Scope {{$value2['name']}} Klien {{$value['name']}}"
												data-scope="{{json_encode($value2['scopes'])}}"
											>
												Scope
											</a>
										</small>
										<br/>
									@endif
								@endforeach
							</td>
							<td class="text-xs-right">
								<a href="{{route('acls.index', ['client_id' => $value['id']])}}" class="btn btn-secondary white-hover-text btn-sm">ACL</a>
								<a href="{{route('apps.edit', ['id' => $value['id']])}}" class="btn btn-secondary white-hover-text btn-sm">Edit</a>
								<a class="btn btn-secondary white-hover-text btn-sm" href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" 
									data-target="#delete"
									data-id="{{$value['id']}}"
									data-title="Hapus Data App {{$value['name']}}"
									data-effect="Menghapus App akan menghapus data acl dan menonaktifkan pemberian resource pada {{$value['domain']}}. Masukkan password Anda untuk melanjutkan "
									data-action="{{ route('apps.destroy', $value['id']) }}">
									Hapus
								</a>
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

@include('desktop_v2.content.apps.scopes')
@include('desktop_v2.components.modal_delete')
@stop

@section('js')
	<script type="text/javascript">
		$('#scopes').on('show.bs.modal', function (e) {

			var scope		= $(e.relatedTarget).attr('data-scope');
			var title		= $(e.relatedTarget).attr('data-title');
			
			$(".modal_title").html(title);
			$(".modal_body").html('');
			
			scopes 			= JSON.parse(scope);
	
			$.each(scopes, function (index, sscope) {
				$(".modal_body").append(" <p> " + sscope.name + " </p> ");
			});
		});

		$('#delete').on('show.bs.modal', function (e) {
			var id      = $(e.relatedTarget).attr('data-id');
			var title   = $(e.relatedTarget).attr('data-title');
			var effect  = $(e.relatedTarget).attr('data-effect');
			var action  = $(e.relatedTarget).attr('data-action');

			$('.mod_id').val(id);
			$('.modal_title').html(title);
			$('.modal_effect').html(effect);
			$('.modal_delete_action').attr('action', action);
		});  
	</script>
@stop