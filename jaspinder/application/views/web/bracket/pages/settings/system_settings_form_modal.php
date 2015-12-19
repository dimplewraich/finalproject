<?php echo form_open($form_action,'name="frm-core-systing" class="form-horizontal" data-ajax="wdpajax" data-options=\'{"params" : "ajax", "loader" : "modal"}\'', $hiddenvars);?>
<div class="row">        
	<div class="col-md-12">
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
</diV>
<?php echo form_close();?>