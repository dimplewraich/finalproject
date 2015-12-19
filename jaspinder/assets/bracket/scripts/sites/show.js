jQuery.validator.setDefaults({
	debug: true,
	success: "valid"
});
gl.site = gl.site || {};
gl.site.view = gl.site.view || {
	
	_frm : null
	,_row_index : 0
	
	, reload_site_form : function(){
		
		var _form_url = this._frm.attr('action');
		
		gl._get({
			form_url : _form_url
			, data_type : "html" 
			, form_method : "GET"
			, callback : 'gl.site.view._reload_callback(response, form);'
		});
		
	}
	
	,_reload_callback : function(response, form){
		
		this._frm.closest('div').html(response);
		gl.bind_ajax();
		
	}
}

$('document').ready(function() {
	
	gl.site.view._frm = $("form[name='frm-site-view']");
});