<div class="row">        
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
                <h4 class="panel-title">User Detail</h4>
				<p>Please enter the users information below.</p>
			</div>
			
			<?php echo form_open_multipart($form_action,' name="frm-user" class="form-horizontal"', $hiddenvars);?>
			<div class="panel-body">

				<div class="row">
					
					<div class="col-sm-12">

						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-right" for="first_name">First Name:</label>
							<div class="col-sm-8">
								<?php echo form_input('first_name', $first_name, 'id="first_name" class="form-control input-sm"'); ?>
								<?php echo form_error('first_name','<label class="error">','</label>');?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-right" for="last_name">Last Name:</label>
							<div class="col-sm-8">
								<?php echo form_input('last_name', $last_name, 'id="last_name" class="form-control input-sm"'); ?>
								<?php echo form_error('last_name','<label class="error">','</label>');?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-right" for="group_id">User Group:</label>
							<div class="col-sm-8">
								<?php echo form_dropdown('group_id', groups_dropdown('return', array('first_row' => TRUE)), $group_id ,'id="group_id" class="form-control input-sm" data-placeholder="Select a Group"'); ?>
								<?php echo form_error('group_id','<label class="error">','</label>');?>
							</div>
						</div>

						<?php if($current_user->group_id == GROUP_ADMIN) { ?>
						<div class="form-group company_option" <?php if( !_has_company_group_access($group_id) ) { ?>style="display:none;"<?php } ?>>
							<label class="col-sm-4 control-label no-padding-right" for="company_id">Agency:</label>
							<div class="col-sm-8">
								<div class="row">
									
									<div class="col-sm-10">
										<?php echo form_dropdown('company_id', companies_dropdown('return', array('first_row' => TRUE)), $company_id ,'id="company_id" class="form-control input-sm" data-placeholder="Select a Agency"'); ?>
									</div>
									<div class="col-sm-2">
										<a href="<?php echo site_url('agencies/create');?>" class="btn btn-primary  btn-xs" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Agency Detail", "modal" : {"buttons" : true, "modal_success_callback" : "gl.user.form._init_companies(response);", "override" : true}, "params" : "echo"}'>
											<i class="fa fa-level-up"></i>
										</a>
									</div>
								</div>
								<?php echo form_error('company_id','<label class="error">','</label>');?>
							</div>
						</div>
						<?php } ?>

						<div class="form-group client_option" <?php echo ( _has_company_non_resources($group_id) && gtzero_integer($company_id)) ? '' : 'style="display:none;"';?>>
							<label class="col-sm-4 control-label no-padding-right" for="client_ids">Client:</label>
							<div class="col-sm-8">
								<div class="row">
									<div class="col-sm-10">
										<?php echo form_dropdown('client_ids[]', clients_dropdown('return' , array( 'company_id' => $company_id, 'first_row' => TRUE)), $client_ids ,'id="client_ids" class="form-control input-sm" data-placeholder="Select a Client" multiple="multiple"'); ?>
									</div>
									<div class="col-sm-2">
										<a href="<?php echo site_url('clients/create/'.serialize_object());?>" class="btn btn-primary btn-xs" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Client detail", "modal" : {"buttons" : true, "modal_success_callback" : "gl.user.form._init_clients(response);", "override" : true}, "params" : "echo"}'>
											<i class="fa fa-level-up mr5"></i>
										</a>
									</div>
								</div>
								<?php echo form_error('client_ids','<label class="error">','</label>');?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-right" for="email">Email:</label>
							<div class="col-sm-8">
								<?php echo form_input('email', $email, 'id="email" class="form-control input-sm"'); ?>
								<?php echo form_error('email','<label class="error">','</label>');?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-right" for="phone">Phone:</label>
							<div class="col-sm-8">
								<?php echo form_input('phone', $phone, 'id="phone" class="form-control input-sm"'); ?>
								<?php echo form_error('phone','<label class="error">','</label>');?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-right" for="password">Password:</label>
							<div class="col-sm-8">
								<?php echo form_password('password', $password, 'id="password" class="form-control input-sm"'); ?>
								<?php echo form_error('password','<label class="error">','</label>');?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-right" for="password_confirm">Confirm Password:</label>
							<div class="col-sm-8">
								<?php echo form_password('password_confirm', $password_confirm, 'id="password_confirm" class="form-control input-sm"'); ?>
								<?php echo form_error('password_confirm','<label class="error">','</label>');?>
							</div>
						</div>
						
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