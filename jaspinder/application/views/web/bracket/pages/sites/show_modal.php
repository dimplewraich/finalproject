<?php echo form_open($form_action,' name="frm-site-view" class="form-horizontal" data-ajax="wdpajax" data-options=\'{"params" : "ajax", "loader" : "modal"}\'', $hiddenvars);?>
<div class="row mb30">
				
	<div class="col-sm-4">
				
		<?php if($current_user->group_id == 1) { ?>
		<div class="form-group mb5">
			<label class="col-sm-5 text-right"><small><strong>AGENCY:</strong></small></label>
			<div class="col-sm-7"><small><?php echo $company_name;?></small></div>
		</div>
		<?php } ?>

		<div class="form-group mb5">
			<label class="col-sm-5 text-right"><small><strong>DISTRICT NO:</strong></small></label>
			<div class="col-sm-7"><small><?php echo $district_no;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-5 text-right"><small><strong>SITE NO:</strong></small></label>
			<div class="col-sm-7"><small><?php echo $site_code;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-5 text-right"><small><strong>TOWN:</strong></small></label>
			<div class="col-sm-7"><small><?php echo $town;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-5 text-right"><small><strong>ADDRESS:</strong></small></label>
			<div class="col-sm-7"><small><?php echo $address; ?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-5 text-right"><small><strong>STREET:</strong></small></label>
			<div class="col-sm-7"><small><?php echo $street;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-5 text-right"><small><strong>POSTCODE:</strong></small></label>
			<div class="col-sm-7"><small><?php echo $postcode; ?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-5 text-right"><small><strong>SITE REF:</strong></small></label>
			<div class="col-sm-7"><small><?php echo $site_ref; ?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-5 text-right"><small><strong>DATE ADDED:</strong></small></label>
			<div class="col-sm-7"><small><?php echo $upload_date; ?></small></div>
		</div>
	
	</div>
	
	<div class="col-sm-3">
				
		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>STATIC/SCROLLER:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $static_scroller;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>SHELTER/FSU:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $shelter_fsu;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>EASTING:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $easting;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>NORTHING:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $northing;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>SHELTER TYPE:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $shelter_type; ?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>CONFIGURATION:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $site_configuration;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>HEIGHT:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $height; ?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>PANEL:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $panel; ?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>RANKING:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $ranking; ?></small></div>
		</div>
	
	</div>
	
	<div class="col-sm-5">
				
		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>EMBARGO START DATE:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $embargo_start_date;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>STATUS:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $status;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>POWER BUILD PACK REQUESTED:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $power_build_pack_requested;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>POWER BUILD PACK RECEIVED TTC:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $power_build_pack_received_ttc;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>ACTUAL POWER COST:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $actual_power_cost; ?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>POWER BUILD DATE:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $power_build_date;?></small></div>
		</div>

		<div class="form-group mb5">
			<label class="col-sm-7 text-right"><small><strong>METER BUILD DATE:</strong></small></label>
			<div class="col-sm-5"><small><?php echo $meter_build_date; ?></small></div>
		</div>
	
	</div>
	
</div>

<?php if( in_array($current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF)) ) { ?>
<div class="row mb10">
	
	<div class="col-sm-12">
			
		<a href="<?php echo site_url('sites/add_form/'.serialize_object(array( SYS_SITE_ID => $site_id)));?>" class="btn btn-sm btn-warning mr5 pull-right" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Site Detail", "modal" : {"buttons" : true, "footer" : true, "override" : true, "modal_success_callback" : "gl.site.view.reload_site_form();"}, "params" : "echo"}'><i class="fa fa-plus mr5"></i>ADD FORM</a>
		<a href="<?php echo site_url('sites/download/'.serialize_object(array( SYS_SITE_ID => $site_id)));?>" class="btn btn-sm btn-warning mr5 pull-right"><i class="fa fa-download mr5"></i>EXPORT</a>
	
	</div>
	
</div>
<?php } ?>

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
				<td class="text-center">
					<a href="<?php echo site_url('sites/feedback/'.serialize_object(array( SYS_SITE_FORM_ID => $site_form->id,SYS_SITE_ID => $site_form->site_id, SYS_FORM_TYPE_ID => $site_form->form_type_id)));?>" class="btn btn-xs btn-warning" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "<?php echo $site_code;?> <small>(<?php echo $site_form->form_name;?>)</small>", "modal" : {"buttons" : false, "size" : "modal-lg", "footer" : false}, "params" : "echo"}'><i class="fa fa-eye"></i></a>
					<?php if( in_array($current_user->group_id, array(GROUP_ADMIN)) ) { ?>
					<a href="<?php echo site_url('sites/sfstatus/'.serialize_object(array( SYS_SITE_FORM_ID => $site_form->id,SYS_SITE_ID => $site_form->site_id, SYS_FORM_TYPE_ID => $site_form->form_type_id)));?>" class="btn btn-xs btn-warning" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "<?php echo $site_code;?> <small>(<?php echo $site_form->form_name;?>)</small>", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.site.view.reload_site_form();"}, "params" : "echo"}'><i class="fa fa-check"></i></a>
					<?php } ?>
				</td>
			  </tr>
			  <?php } ?>
			</tbody>
		</table>
	
	</div>
</div>
<?php echo form_close();?>
<?php echo load_js('sites/show.js');?>