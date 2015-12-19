<div class="panel panel-default grid-list">
	<form name="grid-list-param" data-options='{"grid" : { "_grid_url" : "<?php echo $grid_action;?>" }}' style="display:none;"></form>
	<div class="panel-heading">
		<h3 class="panel-title">Contacts 
			<a href="<?php echo $new_contact_create;?>" class="btn btn-sm btn-warning mr5 mb10 pull-right wht" style="margin-top:-5px;" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Contact Detail", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.contact.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}'><i class="fa fa-plus mr5"></i>New Contact</a>
		</h3>
	</div>
	
	<div class="panel-body">
	
		<div class="table-responsive">

			<table cellpadding="0" id="contact_data_table" cellspacing="0" border="0" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Mobile</th>
						<th>Default</th>
						<th>Added By</th>
						<th>Added On</th>
						<th style="width:100px;">Action</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot></tfoot>
			</table>

		</div>
	</div>
</div>
<script type="text/javascript">
	var aaSorting = [[2, 'desc']];
	var aoColumnDefs = [
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": false, "sClass": "nowrap"}
      ];
</script>