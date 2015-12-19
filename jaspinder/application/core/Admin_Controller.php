<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {
	
	public $current_user = FALSE;
	public $cp_theme_type = 'cp_theme';
	
	public function __construct() {
		parent::__construct();
		//var_dump($this->ion_auth->logged_in());die;
        if (!$this->ion_auth->logged_in()) {
            
            redirect('auth/login', 'refresh');
        }
		
		$this->load->helper('dropdowns');
		$this->load->model('user_model', 'user_m');
		$this->load->model('company_model', 'company_m');
		
		$this->current_user = $this->user_m->get_user_profile($this->session->userdata('user_id'));
		$this->current_user->gmt_offset = $this->cfg->gmt_offset;
		
		if (!$this->current_user) {
            redirect('auth/login', 'refresh');
        }
		
		$company_settings = ( $this->current_user->group_id == 1) ? FALSE : $this->company_m->company_settings($this->current_user->company_id);
		//$custom_field = $this->company_m->company_custom_fields($this->current_user->company_id);
		
		//$this->form_validation->CI =& $this;
		$this->template->current_user = ci()->current_user = $this->current_user;
		$this->template->current_user->company_settings = ci()->current_user->company_settings = $company_settings;
		//$this->template->custom_field = ci()->custom_field = $custom_field;
		
		$gmt_options = $this->session->userdata('gmt_options');
		
		$this->template->gmt_options = ci()->gmt_options = array('recheck' => true);
		
		if( !empty($gmt_options)) {
			$gmt_options = unserialize_object($gmt_options);
			
			$this->template->gmt_options = ci()->gmt_options = $gmt_options;
		}
	}
}