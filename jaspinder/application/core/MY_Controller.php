<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		
		load_cfg_settings();
		
		
	}
	
	protected function _post_args($key, $type = ARGS_TYPE_STRING, $default = '', $params = array()){
		
		$value = '';$post_default='';
		
		$key_exist = array_key_exists($key, $_POST);
		$override = array_key_exists('override', $params) ? $params['override'] : FALSE;
		$entities_to_ascii = array_key_exists('entities_to_ascii', $params) ? $params['entities_to_ascii'] : FALSE;
		$gtzero = array_key_exists('gtzero', $params) ? $params['gtzero'] : TRUE;

		switch($type){
			case ARGS_TYPE_STRING:
				
				$post_default = $override ? $default : '';
				$value = $key_exist ? ($this->input->post($key, TRUE) ? $this->input->post($key, TRUE) : $post_default) : $default;
				if($entities_to_ascii) $value= entities_to_ascii($value);
				break;
				
			case ARGS_TYPE_INT:
				
				$default = validate_integer($default) ? to_int($default) : 0;
				$post_default = $override ? $default : 0;
				$value = $key_exist ? ( (($value = $this->input->post($key)) && gtzero_integer($value)) ? to_int($value) : $post_default ) : $default;
				break;
				
			case ARGS_TYPE_TRUE_FALSE:
				
				$default = validate_integer($default) ? ( gtzero_integer($default) ? TRUE : FALSE ) : FALSE;
				$post_default = $override ? $default : FALSE;
				$value = $key_exist ? ( (($value = $this->input->post($key)) && (($gtzero && gtzero_integer($value)) || (!$gtzero && validate_integer($value))) ) ? TRUE : $post_default ) : $default;
				break;
				
			case ARGS_TYPE_ARRAY:
				
				$value = $key_exist ? ( (($value = $this->input->post($key)) && is_array($value)) ? $value : array() ) : ( is_array($default) ? $default : array());
				break;
				
			case ARGS_TYPE_DECIMAL:
				
				$default = gtzero_decimal($default) ? to_float($default) : 0;
				$post_default = $override ? $default : 0;
				$value = $key_exist ? ( (($value = $this->input->post($key)) && gtzero_decimal($value)) ? to_float($value) : $post_default ) : $default;
				break;
				
			case ARGS_TYPE_DATE:
			
				$default = validate_date($default) ? $default : '';
				$post_default = $override ? $default : '';
				$value = $key_exist ? ( (($value = $this->input->post($key)) && validate_date($value)) ? $value : $post_default ) : $default;
				break;
				
			case ARGS_TYPE_DATETIME:
			
				$default = validate_datetime($default) ? $default : '';
				$post_default = $override ? $default : '';
				$value = $key_exist ? ( (($value = $this->input->post($key)) && validate_date($value)) ? $value : $post_default ) : $default;
				break;
				
			default:
				$post_default = $override ? $default : '';
				$value = $key_exist ? ($this->input->post($key, TRUE) ? $this->input->post($key, TRUE) : $post_default) : $default;
				break;
		}
		
		unset($post_default);
		
		return $value;
		
	}
	
	protected function _output_request($params, $redirect_url = '', $ajax = FALSE){
	
		if($ajax){
			@header('Content-Type: application/json');
			echo json_encode($params);
			exit;
		}
	
		if ($this->input->is_ajax_request()) {
			
			@header('Content-Type: application/json');
			echo json_encode($params);
			exit;
		
		} else {

			set_flash_data($params['status'], $params['message']);
			redirect($redirect_url, 'refresh');
		}
	
	}
	
	protected function show_permission_denied_error($method = "echo", $redirect_url = ''){
		
		if ($this->input->is_ajax_request()) {
			
			$html = $this->template->raw_view('pages/permission_denied_modal', array(), TRUE);
			
			if ($method == "ajax") {
				
				$output = array(
					'message' 		=> $html
					,'status' 		=> ERROR_MESSAGE
					,'redirect_url'	=> $redirect_url
				);
				echo json_encode($output);
				
			} else {
				echo $html;
			}
		} else {
			
			echo $this->template->raw_view('pages/permission_denied', array(), TRUE);
			/*if(!empty($redirect_url)){
				redirect($redirect_url, 'refresh');
			}*/
		}
		die;
	}
}

function ci()
{
	return get_instance();
}

include(APPPATH.'core/Admin_Controller.php');
include(APPPATH.'core/Frontend_Controller.php');