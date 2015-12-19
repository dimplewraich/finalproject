gl.site = gl.site || {};
gl.site.survey = gl.site.survey || {

	_frm : null,
	_thispage : null,
	_init : function(){
	
		this._frm.find("select").each(function(i,mySelect){
			$(mySelect).formmarkup();
		});
	},
	
	avatar_callback : function(response){
	
		if(response.status == "success") {

			var avatar = '<img alt="" class="image" src="' + CDN_URL + 'documents/profile/' + response.avatar + '" /><input type="hidden" name="user_avatar_img" value="'+response.avatar+'" />';

			$("div.user_avatar").html(avatar);
		}
	}
	
}

$(document).on('pagecreate', page_id,  function() {

	$thispage = $(page_id);
	
	gl.site.survey._thispage = $thispage;
	gl.site.survey._frm = $thispage.find('form[name="frm-site-survey"]');
	
	gl.site.survey._init();
});