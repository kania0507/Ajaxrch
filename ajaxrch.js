jQuery(document).ready( function($) {
 var searchRequest = null;

 $("#s").keyup(function(){	 
	var keyVal = $(this).val();
	if(keyVal){
		
		searchRequest = $.ajax({
			type : "POST",
			url: admajax.ajax_url,
			data : {
				action: 'get_result_ajax',
				s: keyVal
			},						
			dataType: 'html',

			success: function( response ) {
				//alert(response);
				$("#ajax-result").html(response);				 
			},
			error: function (error) {				
                console.log(error);
            }
			//, beforeSend and noces						
		});
				
	} else {
		 $("#ajax-result").html("");		 
	}
	return false;
	
 });

});

