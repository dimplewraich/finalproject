<?php echo form_open($form_action,' name="frm-site" class="form-horizontal" data-ajax="wdpajax" data-options=\'{"params" : "ajax", "loader" : "modal"}\'', $hiddenvars);?>
<div class="row">
	
	<div class="col-sm-12">
				
		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="form_type_id">Form Type:</label>
			<div class="col-sm-6">
				<?php echo form_dropdown('form_type_id', form_types_dropdown('return', array('site_id' => $site_id, 'first_row' => TRUE)), $form_type_id ,'id="form_type_id" class="form-control" style="width:250px;" data-placeholder="Select Form"'); ?>
				<?php echo form_error('form_type_id','<label class="error">','</label>');?>
			</div>
		</div>
	
	</div>
	
</div>
<?php echo form_close();?>