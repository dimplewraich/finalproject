<div class="panel panel-default grid-list">
	
	<form name="grid-list-param" data-options='{"grid" : { "_grid_url" : "<?php echo $grid_action;?>" }}' style="display:none;"></form>
	
	<div class="panel-heading">
		<h3 class="panel-title">Users
			<a href="<?php echo $new_user_url;?>" class="btn btn-sm btn-warning mr5 mb10 pull-right wht" style="margin-top:-5px;" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "User Detail", "modal" : {"buttons" : true, "override" : true, "size" : "modal-lg", "modal_success_callback" : "gl.user.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}'><i class="fa fa-plus mr5"></i>New User</a>
			
			<div class="pull-right" style="width:300px;margin-right:16px;margin-top:-5px;">
				<?php echo form_dropdown('group_id', groups_dropdown('return', array('first_row' => TRUE)), '' ,'id="groupSelect" class="form-control input-sm pull-right" data-placeholder="All Groups"'); ?>
			</div>
			
			<?php if( $current_user->group_id == 1 ) { ?>
			<div class="pull-right" style="width:300px;margin-right:16px;margin-top:-5px;">
				<?php echo form_dropdown('company', companies_dropdown('return', array('first_row' => TRUE)), $company_id, 'id="companySelect" class="form-control input-sm pull-right" data-placeholder="All Companies"'); ?>
			</div>
			<?php } ?>
		</h3>
	</div>
	
	<div class="panel-body">
	
		<div class="table-responsive">

			<table cellpadding="0" id="user_data_table" cellspacing="0" border="0" class="table table-striped table-bordered table-hover">
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
<div id="my-form-Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<script type="text/javascript">
	var aaSorting = [[<?php if($current_user->group_id == 1){ ?>7<?php }else{?>6<?php } ?>, 'desc']];
	var aoColumnDefs = [	
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