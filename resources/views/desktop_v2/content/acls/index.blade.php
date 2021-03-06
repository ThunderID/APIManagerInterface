@extends('desktop_v2.wireframe_full')

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
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
			<input type="input" class="form-control" name="q" placeholder="Searching...">
		</div>
		<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 text-xs-right">
			<a href="{{ route('acls.create', ['id' => $page_datas->datas['client']['id']]) }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Add New ACL</a>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table">
				<thead>
					<tr>
						<th>No.</th>
						<th>Username</th>
						<th>Scopes</th>
						<th>Client</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($page_datas->datas['acls'] as $key => $value)
						<tr>
							<td scope="row">{{$key + 1}}</td>
							<td>{{$value['user']['name']}}</td>
							<td>
								{{ $value['scope']['name'] }}
							</td>
							<td>{{$page_datas->datas['client']['name']}}</td>
							<td class="text-xs-right">
								<a href="{{route('acls.edit',['client_id' => $page_datas->datas['client']['id'], 'id' => $value['id']])}}" class="btn btn-secondary white-hover-text btn-sm">Edit</a>
								<a class="btn btn-secondary white-hover-text btn-sm" href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" 
									data-target="#delete"
									data-id="{{$value['id']}}"
									data-title="Hapus Data ACL {{$value['user']['name']}}"
									data-effect="Menghapus ACL akan menonaktifkan pemberian akses pada {{$value['user']['name']}}. Masukkan password Anda untuk melanjutkan "
									data-action="{{ route('acls.destroy',['client_id' => $page_datas->datas['client']['id'], 'id' => $value['id']]) }}">
									Hapus
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@include('desktop_v2.components.modal_delete')
<!-- End of Auth Index -->
@stop

@section('js')
	<script type="text/javascript">
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