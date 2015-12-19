<?php defined('BASEPATH') OR exit('No direct script access allowed');

function theme_anchor_button($params){
	
	$ci = & get_instance();

	$view = is_mobile() ? "mobile/elements/anchor_button.php" : "web/{$ci->cfg->default_theme}/elements/anchor_button.php";
	
	return $ci->load->view($view,array('actions' => $params), TRUE);
}

function theme_button_groups($params){
	
	$ci = & get_instance();
	
	$view = is_mobile() ? "mobile/elements/button_groups.php" : "web/{$ci->cfg->default_theme}/elements/button_groups.php";
	
	return $ci->load->view($view,array('actions' => $params), TRUE);
}

function theme_button_dropdown($params, $additional_params = array()){
	
	$ci = & get_instance();
	
	if( !isset($additional_params['detail_icon'])) $additional_params['detail_icon'] = 'fa fa-eye';
	if( !isset($additional_params['detail_margin'])) $additional_params['detail_margin'] = '';
	if( !isset($additional_params['group_seperator'])) $additional_params['group_seperator'] = TRUE;
	
	$view = is_mobile() ? "mobile/elements/button_dropdown.php" : "web/{$ci->cfg->default_theme}/elements/button_dropdown.php";
	
	return $ci->load->view($view, array('actions' => $params, 'additional_params' => $additional_params), TRUE);
}

function theme_summary_resource_status($params){
	
	$ci = & get_instance();
	
	$view = is_mobile() ? "mobile/elements/resource_status.php" : "web/{$ci->cfg->default_theme}/elements/resource_status.php";
	
	return $ci->load->view($view,array('params' => $params), TRUE);
}

function theme_labels_badges($params){
	
	$ci = & get_instance();
	
	$view = is_mobile() ? "mobile/elements/labels_badges.php" : "web/{$ci->cfg->default_theme}/elements/labels_badges.php";
	
	return $ci->load->view($view,array('params' => $params), TRUE);
}

function theme_anchor_popover($params){
	
	$ci = & get_instance();
	
	$view = is_mobile() ? "mobile/elements/anchor_popover.php" : "web/{$ci->cfg->default_theme}/elements/anchor_popover.php";
	
	return $ci->load->view($view,array('params' => $params), TRUE);
}

function theme_anchor_location($params){
	
	$ci = & get_instance();
	
	$view = is_mobile() ? "mobile/elements/anchor_location.php" : "web/{$ci->cfg->default_theme}/elements/anchor_location.php";
	
	return $ci->load->view($view,array('params' => $params), TRUE);
}