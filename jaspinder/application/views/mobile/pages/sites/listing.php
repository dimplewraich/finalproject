<div class="grid-list">
	<form name="grid-list-param" data-options='{"grid" : { "_grid_url" : "<?php echo $grid_action;?>" }}' style="display:none;"></form>
	<div class="mb20">
		<label>Agencies</label>
		<?php echo form_dropdown('company_id', companies_dropdown('return', array('first_row' => TRUE)), '', 'id="companySelect" data-placeholder="All Companies" data-role="none"'); ?>
	</div>
	<table cellpadding="0" id="site_data_table" cellspacing="0" border="0" class="table">
		<thead>
			<tr>
				<th>Site ID</th>
					<?php if($current_user->group_id == 1){ ?>
					<th>Company</th>
					<?php } ?>
					<th>Address</th>
					<th>Street</th>
					<th>Town</th>
					<th>Postcode</th>
					<th>Date Added</th>
					<th>Added By</th>
					<th>Added On</th>
					<th>Action</th>
			</tr>
		</thead>
		<tbody></tbody>
		<tfoot></tfoot>
	</table>
</div>

<script type="text/javascript">
	var page_id = "#<?php echo $page_id;?>";
	
	var aaSorting = [[<?php if($current_user->group_id == 1){ ?>9<?php }else{?>8<?php } ?>, 'desc']];
	var aoColumnDefs = [	
		{"bVisible": true, "bSearchable": true, "bSortable": true, "sClass": "nowrap"},
		<?php if($current_user->group_id == 1){ ?>
		{"bVisible": true, "bSearchable": true, "bSortable": true, "sClass": "nowrap"},
		<?php } ?>
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": false, "bSearchable": true, "bSortable": true},
		{"bVisible": false, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": false}
	  ];
</script>
<?php echo load_js('sites/index.js');?>