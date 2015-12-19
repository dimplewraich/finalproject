<?php

foreach ($plugins as $plugin) {

	if ($plugin == 'prettify') {
		echo '<link href="' . $asset_url . 'plugins/misc/prettify/prettify.css" type="text/css" rel="stylesheet" /><!-- Code view plugin -->';
	} elseif ($plugin == 'fullcalendar') {
		echo '<link href="' . $asset_url . 'plugins/misc/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /><!-- Calendar plugin -->';
	} elseif ($plugin == 'tipuesearch') {
		echo '<link href="' . $asset_url . 'plugins/misc/search/tipuesearch.css" type="text/css" rel="stylesheet" />';
	} elseif ($plugin == 'toggle') {
		echo '<link href="' . $asset_url . 'plugins/forms/togglebutton/toggle-buttons.css" type="text/css" rel="stylesheet" />';
	} elseif ($plugin == 'colorpicker') {
		echo '<link href="' . $asset_url . 'plugins/forms/color-picker/color-picker.css" type="text/css" rel="stylesheet" />';
	} elseif ($plugin == 'gallery') {
		echo '<!-- Gallery plugins -->';
		echo '<link href="' . $asset_url . 'plugins/gallery/jpages/jPages.css" rel="stylesheet" type="text/css" />';
		echo '<link href="' . $asset_url . 'plugins/gallery/pretty-photo/prettyPhoto.css" type="text/css" rel="stylesheet" />';
	} elseif ($plugin == 'upload') {
		echo '<!-- upload plugins -->';
		echo '<link href="' . $asset_url . 'plugins/files/elfinder/elfinder.css" type="text/css" rel="stylesheet" />';
		echo '<link href="' . $asset_url . 'plugins/files/plupload/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" rel="stylesheet" />';
	} elseif ($plugin == 'ace') {
		echo '<!-- upload plugins -->';
		echo '<link href="' . $asset_url . 'plugins/ace/ace.min.css" type="text/css" rel="stylesheet" />';
		echo '<link href="' . $asset_url . 'plugins/ace/ace-rtl.min.css" type="text/css" rel="stylesheet" />';
		echo '<link href="' . $asset_url . 'plugins/ace/ace-skins.min.css" type="text/css" rel="stylesheet" />';
		echo '<!--[if lte IE 8]>
			  <link rel="stylesheet" href="' . $asset_url . 'plugins/ace/ace-ie.min.css" />
			<![endif]-->';
	} elseif ($plugin == 'leaflet') {
		echo '<!-- leaflet plugins -->';
		echo '<link href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" type="text/css" rel="stylesheet" />';
		echo '<!--[if lte IE 8]>
			  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.ie.css" />
			<![endif]-->';
		echo '<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>';
		echo '<script src="http://www.mapquestapi.com/sdk/leaflet/v1.0/mq-map.js?key=Fmjtd%7Cluur2q682h%2Caa%3Do5-9a2sl6"></script>';
	} elseif ($plugin == 'dropzone') {
		echo '<link href="' . $asset_url . 'plugins/dropzone/dropzone.css" rel="stylesheet" type="text/css" />';
		echo '<link href="' . $asset_url . 'plugins/dropzone/custom.css" rel="stylesheet" type="text/css" />';
		echo '<link href="' . $asset_url . 'plugins/files/plupload/jquery.ui.plupload/css/jquery.ui.plupload.css" rel="stylesheet" type="text/css" />';
	}
}
?>