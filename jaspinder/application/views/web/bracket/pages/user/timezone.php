<?php echo form_open_multipart($form_action,' name="frm-timezone" class="form-horizontal" data-options=\'{"params" : "ajax", "loader" : "modal"}\'');?>
<div class="row mb20">
	<div class="col-sm-12">
		We have detected that your timezone is set differently to that of your computer. You're computer is set to <strong><?php echo $front_gmt_offset;?></strong> or equivalent. Below you can change your WorkDeskPro settings to match. This may be because your country has entered or left daylight saving.
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="gmt_offset">Timezone:</label>
	<div class="col-sm-8">
		<?php echo timezone_menu($gmt_offset,'form-control input-sm', 'gmt_offset');?>
	</div>
</div>

<?php if($current_user->group_id == 2) { ?>

<div class="form-group">
	<label class="col-sm-3 control-label" for="gmt_offset"></label>
	<div class="col-sm-8">
		 <div class="checkbox block"><label><input name="all_resources" type="checkbox" value="1" /> Do you want to update the timezone for all resources</label></div>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="gmt_offset"></label>
	<div class="col-sm-8">
		 <div class="checkbox block"><label><input name="company_setting_offset" type="checkbox" value="1" /> Email and PDF will use this timezone to display date. You can also change this from Account settings</label></div>
	</div>
</div>


<?php } ?>

<?php echo form_close();?>