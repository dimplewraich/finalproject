<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cdn_url')) {

	function cdn_url() {
		$ci = & get_instance();
		
		return $ci->config->item('cdn_url');
	}
}

if ( ! function_exists('load_cfg_settings')) {

	function load_cfg_settings() {
		$ci = & get_instance();
		
		$ci->load->model('setting_model','setting_m');
		
		$cfg = $ci->setting_m->core_settings();
		
		$ci->template->cfg = ci()->cfg = $cfg;
		
		$default_theme = FALSE;
		
		switch($ci->cp_theme_type){
			
			case 'cp_theme':
				$default_theme = $cfg->cp_theme;
				break;
			case 'frontend_theme':
				$default_theme = $cfg->frontend_theme;
				break;
			default:
				break;
			
		}
		
		$cfg->{'default_theme'} = $default_theme;
		
		$ci->config->load('theme_'.$cfg->default_theme, FALSE);
		$ci->load->helper('theme_'.$cfg->default_theme, FALSE);
		
		/*
		$_is_tablet = ( isset($ci->agent) && $ci->agent->is_tablet() ) ? TRUE : FALSE;
		$_is_mobile = ( isset($ci->agent) && $ci->agent->is_mobile() && !$_is_tablet ) ? TRUE : FALSE;
		
		if( (ENVIRONMENT=='development' || ENVIRONMENT=='testing') && $_is_mobile == FALSE) {
			if(!$ci->input->is_ajax_request()) $ci->output->enable_profiler(TRUE);
		}
		*/
		
	}
}

if ( ! function_exists('body_font_color')) {

	function body_font_color(){
		$ci = & get_instance();
		$ci->load->model('company_model', 'company_m');
		
		if( !isset($ci->current_user->company_id)) return '';
		
		$company_setting = $ci->company_m->company_settings($ci->current_user->company_id);
		
		if( !empty($company_setting->body_font_color)){
			echo '<style type="text/css">body{color:'.$company_setting->body_font_color.'!important;}</style>';
		}
		
		return '' ;
	}
}

if ( ! function_exists('random_string')) {
	function random_string($prefix) {
	
		$character_set_array = array();
		$character_set_array[] = array('count' => 4, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		$character_set_array[] = array('count' => 3, 'characters' => '0123456789');
		$temp_array = array();
		
		foreach ($character_set_array as $character_set) {
			for ($i = 0; $i < $character_set['count']; $i++) {
				$temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
			}
		}
		
		shuffle($temp_array);
		
		return $prefix.'-'.implode('', $temp_array);
	}
}

if ( ! function_exists('generate_primary_key')) {

	function generate_primary_key($prefix, $length = 6) {
		
		$character_set_array = array();
		$character_set_array[] = array('count' => 4, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		$character_set_array[] = array('count' => 3, 'characters' => '0123456789');
		$temp_array = array();
		
		foreach ($character_set_array as $character_set) {
			for ($i = 0; $i < $character_set['count']; $i++) {
				$temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
			}
		}
		
		shuffle($temp_array);
		
		return $prefix.'-'.implode('', $temp_array);
		
	}
}

if ( ! function_exists('reference_version')) {

	function reference_version($reference_number) {
		
		$reference_number = explode('-',$reference_number);
		
		$reference_number[2] = isset($reference_number[2]) ? (((INT)$reference_number[2]) + 1) : 1;
		
		return implode('-',$reference_number);
		
	}
}

if ( ! function_exists('keygen')) {

	function keygen($val = 40) {
		
		return md5(microtime().rand());
	}
}

if ( ! function_exists('get_flash_message')) {

	function get_flash_message() {
		$ci = & get_instance();
		
		$message = $ci->session->flashdata('message');
		
		if(!$message && isset($ci->message)){
			$message = $ci->message;
		}
		
		return $message;
	}
}

if ( ! function_exists('set_flash_data')) {

	function set_flash_data($msg_type, $msg, $addtosession = TRUE) {
		$ci = & get_instance();
		
		if($addtosession){
			$ci->session->set_flashdata('message', array('msg_type' => $msg_type, 'msg' => $msg));
		} else {
			$ci->message = array('msg_type' => $msg_type, 'msg' => $msg);
		}
		
	}
}

if ( ! function_exists('_get_csrf_nonce')) {

	function _get_csrf_nonce() {
		$ci = & get_instance();
		$ci->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$ci->session->set_flashdata('csrfkey', $key);
		$ci->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}
}

if ( ! function_exists('_valid_csrf_nonce')) {

	function _valid_csrf_nonce() {
		$ci = & get_instance();
		if ($ci->input->post($ci->session->flashdata('csrfkey')) !== FALSE &&
				$ci->input->post($ci->session->flashdata('csrfkey')) == $ci->session->flashdata('csrfvalue')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

if ( ! function_exists('asset_url')) {

	function asset_url($js_file = NULL, $tag = true) {
		
		return base_url().'assets/';
	}
}

if ( ! function_exists('load_js')) {

	function load_js($js_file = NULL, $tag = true) {
		$ci = & get_instance();
		
		$version = '?v'.local_to_gmt();
		$_is_mobile = ( isset($ci->agent) && $ci->agent->is_mobile() ) ? TRUE : FALSE;
		$_is_ipad = ( isset($ci->agent) && $ci->agent->is_ipad() ) ? TRUE : FALSE;
		$_is_tablet = ( isset($ci->agent) && $ci->agent->is_tablet() ) ? TRUE : FALSE;
		
		if(is_null($js_file) || empty($js_file)) return;
		
		$default_theme = $ci->cfg->default_theme;
		
		if ( $_is_mobile  && !$_is_ipad ) {
			
			if (file_exists("./assets/mobile/scripts/{$js_file}")){
				$data = file_get_contents(cdn_url() ."assets/mobile/scripts/{$js_file}");
			
				return '<script type="text/javascript">'.$data.'</script>';
			}
			
		} elseif ($js_file != NULL) {
			
			if (file_exists("./assets/{$default_theme}/scripts/{$js_file}")){
			
				if($tag) {
					return "<script type=\"text/javascript\" src=\"" . cdn_url() ."assets/{$default_theme}/scripts/{$js_file}{$version}\"></script>";
				} else {
			
					$data = file_get_contents(cdn_url() ."assets/{$default_theme}/scripts/{$js_file}{$version}");
			
					return '<script type="text/javascript">'.$data.'</script>';
				}
			} elseif (file_exists("./assets/scripts/" . $js_file)){
			
				if($tag) {
					return '<script type="text/javascript" src="' . cdn_url() . "assets/scripts/" . $js_file. $version . '"></script>';
				} else {
			
					$data = file_get_contents(cdn_url() . "assets/scripts/" . $js_file.$version);
			
					return '<script type="text/javascript">'.$data.'</script>';
				}
			}
		}
	}
}

if ( ! function_exists('load_css')) {

	function load_css($css_file = NULL, $tag = true) {
		$ci = & get_instance();
		
		$_is_mobile = ( isset($ci->agent) && $ci->agent->is_mobile() ) ? TRUE : FALSE;
		$_is_ipad = ( isset($ci->agent) && $ci->agent->is_ipad() ) ? TRUE : FALSE;
		$_is_tablet = ( isset($ci->agent) && $ci->agent->is_tablet() ) ? TRUE : FALSE;
		
		if(is_null($css_file) || empty($css_file)) return;
		
		if ( $_is_mobile  && !$_is_tablet ) {
			
			if (file_exists("./assets/mobile/css/{$css_file}")){
				
				if($tag) {
					return "<link type=\"text/css\" rel=\"stylesheet\" href=\"" . cdn_url() ."assets/mobile/css/{$css_file}\" />";
				} else {
					$data = file_get_contents(base_url() ."assets/mobile/css/{$css_file}");
					return '<style type=\"text/css\">'.$data.'</style>';
				}
			}
			
		} else {
		
			if ($_is_tablet && file_exists("./assets/{$default_theme}/css/t/{$css_file}")){
			
				if($tag) {
					return "<link type=\"text/css\" rel=\"stylesheet\" href=\"" . cdn_url() ."assets/{$default_theme}/css/t/{$css_file}\" />";
				} else {
			
					$data = file_get_contents(cdn_url() ."assets/{$default_theme}/css/t/{$css_file}");
			
					return '<style type=\"text/css\">'.$data.'</style>';
				}
			
			} elseif (file_exists("./assets/{$default_theme}/css/{$css_file}")){
			
				if($tag) {
					return "<link type=\"text/css\" rel=\"stylesheet\" href=\"" . cdn_url() ."assets/{$default_theme}/css/{$css_file}\" />";
				} else {
			
					$data = file_get_contents(cdn_url() ."assets/{$default_theme}/css/{$css_file}");
			
					return '<style type=\"text/css\">'.$data.'</style>';
				}
			}
		}
	}
}

if ( ! function_exists('_get_user_group')) {

	function _get_user_group($user_id = 0, $return = FALSE) {
		$ci = & get_instance();
		$ci->load->model('user_model', 'user_m');
		
		$group_id = 0;
		if(gtzero_integer($user_id)){

			$group_id = $ci->user_m->get_user_group($user_id);
			
		} else {
		
			$user_id = $ci->current_user->user_id;
			$group_id = $ci->current_user->group_id;
		}
		
		return array(
			"user_id" 	=> $user_id
			,'group_id' => $group_id
		);
	}
}

if ( ! function_exists('_check_company_user_access')) {

	function _check_company_user_access() {
		$ci = & get_instance();
		
		$groups = array(
			GROUP_MANAGEMENT_COMPANY
		);
		
		$company_id = (in_array($ci->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER))) ? 0 : $ci->current_user->company_id;
		
		if( gtzero_integer($company_id) && in_array( to_int($ci->current_user->group_id), $groups, TRUE) ){
			return TRUE;
		}
		
		return FALSE;
	}
}

if ( ! function_exists('_has_company_group_access')) {

	function _has_company_group_access($group_id) {
		$ci = & get_instance();
		
		$groups = array(
			GROUP_MANAGEMENT_COMPANY
		);
		
		
		
		if( in_array( $group_id, $groups, TRUE) ){
			return TRUE;
		}
		
		return FALSE;
	}
//}

//if ( ! function_exists('_has_company_resources')) {
	function _has_company_resources($group_id) {
		$ci = & get_instance();
		
		$groups = array(
			GROUP_MANAGEMENT_COMPANY
		);
		
		if( in_array( $group_id, $groups, TRUE) ){
			return TRUE;
		}
		
		return FALSE;
	}
//}

//if ( ! function_exists('_has_company_non_resources')) {

	function _has_company_non_resources($group_id) {
		$ci = & get_instance();
		
		$groups = array();
		
		if( in_array( $group_id, $groups, TRUE) ){
			return TRUE;
		}
		
		return FALSE;
	}
}

if ( ! function_exists('_has_user_access_permission')) {

	function _has_user_access_permission($show_error = TRUE, $group = null, $method = 'echo') {
		$ci = & get_instance();
		
		if (!empty($group)) {
			
			if ($ci->ion_auth->in_group($group)) {
				return TRUE;
			}
			
			if ($show_error) {
				
				if ($ci->input->is_ajax_request()) {
					
					echo '<div class="well" style="margin:0;">Sorry, Your privileges dont allow you to view this page</div>';
					
				} else {
				
					show_error('Sorry, Your privileges dont allow you to view this page', 500, "Permission Denied");
				}
				exit;
			}
			return FALSE;
		}

		return TRUE;
		
	}
}

if ( ! function_exists('get_sidebar_menu')) {

	function get_sidebar_menu() {
		$ci = & get_instance();

		$sidebar = array();
		
		if (_has_user_access_permission($show_error = FALSE, array('admin'))) {
			$sidebar['companies'] = array(
				'name' => 'Agencies',
				'link' => site_url('agencies'),
				'class' => ICON_COMPANIES,
				'mobile' => true,
				'subitems' => array(),
				'mobile_params' => ' data-ajax="false"'
			);
		}
		
		if (_has_user_access_permission($show_error = FALSE, array('admin'))) {
			$sidebar['users'] = array(
				'name' => 'Users',
				'link' => site_url('users'),
				'class' => ICON_USER,
				'mobile' => true,
				'subitems' => array(),
				'mobile_params' => ' data-ajax="false"'
			);
		}
		
		if (_has_user_access_permission($show_error = FALSE, array('admin', 'staff', 'management_company'))) {
			$sidebar['sites'] = array(
				'name' => 'Sites',
				'link' => site_url('sites'),
				'class' => ICON_SITE,
				'mobile' => true,
				'subitems' => array(),
				'mobile_params' => ' data-ajax="false"'
			);
		}
		
		if (_has_user_access_permission($show_error = FALSE, array('admin', 'staff', 'management_company'))) {
			
			$sidebar['Feedback'] = array(
				'name' => 'Feedback',
				'link' => site_url('sites/survey'),
				'class' => ICON_SITE,
				'mobile' => true,
				'subitems' => array(),
				'mobile_params' => ' data-ajax="false"',
				'website'	=> FALSE
			);
		}
		
		if (_has_user_access_permission($show_error = FALSE, array('admin'))) {
			
			$sidebar['SiteForms'] = array(
				'name' => 'Site Forms',
				'link' => site_url('survey'),
				'class' => ICON_QUESTION,
				'mobile' => FALSE,
				'subitems' => array(
					/*array(
						'name' => 'Questions',
						'link' => site_url('questions'),
						'class' => ICON_QUESTION,
						'mobile' => TRUE,
						'mobile_params' => ' data-ajax="false"'
					),
					array(
						'name' => 'Site Forms',
						'link' => site_url('sforms'),
						'class' => ICON_FORM,
						'mobile' => FALSE
					),
					array(
						'name' => 'Sections',
						'link' => site_url('formsections'),
						'class' => ICON_SECTION,
						'mobile' => FALSE
					)*/
				)
				
			);
			
		}
		
		
		return $sidebar;
	}
}

if ( ! function_exists('serialize_object')) {

	function serialize_object($params = array()) {
	
		$ci = & get_instance();
		$ci->load->library('encrypt');
		
		$input = array();
		foreach($params AS $key=>$value){
			$input[] = "{$key}={$value}";
		}
		$input[] = "pk=".generate_primary_key('pk');
		$input = implode('/',$input);

		return $ci->encrypt->encode($input);
		
		/*$ascii = (serialize($params));
	
		$hex = '';
		for($i = 0; $i < strlen($ascii); $i++) {
			$hex .= str_pad(base_convert(ord($ascii[$i]), 10, 16), 2, '0', STR_PAD_LEFT);
		}

		return $hex;*/
	}
}

if ( ! function_exists('unserialize_object')) {

	function unserialize_object($key) {
	
		$ci = & get_instance();
		$ci->load->library('encrypt');
		
		$input = $ci->encrypt->decode($key);
		
		$input = explode('/', $input);
		
		$params = array();
		$temp = '';
		if(is_array($input) && count($input) > 0){
			foreach($input AS $value){
				$temp = explode('=', $value);
				
				if(is_array($temp) && count($temp) == 2){
					$params[$temp[0]] = $temp[1];
				}
			}
		}
		unset($temp);
		unset($input);
		return $params;
		
		/*$ascii = '';
   
		if (strlen($key) % 2 == 1) {
			$key = '0'.$key;
		}
   
		for($i = 0; $i < strlen($key); $i += 2) {
			$ascii .= chr(base_convert(substr($key, $i, 2), 16, 10));
		}
		
		$return = FALSE;
		
		try {
	
			$return = @unserialize(($ascii));
		} catch (Exception $e) {
			$return = FALSE;
		}
		
		return $return;*/
	}
}

if ( ! function_exists('validate_integer')) {

	function validate_integer($input, $gtzero = FALSE){
	
		$input = to_string($input);
		$minus = strrpos($input, '-');
		$multiplier = ($minus !== FALSE && to_int($minus) == 0) ? -1 : 1;
		$input = str_replace(array('-'),array(''), $input);
	
		$return = (preg_match('/^\d+$/',$input)) ? TRUE : FALSE;
		
		if($gtzero && $return){
			if( (((INT)$input)*$multiplier) > 0 ){
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return $return;
		}
	}
}

if ( ! function_exists('gtzero_integer')) {

	function gtzero_integer($value){

		return validate_integer($value, TRUE);
	}
}

if ( ! function_exists('gtzero_decimal')) {

	function gtzero_decimal($value){
		
		return ( ($value = to_float($value)) && $value > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('round2decimal')) {
	
	function round2decimal($value){

		$value = ((INT)($value * 100))/100;

		return number_format($value, 2,'.','');
	}
}

if ( ! function_exists('vat')) {

	function vat($total, $vatPercent){
		
		return ($vatPercent>0) ? ($total * ($vatPercent / 100)) : 0;
	}
}

if ( ! function_exists('to_float')) {
	function to_float($input) {

		if(is_null($input) || empty($input)) return 0;
	
		$input = preg_replace("/[^-0-9\.]/", "", $input);

		$input = str_replace(array(','),array(''), $input);
		
		$minus = strrpos($input, '-');
		$multiplier = ($minus !== FALSE && to_int($minus) == 0) ? -1 : 1;

		$dotPos = strrpos($input, '.');
		$sep = ($dotPos === FALSE) ? FALSE : (INT)$dotPos;
	  
		if (($dotPos === FALSE)) {
			$floatvalue = floatval(preg_replace("/[^0-9]/", "", $input));
			return $floatvalue*$multiplier;
		}

		$floatvalue = floatval(preg_replace("/[^0-9]/", "", substr($input, 0, $sep)) . '.' .preg_replace("/[^0-9]/", "", substr($input, $sep+1, strlen($input))) );
		
		return $floatvalue * $multiplier;
	}
}

if ( ! function_exists('to_int')) {
	function to_int($input) {
		
		if( validate_integer($input) === FALSE ) return 0;
		
		$input = to_string($input);
		$minus = strrpos($input, '-');
		$multiplier = ($minus !== FALSE && to_int($minus) == 0) ? -1 : 1;
		$input = str_replace(array('-'),array(''), $input);
		
		return ((INT)$input)*$multiplier;
	}
}

if ( ! function_exists('to_string')) {
	function to_string($input) {
		
		return (STRING)$input;
	}
}

if ( ! function_exists('validate_datetime')) {
	
	function validate_datetime($date){
		$ci = & get_instance();
	
		if( empty($date) ) return TRUE;
		
		$_is_mobile = ( isset($ci->agent) && $ci->agent->is_mobile() ) ? TRUE : FALSE;
		$_is_ipad = ( isset($ci->agent) && $ci->agent->is_ipad() ) ? TRUE : FALSE;
		
		$format = 'd-m-Y H:i';
		
		if($_is_mobile && !$_is_ipad){
			$format = 'Y-m-d H:i';
		}

		$date = str_replace('/', '-', $date);
		$date = str_replace('T', ' ', $date);
		
		$version = explode('.', phpversion());
		if (((int) $version[0] >= 5 && (int) $version[1] >= 2 && (int) $version[2] > 17)) {
			$d = DateTime::createFromFormat($format, $date);
		} else {
			$d = new DateTime(date($format, strtotime($date)));
		}
	
		$flag = ($d && $d->format($format) == $date) ? TRUE: FALSE;
		
		if (!$flag){
			return FALSE;
		}
		
		return TRUE;
	}
}

if ( ! function_exists('validate_date')) {
	
	function validate_date($date){
		$ci = & get_instance();
	
		if( empty($date) ) return TRUE;
		
		$_is_mobile = ( isset($ci->agent) && $ci->agent->is_mobile() ) ? TRUE : FALSE;
		$_is_ipad = ( isset($ci->agent) && $ci->agent->is_ipad() ) ? TRUE : FALSE;
		
		$format = 'd-m-Y';
		
		if($_is_mobile && !$_is_ipad){
			$format = 'Y-m-d';
		}

		$date = str_replace('/', '-', $date);
		$date = str_replace('T', ' ', $date);
		
		$version = explode('.', phpversion());
		if (((int) $version[0] >= 5 && (int) $version[1] >= 2 && (int) $version[2] > 17)) {
			$d = DateTime::createFromFormat($format, $date);
		} else {
			$d = new DateTime(date($format, strtotime($date)));
		}
	
		$flag = ($d && $d->format($format) == $date) ? TRUE: FALSE;
		
		if (!$flag){
			return FALSE;
		}
		
		return TRUE;
	}
}

if ( ! function_exists('is_serialized')) {
	function is_serialized($value, &$result = null) {
	
		// Bit of a give away this one
		if (!is_string($value))
		{
			return false;
		}

		// Serialized false, return true. unserialize() returns false on an
		// invalid string or it could return false if the string is serialized
		// false, eliminate that possibility.
		if ($value === 'b:0;')
		{
			$result = false;
			return true;
		}

		$length	= strlen($value);
		$end	= '';

		switch ($value[0])
		{
			case 's':
				if ($value[$length - 2] !== '"')
				{
					return false;
				}
			case 'b':
			case 'i':
			case 'd':
				// This looks odd but it is quicker than isset()ing
				$end .= ';';
			case 'a':
			case 'O':
				$end .= '}';

				if ($value[1] !== ':')
				{
					return false;
				}

				switch ($value[2])
				{
					case 0:
					case 1:
					case 2:
					case 3:
					case 4:
					case 5:
					case 6:
					case 7:
					case 8:
					case 9:
					break;

					default:
						return false;
				}
			case 'N':
				$end .= ';';

				if ($value[$length - 1] !== $end[0])
				{
					return false;
				}
			break;

			default:
				return false;
		}

		if (($result = @unserialize($value)) === false)
		{
			$result = null;
			return false;
		}
		return true;
	}
}

if ( ! function_exists('is_tablet')) {
	
	function is_tablet(){
		$ci = & get_instance();

		return ( isset($ci->agent) && $ci->agent->is_tablet() ) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_mobile')) {
	
	function is_mobile(){
		$ci = & get_instance();

		return ( isset($ci->agent) && $ci->agent->is_mobile() && !$ci->agent->is_tablet() ) ? TRUE : FALSE;
	}
}

if ( ! function_exists('_get_cache')) {
	function _get_cache($key, $key_prefix, $cache_drivers = CACHE_DRIVER_FILE) {
		$ci = & get_instance();
		
		$ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$ci->cache->key_prefix = $key_prefix;
		
		if($cache_drivers == CACHE_DRIVER_APC){
			
			if( !$ci->cache->apc->is_supported()) return FALSE;
			
			return $ci->cache->apc->get($key_prefix.$key);
			
		} elseif($cache_drivers == CACHE_DRIVER_FILE){
		
			if( !$ci->cache->file->is_supported()) return FALSE;
			
			return $ci->cache->file->get($key_prefix.$key);
		
		} elseif($cache_drivers == CACHE_DRIVER_MEMCACHED){
		
			if( !$ci->cache->memcached->is_supported()) return FALSE;
			
			return $ci->cache->memcached->get($key_prefix.$key);
		
		} elseif($cache_drivers == CACHE_DRIVER_REDIS){
		
			if( !$ci->cache->redis->is_supported()) return FALSE;
			
			return $ci->cache->redis->get($key_prefix.$key);
			
		} elseif($cache_drivers == CACHE_DRIVER_WINCACHE){
			
			if( !$ci->cache->wincache->is_supported()) return FALSE;
			
			return $ci->cache->wincache->get($key_prefix.$key);
			
		} else {
			
			return $ci->cache->get($key);
		
		}
	}
}

if ( ! function_exists('_set_cache')) {
	function _set_cache($key, $data, $key_prefix, $cache_drivers = CACHE_DRIVER_FILE, $time_to_live = ONE_DAY) {
		$ci = & get_instance();
		
		$ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$ci->cache->key_prefix = $key_prefix;
		
		if($cache_drivers == CACHE_DRIVER_APC){
			
			if( !$ci->cache->apc->is_supported()) return FALSE;
			
			$ci->cache->apc->save($key_prefix.$key, $data, $time_to_live);
			
		} elseif($cache_drivers == CACHE_DRIVER_FILE){
		
			if( !$ci->cache->file->is_supported()) return FALSE;
			
			$ci->cache->file->save($key_prefix.$key, $data, $time_to_live);
		
		} elseif($cache_drivers == CACHE_DRIVER_MEMCACHED){
		
			if( !$ci->cache->memcached->is_supported()) return FALSE;
			
			$ci->cache->memcached->save($key_prefix.$key, $data, $time_to_live);
		
		} elseif($cache_drivers == CACHE_DRIVER_REDIS){
		
			if( !$ci->cache->redis->is_supported()) return FALSE;
			
			$ci->cache->redis->save($key_prefix.$key, $data, $time_to_live);
			
		} elseif($cache_drivers == CACHE_DRIVER_WINCACHE){
			
			if( !$ci->cache->wincache->is_supported()) return FALSE;
			
			$ci->cache->wincache->save($key_prefix.$key, $data, $time_to_live);
			
		} else {
		
			return $ci->cache->save($key, $data, $time_to_live);
		}
		
	}
}

if ( ! function_exists('_delete_cache')) {
	function _delete_cache($key, $key_prefix, $cache_drivers = CACHE_DRIVER_FILE) {
		$ci = & get_instance();
		
		$ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$ci->cache->key_prefix = $key_prefix;
		
		if($cache_drivers == CACHE_DRIVER_APC){
			
			if( !$ci->cache->apc->is_supported()) return FALSE;
			
			$ci->cache->apc->delete($key_prefix.$key);
			
		} elseif($cache_drivers == CACHE_DRIVER_FILE){
		
			if( !$ci->cache->file->is_supported()) return FALSE;
			
			$ci->cache->file->delete($key_prefix.$key);
		
		} elseif($cache_drivers == CACHE_DRIVER_MEMCACHED){
		
			if( !$ci->cache->memcached->is_supported()) return FALSE;
			
			$ci->cache->memcached->delete($key_prefix.$key);
		
		} elseif($cache_drivers == CACHE_DRIVER_REDIS){
		
			if( !$ci->cache->redis->is_supported()) return FALSE;
			
			$ci->cache->redis->delete($key_prefix.$key);
			
		} elseif($cache_drivers == CACHE_DRIVER_WINCACHE){
			
			if( !$ci->cache->wincache->is_supported()) return FALSE;
			
			$ci->cache->wincache->delete($key_prefix.$key);
			
		} else {
			
			return $ci->cache->delete($key);
			
		}
	}
}

if ( ! function_exists('_clean_cache')) {
	function _clean_cache($cache_drivers = CACHE_DRIVER_FILE) {
		$ci = & get_instance();
		
		$ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		
		if($cache_drivers == CACHE_DRIVER_APC){
			
			if( !$ci->cache->apc->is_supported()) return FALSE;
			
			$ci->cache->apc->clean();
			
		} elseif($cache_drivers == CACHE_DRIVER_FILE){
		
			if( !$ci->cache->file->is_supported()) return FALSE;
			
			$ci->cache->file->clean();
		
		} elseif($cache_drivers == CACHE_DRIVER_MEMCACHED){
		
			if( !$ci->cache->memcached->is_supported()) return FALSE;
			
			$ci->cache->memcached->clean();
		
		} elseif($cache_drivers == CACHE_DRIVER_REDIS){
		
			if( !$ci->cache->redis->is_supported()) return FALSE;
			
			$ci->cache->redis->clean();
			
		} elseif($cache_drivers == CACHE_DRIVER_WINCACHE){
			
			if( !$ci->cache->wincache->is_supported()) return FALSE;
			
			$ci->cache->wincache->clean();
			
		} else {
			
			return $ci->cache->clean();
			
		}
	}
}

if ( ! function_exists('_get_csrf_nonce')) {

	function _get_csrf_nonce() {
		$ci = & get_instance();
		$ci->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$ci->session->set_flashdata('csrfkey', $key);
		$ci->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}
}

if ( ! function_exists('_valid_csrf_nonce')) {

	function _valid_csrf_nonce() {
		$ci = & get_instance();
		if ($ci->input->post($ci->session->flashdata('csrfkey')) !== FALSE &&
				$ci->input->post($ci->session->flashdata('csrfkey')) == $ci->session->flashdata('csrfvalue')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}