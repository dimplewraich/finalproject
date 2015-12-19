<div class="row">        
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
                <h4 class="panel-title">Agency Detail</h4>
			</div>
			
			<?php echo form_open_multipart( $form_action, 'name="frm-company" class="form-horizontal"', $hiddenvars);?>
			<div class="panel-body">

				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="name">Agency Name:</label>
							<div class="col-sm-9">
								<?php echo form_input('name', $name, 'id="name" class="form-control"'); ?>
								<?php echo form_error('name','<label class="error">','</label>');?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="address">Agency Address:</label>
							<div class="col-sm-9">
								<?php echo form_input('address', $address, 'id="address" class="form-control"'); ?>
								<?php echo form_error('address', '<label class="error">', '</label>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="standard_hourly_rate">Agency Logo:</label>
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-10">
										<input type="file" name="company_logo" id="company_logo" class="form-control input-sm" />
									</div>
									<div class="col-sm-2">
										<button type="button" class="btn btn-primary btn-sm mt5" name="btn-upload"><i class="fa fa-upload"></i></button>
									</div>
								</div>
								<div class="clearfix company_logo" style="margin-top:10px;">
								<?php
									if(isset($logo)) { 
										$file = cdn_url() . 'documents/companylogo/' . $logo;
										$file_headers = @get_headers($file);
										
										if (isset($logo) && !empty($logo) && !(strpos($file_headers[0], '404 Not Found'))   && !(strpos($file_headers[0], '403 Forbidden'))) {
											echo '<img src="' . cdn_url() . 'documents/companylogo/' . $logo . '" alt="" class="image" style="margin-top:10px;" />';
										} else {
											echo '<img src="' . $asset_url . 'images/' . DEFAULT_IMAGE . '" alt="" class="image" style="margin-top:10px;" />';
										}
									}
								?>
								</div>
								<?php echo form_error('company_logo', '<label class="error">', '</label>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="gmt_offset">Timezone:</label>
							<div class="col-sm-9">
								<?php echo timezone_menu($gmt_offset,'form-control', 'gmt_offset');?>
								<?php echo form_error('gmt_offset', '<label class="error">', '</label>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="active">Status: </label>
							<div class="col-sm-8">
								<div class="mt5">
									<label class="radio-inline">
										<input type="radio" id="active_0" name="active" value="1" class="ace" <?php if( $active == "1"){ ?>checked="checked"<?php } ?> /> <span class="lbl"> Activate</span>
									</label>
									<label class="radio-inline">
										<input type="radio" id="active_1" name="active" value="0" class="ace" <?php if( $active != '1'){ ?>checked="checked"<?php } ?> /> <span class="lbl"> De-Activate</span>
									</label>
								</div>
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