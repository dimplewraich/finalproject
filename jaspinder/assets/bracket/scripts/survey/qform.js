gl.qform = gl.qform || {};
gl.qform.form = gl.qform.form || {
	
	_frm : true
	,_init_m : function(){
		
		this._frm.find('select[name="question_type"]').change(function(){
			
			var question_type = gl.qform.form._frm.find('select[name="question_type"] option:selected').sval();
			
			$('.div-allowed-types, .div-max-size, .div-db-table, .div-options').hide();
			if(question_type == 'upload'){
				$('.div-allowed-types, .div-max-size').show();
			} else if(question_type == 'database_table'){
				$('.div-db-table').show();
			} else if(question_type == 'select' || question_type == 'checkbox' || question_type == 'radio'){
				$('.div-options').show();
			}
		});
	}
	
	,close_modal : function (response, form){
	}
}

$('document').ready(function() {
	
	gl.qform.form._frm  = $("form[name='frm-qform']");
	
	gl.qform.form._init_m();
});