<?php echo form_open($form_action,' name="frm-sfcreate" class="form-horizontal" data-ajax="wdpajax" data-options=\'{"params" : "ajax", "loader" : "modal"}\'', $hiddenvars);?>
			
<div class="row">
	
	<div class="col-sm-12">

		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="name">Name:</label>
			<div class="col-sm-6">
				<?php echo form_input('name', $name, 'id="name" class="form-control input-sm"'); ?>
				<?php echo form_error('name','<label class="error">','</label>');?>
			</div>
		</div>
		
	</div>
	
</div>

<?php echo form_close();?>

<?php echo load_js('sfcreate/form.js');?>