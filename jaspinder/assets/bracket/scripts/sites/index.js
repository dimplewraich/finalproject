gl.site = gl.site || {};
gl.site.listing = gl.site.listing || {
	
	_default_load : true,
	_init_m : function(){
	
		$("select#companySelect").change(function(){
			
			gl.site.listing._init_d();
		});

		gl.site.listing._init_d();
		
		gl.select2({ form_ctrl : $("select#companySelect"), empty : false});
		gl.select2({ "form_ctrl" : jQuery(".table-responsive select"), empty : false});
	},
	_init_d : function (){
	
		var $this = $("#site_data_table").closest(".grid-list").find("form[name='grid-list-param']") 
				,g = $this.data('options');
		
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
		
		localStorage.removeItem(g.grid._sKey);
		var oTable = $(g.grid._table_id).dataTable({
			"sPaginationType": "full_numbers"
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
					aoData.push({"name": "iCompany", "value": company_id});
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
				gl.bind_ajax();
				$("a[rel=popover]").popover({html: true, container : 'body'});
				$(".btip").tooltip();
			}
			,"fnFooterCallback": function( nFoot, aData, iStart, iEnd, aiDisplay ) {
				
		   }
		});
		
		
		g.grid._oTable = oTable;
		$(g.grid._frm).data('options',g);
		
		gl.select2({ "form_ctrl" : jQuery(g.grid._frm).closest(".grid-list").find(".table-responsive select"), empty : false, width : "40px"});
		jQuery(g.grid._frm).closest(".grid-list").find(".table-responsive input").attr({"class" : "input-sm"});
		
		gl.log_it("AFTER INIT siteS DATA TABLE", $(g.grid._frm).data('options'));
	},
	
	close_grid : function (g){
	
		gl.log_it("CLOSE siteS GRID", $(g.grid._frm).data('options'));
	
		if( typeof g.grid._oTable === 'object') g.grid._oTable.fnDestroy();
		
		$(g.grid._table_id).empty();
		
		localStorage.removeItem(g.grid._sKey);
	}
}
$('document').ready(function() {

	if( typeof _grid_default_load !== 'undefined') gl.site.listing._default_load = _grid_default_load;
	if(gl.site.listing._default_load) gl.site.listing._init_m();
});