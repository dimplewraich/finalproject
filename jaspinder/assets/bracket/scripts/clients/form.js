jQuery.validator.setDefaults({
	debug: true,
	success: "valid"
});
gl.client = gl.client || {};
gl.client.form = gl.client.form || {
	
	_frm : null
	,_row_index : 0
	
	,init_wizard : function(){
		
		gl.client.form._frm.find('div.basic-wizard').bootstrapWizard({
			'nextSelector': '.next',
			'previousSelector': '.previous',
			onNext: function(tab, navigation, index) {
			
				$flag = true;$error = [];
				if(index == 1){
				
					if(gl.client.form._frm.find("select#company_id").length > 0 && gl.client.form._frm.find("select#company_id option:selected").sval() == ""){
						$flag = false;
						$error.push('<p>The agency field is required</p>');
					}
					
					if(gl.client.form._frm.find("input[name='first_name']").sval() == ""){
						$flag = false;
						$error.push('<p>The first name field is required</p>');
					}
					
					if(gl.client.form._frm.find("input[name='last_name']").sval() == ""){
						$flag = false;
						$error.push('<p>The last name field is required</p>');
					}
					
					if(gl.client.form._frm.find("input[name='address']").sval() == ""){
						$flag = false;
						$error.push('<p>The address field is required</p>');
					}
					
					if(gl.client.form._frm.find("input[name='phone']").sval() == ""){
						$flag = false;
						$error.push('<p>The phone field is required</p>');
					}
				}
				
				if($flag == false){
					gl.show_error($error.join(''));
					return false;
				}
				
				var $total = navigation.find('li').length;
				var $current = index+1;
				
				if($current == ($total + 1)){
					gl.client.form._frm.submit();
				}
			},
			onPrevious: function(tab, navigation, index) {
				
			},
			onTabShow: function(tab, navigation, index) {
			
				var $total = navigation.find('li').length;
				var $current = index+1;
				var $percent = ($current/$total) * 100;
				gl.client.form._frm.find('.progress-bar').css('width', $percent+'%');
				
				if($current >= $total){
					gl.client.form._frm.find("button[name='btn-submit']").html("Save Changes");
				} else{
					gl.client.form._frm.find("button[name='btn-submit']").html("Next");
				}
			},
			tabClass: 'nav nav-pills nav-justified nav-disabled-click',
			onTabClick: function(tab, navigation, index) {
				return false;
			}
		});
	},
	
	avatar_callback : function(response){
	
		if(response.status == "success") {

			var avatar = '<img alt="" class="image" src="' + CDN_URL + 'documents/profile/' + response.avatar + '" /><input type="hidden" name="profile_avatar_img" value="'+response.avatar+'" />';

			$("div.profile_avatar").html(avatar);
		}
	}
}

$('document').ready(function() {
	
	gl.client.form._frm = $("form[name='frm-client']");
	
	gl.client.form._frm.find("select").each(function(i,ctrl){
		$(ctrl).chosen({'width':'100%', 'white-space':'nowrap', allow_single_deselect:true});
	});
	
	gl.client.form._frm.find("button[name='btn-upload']").click(function () {
		gl.upload_document(SITE_URL +"clients/upload", {}, "profile_avatar", "gl.client.form.avatar_callback(response);");
	});
	
	gl.client.form.init_wizard();
});