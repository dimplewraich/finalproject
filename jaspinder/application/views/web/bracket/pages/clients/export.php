<div class="row">        
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
                <h4 class="panel-title">Download File Detail</h4>
			</div>
			
			<?php echo form_open_multipart($form_action,' name="frm-import" class="form-horizontal"');?>
			<div class="panel-body">
				
				<?php if($current_user->group_id == 1) { ?>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="company_id">Company</label>
					<div class="col-sm-7">
						<?php echo form_dropdown('company_id', companies_dropdown('return', TRUE), $company_id ,'id="company_id" class="required form-control" style="width:250px;" data-placeholder="Select Company"'); ?>
						<?php echo form_error('company_id','<label class="error">','</label>');?>
					</div>
				</div>
				<?php } ?>

				<div class="form-group">
					<label class="col-sm-2 control-label">Export Options</label>
					<div class="col-sm-6">
						<label class="radio-inline"><input type="radio"  name="export_sheet_option" id="export_sheet_option_1_<?php echo $ctrl_id;?>" value="0" <?php if($export_sheet_option == 0) {?>checked="checked"<?php } ?>> All clients</label>
						<label class="radio-inline"><input type="radio" name="export_sheet_option" id="export_sheet_option_2_<?php echo $ctrl_id;?>" value="1" <?php if($export_sheet_option == 1) {?>checked="checked"<?php } ?>> Blank Template</label>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Field Detail</label>
					<div class="col-sm-12">
						
					</div>
				</div>
				
            </div>
				
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-3">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok mr5"></i><?php echo $submit_btn_text;?></button>
						<a class="btn btn-default" href="<?php echo $cancel_url;?>"><i class="glyphicon glyphicon-remove mr5"></i>Cancel</a>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
        </div>
    </div>
</div>