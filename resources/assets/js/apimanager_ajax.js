; var apimanager_ajax = { 

	init: function(){
		var ajax = function(url, callback) {
			$.ajax({url: url, success: function(result){
				callback(result);
		    }});
		}

		$( "#generateKey" ).click(function() {
			//loading state
			$("#inputKey").val('Generating');

			//processing
			ajax("{!! route('generate.key') !!}", function(data) { 
				$("#inputKey").val(data.data);
		    });
		});

		$( "#generateSecret" ).click(function() {
			//loading state
			$("#inputSecret").val('Generating');
			
			//processing
			ajax("{!! route('generate.secret') !!}", function(data) { 
				$("#inputSecret").val(data.data);
		    });
		});	
	},
}