<!DOCTYPE html>
<html lang="en">
	
	<?php $this->load->view("web/{$default_theme}/partials/header");?>

<body>

<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<section>
<div class="mainpanel nomargin">
	
	<div class="pageheader">
      <h2><i class="fa fa-th-list mr5"></i> Tabs &amp; Accordions <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html">Bracket</a></li>
          <li><a href="buttons.html">UI Elements</a></li>
          <li class="active">Tabs &amp; Accordions</li>
        </ol>
      </div>
    </div>
	
	<div class="contentpanel">
		<?php $this->load->view("web/{$default_theme}/pages/{$page}"); ?>
	</div>
</div>
</section>
<?php $this->load->view("web/{$default_theme}/partials/footer"); ?>
</body>
</html>