var $frmnote = null;
$('document').ready(function() {
	
	$frmnote = $("form[name='frm-note']");
	
	/*try{
		$frmnote.find("textarea.tinymce").tinymce().remove();
	}catch(e){}
	
	$frmnote.find('textarea.tinymce').tinymce({
		selector: "textarea",
		theme: "modern",
		width: "100%",
		height: 160,
		menubar : false,
		plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code"
	});*/
	
	if($("input#communication_date").length){
		$("input#communication_date").datepicker({dateFormat: 'dd/mm/yy'});
	}
	
	$("input#communication_date").closest('div').find('.fa-calendar').click(function(){
		$("input#communication_date").datepicker('show');
	});
	
});