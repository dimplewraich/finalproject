<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template {

    protected $ci;
	
	protected $_data = array();
	protected $_layout = 'default';
	protected $default_theme = 'default';

    public function __construct() {
        $this->ci = & get_instance();
		
		$this->_is_tablet = ( isset($this->ci->agent) && $this->ci->agent->is_tablet() ) ? TRUE : FALSE;
		$this->_is_mobile = ( isset($this->ci->agent) && $this->ci->agent->is_mobile() && !$this->_is_tablet ) ? TRUE : FALSE;
		$this->_data['agent'] = $this->ci->agent->agent_string();
		
		$this->_data['plugins'] = array();
		$this->_data['scripts'] = array();
		$this->_data['styles'] 	= array();
		$this->_data['page_id'] = now();
		
		$this->_data['_is_mobile'] 	= $this->_is_mobile;
		$this->_data['_is_tablet'] 	= $this->_is_tablet;
    }
	
	public function __get($name){
		return isset($this->_data[$name]) ? $this->_data[$name] : null;
	}
	
	public function __set($name, $value) {
		$this->_data[$name] = $value;
	}

    public function load($layout = '', $data = array()) {

		is_array($data) OR $data = (array) $data;
		
		$this->_data = array_merge($this->_data, $data);

		$this->_layout = !empty($layout) ? $layout : $this->_layout;
		
		if($layout == 'survey_builder'){
			$this->_data['default_theme'] = $this->_default_theme = 'ace';
		} elseif(isset($this->ci->cfg->default_theme)){
			$this->_data['default_theme'] = $this->_default_theme = $this->ci->cfg->default_theme;
		}
		
		$this->_data['asset_url'] = cdn_url().'assets/'.$this->_default_theme.'/';
		$this->_data['mobile_asset_url'] = cdn_url().'assets/mobile/';
		$this->_data['cdn_url'] = cdn_url().'/';
		
		$this->_data['notification'] = array(
											'message_count'	=> 0
											,'messages'		=> array()
										);
		
		$this->_data['plugins'] = array_unique(array_merge($this->_data['plugins'], array('sparkline','datatables', 'wizard', 'gallery','tinymce','timepicker')));
        $this->_data['ctrl_id'] = now();

        if ( $this->_is_mobile && $this->_data['page'] != 'login/form') {
            
            $this->_data['agent'] = $this->ci->agent->agent_string();
            
			//$this->ci->load->view("mobile/layouts/default_test", $this->_data);
			
			$this->ci->load->view("mobile/layouts/".$this->_layout, $this->_data);
			
		} else {
		
			$page = VIEWPATH."tablets/{$this->_default_theme}/pages/".$this->_data['page'].".php";
		
			if($this->_is_tablet && file_exists($page)){
            
				$this->ci->load->view("tablets/{$this->_default_theme}/layouts/".$this->_layout, $this->_data);
			
			} else {

				$this->ci->load->view("web/{$this->_default_theme}/layouts/".$this->_layout, $this->_data);
			}
		}
    }
	
	public function raw_view($view, $data = array(), $return = FALSE){
	
		is_array($data) OR $data = (array) $data;

		$this->_data = array_merge($this->_data, $data);
		
		if(isset($this->ci->cfg->default_theme)){
			$this->_data['default_theme'] = $this->_default_theme = $this->ci->cfg->default_theme;
		}
		
		$this->_data['asset_url'] = cdn_url().'assets/'.$this->_default_theme.'/';
		$this->_data['mobile_asset_url'] = cdn_url().'assets/mobile/';
		$this->_data['cdn_url'] = cdn_url().'/';
		$this->_data['ctrl_id'] = now();
		
		$this->_data['plugins'] = array_merge($this->_data['plugins'], array('sparkline'));
		
		$mobile_override = isset($data['mobile_override']) ? $data['mobile_override'] : FALSE;
		
		if ( $this->_is_mobile && ($view != 'auth/login' || $view != 'login') && $mobile_override == FALSE) {
			
			$view = "mobile/".$view;
			if($return == TRUE){
				return $this->ci->load->view($view, $this->_data, TRUE);
			} else {
				$this->ci->load->view($view, $this->_data);
			}
			
		} else{
				
			$page = VIEWPATH."tablets/{$this->_default_theme}/{$view}.php";
		
			if($this->_is_tablet && ($view != 'auth/login' || $view != 'login') && file_exists($page)){
				
				if($return == TRUE){
					return $this->ci->load->view("tablets/{$this->_default_theme}/{$view}", $this->_data, TRUE);
				} else {
					$this->ci->load->view("tablets/{$this->_default_theme}/{$view}", $this->_data);
				}
			
			} else {
				
				if($return == TRUE){
					return $this->ci->load->view("web/{$this->_default_theme}/{$view}", $this->_data, TRUE);
				} else {
					$this->ci->load->view("web/{$this->_default_theme}/{$view}", $this->_data);
				}
			}
		}
	}

}