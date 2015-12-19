<!DOCTYPE html>
<html lang="en">
	
	<?php $this->load->view("web/{$default_theme}/partials/header");?>

<body>
<?php /*<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>*/ ?>
<section>
	<div class="leftpanel">
		<?php $this->load->view("web/{$default_theme}/partials/sidebar"); ?>
	</div>
	<div class="mainpanel">
		
		<div class="headerbar">
			<?php $this->load->view("web/{$default_theme}/partials/topnav");?>
		</div>
		
		<div class="pageheader">
			<h2><i class="fa fa-home"></i> Home <span><?php echo $title;?></span></h2>
			<?php $this->load->view("web/{$default_theme}/partials/search_and_crumbs"); ?>
		</div>
		
		<div class="contentpanel">
			<?php $this->load->view("web/{$default_theme}/pages/{$page}"); ?>
		</div>
		
	</div>

</section>

<?php $this->load->view("web/{$default_theme}/partials/footer"); ?>
</body>
</html>