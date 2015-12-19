<?php echo form_open($form_action,' name="frm-note" class="form-horizontal" data-options=\'{"params" : "ajax", "loader" : "modal"}\'', $hiddenvars);?>

<div class="form-group">
	<label class="col-sm-12 no-padding-right" for="address">Notes:</label>
	<div class="col-sm-12">
		<?php echo form_textarea('description', $description, 'id="description" class="form-control input-sm tinymce"'); ?>
	</div>
</div>

<?php echo form_close();?>
<?php echo load_js('notes/form.js');?>