gl.sfform = gl.sfform || {};
gl.sfform.listing = gl.sfform.listing || {
	
	_default_load : true,
	_init_m : function(){
	},
	
	load_grid : function(g){
	
		gl._get({
			form_url : SITE_URL + "survey/index"
			,form_method : 'GET'
			,data_type : 'html'
			,params : 'echo'
			,callback : "gl.sfform.listing._callback(response, form)"
		});
	},
	
	_callback : function (response, form){
		
		$(".panel-body").html(response);
		gl.bind_ajax();
	},
	
	close_modal : function (response, form){
	}
}