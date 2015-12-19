<head>
	<base href="<?php echo base_url(); ?>">
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="apple-mobile-web-app-title" content="<?php echo $cfg->application_title;?>">
	<meta name="viewport" content="user-scalable=no">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">
	<meta name="viewport" content="width=320.1">
	<title><?php echo $cfg->application_title;?></title>
	
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="<?php echo $mobile_asset_url; ?>css/jquery.mobile-1.4.5.min.css" />
	
	<script src="<?php echo $mobile_asset_url; ?>js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo $mobile_asset_url; ?>scripts/jqm.mobileinit.js"></script>
	<script src="<?php echo $mobile_asset_url; ?>js/jquery.mobile-1.4.5.min.js"></script>
	
	<link rel="stylesheet" href="<?php echo $asset_url; ?>css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $mobile_asset_url; ?>css/custom.css">
	
	<link rel="stylesheet" href="<?php echo $mobile_asset_url; ?>css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo $mobile_asset_url; ?>css/responsive.dataTables.min.css">
	
	<script src="<?php echo $mobile_asset_url; ?>js/jquery.dataTables-1.10.9.min.js"></script>
	<script src="<?php echo $mobile_asset_url; ?>js/dataTables.responsive-1.0.7.min.js"></script>
	<link rel="stylesheet" href="<?php echo $asset_url; ?>css/chosen.css" />
	<script src="<?php echo $asset_url; ?>js/chosen.jquery.js"></script>
	<script src="<?php echo $mobile_asset_url; ?>scripts/global.js"></script>
	
	<?php /*
	<script src="http://192.168.0.63/assets/mobile/js/date-box.js"></script>
	<link rel="stylesheet" type="text/css" href="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.min.css">
	<script type='text/javascript' src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
	<script type='text/javascript' src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
	<script type='text/javascript' src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.datebox.min.js"></script>
	<script type='text/javascript' src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.flipbox.min.js"></script>
	<link rel="stylesheet" href="<?php echo cdn_url(); ?>assets/mobile/css/mobile.css<?php echo '?v'.local_to_gmt();?>" />

	<link rel="shortcut icon" href="<?php echo cdn_url(); ?>assets/mobile/images/favicon.ico" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo cdn_url(); ?>assets/mobile/images/apple-touch-icon-144-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo cdn_url(); ?>assets/mobile/images/apple-touch-icon-114-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo cdn_url(); ?>assets/mobile/images/apple-touch-icon-72-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo cdn_url(); ?>assets/mobile/images/apple-touch-icon-57-precomposed.png" />


	<!-- iPhone -->

	<link href="<?php echo cdn_url(); ?>assets/mobile/images/splash/apple-touch-startup-image-320x460.png"
		  media="(device-width: 320px) and (device-height: 480px)
		  and (-webkit-device-pixel-ratio: 1)"
		  rel="apple-touch-startup-image">

	<!-- iPhone (Retina) -->

	<link href="<?php echo cdn_url(); ?>assets/mobile/images/splash/apple-touch-startup-image-640x920.png"
		  media="(device-width: 320px) and (device-height: 480px)
		  and (-webkit-device-pixel-ratio: 2)"
		  rel="apple-touch-startup-image">

	<!-- iPhone 5 -->
	<link href="<?php echo cdn_url(); ?>assets/mobile/images/splash/apple-touch-startup-image-640x1096.png"
		  media="(device-width: 320px) and (device-height: 568px)
		  and (-webkit-device-pixel-ratio: 2)"
		  rel="apple-touch-startup-image">
	*/ ?>


	<meta name="application-name" content="<?php echo $cfg->application_name;?>"/> 
	<meta name="msapplication-TileColor" content="#3399cc"/>

	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url(); ?>";
		var SITE_URL = "<?php echo site_url('/'); ?>";
		var ASSET_URL = "<?php echo $asset_url; ?>";
		var MOBILE_ASSET_URL = "<?php echo $mobile_asset_url; ?>";
		var CDN_URL = "<?php echo cdn_url(); ?>";
		var APP = {
			<?php if(isset($current_user->gmt_offset)) { ?>
			gmt_offset : '<?php echo $current_user->gmt_offset;?>',
			gmt_options : <?php echo json_encode($gmt_options);?>
			<?php } ?>
		};
	</script>
</head>