jQuery.validator.setDefaults({
	debug: true,
	success: "valid"
});
gl.user = gl.user || {};
gl.user.view = gl.user.view || {
	
	_frm : null
	,_row_index : 0
	
	,init_wizard : function(){
	
	}
}

$('document').ready(function() {
	
	gl.user.view._frm = $("form[name='frm-user-view']");
	
	gl.user.view.init_wizard();
	
});