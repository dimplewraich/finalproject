<div class="grid-list">
	<?php /*<form name="grid-list-param" data-options='{"grid" : { "_grid_url" : "<?php echo $grid_action;?>" }}' style="display:none;"></form>*/ ?>
	<form name="grid-list-param" data-options='{"grid" : { "_aaSorting" : "_aSort_<?php echo $page_id;?>", "_aoColumnDefs" : "_aColDefs_<?php echo $page_id;?>", "_table_id" : "#data_<?php echo $page_id;?>" ,"_grid_url" : "<?php echo $grid_action;?>", "_sKey" :  "DataTables__<?php echo $page_id;?>"}}' style="display:none;"></form>
	<div class="mb20">
		<label>User Groups</label>
		<select name="group_id" id="groupSelect" data-placeholder="All Groups" data-role="none">
			<option value=""></option>
			<?php if( $current_user->group_id == 1 ) { ?>
			<option value="1">Administrator</option>
			<?php } ?>
			<option value="2">Company (management)</option>
			<option value="3">Company (user)</option>
			<option value="4">Client</option>
			<option value="5">Caregiver</option>
			<option value="6">Supervisor</option>
			<option value="7">Physician</option>
		</select>
	</div>
	<table id="data_<?php echo $page_id;?>">
		<thead>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>Timezone</th>
			<th>Status</th>
			<th>Added By</th>
			<th>Added On</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		</tbody>
	
	</table>
</div>

<script type="text/javascript">
	var page_id = "#<?php echo $page_id;?>";
	
	var _aSort_<?php echo $page_id;?> = [[5, 'desc']];
	var _aColDefs_<?php echo $page_id;?> = [	
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": false},
		{"bVisible": true, "bSearchable": false, "bSortable": false},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": false, "sClass" : "nowrap"}
	  ];
</script>
<?php echo load_js('companies/index.js');?>