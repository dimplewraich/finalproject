<!DOCTYPE html>
<html lang="en">
	
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
	
	<link href="<?php echo asset_url(); ?>css/style.opensans.css" rel="stylesheet" />
	<link href="<?php echo asset_url(); ?>css/style.default.css" rel="stylesheet" />

	<!--[if lt IE 9]>
	<script src="<?php echo asset_url(); ?>js/html5shiv.js"></script>
	<script src="<?php echo asset_url(); ?>js/respond.min.js"></script>
	<![endif]-->
</head>

<body class="notfound">

<section>
  
  <div class="notfoundpanel">
    <h1><?php echo $heading; ?>!</h1>
    <h3><?php echo $message; ?></h4>
  </div><!-- notfoundpanel -->
  
</section>
</body>
</html>