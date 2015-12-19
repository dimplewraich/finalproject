<div class="btn-group nomargin <?php echo $additional_params['detail_margin'];?>">
	<?php if(isset($actions['view'])) { ?>
	<a href="<?php echo $actions['view']['href'];?>" <?php echo $actions['view']['params'];?> class="btn btn-xs btn-primary"><i class="<?php echo $additional_params['detail_icon'];?>"></i></a>
	<?php }else{?>
	<a href="javascript:void(0);" class="btn btn-xs btn-primary"><i class="<?php echo $additional_params['detail_icon'];?>"></i></a>
	<?php } ?>
	<button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu pull-right" role="menu">
			
		<?php if(isset($actions['view'])) { ?>
		<li><a href="<?php echo $actions['view']['href'];?>" <?php echo $actions['view']['params'];?>  title="<?php echo strip_tags($actions['view']['title']);?>" class="btip"><i class="fa fa-eye mr5"></i> <?php echo $actions['view']['text'];?></a></li>
		<?php } ?>
	
		<?php if(isset($actions['edit'])) { ?>
		<li><a href="<?php echo $actions['edit']['href'];?>" <?php echo $actions['edit']['params'];?>  title="<?php echo strip_tags($actions['edit']['title']);?>" class="btip"><i class="fa fa-pencil mr5"></i> <?php echo $actions['edit']['text'];?></a></li>
		<?php } ?>
	
		<?php if(isset($actions['delete'])) { ?>
		<li><a href="<?php echo $actions['delete']['href'];?>" <?php echo $actions['delete']['params'];?>  title="<?php echo strip_tags($actions['delete']['title']);?>" class="btip"><i class="fa fa-trash-o mr5"></i> <?php echo $actions['delete']['text'];?></a></li>
		<?php } ?>
	
		<?php if(isset($actions['cancelled'])) { ?>
		<li><a href="<?php echo $actions['cancelled']['href'];?>" <?php echo $actions['cancelled']['params'];?>  title="<?php echo strip_tags($actions['cancelled']['title']);?>" class="btip"><i class="fa fa-times mr5"></i> <?php echo $actions['cancelled']['text'];?></a></li>
		<?php } ?>
	
		<?php if(isset($actions['archived'])) { ?>
		<li><a href="<?php echo $actions['archived']['href'];?>" <?php echo $actions['archived']['params'];?>  title="<?php echo strip_tags($actions['archived']['title']);?>" class="btip"><i class="fa fa-archive mr5"></i> <?php echo $actions['archived']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['communication'])) { ?>
		<li><a href="<?php echo $actions['communication']['href'];?>" <?php echo $actions['communication']['params'];?>  title="<?php echo strip_tags($actions['communication']['title']);?>" class="btip"><i class="fa fa-comments mr5"></i> <?php echo $actions['communication']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['new_communication'])) { ?>
		<li><a href="<?php echo $actions['new_communication']['href'];?>" <?php echo $actions['new_communication']['params'];?> title="<?php echo strip_tags($actions['new_communication']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_communication']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['notes'])) { ?>
		<li><a href="<?php echo $actions['notes']['href'];?>" <?php echo $actions['notes']['params'];?>  title="<?php echo strip_tags($actions['notes']['title']);?>" class="btip"><i class="fa fa-comments mr5"></i> <?php echo $actions['notes']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['new_note'])) { ?>
		<li><a href="<?php echo $actions['new_note']['href'];?>" <?php echo $actions['new_note']['params'];?> title="<?php echo strip_tags($actions['new_note']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_note']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['contacts'])) { ?>
		<li><a href="<?php echo $actions['contacts']['href'];?>" <?php echo $actions['contacts']['params'];?>  title="<?php echo strip_tags($actions['contacts']['title']);?>" class="btip"><i class="fa fa-user mr5"></i> <?php echo $actions['contacts']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['new_contact'])) { ?>
		<li><a href="<?php echo $actions['new_contact']['href'];?>" <?php echo $actions['new_contact']['params'];?> title="<?php echo strip_tags($actions['new_contact']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_contact']['text'];?></a></li>
		<?php } ?>
		
		<?php if( $additional_params['group_seperator'] && (isset($actions['settings']) || isset($actions['deactivate']) || isset($actions['activate']) || isset($actions['approve']) || isset($actions['download'])
			 || isset($actions['regions']) || isset($actions['void']) || isset($actions['site_location']) || isset($actions['add_stock']) || isset($actions['my_pdf_templates_settings']) || isset($actions['timesheet']))
		) { ?>
		<li class="divider"></li>
		<?php } ?>
		
		<?php if(isset($actions['download'])) { ?>
		<li><a href="<?php echo $actions['download']['href'];?>" <?php echo $actions['download']['params'];?>  title="<?php echo strip_tags($actions['download']['title']);?>" class="btip"><i class="fa fa-download mr5"></i> <?php echo $actions['download']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['add_stock'])) { ?>
		<li><a href="<?php echo $actions['add_stock']['href'];?>" <?php echo $actions['add_stock']['params'];?>  title="<?php echo strip_tags($actions['add_stock']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['add_stock']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['settings'])) { ?>			
		<li><a href="<?php echo $actions['settings']['href'];?>" <?php echo $actions['settings']['params'];?>  title="<?php echo strip_tags($actions['settings']['title']);?>" class="btip"><i class="fa fa-cog mr5"></i> <?php echo $actions['settings']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['account_settings'])) { ?>			
		<li><a href="<?php echo $actions['account_settings']['href'];?>" <?php echo $actions['account_settings']['params'];?>  title="<?php echo strip_tags($actions['account_settings']['title']);?>" class="btip"><i class="fa fa-cog mr5"></i> <?php echo $actions['account_settings']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['permission_settings'])) { ?>			
		<li><a href="<?php echo $actions['permission_settings']['href'];?>" <?php echo $actions['permission_settings']['params'];?>  title="<?php echo strip_tags($actions['permission_settings']['title']);?>" class="btip"><i class="fa fa-cog mr5"></i> <?php echo $actions['permission_settings']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['cstfld_settings'])) { ?>			
		<li><a href="<?php echo $actions['cstfld_settings']['href'];?>" <?php echo $actions['cstfld_settings']['params'];?>  title="<?php echo strip_tags($actions['cstfld_settings']['title']);?>" class="btip"><i class="fa fa-cog mr5"></i> <?php echo $actions['cstfld_settings']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['my_pdf_templates_settings'])) { ?>			
		<li><a href="<?php echo $actions['my_pdf_templates_settings']['href'];?>" <?php echo $actions['my_pdf_templates_settings']['params'];?>  title="<?php echo strip_tags($actions['my_pdf_templates_settings']['title']);?>" class="btip"><i class="fa fa-cog mr5"></i> <?php echo $actions['my_pdf_templates_settings']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['cost'])) { ?>			
		<li><a href="<?php echo $actions['cost']['href'];?>" <?php echo $actions['cost']['params'];?>  title="<?php echo strip_tags($actions['cost']['title']);?>" class="btip"><i class="fa fa-cog mr5"></i> <?php echo $actions['cost']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['deactivate'])) { ?>			
		<li><a href="<?php echo $actions['deactivate']['href'];?>" <?php echo $actions['deactivate']['params'];?>  title="<?php echo strip_tags($actions['deactivate']['title']);?>" class="btip"><i class="fa fa-times mr5"></i> <?php echo $actions['deactivate']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['activate'])) { ?>			
		<li><a href="<?php echo $actions['activate']['href'];?>" <?php echo $actions['activate']['params'];?>  title="<?php echo strip_tags($actions['activate']['title']);?>" class="btip"><i class="fa fa-check mr5"></i> <?php echo $actions['activate']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['regions'])) { ?>			
		<li><a href="<?php echo $actions['regions']['href'];?>" <?php echo $actions['regions']['params'];?>  title="<?php echo strip_tags($actions['regions']['title']);?>" class="btip"><i class="fa fa-home mr5"></i> <?php echo $actions['regions']['text'];?></a></li>			
		<?php } ?>
		
		<?php if(isset($actions['void'])) { ?>
		<li><a href="<?php echo $actions['void']['href'];?>" <?php echo $actions['void']['params'];?>  title="<?php echo strip_tags($actions['void']['title']);?>" class="btip"><i class="fa fa-trash-o mr5"></i> <?php echo $actions['void']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['approve'])) { ?>
		<li><a href="<?php echo $actions['approve']['href'];?>" <?php echo $actions['approve']['params'];?>  title="<?php echo strip_tags($actions['approve']['title']);?>" class="btip"><i class="fa fa-check-square-o mr5"></i> <?php echo $actions['approve']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['goods_received'])) { ?>
		<li><a href="<?php echo $actions['goods_received']['href'];?>" <?php echo $actions['goods_received']['params'];?>  title="<?php echo strip_tags($actions['goods_received']['title']);?>" class="btip"><i class="fa fa-check-square-o mr5"></i> <?php echo $actions['goods_received']['text'];?></a></li>
		<?php } ?>
		<?php if(isset($actions['site_location'])) { ?>
		<li><a href="<?php echo $actions['site_location']['href'];?>" <?php echo $actions['site_location']['params'];?> title="<?php echo strip_tags($actions['site_location']['title']);?>" class="btip"><i class="fa fa-globe mr5"></i> <?php echo $actions['site_location']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['paid_invoice'])) { ?>
		<li><a href="<?php echo $actions['paid_invoice']['href'];?>" <?php echo $actions['paid_invoice']['params'];?> title="<?php echo strip_tags($actions['paid_invoice']['title']);?>" class="btip"><i class="fa  fa-check-square-o mr5"></i> <?php echo $actions['paid_invoice']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['timesheet'])) { ?>
		<li><a href="<?php echo $actions['timesheet']['href'];?>" <?php echo $actions['timesheet']['params'];?> title="<?php echo strip_tags($actions['timesheet']['title']);?>" class="btip"><i class="fa fa-clock-o mr5"></i> <?php echo $actions['timesheet']['text'];?></a></li>
		<?php } ?>
		
		<?php if( 
				$additional_params['group_seperator'] && (isset($actions['clients']) || isset($actions['equipments']) || isset($actions['jobs']) || isset($actions['parts']) || isset($actions['quotes']) ||
				isset($actions['sites']) || isset($actions['consumables']) || isset($actions['suppliers']) || isset($actions['new_job']))
		) { ?>
		<li class="divider"></li>
		<?php } ?>
		
		<?php if(isset($actions['clients'])) { ?>
		<li><a href="<?php echo $actions['clients']['href'];?>" <?php echo $actions['clients']['params'];?>  title="<?php echo strip_tags($actions['clients']['title']);?>" class="btip"><i class="fa fa-user mr5"></i> <?php echo $actions['clients']['text'];?></a></li>			
		<?php } ?>
		<?php if(isset($actions['new_client'])) { ?>
		<li><a href="<?php echo $actions['new_client']['href'];?>" <?php echo $actions['new_client']['params'];?> title="<?php echo strip_tags($actions['new_client']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_client']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['sites'])) { ?>			
		<li><a href="<?php echo $actions['sites']['href'];?>" <?php echo $actions['sites']['params'];?>  title="<?php echo strip_tags($actions['sites']['title']);?>" class="btip"><i class="fa fa-home mr5"></i> <?php echo $actions['sites']['text'];?></a></li>			
		<?php } ?>
		<?php if(isset($actions['new_site'])) { ?>
		<li><a href="<?php echo $actions['new_site']['href'];?>" <?php echo $actions['new_site']['params'];?> title="<?php echo strip_tags($actions['new_site']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_site']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['equipments'])) { ?>			
		<li><a href="<?php echo $actions['equipments']['href'];?>" <?php echo $actions['equipments']['params'];?>  title="<?php echo strip_tags($actions['equipments']['title']);?>" class="btip"><i class="fa fa-gavel mr5"></i> <?php echo $actions['equipments']['text'];?></a></li>			
		<?php } ?>
		<?php if(isset($actions['new_equipment'])) { ?>
		<li><a href="<?php echo $actions['new_equipment']['href'];?>" <?php echo $actions['new_equipment']['params'];?> title="<?php echo strip_tags($actions['new_equipment']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_equipment']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['jobs'])) { ?>			
		<li><a href="<?php echo $actions['jobs']['href'];?>" <?php echo $actions['jobs']['params'];?>  title="<?php echo strip_tags($actions['jobs']['title']);?>" class="btip"><i class="fa fa-tasks mr5"></i> <?php echo $actions['jobs']['text'];?></a></li>			
		<?php } ?>
		<?php if(isset($actions['new_job'])) { ?>
		<li><a href="<?php echo $actions['new_job']['href'];?>" <?php echo $actions['new_job']['params'];?> title="<?php echo strip_tags($actions['new_job']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_job']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['invoices'])) { ?>
		<li><a href="<?php echo $actions['invoices']['href'];?>" <?php echo $actions['invoices']['params'];?>  title="<?php echo strip_tags($actions['invoices']['title']);?>" class="btip"><i class="fa fa-leaf mr5"></i> <?php echo $actions['invoices']['text'];?></a></li>			
		<?php } ?>
		<?php if(isset($actions['new_invoice'])) { ?>
		<li><a href="<?php echo $actions['new_invoice']['href'];?>" <?php echo $actions['new_invoice']['params'];?> title="<?php echo strip_tags($actions['new_invoice']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_invoice']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['consumables'])) { ?>			
		<li><a href="<?php echo $actions['consumables']['href'];?>" <?php echo $actions['consumables']['params'];?>  title="<?php echo strip_tags($actions['consumables']['title']);?>" class="btip"><i class="fa fa-hdd-o mr5"></i> <?php echo $actions['consumables']['text'];?></a></li>			
		<?php } ?>
		<?php if(isset($actions['new_consumable'])) { ?>
		<li><a href="<?php echo $actions['new_consumable']['href'];?>" <?php echo $actions['new_consumable']['params'];?> title="<?php echo strip_tags($actions['new_consumable']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_consumable']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['suppliers'])) { ?>			
		<li><a href="<?php echo $actions['suppliers']['href'];?>" <?php echo $actions['suppliers']['params'];?>  title="<?php echo strip_tags($actions['suppliers']['title']);?>" class="btip"><i class="fa fa-user mr5"></i> <?php echo $actions['suppliers']['text'];?></a></li>			
		<?php } ?>
		<?php if(isset($actions['new_supplier'])) { ?>
		<li><a href="<?php echo $actions['new_supplier']['href'];?>" <?php echo $actions['new_supplier']['params'];?> title="<?php echo strip_tags($actions['new_supplier']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_supplier']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['parts'])) { ?>			
		<li><a href="<?php echo $actions['parts']['href'];?>" <?php echo $actions['parts']['params'];?>  title="<?php echo strip_tags($actions['parts']['title']);?>" class="btip"><i class="fa fa-wrench mr5"></i> <?php echo $actions['parts']['text'];?></a></li>			
		<?php } ?>
		<?php if(isset($actions['new_part'])) { ?>
		<li><a href="<?php echo $actions['new_part']['href'];?>" <?php echo $actions['new_part']['params'];?> title="<?php echo strip_tags($actions['new_part']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_part']['text'];?></a></li>
		<?php } ?>
		
		<?php if(isset($actions['quotes'])) { ?>			
		<li><a href="<?php echo $actions['quotes']['href'];?>" <?php echo $actions['quotes']['params'];?>  title="<?php echo strip_tags($actions['quotes']['title']);?>" class="btip"><i class="fa fa-dollar mr5"></i> <?php echo $actions['quotes']['text'];?></a></li>			
		<?php } ?>
		<?php if(isset($actions['new_quote'])) { ?>
		<li><a href="<?php echo $actions['new_quote']['href'];?>" <?php echo $actions['new_quote']['params'];?> title="<?php echo strip_tags($actions['new_quote']['title']);?>" class="btip"><i class="fa fa-plus mr5"></i> <?php echo $actions['new_quote']['text'];?></a></li>
		<?php } ?>
	</ul>
</div>