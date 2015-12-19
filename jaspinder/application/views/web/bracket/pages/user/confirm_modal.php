<?php echo form_open($form_action,' class="form-horizontal" data-options=\'{"params" : "ajax", "loader" : "modal"}\'', $hiddenvars );?>	
	<input type="hidden" name="confirm" value="1" />
	
	<p class="text-info" style="text-align:center;"><?php echo $display_message;?></p>
		
<?php echo form_close();?>