var oTable = null;
var oSettings = null;

function updateData() {
    
	localStorage.removeItem('DataTables_'+window.location.pathname);
    oTable = $('#data').dataTable({
		"sPaginationType": "full_numbers"
        ,"bJQueryUI": false
        ,"bAutoWidth": false
        ,"bDestroy": true
        ,"fnServerParams": function(aoData) {
			
		}
        ,"bStateSave": true
		,"fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables_'+window.location.pathname, JSON.stringify(oData) );
        }
        ,"fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables_'+window.location.pathname) );
        }
        ,"bProcessing": true
        ,"bServerSide": true
        ,"sServerMethod": "POST"
        ,"sAjaxSource": SITE_URL + "agencies/getTable"
        ,"iDisplayLength": 10
        ,"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        ,"aaSorting": [[0, 'asc']]
        ,"aoColumns": aoColumnDefs
		,"fnDrawCallback": function( oSettings ) {			
			
			gl.bind_ajax();
			$("a[rel=popover]").popover({html: true, container : 'body'});
			$(".btip").tooltip();
			
		}
		,"fnInitComplete": function(oSettings, json) {

		}
    });
	
	gl.select2({ "form_ctrl" : jQuery(".table-responsive select"), empty : false, width : "40px"});
	jQuery(".table-responsive input").attr({"class" : "input-sm"});
}

$('document').ready(function() {
    updateData();
});