<div class="row">        
	<div class="col-md-9">
		
		<div class="panel panel-default">
		
			<div class="panel-heading">
                <h4 class="panel-title">Recent Submited Form</h4>
			</div>
			<div class="panel-body">
				
				<div class="row">
					<div class="col-sm-12">
					
						<table class="table table-primary mb30">
							<thead>
							  <tr>
								<th>FORM</th>
								<th>DATE ADDED</th>
								<th>ADDED BY</th>
								<th>STATUS</th>
								<?php /*<th>DATE SUBMITTED</th>*/ ?>
								<th>SUBMITTED BY</th>
								<th>DATE COMPLETED</th>
								<?php /*<th>COMPLETED BY</th>*/ ?>
								<th style="width:95px;"></th>
							  </tr>
							</thead>
							<tbody>
								<?php foreach($site_forms AS $site_form) {?>
							  <tr>
								<td><?php echo $site_form->form_name;?></td>
								<td><?php echo local_time($site_form->added_on,'M d, Y @ h:ia');?></td>
								<td><?php echo $site_form->added_by_name;?></td>
								<td><?php echo $site_statuses[$site_form->status];?></td>
								<?php /*<td><?php echo local_time($site_form->submitted_on,'M d, Y @ h:ia');?></td>*/ ?>
								<td><?php echo $site_form->submitted_by_name;?></td>
								<td><?php echo local_time($site_form->completed_on,'M d, Y @ h:ia');?></td>
								<?php /*<td><?php echo $site_form->completed_by_name;?></td>*/ ?>
								<td>
									<a href="<?php echo site_url('sites/feedback/'.serialize_object(array( SYS_SITE_FORM_ID => $site_form->id,SYS_SITE_ID => $site_form->site_id, SYS_FORM_TYPE_ID => $site_form->form_type_id)));?>" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></a>
									<?php if( $current_user->group_id == GROUP_ADMIN) { ?>
									<a href="<?php echo site_url('sites/sfstatus/'.serialize_object(array( SYS_SITE_FORM_ID => $site_form->id,SYS_SITE_ID => $site_form->site_id, SYS_FORM_TYPE_ID => $site_form->form_type_id)));?>" class="btn btn-xs btn-warning"><i class="fa fa-check"></i></a>
								<?php } ?>
								</td>
							  </tr>
							  <?php } ?>
							</tbody>
							
							<?php if(!$site_forms){ ?>
							<tfoot>
							<tr>
								<td colspan="7" class="text-center">No record(s) found.</td>
							</tr>
							</tfoot>
							<?php } ?>
						</table>
					
					</div>
				</div>
				
            </div>
			
        </div>
    </div>
	
	
	
	<div class="col-md-3">
		<div class="panel panel-default">
		
			<div class="panel-heading">
                <h4 class="panel-title">Sites</h4>
			</div>
		
			<div class="panel-body">
				<p><strong>Total Sites: <?php echo $site_count ;?></strong></p>
			</div>
		</div>
	</div>
	
</div>