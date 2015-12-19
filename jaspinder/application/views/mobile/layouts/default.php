<!DOCTYPE html>
<html lang="en">
	
	<?php $this->load->view("mobile/partials/header");?>

<body>
<div data-role="page" id="<?php echo isset($page_id) ? $page_id : 'main';?>" data-dom-cache="false" data-theme="a">
		<?php /* data-display="reveal|overlay|push" */ ?>
	<div data-role="panel" id="panel_sidebar">
		<?php $this->load->view("mobile/partials/sidebar"); ?>
	</div>
	
	<div data-role="header">
		<?php $this->load->view("mobile/partials/topnav");?>
	</div>
	
	<div class="ui-content" role="main">
		<?php $this->load->view("mobile/pages/{$page}");?>
	</div>
	
	<?php $this->load->view("mobile/partials/footer");?>
	
	<div data-role="popup" class="my_message_popup ui-corner-all" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="max-width:400px;">
		<div data-role="header" data-theme="b" class="ui-corner-top">
			<h1 class="ui-title"></h1>
		</div>
		<div data-role="content" data-theme="d" style="text-align:center;">
			<p></p>
			<a href="#" data-role="button" data-inline="true" data-rel="back" data-transition="flow" data-theme="b" data-mini="true">Close</a>
		</div>
	</div>
	
</div>

</body>
</html>