<div class="row">        
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
                <div class="panel-btns">
					<a href="<?php echo $cancel_url;?>">Back</a>
				</div>
				<h4 class="panel-title">Client Detail</h4>
			</div>
			
			 <div class="panel-body panel-body-nopadding">
				<?php echo form_open($form_action,' name="frm-client" class="form-horizontal"', $hiddenvars);?>
				
				<div id="basicWizard" class="basic-wizard">
                
					<ul class="nav nav-pills nav-justified">
						<li><a href="#tab_efn_1" data-toggle="tab"><span>Step 1:</span> Basic info</a></li>
						<li><a href="#tab_efn_2" data-toggle="tab"><span>Step 2:</span> Contact Info</a></li>
					</ul>

					<div class="tab-content">
					
						<div class="progress progress-striped active">
							<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						
						<div class="tab-pane mb30" id="tab_efn_1">
							
							<div class="row">
								
								<div class="col-sm-12">
											
									<?php if($current_user->group_id == 1) { ?>
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="company_id">Agency:</label>
										<div class="col-sm-6">
											<?php echo form_dropdown('company_id', companies_dropdown('return', array('first_row' => TRUE)), $company_id ,'id="company_id" class="required form-control" style="width:250px;" data-placeholder="Select Agency"'); ?>
											<?php echo form_error('company_id','<label class="error">','</label>');?>
										</div>
									</div>
									<?php } ?>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="first_name">First Name:</label>
										<div class="col-sm-6">
											<?php echo form_input('first_name', $first_name, 'id="first_name" class="form-control input-sm required"'); ?>
											<?php echo form_error('first_name','<label class="error">','</label>');?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="last_name">Last Name:</label>
										<div class="col-sm-6">
											<?php echo form_input('last_name', $last_name, 'id="last_name" class="form-control input-sm required"'); ?>
											<?php echo form_error('last_name','<label class="error">','</label>');?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="address">Address:</label>
										<div class="col-sm-6">
											<?php echo form_input('address', $address, 'id="address" class="form-control input-sm"'); ?>
											<?php echo form_error('address', '<label class="error">', '</label>'); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="phone">Postcode:</label>
										<div class="col-sm-6">
											<?php echo form_input('postcode', $postcode, 'id="postcode" class="form-control input-sm"'); ?>
											<?php echo form_error('postcode', '<label class="error">', '</label>'); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="email">Email:</label>
										<div class="col-sm-6">
											<?php echo form_input('email', $email, 'id="email" class="form-control input-sm"'); ?>
											<?php echo form_error('email', '<label class="error">', '</label>'); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="phone">Phone:</label>
										<div class="col-sm-6">
											<?php echo form_input('phone', $phone, 'id="phone" class="form-control input-sm"'); ?>
											<?php echo form_error('phone', '<label class="error">', '</label>'); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="address">Profile Image:</label>
										<div class="col-sm-6">
										
											<div class="row">
												<div class="col-sm-10">
													<input type="file" name="profile_avatar" id="profile_avatar" class="form-control input-sm" />
												</div>
												<div class="col-sm-2">
													<button type="button" class="btn btn-primary btn-sm" name="btn-upload"><i class="fa fa-upload"></i></button>
												</div>
											</div>
											<div class="clearfix profile_avatar" style="margin-top:10px;">
											<?php
												if(isset($avatar)) { 
													$file = cdn_url() . 'documents/profile/' . $avatar;
													$file_headers = @get_headers($file);
													
													if (isset($avatar) && !empty($avatar) && !(strpos($file_headers[0], '404 Not Found'))   && !(strpos($file_headers[0], '403 Forbidden'))) {
														echo '<img src="' . cdn_url() . 'documents/profile/' . $avatar . '" alt="" class="image" style="margin-top:10px;" />';
													} else {
														echo '<img src="' . $asset_url . 'images/' . DEFAULT_IMAGE . '" alt="" class="image" style="margin-top:10px;" />';
													}
												}
											?>
											</div>
										</div>
									</div>
								
								</div>
								
							</div>
					
						</div>
						
						<div class="tab-pane mb30" id="tab_efn_2">
							
							<div class="row">
								
								<div class="col-sm-12">

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="contact_first_name">First Name:</label>
										<div class="col-sm-6">
											<?php echo form_input('contact_first_name', $contact_first_name, 'id="contact_first_name" class="form-control input-sm required"'); ?>
											<?php echo form_error('contact_first_name','<label class="error">','</label>');?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="contact_last_name">Last Name:</label>
										<div class="col-sm-6">
											<?php echo form_input('contact_last_name', $contact_last_name, 'id="contact_last_name" class="form-control input-sm required"'); ?>
											<?php echo form_error('contact_last_name','<label class="error">','</label>');?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="contact_address">Address:</label>
										<div class="col-sm-6">
											<?php echo form_input('contact_address', $contact_address, 'id="contact_address" class="form-control input-sm"'); ?>
											<?php echo form_error('contact_address', '<label class="error">', '</label>'); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="contact_email">Email:</label>
										<div class="col-sm-6">
											<?php echo form_input('contact_email', $contact_email, 'id="contact_email" class="form-control input-sm"'); ?>
											<?php echo form_error('contact_email', '<label class="error">', '</label>'); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="contact_phone">Phone:</label>
										<div class="col-sm-6">
											<?php echo form_input('contact_phone', $contact_phone, 'id="contact_phone" class="form-control input-sm"'); ?>
											<?php echo form_error('contact_phone', '<label class="error">', '</label>'); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="contact_mobile">Mobile:</label>
										<div class="col-sm-6">
											<?php echo form_input('contact_mobile', $contact_mobile, 'id="contact_mobile" class="form-control input-sm"'); ?>
											<?php echo form_error('contact_mobile', '<label class="error">', '</label>'); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="contact_fax">Fax:</label>
										<div class="col-sm-6">
											<?php echo form_input('contact_fax', $contact_fax, 'id="contact_fax" class="form-control input-sm"'); ?>
											<?php echo form_error('contact_fax', '<label class="error">', '</label>'); ?>
										</div>
									</div>
								
								</div>
								
							</div>
							
						</div>
						
					</div>

					<?php if( in_array($current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) { ?>
					<?php if( isset($client_id)) { ?>
					<div class="row mb15">
						<div class="col-sm-12">
							<a href="<?php echo $notes_listing_url;?>" class="btn btn-sm btn-primary pull-right mr5" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Notes <small>(Client: <?php echo $full_name;?>)</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.notes.close_grid(g);", "callback" : "wdp.notes.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}'><i class="fa fa-comments mr5"></i>Notes</a>
						</div>
					</div>
					<?php } ?>
					<?php } ?>

					<ul class="pager wizard">
						<li class="previous"><button name="btn-prev" id="btn-prev" type="button" class="btn btn-primary pull-left">Previous</button></li>
						<li class="next"><button name="btn-submit" id="btn-submit" type="button" class="btn btn-primary pull-right">Next</button></li>
					</ul>

				</div>
				<?php echo form_close();?>
				
            </div>
        </div>
    </div>
</div>