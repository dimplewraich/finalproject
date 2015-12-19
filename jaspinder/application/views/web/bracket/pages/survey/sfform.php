<div class="row">        
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
                <div class="panel-btns">
					<a href="<?php echo $cancel_url;?>">Back</a>
				</div>
				<h4 class="panel-title">Site Detail</h4>
			</div>
			
			<?php echo form_open($form_action,' name="frm-sfcreate" class="form-horizontal"', $hiddenvars);?>
			<div class="panel-body">
				
				<div class="row">
	
					<div class="col-sm-12">

						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-right" for="name">Name:</label>
							<div class="col-sm-6">
								<?php echo form_input('name', $name, 'id="name" class="form-control input-sm"'); ?>
								<?php echo form_error('name','<label class="error">','</label>');?>
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