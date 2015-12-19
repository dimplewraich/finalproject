<?php echo form_open($form_action,' name="frm-contact" class="form-horizontal" data-options=\'{"params" : "ajax", "loader" : "modal"}\'', $hiddenvars);?>
<div class="row">
					
	<div class="col-sm-12">
	
		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="first_name">First Name:</label>
			<div class="col-sm-7">
				<?php echo form_input('first_name', $first_name, 'id="first_name" class="form-control input-sm"'); ?>
				<?php echo form_error('first_name','<label class="error">','</label>');?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="last_name">Last Name:</label>
			<div class="col-sm-7">
				<?php echo form_input('last_name', $last_name, 'id="last_name" class="form-control input-sm"'); ?>
				<?php echo form_error('last_name','<label class="error">','</label>');?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="email">Email:</label>
			<div class="col-sm-7">
				<?php echo form_input('email', $email, 'id="email" class="form-control input-sm"'); ?>
				<?php echo form_error('email', '<label class="error">', '</label>'); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="address">Address:</label>
			<div class="col-sm-7">
				<?php echo form_input('address', $address, 'id="address" class="form-control input-sm"'); ?>
				<?php echo form_error('address', '<label class="error">', '</label>'); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="postcode">Postcode:</label>
			<div class="col-sm-7">
				<?php echo form_input('postcode', $postcode, 'id="postcode" class="form-control input-sm"'); ?>
				<?php echo form_error('postcode', '<label class="error">', '</label>'); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="phone">Phone:</label>
			<div class="col-sm-7">
				<?php echo form_input('phone', $phone, 'id="phone" class="form-control input-sm"'); ?>
				<?php echo form_error('phone', '<label class="error">', '</label>'); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="mobile">Mobile:</label>
			<div class="col-sm-7">
				<?php echo form_input('mobile', $mobile, 'id="mobile" class="form-control input-sm"'); ?>
				<?php echo form_error('mobile', '<label class="error">', '</label>'); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="fax">Fax:</label>
			<div class="col-sm-7">
				<?php echo form_input('fax', $fax, 'id="fax" class="form-control input-sm"'); ?>
				<?php echo form_error('fax', '<label class="error">', '</label>'); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="is_default">Default:</label>
			<div class="col-sm-8">
				<div class="radio-inline">
					<label>
						<input type="radio" id="is_default_0" name="is_default" value="1" class="ace" <?php if( $is_default == "1"){ ?>checked="checked"<?php } ?> /> <span class="lbl"> YES</span>
					</label>
				</div>
				<div class="radio-inline">
					<label>
						<input type="radio" id="is_default_1" name="is_default" value="0" class="ace" <?php if( $is_default != '1'){ ?>checked="checked"<?php } ?> /> <span class="lbl"> No</span>
					</label>
				</div>
			</div>
		</div>
		
	</div>
</div>
<?php echo form_close();?>
<?php echo load_js('contact/form.js');?>