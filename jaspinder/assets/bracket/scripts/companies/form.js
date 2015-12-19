jQuery.validator.setDefaults({
	debug: true,
	success: "valid"
});
gl.company = gl.company || {};
gl.company.form = gl.company.form || {

	_frm : null,
	_init : function(){
	
		gl.company.form._frm.find("select").each(function(i,mySelect){
			gl.select2({ "form_ctrl" : $(mySelect), empty : false});
		});
	},
	
	avatar_callback : function(response){console.log(response);
	
		if(response.status == "success") {

			var company_logo = '<img alt="" class="image" src="' + CDN_URL + 'documents/companylogo/' + response.logo + '" /><input type="hidden" name="company_logo_img" value="'+response.logo+'" />';

			$("div.company_logo").html(company_logo);
		}
	}
	
}

$(document).ready(function() {

	gl.company.form._frm = $('form[name="frm-company"]');
	
	gl.company.form._frm.find("button[name='btn-upload']").click(function () {
		gl.upload_document(SITE_URL +"agencies/upload", {}, "company_logo", "gl.company.form.avatar_callback(response);");
	});
	
	gl.company.form._init();

});