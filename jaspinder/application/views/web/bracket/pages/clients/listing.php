<div class="panel panel-default grid-list">
	<form name="grid-list-param" data-options='{"grid" : { "_grid_url" : "<?php echo $grid_action;?>" }}' style="display:none;"></form>
	<div class="panel-heading">
		<h3 class="panel-title">Clients 
			<?php if( in_array($current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) { ?>
			<a href="<?php echo site_url('export/clients');?>" class="btn btn-sm btn-warning mr5 mb10 pull-right wht" style="margin-top:-5px;"><i class="fa fa-download mr5"></i>Export</a>
			<a href="<?php echo site_url('import/clients');?>" class="btn btn-sm btn-warning mr5 mb10 pull-right wht" style="margin-top:-5px;"><i class="fa fa-upload mr5"></i>Import</a>
			<?php } ?>
			
			<?php if( in_array($current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) { ?>
			<a href="<?php echo $new_client_url;?>" class="btn btn-sm btn-warning mr5 mb10 pull-right wht" style="margin-top:-5px;" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Client Detail", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "modal_success_callback" : "gl.client.listing.load_grid(g);"}, "params" : "echo" , "grid" : {"_init" : true, "gType" : "default"}}'><i class="fa fa-plus mr5"></i>New Client</a>
			<?php } ?>
			
			<?php if( $current_user->group_id == 1 ) { ?>
			<div class="pull-right" style="width:300px;margin-right:16px;margin-top:-5px;">
				<?php echo form_dropdown('company', companies_dropdown('return', array('first_row' => TRUE)), $company_id, 'id="companySelect" class="pull-right form-control" data-placeholder="All Companies"'); ?>
			</div>
			<?php } ?>
		</h3>
	</div>
	
	<div class="panel-body">
	
		<div class="table-responsive">

			<table cellpadding="0" id="client_data_table" cellspacing="0" border="0" class="table table-striped table-bordered table-hover">
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
	var aaSorting = [[<?php if($current_user->group_id == 1){ ?>0<?php }else{?>0<?php } ?>, 'asc']];
	var aoColumnDefs = [
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