<div class="row">        
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
                <div class="panel-btns">
					<a href="<?php echo $cancel_url;?>">Back</a>
				</div>
				<h4 class="panel-title">Site Detail</h4>
			</div>
			
			 <div class="panel-body panel-body-nopadding">
				<?php echo form_open($form_action,' name="frm-site" class="form-horizontal"', $hiddenvars);?>
				
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
							
									<?php if(in_array($current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER))) { ?>
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="company_id">Agency:</label>
										<div class="col-sm-6">
											<?php echo form_dropdown('company_id', companies_dropdown('return', array('first_row' => TRUE)), $company_id ,'id="company_id" class="required form-control" style="width:250px;" data-placeholder="Select Agency"'); ?>
											<?php echo form_error('company_id','<label class="error">','</label>');?>
										</div>
									</div>
									<?php } ?>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="district_no">District No:</label>
										<div class="col-sm-6">
											<?php echo form_input('district_no', $district_no, 'id="district_no" class="form-control input-sm"'); ?>
											<?php echo form_error('district_no','<label class="error">','</label>');?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="site_code">Site No:</label>
										<div class="col-sm-6">
											<?php echo form_input('site_code', $site_code, 'id="site_code" class="form-control input-sm"'); ?>
											<?php echo form_error('site_code','<label class="error">','</label>');?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="town">Town/District:</label>
										<div class="col-sm-6">
											<?php echo form_input('town', $town, 'id="town" class="form-control input-sm"'); ?>
											<?php echo form_error('town','<label class="error">','</label>');?>
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
										<label class="col-sm-4 control-label no-padding-right" for="street">Street:</label>
										<div class="col-sm-6">
											<?php echo form_input('street', $street, 'id="street" class="form-control input-sm"'); ?>
											<?php echo form_error('street','<label class="error">','</label>');?>
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
										<label class="col-sm-4 control-label no-padding-right" for="site_ref">Site Ref:</label>
										<div class="col-sm-6">
											<?php echo form_input('site_ref', $site_ref, 'id="site_ref" class="form-control input-sm"'); ?>
											<?php echo form_error('site_ref', '<label class="error">', '</label>'); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="upload_date">Date Added:</label>
										<div class="col-sm-6">
											<div class="input-group col-sm-12 input-group-sm">
												<input name="upload_date"  id="upload_date" type="text" class="form-control dpicker" placeholder="dd/mm/yyyy" value="<?php echo $upload_date;?>" />
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
											<?php echo form_error('upload_date', '<label class="error">', '</label>'); ?>
										</div>
									</div>
								
								</div>
								
							</div>
					
						</div>
						
						<div class="tab-pane mb30" id="tab_efn_2">
							
							<div class="row">
				
								<div class="col-sm-11">
							
									<div class="row">
										
										<div class="col-sm-6">

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="static_scroller">STATIC/SCROLLER:</label>
												<div class="col-sm-6">
													<?php echo form_dropdown('static_scroller', array('STATIC' => 'STATIC', 'SCROLLER' => 'SCROLLER'), $static_scroller ,'class="form-control" data-placeholder="I\'ll choose it later on"'); ?>
													<?php echo form_error('static_scroller','<label class="error">','</label>');?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="shelter_fsu">SHELTER/FSU:</label>
												<div class="col-sm-6">
													<?php echo form_dropdown('shelter_fsu', array('SHELTER' => 'SHELTER', 'FSU' => 'FSU'), $shelter_fsu ,'class="form-control" data-placeholder="I\'ll choose it later on"'); ?>
													<?php echo form_error('shelter_fsu','<label class="error">','</label>');?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="easting">EASTING:</label>
												<div class="col-sm-6">
													<?php echo form_input('easting', $easting, 'id="easting" class="form-control input-sm"'); ?>
													<?php echo form_error('easting','<label class="error">','</label>');?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="northing">NORTHING:</label>
												<div class="col-sm-6">
													<?php echo form_input('northing', $northing, 'id="northing" class="form-control input-sm"'); ?>
													<?php echo form_error('northing', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="shelter_type">SHELTER TYPE:</label>
												<div class="col-sm-6">
													<?php echo form_dropdown('shelter_type', cust_tbls_dropdown('return' ,'shelter_types', TRUE), $shelter_type ,'class="form-control" data-placeholder="I\'ll choose it later on"'); ?>
													<?php echo form_error('shelter_type', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="site_configuration">CONFIGURATION:</label>
												<div class="col-sm-6">
													<?php echo form_dropdown('site_configuration', cust_tbls_dropdown('return' ,'configurations', TRUE), $site_configuration ,'class="form-control" data-placeholder="I\'ll choose it later on"'); ?>
													<?php echo form_error('site_configuration', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="height">HEIGHT:</label>
												<div class="col-sm-6">
													<?php echo form_input('height', $height, 'id="height" class="form-control input-sm"'); ?>
													<?php echo form_error('height', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="panel">PANEL:</label>
												<div class="col-sm-6">
													<?php echo form_dropdown('panel', cust_tbls_dropdown('return' ,'panels', TRUE), $panel ,'class="form-control" data-placeholder="I\'ll choose it later on"'); ?>
													<?php echo form_error('panel', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="ranking">RANKING:</label>
												<div class="col-sm-6">
													<?php echo form_dropdown('ranking', cust_tbls_dropdown('return' ,'ranking', TRUE), $ranking ,'class="form-control" data-placeholder="I\'ll choose it later on"'); ?>
													<?php echo form_error('ranking', '<label class="error">', '</label>'); ?>
												</div>
											</div>
											
										</div>
										
										<div class="col-sm-6">

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="embargo_start_date">EMBARGO START DATE:</label>
												<div class="col-sm-6">
													<div class="input-group col-sm-12 input-group-sm">
														<input name="embargo_start_date"  id="embargo_start_date" type="text" class="form-control dpicker" placeholder="dd/mm/yyyy" value="<?php echo $embargo_start_date;?>" />
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div>
													<?php echo form_error('embargo_start_date', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="status">STATUS:</label>
												<div class="col-sm-6">
													<?php echo form_dropdown('status', cust_tbls_dropdown('return' ,'statuses', TRUE), $status ,'class="form-control" data-placeholder="I\'ll choose it later on"'); ?>
													<?php echo form_error('status', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="power_build_pack_requested">POWER BUILD PACK REQUESTED:</label>
												<div class="col-sm-6">
													<div class="input-group col-sm-12 input-group-sm">
														<input name="power_build_pack_requested"  id="power_build_pack_requested" type="text" class="form-control dpicker" placeholder="dd/mm/yyyy" value="<?php echo $power_build_pack_requested;?>" />
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div>
													<?php echo form_error('power_build_pack_requested', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="power_build_pack_received_ttc">POWER BUILD PACK RECEIVED TTC:</label>
												<div class="col-sm-6">
													<div class="input-group col-sm-12 input-group-sm">
														<input name="power_build_pack_received_ttc"  id="power_build_pack_received_ttc" type="text" class="form-control dpicker" placeholder="dd/mm/yyyy" value="<?php echo $power_build_pack_received_ttc;?>" />
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div>
													<?php echo form_error('power_build_pack_received_ttc', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="actual_power_cost">ACTUAL POWER COST:</label>
												<div class="col-sm-6">
													<div class="input-group col-sm-12 input-group-sm">
														<input name="actual_power_cost"  id="actual_power_cost" type="text" class="form-control" value="<?php echo $actual_power_cost;?>" />
														<span class="input-group-addon"><?php echo $cfg->currency;?></span>
													</div>
													<?php echo form_error('actual_power_cost', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="power_build_date">POWER BUILD DATE:</label>
												<div class="col-sm-6">
													<div class="input-group col-sm-12 input-group-sm">
														<input name="power_build_date"  id="power_build_date" type="text" class="form-control dpicker" placeholder="dd/mm/yyyy" value="<?php echo $power_build_date;?>" />
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div>
													<?php echo form_error('power_build_date', '<label class="error">', '</label>'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-6 control-label no-padding-right" for="meter_build_date">METER BUILD DATE:</label>
												<div class="col-sm-6">
													<div class="input-group col-sm-12 input-group-sm">
														<input name="meter_build_date"  id="meter_build_date" type="text" class="form-control dpicker" placeholder="dd/mm/yyyy" value="<?php echo $meter_build_date;?>" />
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div>
													<?php echo form_error('meter_build_date', '<label class="error">', '</label>'); ?>
												</div>
											</div>
											
										
										</div>
										
									</div>
								</div>
								
							</div>
							
						</div>
						
					</div>

					<?php if( in_array($current_user->group_id, array(GROUP_ADMIN)) ) { ?>
					<?php if( isset($site_id)) { ?>
					<div class="row mb15">
						<div class="col-sm-12">
							<a href="<?php echo $notes_listing_url;?>" class="btn btn-sm btn-primary pull-right mr5" data-ajax="wdpajax" data-options='{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Notes <small>(Site: <?php echo $full_name;?>)</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.notes.close_grid(g);", "callback" : "wdp.notes.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}'><i class="fa fa-comments mr5"></i>Notes</a>
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