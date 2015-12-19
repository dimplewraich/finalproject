<div class="row">        
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
                <h4 class="panel-title">System Settings</h4>
			</div>
			
			<?php echo form_open($form_action, 'name="frm-core-systing" class="form-horizontal"', $hiddenvars);?>
			<div class="panel-body">
				
				<?php foreach($qrows AS $qrow) { ?>
					<?php if($qrow->type == 'text') { ?>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="<?php echo $qrow->key;?>"><?php echo $qrow->title;?></label>
						<div class="col-sm-7">
							<?php echo form_input($qrow->key, ${$qrow->key}, 'class="form-control input-sm"'); ?>
							<?php echo form_error($qrow->key,'<label class="error">','</label>');?>
						</div>
					</div>
					
					<?php } elseif($qrow->type == 'select'){ ?>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="<?php echo $qrow->key;?>"><?php echo $qrow->title;?></label>
						<div class="col-sm-7">
							<?php echo form_dropdown($qrow->key, $qrow->options, ${$qrow->key} ,'class="form-control input-sm"'); ?>
							<?php echo form_error($qrow->key,'<label class="error">','</label>');?>
						</div>
					</div>
			
					<?php } elseif($qrow->type == 'codeigniter_timezone'){ ?>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="<?php echo $qrow->key;?>"><?php echo $qrow->title;?></label>
						<div class="col-sm-7">
							<?php echo timezone_menu(${$qrow->key},'form-control input-sm', 'gmt_offset');?>
							<?php echo form_error($qrow->key,'<label class="error">','</label>');?>
						</div>
					</div>
					
					<?php } ?>
				<?php } ?>
				
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