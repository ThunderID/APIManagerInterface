; var apimanager_ajax = { 

	init: function(){
		var ajax = function(url, callback) {
			$.ajax({url: url, success: function(result){
				callback(result);
		    }});
		}
	},

	init_generateKey: function(url){
		$( "#generateKey" ).click(function() {
			//loading state
			$("#inputKey").val('Generating');

			//processing
			ajax(url, function(data) { 
				$("#inputKey").val(data.data);
		    });
		});
	}

	init_generateSecret: function(url){
		$( "#generateSecret" ).click(function() {
			//loading state
			$("#inputSecret").val('Generating');
			
			//processing
			ajax("{!! route('generate.secret') !!}", function(data) { 
				$("#inputSecret").val(data.data);
		    });
		});	
	}

}