<div class="ui-content" role="main">
<table id="com_jqm_data">
	<thead>
	<tr>
		<th>Agency</th>
		<th>Phone</th>
		<th>Contact Name</th>
		<th>Contact Email</th>
		<th>Timezone</th>
		<th>Status</th>
		<th>Added By</th>
		<th>Added On</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	</tbody>
</table>
<script type="text/javascript">
	var page_id = "#<?php echo $page_id;?>";
	var $thispage = null;
</script>
<script type="text/javascript">
	var aaSorting = [[7, 'desc']];
	var aoColumnDefs = [	
		{"bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": true},
			{"bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": true},
			{"bVisible": true, "bSearchable": false, "bSortable": false},
			{"bVisible": true, "bSearchable": true, "bSortable": true, "sClass" : "nowrap"},
			{"bVisible": true, "bSearchable": true, "bSortable": true, "sClass" : "nowrap"},
            {"bVisible": true, "bSearchable": false, "bSortable": false, "sClass" : "nowrap"}
      ];
</script>
<?php echo load_js('companies/index.js');?>
</div>