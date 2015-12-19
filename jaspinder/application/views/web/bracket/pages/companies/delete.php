<div class="row">        
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
                <h4 class="panel-title"><?php echo $display_heading;?></h4>
			</div>
			
			<?php echo form_open( $form_action, 'class="form-horizontal"', $hiddenvars);?>
			<input type="hidden" name="confirm" value="1" />
			<div class="panel-body">
				<p class="text-info" style="text-align:center;"><?php echo $display_message;?></p>
			</div>
				
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-4">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok mr5"></i>Save Changes</button>
						<a class="btn btn-default" href="<?php echo $cancel_url;?>"><i class="glyphicon glyphicon-remove mr5"></i>Cancel</a>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
			
        </div>
    </div>
</div>