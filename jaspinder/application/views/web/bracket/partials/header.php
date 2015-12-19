<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo config_item('application_name');?></title>
	<meta name="author" content="" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="application-name" content="<?php echo config_item('application_name');?>" />
	
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<!-- Force IE9 to render in normla mode -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- basic styles -->
	
	<link href="<?php echo $asset_url; ?>css/style.opensans.css" rel="stylesheet" />
	<link href="<?php echo $asset_url; ?>css/style.default.css" rel="stylesheet" />
	<link href="<?php echo $asset_url; ?>css/jquery.gritter.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo $asset_url; ?>css/jquery.tagsinput.css" />
	<?php
	if (isset($plugins))
	foreach ($plugins as $plugin) {

		if ($plugin == 'prettify') {
			echo '<link href="' . $asset_url . 'plugins/misc/prettify/prettify.css" type="text/css" rel="stylesheet" />';
		} elseif ($plugin == 'fullcalendar') {
			echo '<link href="' . $asset_url . 'css/fullcalendar.css" rel="stylesheet" type="text/css" />';
		} elseif ($plugin == 'gallery') {
			echo '<link href="' . $asset_url . 'plugins/gallery/pretty-photo/prettyPhoto.css" type="text/css" rel="stylesheet" />';
		} elseif ($plugin == 'dropzone') {
			echo '<link href="' . $asset_url . 'plugins/dropzone/dropzone.css" rel="stylesheet" type="text/css" />';
		} elseif ($plugin == 'datatables') {
			echo '<link href="' . $asset_url . 'css/jquery.datatables.css" rel="stylesheet" type="text/css" />';
		} elseif ($plugin == 'timepicker') {
			echo '<link href="' . $asset_url . 'css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />';
			echo '<link href="' . $asset_url . 'css/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" />';
		}
	}
	?>
	<link href="<?php echo $asset_url; ?>css/custom.css" rel="stylesheet" />

	<!--[if lt IE 9]>
	<script src="<?php echo $asset_url; ?>js/html5shiv.js"></script>
	<script src="<?php echo $asset_url; ?>js/respond.min.js"></script>
	<![endif]-->

	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url(); ?>";
		var SITE_URL = "<?php echo site_url('/'); ?>";
		var ASSET_URL = "<?php echo $asset_url; ?>";
		var CDN_URL = "<?php echo cdn_url(); ?>";
		var APP = {
			
			<?php if(isset($current_user->gmt_offset)) { ?>
			gmt_offset : '<?php echo $current_user->gmt_offset;?>',
			gmt_options : <?php echo json_encode($gmt_options);?>
			<?php } ?>
		};
	</script>
</head>

    
       