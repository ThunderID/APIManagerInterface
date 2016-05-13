; var apimanager_select2 = { 
	select_scope: function(){
		$('.select-scope').select2({
			tags: true
		});
	},

	select_user: function(preload_data_user){
		var action = $('.select-user').attr('data-route');

		$('.select-user').select2({
		placeholder: 'Masukkan nama karyawan',
		minimumInputLength: 3,
		data: preload_data_user,
		tags: false,
		ajax: {
			url: action,
			dataType: 'json',
			data: function (term) {
				return {
					term
				};
			},
			processResults: function (data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data
                };

            },

			}
		});	
	},

	init: function(){
		var preload_data_user	= $('.select-user').attr('data-user');
		this.select_scope();
		this.select_user(preload_data_user);
	}
};

; var apimanager_ui = {
	init: function() {
		apimanager_select2.init();
	}
}