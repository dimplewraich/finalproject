<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_Controller extends MY_Controller {
	
	public $current_user = FALSE;
	public $cp_theme_type = 'frontend_theme';
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('user_model', 'user_m');
		
		$this->current_user = $this->user_m->get_user_profile($this->session->userdata('user_id'));
		
		//$this->form_validation->CI =& $this;
		$this->template->current_user = ci()->current_user = $this->current_user;
		
		$gmt_options = $this->session->userdata('gmt_options');
		
		$this->template->gmt_options = ci()->gmt_options = array('recheck' => true);
		
		if( !empty($gmt_options)) {
			$gmt_options = unserialize_object($gmt_options);
			
			$this->template->gmt_options = ci()->gmt_options = $gmt_options;
		}
	}
}