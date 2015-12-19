jQuery.validator.setDefaults({
	debug: true,
	success: "valid"
});
gl.user = gl.user || {};
gl.user.form = gl.user.form || {

	_frm : null,
	_init : function(){
	
		gl.user.form._frm.find("select").each(function(i,mySelect){
			gl.select2({ "form_ctrl" : $(mySelect), empty : false});
		});
	},
	
	_init_options : function(){
		
		var com = gl.user.form._frm.find('select[name="company_id"]');
		
		gl.user.form._frm.find(".client_option").hide();
		gl.user.form._frm.find(".company_option").hide();
		gl.user.form._frm.find(".timezone_menu").show();
		
		gl.select2({ "form_ctrl" : gl.user.form._frm.find('select#client_ids'), empty : true});
		
		var group_id = gl.to_int(gl.user.form._frm.find('select[name="group_id"] option:selected').sval());
		var company_id = gl.to_int(gl.user.form._frm.find('select[name="company_id"] option:selected').sval());

		if(parseInt(group_id) <= 1){
			
			if(com.length > 0){
				com.find('option[value=""]').prop('selected', true);
				com.trigger("chosen:updated");
				gl.user.form._frm.find(".company_option").hide();
			}
			return;
		} 

		if(com.length > 0){
			gl.user.form._frm.find(".company_option").show();
		}
		
		if ( (group_id == 4)) {
			
			gl.user.form._frm.find(".client_option").show();
			gl.user.form._init_clients({client_id : 0});
			
		} else {
			
			gl.select2({ "form_ctrl" : gl.user.form._frm.find('select#client_ids'), empty : true});
			gl.user.form._frm.find(".client_option").hide();
		}
		
	},

	_init_companies : function(response){
	
		gl.dropdown({
			form_action : "agencies/get_all_companies"
			,form_data : {}
			,form_ctrl : gl.user.form._frm.find("select[name='company_id']")
			,select_type : "select2"
			,callback_fun : "gl.user.form._set_company("+response.company_id+");"
		});
	},
	
	_init_clients: function(response){
	
		var company_id = gl.user.form._frm.find('select[name="company_id"] option:selected').sval();
		
		gl.select2({ "form_ctrl" : gl.user.form._frm.find('select#client_ids')});
		
		gl.dropdown({
			form_action : "clients/get_clients_by_company_id"
			,form_data : {'company_id': company_id}
			,form_ctrl : gl.user.form._frm.find('select#client_ids')
			,select_type : "select2"
			,callback_fun : "gl.user.form._set_client("+response.client_id+");"
		});
		
	},
	
	_set_company : function(company_id){
		
		var com = gl.user.form._frm.find('select[name="company_id"]');
		if(com.length <= 0 || gl.to_int(company_id) <= 0){
			return;
		}
		
		com.find('option[value="'+company_id+'"]').prop('selected', true);
		com.trigger("chosen:updated");
		
		gl.user.form._init_options();
	},
	
	_set_client : function(client_id){
		
		var client = gl.user.form._frm.find('select[name="client_id"]');
		if(client.length <= 0 || gl.to_int(client_id) == ""){
			return;
		}
		
		client.find('option[value="'+client_id+'"]').prop('selected', true);
		client.trigger("chosen:updated");
	},
	
	avatar_callback : function(response){
	
		if(response.status == "success") {

			var avatar = '<img alt="" class="image" src="' + CDN_URL + 'documents/profile/' + response.avatar + '" /><input type="hidden" name="user_avatar_img" value="'+response.avatar+'" />';

			$("div.user_avatar").html(avatar);
		}
	}
	
}

$(document).ready(function() {

	gl.user.form._frm = $('form[name="frm-user"]');

    gl.user.form._frm.find('select[name="group_id"]').change(function() {
		gl.user.form._init_options();
    });

    gl.user.form._frm.find('select[name="company_id"]').change(function() {
        gl.user.form._init_options();
    });
	
	gl.user.form._frm.find("button[name='btn-upload']").click(function () {
		gl.upload_document(SITE_URL +"users/upload", {}, "user_avatar", "gl.user.form.avatar_callback(response);");
	});
	
	gl.user.form._init();

});