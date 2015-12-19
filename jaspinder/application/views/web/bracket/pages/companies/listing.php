<div class="panel panel-default">
	
	<div class="panel-heading">
		<h3 class="panel-title">Agencies 
			<a href="<?php echo $new_company_url;?>" class="btn btn-warning btn-sm mr5 mb10 pull-right wht" style="margin-top:-5px;" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Agency Detail", "modal" : {"buttons" : true, "modal_success_callback" : "updateData(g);"}, "params" : "echo"}'><i class="fa fa-plus mr5"></i>New Agency</a>
			<?php /* if( $current_user->group_id == GROUP_ADMIN) { ?>
			<a href="<?php echo site_url('companies/refresh_settings');?>" class="btn btn-warning btn-sm mr5 mb10 pull-right wht" style="margin-top:-5px;" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Refresh Cache", "modal" : {"buttons" : true}, "params" : "echo"}'><i class="fa fa-refresh mr5"></i>Clear Cache</a>
			<?php } */ ?>
		</h3>
	</div>
	
	<div class="panel-body">
	
		<div class="table-responsive">

			<table cellpadding="0" id="data" cellspacing="0" border="0" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Address</th>
						<th>Timezone</th>
						<th>Status</th>
						<th>Added By</th>
						<th>Added On</th>
						<th style="width:80px;">Action</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot></tfoot>
			</table>

		</div>
	</div>
</div>
<script type="text/javascript">
	var aaSorting = [[<?php if($current_user->group_id == 1){ ?>9<?php }else{?>8<?php } ?>, 'desc']];
	var aoColumnDefs = [	
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": false},
		{"bVisible": true, "bSearchable": false, "bSortable": false},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": false, "sClass" : "nowrap"}
      ];
</script>
