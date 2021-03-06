gl.site = gl.site || {};
gl.site.listing = gl.site.listing || {
	
	_default_load : true,
	_init_m : function(){
	
		$("select#companySelect").change(function(){
			
			gl.site.listing._init_d();
		});

		gl.site.listing._init_d();
		
		//gl.select2({ form_ctrl : $("select#companySelect"), empty : false});
		//gl.select2({ form_ctrl : $("select#groupSelect"), empty : false});
	},
	_init_d : function (){
	
		var $this = $("#site_data_table").closest(".grid-list").find("form[name='grid-list-param']") 
				,g = $this.data('options');
		console.log(g);
		g.grid = $.extend({
			_bFilter : true,
			_bLengthChange : true,
			_aaSorting : aaSorting,
			_init_ctrls : false,
			_frm : false,
			_oTable : false,
			_oSettings : false,
			_sKey : 'DataTables_'+window.location.pathname,
			_default : true,
			_table_id : "#site_data_table",
			_aoColumnDefs : aoColumnDefs,
			_grid_url : "sites/getTable"
		}, g.grid,  {_frm : $this});
	
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
	
		var company_id = $(g.grid._frm).closest(".grid-list").find("select#companySelect option:selected").sval();
		
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
				if(g.grid._default){
					aoData.push({"name": "company_id", "value": company_id});
				}
			}
			,"bProcessing": true
			,"bServerSide": true
			,"sServerMethod": "POST"
			,"sAjaxSource": g.grid._grid_url
			,"iDisplayLength": 10
			,"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
			,"aaSorting": g.grid._aaSorting
			,"aoColumns": g.grid._aoColumnDefs
			,fnCreatedRow : function( nRow, aData, iDataIndex ) {
			}
			,"fnDrawCallback": function( oSettings ) {
			}
			,"fnFooterCallback": function( nFoot, aData, iStart, iEnd, aiDisplay ) {
				
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
		
		$thispage.find("#companySelect").formmarkup();
	},
	
	close_grid : function (g){
	
		//gl.log_it("CLOSE USER GRID", $(g.grid._frm).data('options'));
	
		if( typeof g.grid._oTable === 'object') g.grid._oTable.fnDestroy();
		
		$(g.grid._table_id).empty();
		
		localStorage.removeItem(g.grid._sKey);
	}
}
$(document).on('pagecreate', page_id,  function() {console.log("SITE:pagecreate");

	$thispage = $(page_id);

	if( typeof _grid_default_load !== 'undefined') gl.site.listing._default_load = _grid_default_load;
	if(gl.site.listing._default_load) gl.site.listing._init_m();
});
