jQuery.validator.setDefaults({
	debug: true,
	success: "valid"
});
gl.site = gl.site || {};
gl.site.form = gl.site.form || {
	
	_frm : null
	,_row_index : 0
	
	,init_wizard : function(){
		
		gl.site.form._frm.find('div.basic-wizard').bootstrapWizard({
			'nextSelector': '.next',
			'previousSelector': '.previous',
			onNext: function(tab, navigation, index) {
			
				$flag = true;$error = [];
				if(index == 1){
				
					if(gl.site.form._frm.find("select#company_id").length > 0 && gl.site.form._frm.find("select#company_id option:selected").sval() == ""){
						$flag = false;
						$error.push('<p>The agency field is required</p>');
					}
					
					if(gl.site.form._frm.find("input[name='site_code']").sval() == ""){
						$flag = false;
						$error.push('<p>The Site ID field is required</p>');
					}
					
					if(gl.site.form._frm.find("input[name='address']").sval() == ""){
						$flag = false;
						$error.push('<p>The address field is required</p>');
					}
					
					if(gl.site.form._frm.find("input[name='street']").sval() == ""){
						$flag = false;
						$error.push('<p>The street field is required</p>');
					}
					
					if(gl.site.form._frm.find("input[name='town']").sval() == ""){
						$flag = false;
						$error.push('<p>The town field is required</p>');
					}
				}
				
				if($flag == false){
					gl.show_error($error.join(''));
					return false;
				}
				
				var $total = navigation.find('li').length;
				var $current = index+1;
				
				if($current == ($total + 1)){
					gl.site.form._frm.submit();
				}
			},
			onPrevious: function(tab, navigation, index) {
				
			},
			onTabShow: function(tab, navigation, index) {
			
				var $total = navigation.find('li').length;
				var $current = index+1;
				var $percent = ($current/$total) * 100;
				gl.site.form._frm.find('.progress-bar').css('width', $percent+'%');
				
				if($current >= $total){
					gl.site.form._frm.find("button[name='btn-submit']").html("Save Changes");
				} else{
					gl.site.form._frm.find("button[name='btn-submit']").html("Next");
				}
			},
			tabClass: 'nav nav-pills nav-justified nav-disabled-click',
			onTabClick: function(tab, navigation, index) {
				return false;
			}
		});
	}
}

$('document').ready(function() {
	
	gl.site.form._frm = $("form[name='frm-site']");
	
	/*gl.site.form._frm.find("select").each(function(i,ctrl){
		$(ctrl).chosen({'width':'100%', 'white-space':'nowrap', allow_single_deselect:true});
	});*/
	
	gl.site.form.init_wizard();
});