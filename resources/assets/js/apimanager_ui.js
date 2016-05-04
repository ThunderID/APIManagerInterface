; var apimanager_select2 = { 
	select_scope: function(){
		$('.select-scope').select2({
			tags: true
		});
	},
	init: function(){
		this.select_scope();
	}
};

; var apimanager_ui = {
	init: function() {
		apimanager_select2.init();
	}
}