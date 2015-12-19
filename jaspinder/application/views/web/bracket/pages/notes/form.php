<div class="row">        
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
                <h4 class="panel-title">Note Detail</h4>
			</div>
			
			<?php echo form_open($form_action,' name="frm-note" class="form-horizontal"', $hiddenvars);?>
			<div class="panel-body">

				<div class="form-group">
					<label class="col-sm-12 no-padding-right" for="address">Notes:</label>
					<div class="col-sm-12">
						<?php echo form_textarea('description', $description, 'id="description" class="form-control input-sm tinymce"'); ?>
					</div>
				</div>
				
            </div>
				
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-3">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok mr5"></i><?php echo $submit_btn_text;?></button>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
        </div>
    </div>
</div>