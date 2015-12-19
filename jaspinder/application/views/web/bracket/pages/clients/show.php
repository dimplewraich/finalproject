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
				<?php echo form_open_multipart($form_action, ' name="frm-view" class="form-horizontal"', $hiddenvars);?>
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
										<label class="col-sm-5 text-right" for="company_id">Agency:</label>
										<div class="col-sm-6"><?php echo $company_name;?></div>
									</div>
									<?php } ?>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="first_name">First Name:</label>
										<div class="col-sm-6"><?php echo $first_name;?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="last_name">Last Name:</label>
										<div class="col-sm-6"><?php echo $last_name;?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="address">Address:</label>
										<div class="col-sm-6"><?php echo $address; ?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="phone">Postcode:</label>
										<div class="col-sm-6"><?php echo $postcode; ?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="email">Email:</label>
										<div class="col-sm-6"><?php echo $email; ?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="phone">Phone:</label>
										<div class="col-sm-6"><?php echo $phone; ?></div>
									</div>
									<div class="form-group">
										<label class="col-sm-5 text-right" for="address">Profile Image:</label>
										<div class="col-sm-6">
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
						
						<div class="tab-pane mb30" id="tab_efn_2">
							
							<div class="row">
								
								<div class="col-sm-12">

									<div class="form-group">
										<label class="col-sm-5 text-right" for="contact_first_name">First Name:</label>
										<div class="col-sm-6"><?php echo $contact_first_name;?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="contact_last_name">Last Name:</label>
										<div class="col-sm-6"><?php echo $contact_last_name;?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="contact_address">Address:</label>
										<div class="col-sm-6"><?php echo $contact_address; ?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="contact_email">Email:</label>
										<div class="col-sm-6"><?php echo $contact_email; ?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="contact_phone">Phone:</label>
										<div class="col-sm-6"><?php echo $contact_phone; ?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="contact_mobile">Mobile:</label>
										<div class="col-sm-6"><?php echo $contact_mobile; ?></div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 text-right" for="contact_fax">Fax:</label>
										<div class="col-sm-6"><?php echo $contact_fax; ?></div>
									</div>
								
								</div>
								
							</div>
							
						</div>
						
					</div>

					<ul class="pager wizard">
						<li class="previous"><button name="btn-previous" id="btn-previous" type="button" class="btn btn-primary pull-left">Previous</button></li>
						<li class="next"><button name="btn-submit" id="btn-submit" type="button" class="btn btn-primary pull-right">Next</button></li>
					</ul>

				</div>
				<?php echo form_close();?>
            </div>
         
        </div>
	</div>
</div>