<div class="row">        
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
                <h4 class="panel-title">My Profile</h4>
			</div>
			
			<?php echo form_open_multipart('profile/update',' name="frm-profile" class="form-horizontal"');?>
			<div class="panel-body">

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="username">Username:</label>
					<div class="col-sm-7">
						<?php echo form_input('username', $current_user->username, 'id="username" class="form-control" disabled="disabled"'); ?>
						<?php echo form_error('username','<label class="error">','</label>');?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="address">Avatar:</label>
					<div class="col-sm-7">
						<div class="row">
							<div class="col-sm-6">
								<?php echo form_upload(array('name' => 'user_avatar', 'class' => 'form-control input-sm', 'id' => 'file')); ?>
								<?php
									$file = base_url() . 'documents/profile/' . $current_user->avatar;
									$file_headers = @get_headers($file);


									if (isset($current_user->avatar) && !(strpos($file_headers[0], '404 Not Found'))   && !(strpos($file_headers[0], '403 Forbidden'))) {

										echo '<br /><img src="' . base_url() . 'documents/profile/' . $current_user->avatar . '" alt="" class="image" />';
									} else {

										echo '<br /><img src="' . $asset_url . 'images/' . DEFAULT_IMAGE . '" alt="" class="image" />';
									}
								?>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="first_name">First name: </label>
					<div class="col-sm-7">
						<?php echo form_input('first_name',$current_user->first_name,'class="form-control" id="first_name" type="text"') ?>
						<?php echo form_error('first_name', '<label class="error">', '</label>'); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="last_name">Last name: </label>
					<div class="col-sm-7">
						<?php echo form_input('last_name',$current_user->last_name,'class="form-control" id="last_name" type="text"') ?>
						<?php echo form_error('last_name', '<label class="error">', '</label>'); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="email">Email:  </label>
					<div class="col-sm-7">
						<?php echo form_input('email', $current_user->email, 'id="email" class="form-control" disabled="disabled"'); ?>
						<span class="help-block">Note: This is also your login</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="phone">Phone:  </label>
					<div class="col-sm-7">
						<?php echo form_input('phone', $current_user->phone, 'id="phone" class="form-control"'); ?>
						<?php echo form_error('phone', '<label class="error">', '</label>'); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="group_description">Group Name(s):  </label>
					<div class="col-sm-7">
						<?php echo form_input('group_description', $current_user->group_description, 'id="group_description" class="form-control" disabled="disabled"'); ?>
						<?php echo form_error('group_description', '<label class="error">', '</label>'); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="password">Password:  </label>
					<div class="col-sm-7">
						<div class="row">
							<div class="col-sm-12">
								<?php echo form_password('password', '', 'id="password" class="form-control mb15" placeholder="Enter your password"'); ?>
								<?php echo form_password('password_confirm', '', 'id="password_confirm" class="form-control" placeholder="Enter your password again"'); ?>
							</div>
						</div>
						<?php echo form_error('password', '<label class="error">', '</label>'); ?>
					</div>
				</div>
				
            </div>
				
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-4">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok mr5"></i><?php echo $submit_btn_text;?></button>
						<a class="btn btn-default" href="<?php echo $cancel_url;?>"><i class="glyphicon glyphicon-remove mr5"></i>Cancel</a>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
        </div>
    </div>
</div>