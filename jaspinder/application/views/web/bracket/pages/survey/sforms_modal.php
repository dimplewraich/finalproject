<table cellpadding="0" cellspacing="0" border="0" class="table table-primary table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Site Form</th>
			<th style="width:100px;">Questions</th>
			<?php if( in_array($current_user->group_id, array(GROUP_ADMIN)) ) { ?>
			<th style="width:100px;">Action</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
	<?php foreach($sform_rows AS $sform_row){?>
	<tr>
		<td><?php echo $sform_row->name;?></td>
		<td><a href="<?php echo site_url('survey/questions/'.serialize_object(array( SYS_FORM_TYPE_ID => $sform_row->id)));?>" class="btn btn-xs btn-warning" ><i class="fa fa-question mr5"></i>List</a>
		<?php if( in_array($current_user->group_id, array(GROUP_ADMIN)) ) { ?>
		<td>
			<a href="<?php echo site_url('survey/sfedit/'.serialize_object(array( SYS_FORM_TYPE_ID => $sform_row->id)));?>" class="btn btn-xs btn-warning" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Site Form Detail", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.sfform.listing.load_grid();"}, "params" : "echo"}'><i class="fa fa-pencil"></i></a>
			<a href="<?php echo site_url('survey/sfdelete/'.serialize_object(array( SYS_FORM_TYPE_ID => $sform_row->id)));?>" class="btn btn-xs btn-warning" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Site Form Detail", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.sfform.listing.load_grid();"}, "params" : "echo"}'><i class="fa fa-trash-o"></i></a>
		</td>
		<?php } ?>
	<?php } ?>
	</tbody>
	<tfoot></tfoot>
</table>