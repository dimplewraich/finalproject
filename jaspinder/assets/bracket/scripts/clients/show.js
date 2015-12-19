jQuery.validator.setDefaults({
	debug: true,
	success: "valid"
});
gl.client = gl.client || {};
gl.client.view = gl.client.view || {
	
	_frm : null
	,_row_index : 0
	
	,init_wizard : function(){
		
		gl.client.view._frm.find('div.basic-wizard').bootstrapWizard({
			'nextSelector': '.next',
			'previousSelector': '.previous',
			onNext: function(tab, navigation, index) {
			
			},
			onPrevious: function(tab, navigation, index) {
				
			},
			onTabShow: function(tab, navigation, index) {
			
				var $total = navigation.find('li').length;
				var $current = index+1;
				var $percent = ($current/$total) * 100;
				gl.client.view._frm.find('.progress-bar').css('width', $percent+'%');
				
				if($current >= $total){
					gl.client.view._frm.find("button[name='btn-submit']").hide();
				} else{
					gl.client.view._frm.find("button[name='btn-submit']").show();
				}
				
				if($current <= 1 ){
					gl.client.view._frm.find("button[name='btn-previous']").hide();
				} else{
					gl.client.view._frm.find("button[name='btn-previous']").show();
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
	
	gl.client.view._frm = $("form[name='frm-view']");
	
	gl.client.view.init_wizard();
});