<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('_local_time')) {
	function _local_time ($time, $timezone, $format = 'd/m/Y H:i') {
		
		$timestamp = !is_numeric($time) ? strtotime($time) : $time;
		//$timestamp = $timestamp - date("Z");
		
		$daylight_saving = (date("I") == 1) ? TRUE : FALSE;
		
		$formatted_date = date($format, gmt_to_local($timestamp, $timezone, $daylight_saving));
		
		$is_null = ($timestamp < 580881600) ? TRUE : FALSE;
		
		if ($is_null === TRUE) {
			return '<span class="label label-important">None set</span>';
		} else {
			return $formatted_date;
		}
	}
}

if ( ! function_exists('_to_gmt')) {
	function _to_gmt($time, $timezone, $format = 'Y-m-d H:i:s') {
		
		$dst = FALSE;
		$time = !is_numeric($time) ? strtotime(str_replace('/', '-', $time)) : $time;
		
		$daylight_saving = (date("I") == 1) ? TRUE : FALSE;

		$time -= timezones($timezone) * 3600;

		if ($daylight_saving == TRUE)
		{
		   $time -= 3600;
		}

		return date($format, $time);
	}
}

if ( ! function_exists('curr_timestamp')) {

	function curr_timestamp($format = 'Y-m-d H:i:s') {
		return date($format ,local_to_gmt()); /*date("Y-m-d H:i:s", now());*/
	}
}

if ( ! function_exists('local_time')) {
	function local_time ($time, $format = 'd/m/Y H:i') {	
		$CI =& get_instance();
		
		$timezone = $CI->current_user->gmt_offset;
		
		return _local_time($time, $timezone, $format);
	}
}

if ( ! function_exists('convert_to_gmt')) {
	function convert_to_gmt($time, $format = 'Y-m-d H:i:s') {	
		$CI =& get_instance();
		$timezone = $CI->current_user->gmt_offset;
		
		return _to_gmt($time, $timezone, $format);
	}
}

if ( ! function_exists('valid_date')) {
	function valid_date($time = '', $format = 'Y-m-d H:i:s') {	
		$CI =& get_instance();
		
		$dst = FALSE;
		$time = !is_numeric($time) ? strtotime(str_replace('/', '-', $time)) : $time;

		return date($format, $time);
	}
}

if ( ! function_exists('convert_to_local')) {
	function convert_to_local($time = '', $format = 'Y-m-d H:i:s') {	
		$CI =& get_instance();
		
		$time = !is_numeric($time) ? strtotime(str_replace('/', '-', $time)) : $time;
		$timezone = $CI->current_user->gmt_offset;
		$daylight_saving = (date("I") == 1) ? TRUE : FALSE;
		
		$time = gmt_to_local($time, $timezone, $daylight_saving);

		return date($format,$time);
	}
}

if ( ! function_exists('trigger_convert_to_local')) {
	function trigger_convert_to_local($time = '', $gmt_offset, $format = 'Y-m-d H:i:s') {	
		$CI =& get_instance();
		
		$time = !is_numeric($time) ? strtotime(str_replace('/', '-', $time)) : $time;
		$timezone = $gmt_offset;
		$daylight_saving = (date("I") == 1) ? TRUE : FALSE;
		
		$time = gmt_to_local($time, $timezone, $daylight_saving);

		return date($format,$time);
	}
}

if ( ! function_exists('date_time_format')) {
	function date_time_format($time, $format='d/m/Y H:i'){
	
		if( empty($time) ) return '';

		$timestamp = !is_numeric($time) ? strtotime($time) : $time;
		
		return date($format, $timestamp);
	}
}

if ( ! function_exists('time_since')) {
	function time_since($time, $now = FALSE, $date_format = 'M d, Y @ h:ia') {
		
		if ($now == FALSE) {
			$now = strtotime(date('Y-m-d H:i:s',now()));
		}

		if (!is_numeric($time)) {
			$time = strtotime($time);
		}
		
		// calculate $since
		$since = $now - $time;
		
		// greater than a day?
		if ($since > (60*60*24)) {
			// it's more than a day ago, let's just return the data
			$return = local_time($time, $date_format);
		}
		else {
			$chunks = array(
				array(60 * 60 , 'hour'),
				array(60 , 'minute'),
				array(1 , 'second')
			);
		
			for ($i = 0, $j = count($chunks); $i < $j; $i++) {
				$seconds = $chunks[$i][0];
				$name = $chunks[$i][1];
				if (($count = floor($since / $seconds)) != 0) {
					break;
				}
			}
		
			$return = ($count == 1) ? '1 '.$name : "$count {$name}s";
			$return .= ' ago';
		}
		
		return $return;
	}
}

if ( ! function_exists('month_first_day')) {
	function month_first_day($time) {

		$time = !is_numeric($time) ? strtotime(str_replace('/', '-', $time)) : $time;

		return date('Y-m-01', $time);
	}
}

if ( ! function_exists('month_last_day')) {
	function month_last_day($time) {

		$time = !is_numeric($time) ? strtotime(str_replace('/', '-', $time)) : $time;

		return date("Y-m-t", $time);
	}
}

if ( ! function_exists('year_first_day')) {
	function year_first_day($time) {

		$time = !is_numeric($time) ? strtotime(str_replace('/', '-', $time)) : $time;

		return date('Y-01-01', $time);
	}
}

if ( ! function_exists('year_last_day')) {
	function year_last_day($time) {

		$time = !is_numeric($time) ? strtotime(str_replace('/', '-', $time)) : $time;

		return date("Y-12-31", $time);
	}
}

if ( ! function_exists('date_diff_days')) {
	function date_diff_days($start_date, $end_date) {
	
		$start_date = new DateTime( date('Y-m-d', strtotime($start_date)) );
		$end_date = new DateTime( date('Y-m-d', strtotime($end_date)) );
	

		$interval = $start_date->diff($end_date);

		return validate_integer($interval->days) ? $interval->days : 0;
	}
}

if ( ! function_exists('_mysql_datetime_format')) {
	function _mysql_datetime_format($date, $default = NULL, $check_agent = TRUE) {
		$ci =& get_instance();
		
		if( $date == FALSE || empty($date) ) return $default;
		
		$_is_mobile = ( isset($ci->agent) && $ci->agent->is_mobile() ) ? TRUE : FALSE;
		$_is_ipad = ( isset($ci->agent) && $ci->agent->is_ipad() ) ? TRUE : FALSE;

		$format = 'd-m-Y H:i';
		$to_format = 'Y-m-d H:i';
		
		if($check_agent && $_is_mobile && !$_is_ipad){
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
		
		return ($d && $d->format($format) == $date) ? $d->format($to_format): $default;
	}
}

if ( ! function_exists('_mysql_date_format')) {
	function _mysql_date_format($date, $default = NULL, $check_agent = TRUE, $to_format = 'Y-m-d 00:00:00') {
		$ci =& get_instance();
		
		if( $date == FALSE || empty($date) ) return $default;
		
		$_is_mobile = ( isset($ci->agent) && $ci->agent->is_mobile() ) ? TRUE : FALSE;
		$_is_ipad = ( isset($ci->agent) && $ci->agent->is_ipad() ) ? TRUE : FALSE;

		$format = 'd-m-Y';
		
		if($check_agent && $_is_mobile && !$_is_ipad){
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
		
		return ($d && $d->format($format) == $date) ? $d->format($to_format): $default;
	}
}

if ( ! function_exists('_local_date_format')) {
	function _local_date_format($date, $default = '', $check_agent = TRUE, $to_format = 'd/m/Y') {
		$ci =& get_instance();
		
		if( $date == FALSE || empty($date) ) return $default;
		
		$_is_mobile = ( isset($ci->agent) && $ci->agent->is_mobile() ) ? TRUE : FALSE;
		$_is_ipad = ( isset($ci->agent) && $ci->agent->is_ipad() ) ? TRUE : FALSE;

		$format = 'Y-m-d';
		
		if($check_agent && $_is_mobile && !$_is_ipad){
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
		
		return ($d && $d->format($format) == $date) ? $d->format($to_format): $default;
	}
}

if ( ! function_exists('_date_lang_shorttag')) {
	
	function _date_lang_shorttag($timezone) {
		$ci =& get_instance();
		
		$ci->lang->load('date');
		$text = $ci->lang->line($timezone);
        $text = explode(')', $text);
		$text = explode('(', $text[0]);
		
        return ($timezone == 'UTC') ? $timezone : str_replace(array(':00'), array(''), $text[1]);
		
    }
	
	function _date_lang($timezone) {
		$ci =& get_instance();
		
		$ci->lang->load('date');
		
        return $ci->lang->line($timezone);
		
    }
}

if ( ! function_exists('_validate_date')) {
	
	function _validate_date($date, $format){
		$ci =& get_instance();
		
		$date = is_numeric($date) ? date($format , $date) : $date;
		
		$date = str_replace('/', '-', $date);
		$date = str_replace('T', ' ', $date);
		
		$version = explode('.', phpversion());
		
		if (((int) $version[0] >= 5 && (int) $version[1] >= 2 && (int) $version[2] > 17)) {
			$d = DateTime::createFromFormat($format, $date);
		} else {
			$d = new DateTime(date($format, strtotime($date)));
		}
	
		return ($d && $d->format($format) == $date) ? TRUE: FALSE;
	}
	
}