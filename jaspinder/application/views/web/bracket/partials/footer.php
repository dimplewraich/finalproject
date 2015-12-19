<script src="<?php echo $asset_url; ?>js/jquery-1.11.1.min.js"></script>
<script src="<?php echo $asset_url; ?>js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo $asset_url; ?>js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo $asset_url; ?>js/bootstrap.js"></script>
<script src="<?php echo $asset_url; ?>js/modernizr.min.js"></script>
<script src="<?php echo $asset_url; ?>js/jquery.sparkline.min.js"></script>
<script src="<?php echo $asset_url; ?>js/toggles.min.js"></script>
<script src="<?php echo $asset_url; ?>js/retina.min.js"></script>
<script src="<?php echo $asset_url; ?>js/jquery.cookies.js"></script>
<script src="<?php echo $asset_url; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo $asset_url; ?>js/jquery.tagsinput.min.js"></script>
<script src="<?php echo $asset_url; ?>js/custom.js"></script>
<script src="<?php echo $asset_url; ?>js/ajaxfileupload.js"></script>
<script src="<?php echo $asset_url; ?>js/chosen.jquery.js"></script>

<?php
foreach ($plugins as $plugin) {

    if ($plugin == 'flot') {
        echo '<!-- Charts plugins -->';
		echo '<script src="' . $asset_url . 'plugins/charts/flot/flot.min.js"></script>';
		echo '<script src="' . $asset_url . 'plugins/charts/flot/flot.resize.min.js"></script>';
		echo '<script src="' . $asset_url . 'plugins/charts/flot/flot.symbol.min.js"></script>';
		echo '<script src="' . $asset_url . 'plugins/charts/flot/flot.crosshair.min.js"></script>';
		echo '<script src="' . $asset_url . 'plugins/charts/flot/flot.categories.min.js"></script>';
		echo '<script src="' . $asset_url . 'plugins/charts/flot/flot.pie.min.js"></script>';
		echo '<script src="' . $asset_url . 'plugins/charts/flot/flot.time.js"></script>';
		echo '<script src="' . $asset_url . 'plugins/charts/flot/flot.axislabels.js"></script>';
		echo '<script type="text/javascript" src="' . $asset_url . 'plugins/charts/flot/jquery.flot.tooltip_0.4.4.js"></script>';
    }
	
    if ($plugin == 'sparkline') {
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/charts/sparkline/jquery.sparkline.min.js"></script><!-- Sparkline plugin -->';
    }
	
    if ($plugin == 'prettify') {
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/misc/prettify/prettify.js"></script><!-- Code view plugin -->';
    }
	
    if ($plugin == 'fullcalendar') {
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/fullcalendar/fullcalendar.min.js"></script><!-- Calendar plugin -->';
    }
	
    if ($plugin == 'wizard') {
        echo '<script type="text/javascript" src="' . $asset_url . 'js/bootstrap-wizard.min.js"></script>';
    }
    if ($plugin == 'elastic') {
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/forms/elastic/jquery.elastic.js"></script>';
    }
	
    if ($plugin == 'tinymce') {
		echo '<script type="text/javascript" src="' . $asset_url . 'plugins/forms/tinymce/tinymce.min.js"></script>';
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/forms/tinymce/jquery.tinymce.min.js"></script>';
    }
	
    if ($plugin == 'timepicker') {
        echo '<script type="text/javascript" src="' . $asset_url . 'js/bootstrap-timepicker.min.js"></script>';
		echo '<script type="text/javascript" src="' . $asset_url . 'js/jquery-ui-timepicker-addon.js"></script>';
    }
	
    if ($plugin == 'gallery') {
        echo '<!-- Gallery plugins -->';
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/gallery/lazy-load/jquery.lazyload.min.js"></script>';
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/gallery/pretty-photo/jquery.prettyPhoto.js"></script>';
    }
	
    if ($plugin == 'upload') {
        echo '<!-- upload plugins -->';
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/files/elfinder/elfinder.min.js"></script>';
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/files/plupload/plupload.js"></script>';
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/files/plupload/plupload.html4.js"></script>';
        echo '<script type="text/javascript" src="' . $asset_url . 'plugins/files/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>';
    }
	
	if ($plugin == 'dropzone') {
		echo '<script type="text/javascript" src="' . $asset_url . 'plugins/dropzone/dropzone.min.js"></script>';
	}
	if ($plugin == 'datatables') {
		echo '<script type="text/javascript" src="' . $asset_url . 'js/jquery.datatables.min.js"></script>';
	}
}
?>

<script src="<?php echo $asset_url; ?>js/jquery.validate.min.js"></script>

<?php echo load_js('global.js'); ?>
	
<?php foreach ($scripts as $js_file) { ?>
<?php echo load_js($js_file);?>
<?php } ?>
<?php $this->load->view("web/{$default_theme}/partials/notify"); ?>