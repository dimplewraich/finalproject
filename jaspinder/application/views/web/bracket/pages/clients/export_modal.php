<?php echo form_open($form_action,' name="frm-import" class="form-horizontal" data-options=\'{"params" : "ajax", "loader" : "modal"}\'');?>

<?php if($current_user->group_id == 1) { ?>
<div class="form-group">
	<label class="col-sm-4 control-label no-padding-right" for="company_id">Company</label>
	<div class="col-sm-8">
		<?php echo form_dropdown('company_id', companies_dropdown('return', TRUE, ''), $company_id ,'id="company_id" class="required form-control" style="width:250px;" data-placeholder="Select Company"'); ?>
		<?php echo form_error('company_id','<label class="error">','</label>');?>
	</div>
</div>
<?php } ?>

<div class="form-group">
	<label class="col-sm-4 control-label no-padding-right" for="import_sheet">File</label>
	<div class="col-sm-7">
		<?php echo form_input('import_sheet', '', 'id="import_sheet" class="form-control input-sm required"'); ?>
		<?php echo form_error('import_sheet','<label class="error">','</label>');?>
	</div>
</div>
<?php echo form_close();?>
<?php echo load_js('import/form.js');?>