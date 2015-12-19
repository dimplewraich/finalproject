gl.agency = gl.agency || {};
gl.agency.listing = gl.agency.listing || {
	
	_default_load : true,
	_init_m : function(){
		gl.agency.listing._init_d();
	},
	_init_d : function (){
	
		var $this = $thispage.find("form[name='grid-list-param']") 
				,g = $this.data('options');
		console.log($.extend({},g.grid));
		g.grid = $.extend({
			_bFilter : true,
			_bLengthChange : true,
			_aaSorting : [],
			_init_ctrls : false,
			_frm : false,
			_oTable : false,
			_oSettings : false,
			_sKey : 'DataTables_'+window.location.pathname,
			_default : true,
			_table_id : "",
			_aoColumnDefs : [],
			_grid_url : ""
		}, g.grid,  {_frm : $this});
		
		g.grid._aaSorting = eval(g.grid._aaSorting);
		g.grid._aoColumnDefs = eval(g.grid._aoColumnDefs);
	console.log($.extend({},g.grid));
		this.load_grid(g);
	},
	
	load_grid : function(g){
	
		var _init_grid = typeof g.grid._init !== 'undefined' ? g.grid._init : false;
	
		g.grid = $.extend({
			_bFilter : true,
			_bLengthChange : true,
			_aaSorting : [[0, 'desc']],
			_init_ctrls : false,
			_frm : false,
			_oTable : false,
			_oSettings : false,
			_sKey : 'DataTables_'+window.location.pathname,
			_default : true,
			_table_id : "",
			_aoColumnDefs : [],
			_grid_url : ""
		}, g.grid || {}, {_init_ctrls : false});
		//console.log(g.grid);
		var oTable = $(g.grid._table_id).dataTable({
			responsive: true
			//,"sPaginationType": "full_numbers" /*full_numbers|two_button*/
			,"bFilter": g.grid._bFilter
			,"bLengthChange" : g.grid._bLengthChange
			,"bJQueryUI": false
			,"bAutoWidth": false
			,"bStateSave": true
			,"fnStateSave": function (oSettings, oData) {
				localStorage.setItem( g.grid._sKey, JSON.stringify(oData) );
			}
			,"fnStateLoad": function (oSettings) {
				return JSON.parse( localStorage.getItem(g.grid._sKey) );
			}
			,"bDestroy": true
			,"fnServerParams": function(aoData) {
				
			}
			,"bProcessing": true
			,"bServerSide": true
			,"sServerMethod": "POST"
			,"sAjaxSource": g.grid._grid_url
			,"iDisplayLength": 5 /* iDisplayLength is now legacy. Use pageLength instead */
			,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
			,"aaSorting": g.grid._aaSorting
			,"aoColumns": g.grid._aoColumnDefs
			,fnCreatedRow : function( nRow, aData, iDataIndex ) {
			}
			,"fnDrawCallback": function( oSettings ) {
				gl.bind_ajax();
			}
			,"fnFooterCallback": function( nFoot, aData, iStart, iEnd, aiDisplay ) {
				
			},
			"oLanguage": {
				//"sUrl": "media/language/de_DE.txt",
				"sZeroRecords": "There are no records that match your search criterion",
				"sLengthMenu": "Records per page _MENU_ ",
				"sInfo": "Displaying _START_ to _END_ of _TOTAL_ records",
				"sInfoEmpty": "Showing 0 to 0 of 0 records",
				"sInfoFiltered": "(filtered from _MAX_ total records)"
			}
		});
		
		
		g.grid._oTable = oTable;
		//g.grid._oSettings = oTable.fnSettings();
		//g.grid._oSettings.oApi._fnPageChange( g.grid._oSettings, "first" );
		$(g.grid._frm).data('options',g);
		
		var dt_select = $thispage.find(".dataTables_length select");
		var dt_input = $thispage.find(".dataTables_filter input");
		var dt_length = $thispage.find('.dataTables_length');
		var dt_filter = $thispage.find('.dataTables_filter');
		
		dt_length.append(dt_select);
		dt_filter.append(dt_input);
		dt_select.formmarkup();
		dt_input.formmarkup();
		
		dt_filter.find('div.ui-input-search').css({'margin' : '0'});
		
		$thispage.find("#groupSelect").formmarkup();
	},
	
	close_grid : function (g){
	
		if( typeof g.grid._oTable === 'object') g.grid._oTable.fnDestroy();
		
		$(g.grid._table_id).empty();
		
		localStorage.removeItem(g.grid._sKey);
	}
}

$(document).on('pagecreate', page_id,  function() {gl.log_it("agency:pagecreate");

	$thispage = $(page_id);

	if( typeof _grid_default_load !== 'undefined') gl.agency.listing._default_load = _grid_default_load;
	if(gl.agency.listing._default_load) gl.agency.listing._init_m();
});