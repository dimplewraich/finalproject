<div class="grid-list">
	<form name="grid-list-param" data-options='{"grid" : { "_grid_url" : "<?php echo $grid_action;?>" }}' style="display:none;"></form>
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
				<th>Action</th>
			</tr>
		</thead>
		<tbody></tbody>
		<tfoot></tfoot>
	</table>
</div>

<script type="text/javascript">
	var page_id = "#<?php echo $page_id;?>";
	
	var aaSorting = [[<?php if($current_user->group_id == 1){ ?>6<?php }else{?>5<?php } ?>, 'desc']];
	var aoColumnDefs = [	
		<?php if($current_user->group_id == 1){ ?>
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		<?php } ?>
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": true, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true},
		{"bVisible": true, "bSearchable": false, "bSortable": true, "sClass": "nowrap"},
		{"bVisible": true, "bSearchable": false, "bSortable": false, "sClass": "nowrap"}
	  ];
</script>
<?php echo load_js('user/index.js');?>