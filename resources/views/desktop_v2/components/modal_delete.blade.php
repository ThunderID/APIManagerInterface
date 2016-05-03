<!-- Modal -->
<div id="delete" class="modal fade  padding-top-58" role="dialog">
	 <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<div class="font-18 modal_title text-uppercase"></div>
			</div>
			<div class="modal-body">
				<p id="data-effect"></p>
				{!! Form::open(['method' => 'DELETE', 'class' => 'modal_delete_action']) !!}
					{!! Form::input('hidden', 'id', NULL,  
							['class' => 'mod_id']
					) !!}   
					<div class="form-group">
						<div class="font-14 modal_effect"></div>
					</div>
					 <div class="form-group">
						{!! Form::Password('password', [
									'class'        => 'form-control mod_pwd',
									'required'     => 'required', 
									'tabindex'     => '1'
						]) !!}
					</div>
					</br>
					<div class="form-group text-xs-right">
						<button type="button" class="btn btn-secondary" tabindex="2" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-danger" tabindex="1">Hapus</button>
					</div>    
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
