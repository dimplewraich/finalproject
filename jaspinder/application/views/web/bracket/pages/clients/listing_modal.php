<div class="row grid-list">
	<div class="col-md-12">
		<form name="grid-list-param"  data-options='{"grid" : { "_aaSorting" : "_aSort_<?php echo $page_id;?>", "_aoColumnDefs" : "_aColDefs_<?php echo $page_id;?>", "_table_id" : "#data_<?php echo $page_id;?>" ,"_grid_url" : "<?php echo $grid_action;?>", "_sKey" :  "DataTables__<?php echo $page_id;?>"}}' style="display:none;"></form>

		<?php if( in_array($current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) { ?>
		<a href="<?php echo $new_client_url;?>" class="btn btn-sm btn-warning mb10 pull-right" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Client Detail", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "modal_success_callback" : "gl.client.listing.load_grid(g);"}, "params" : "echo" , "grid" : {"_init" : true, "gType" : "default"}}'><i class="fa fa-plus mr5"></i>New Client</a>
		<?php } ?>
	
		<div class="table-responsive">

			<table cellpadding="0" id="data_<?php echo $page_id;?>" cellspacing="0" border="0" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<?php if($current_user->group_id == 1){ ?>
						<th>Company</th>
						<?php } ?>
						<th>Address</th>
						<th>Phone</th>
						<th>Postcode</th>
						<th>Email</th>
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
	var _grid_default_load = false;
	var _aSort_<?php echo $page_id;?> = [[<?php if($current_user->group_id == 1){ ?>0<?php }else{?>0<?php } ?>, 'asc']]
	var _aColDefs_<?php echo $page_id;?> = [
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		<?php if($current_user->group_id == 1){ ?>
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		<?php } ?>
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true, "sClass": "nowrap"},
		{"bVisible": true, "bSearchable": true, "bSortable": true, "sClass": "nowrap"},
		{"bVisible": true, "bSearchable": true, "bSortable": true, "sClass": "nowrap"},
		{"bVisible": true, "bSearchable": true, "bSortable": true, "sClass": "nowrap"},
		{"bVisible": true, "bSearchable": true, "bSortable": true, "sClass": "nowrap"},
		{"bVisible": true, "bSearchable": false, "bSortable": false, "sClass": "nowrap"}
      ];
</script>
<?php echo load_js('clients/index.js'); ?>