<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
    
	public function __construct() {
        parent::__construct();
		
		$this->load->model('site_model', 'site_m');
    }

	public function index() {
		
		$data = array(
			'page'				=> 'dashboard'
			,'title'			=> 'Dashboard'
			,'site_forms'		=> $this->site_m->submitted_form()
			,'site_statuses'	=> array('' => '', 1 => 'OPEN', 2 => 'SUBMITTED', 3 => 'COMPLETED')
			,'site_count'		=> $this->site_m->site_count()
		);
		
                
		$this->template->load('default', $data);

	}

}