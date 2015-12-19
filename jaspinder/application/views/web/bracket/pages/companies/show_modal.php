<?php echo form_open($form_action,' name="frm-user-view" class="form-horizontal" data-ajax="wdpajax" data-options=\'{"params" : "ajax", "loader" : "modal"}\'', $hiddenvars);?>
<div class="row">
	
	<div class="col-sm-12">

		<div class="form-group">
			<label class="col-sm-3 text-right" for="name">Agency Name:</label>
			<div class="col-sm-8"><?php echo $name;?></div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 text-right" for="address">Agency Address:</label>
			<div class="col-sm-8"><?php echo $address;?></div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 text-right" for="standard_hourly_rate">Agency Logo:</label>
			<div class="col-sm-8">
				<?php
					if(isset($logo)) { 
						$file = cdn_url() . 'documents/companylogo/' . $logo;
						$file_headers = @get_headers($file);
						
						if (isset($logo) && !empty($logo) && !(strpos($file_headers[0], '404 Not Found'))   && !(strpos($file_headers[0], '403 Forbidden'))) {
							echo '<img src="' . cdn_url() . 'documents/companylogo/' . $logo . '" alt="" class="image" style="margin-top:10px;" />';
						} else {
							echo '<img src="' . $asset_url . 'images/' . DEFAULT_IMAGE . '" alt="" class="image" style="margin-top:10px;" />';
						}
					}
				?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 text-right" for="gmt_offset">Timezone:</label>
			<div class="col-sm-8"><?php echo _date_lang_shorttag($gmt_offset);?></div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 text-right" for="active">Status: </label>
			<div class="col-sm-8"><?php echo ( $active == 1) ? 'Active' : 'In-active';?></div>
		</div>
	
	</div>
	
</div>
<?php echo form_close();?>