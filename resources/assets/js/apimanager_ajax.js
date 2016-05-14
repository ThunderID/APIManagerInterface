; var apimanager_ajax = { 

	ajax: function(url, callback) {
		$.ajax({url: url, success: function(result){
			if(callback) callback(result);
	    }});
	},

	init_generateKey: function(url){
		$( "#generateKey" ).click(function() {
			//loading state
			$("#inputKey").val('Generating');

			//processing
			apimanager_ajax.ajax(url, function(data) { 
				$("#inputKey").val(data.data);
		    });
		});
	},

	init_generateSecret: function(url){
		$( "#generateSecret" ).click(function() {
			//loading state
			$("#inputSecret").val('Generating');
			
			//processing
			apimanager_ajax.ajax(url, function(data) { 
				$("#inputSecret").val(data.data);
		    });
		});	
	}	
}