gl.qform = gl.qform || {};
gl.qform.listing = gl.qform.listing || {
	
	_default_load : true,
	_init_m : function(){
		
	},
	
	load_grid : function(flag){
	
		var sort_ids = [];
		$( 'div[id*="ccl_"]' ).each(function(index, ctrl){
			var rowid = $(ctrl)[0].id;
			sort_ids.push(rowid.replace(/ccl_/g, ''));
		});
	
		gl._form({
			form_url : question_sort_url
			,form_method : 'POST'
			,data_type : 'json'
			,params : 'ajax'
			,form_data : {'confirm' : 1, 'sort_ids' : sort_ids}
			,callback : "gl.qform.listing._sort_callback()"
		});
	},
	
	_sort_callback : function (response, form){
		
		gl._get({
			form_url : questions_url
			,form_method : 'GET'
			,data_type : 'html'
			,params : 'echo'
			,callback : "gl.qform.listing._refresh_callback(response, form)"
		});
	},
	
	_refresh_callback : function (response, form){
		
		$("#sortable_accordion").html(response);
		
		$( "#sortable_accordion" ).sortable( "refresh" );
		$( "#sortable_accordion a.btn-edit" ).show();
		gl.bind_ajax();
	},
	
	close_modal : function (response, form){
	}
}

$('document').ready(function() {
	
	$( "#sortable_accordion" ).sortable({
      placeholder: "ui-state-highlight"
	  ,forceHelperSize: true
    });
	
	$( "#sortable_accordion" ).disableSelection();
	
	$( "#sortable_accordion" ).on( "sortstop", function( event, ui ) {
		
		var sorted = $( "#sortable_accordion" ).sortable( "serialize", { key: "sort" } );
		
		var sortedIDs = $( "#sortable_accordion" ).sortable( "toArray" );
		
		gl.qform.listing.load_grid();
		
	});
	
	$( "#sortable_accordion" ).on( "sort", function( event, ui ) {
		
		$( "#sortable_accordion a.btn-edit" ).hide();
		
	});
});