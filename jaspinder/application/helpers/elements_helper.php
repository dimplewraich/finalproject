<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('popup_atts')) {

	function popup_atts() {
		return array(
            'width' => '1000',
            'height' => '600',
            'scrollbars' => 'yes',
            'status' => 'no',
            'resizable' => 'yes',
            'screenx' => '300',
            'screeny' => '100'
        );
	}
}

function theme_anchor_button($params){
	
	$ci = & get_instance();
	
	$view = "web/elements/anchor_button.php";
	
	return $ci->load->view($view,array('actions' => $params), TRUE);
}

if ( ! function_exists('theme_button_groups')) {

	function theme_button_groups($params){
		$ci = & get_instance();
		
		$view = "web/elements/button_groups.php";
		
		return $ci->load->view($view,array('actions' => $params), TRUE);
	}
}

if ( ! function_exists('theme_button_dropdown')) {

	function theme_button_dropdown($params){
	
		$ci = & get_instance();
		
		$view = "web/elements/button_dropdown.php";
		
		return $ci->load->view($view,array('actions' => $params), TRUE);
	}
}

if ( ! function_exists('theme_summary_resource_status')) {

	function theme_summary_resource_status($params){
	
		$ci = & get_instance();
		
		$view = "web/elements/resource_status.php";
		
		return $ci->load->view($view,array('params' => $params), TRUE);
	}
}

if ( ! function_exists('theme_labels_badges')) {

	function theme_labels_badges($params){
	
		$ci = & get_instance();
		
		$view = "web/elements/labels_badges.php";
		
		return $ci->load->view($view,array('params' => $params), TRUE);
	}
}

if ( ! function_exists('theme_anchor_popover')) {

	function theme_anchor_popover($params){
	
		$ci = & get_instance();
		
		$view = "web/elements/anchor_popover.php";
		
		return $ci->load->view($view,array('params' => $params), TRUE);
	}
}

if ( ! function_exists('theme_anchor_location')) {

	function theme_anchor_location($params){
	
		$ci = & get_instance();
		
		$view = "web/elements/anchor_location.php";
		
		return $ci->load->view($view,array('params' => $params), TRUE);
	}
}
