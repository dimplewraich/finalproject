<div class="row grid-list">
	<div class="col-md-12">
		<form name="grid-list-param"  data-options='{"grid" : { "_aaSorting" : "_aSort_<?php echo $page_id;?>", "_aoColumnDefs" : "_aColDefs_<?php echo $page_id;?>", "_table_id" : "#data_<?php echo $page_id;?>" ,"_grid_url" : "<?php echo $grid_action;?>", "_sKey" :  "DataTables__<?php echo $page_id;?>"}}' style="display:none;"></form>
		<a href="<?php echo $new_user_url;?>" class="btn btn-sm btn-warning mb10 pull-right" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "User Detail", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.user.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}'><i class="fa fa-plus mr5"></i>New User</a>
	
		<div class="table-responsive">

			<table cellpadding="0" id="data_<?php echo $page_id;?>" cellspacing="0" border="0" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<?php if($current_user->group_id == 1){ ?>
						<th>Agency</th>
						<?php } ?>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>group</th>
						<th>Status</th>
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
	var _aSort_<?php echo $page_id;?> = [[<?php if($current_user->group_id == 1){ ?>7<?php }else{?>6<?php } ?>, 'desc']];
	var _aColDefs_<?php echo $page_id;?> = [
		<?php if($current_user->group_id == 1){ ?>
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		<?php } ?>
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true, "sClass": "nowrap"},
		{"bVisible": true, "bSearchable": false, "bSortable": false, "sClass": "nowrap"}
      ];
</script>
<?php echo load_js('user/index.js'); ?>