jQuery(document).ready( function($) {
alert(admajax.ajax_url);
$("#s").keyup(function(){
	alert(keyVal);

	var keyVal = $(this).val();
	
	if(keyVal){
		
		$.ajax({
			type : "POST",
			url: admajax.ajax_url, //"http://localhost/mywp/wp-admin/admin-ajax.php",
			data : {
				action: 'get_result_ajax',
				s: keyVal 
			},
			//data: 'action=get_result_ajax&s='+ keyVal ,
			
			//contentType: "application/json; charset=utf-8",
            //dataType: "json", 
			
            
			
			success: function( response ) {
				 $("#ajax-result").html(response);
				 //alert(response);
				 
			},
			error: function (error) {
                console.log(error);
            }
			//, beforeSend and noces
		});
	} else {
		 $("#ajax-result").html("1");
	}
	//return false;
	
});

});

