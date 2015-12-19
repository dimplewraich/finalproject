<?php echo form_open($form_action,' name="frm-user-view" class="form-horizontal" data-ajax="wdpajax" data-options=\'{"params" : "ajax", "loader" : "modal"}\'', $hiddenvars);?>
<div class="row mb15">
	
	<div class="col-sm-12">

		<div class="form-group">
			<label class="col-sm-4 text-right">First Name:</label>
			<div class="col-sm-8"><?php echo $first_name;?></div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 text-right">Last Name:</label>
			<div class="col-sm-8"><?php echo $last_name;?></div>
		</div>
	
		<div class="form-group">
			<label class="col-sm-4 text-right">User Group:</label>
			<div class="col-sm-8"><?php echo $group_name;?></div>
		</div>

		<?php if($current_user->group_id == GROUP_ADMIN) { ?>
		<div class="form-group company_option" <?php if( !_has_company_group_access($group_id) ) { ?>style="display:none;"<?php } ?>>
			<label class="col-sm-4 text-right">Agency:</label>
			<div class="col-sm-8"><?php echo $company_name;?></div>
		</div>
		<?php } ?>

		<div class="form-group client_option" <?php echo ( _has_company_non_resources($group_id) && gtzero_integer($company_id)) ? '' : 'style="display:none;"';?>>
			<label class="col-sm-4 text-right">Client(s):</label>
			<div class="col-sm-8">
				<?php 
					$clients = clients_dropdown('return' , array( 'company_id' => $company_id, 'client_ids' => $client_ids));
					
					echo implode(', ', $clients);
				?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 text-right">Email:</label>
			<div class="col-sm-8"><?php echo $email;?></div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 text-right">Phone:</label>
			<div class="col-sm-8"><?php echo $phone;?></div>
		</div>
		
	</div>
	
</div>
<?php echo form_close();?>