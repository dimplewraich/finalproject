

	
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