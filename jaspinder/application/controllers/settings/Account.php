<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        
		_has_user_access_permission(TRUE, array('admin'));
    }
	
	public function index($method = 'echo'){
	
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		$qrows = $this->setting_m->get_all();
		
		foreach($qrows AS $row){
			$this->form_validation->set_rules($row->key, $row->title, 'required|xss_clean');
		}
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
		
			foreach($qrows AS $row){
			
				$this->setting_m->update($row->key, $this->_post_args($row->key, ARGS_TYPE_STRING));
			}
			
			$companies = $this->company_m->get_companies_list();
			
			foreach($companies AS $company){
				
				$this->company_m->update_company_settings(array(
					'gmt_offset' 	=> $this->cfg->gmt_offset
				), $company->id);
				
			}
			
			$this->setting_m->clear_core_setting_cache();
			
			$output['message'] 	= sprintf('system setting updated');
			$output['status'] 	= SUCCESS_MESSAGE;
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
			
		}

        $data = array(
			'form_action'				=> site_url('settings/account')
			,'cancel_url'				=> site_url($redirect_url)
            , 'page' 					=> 'settings/system_settings_form'
            , 'title' 					=> 'System Settings'
			, 'qrows'					=> $qrows
			, 'submit_btn_text'			=> 'Save Changes'
			, 'hiddenvars'				=> array('redirect_url' => $redirect_url)
			
        );
		
		foreach($qrows AS $row){
			$data[$row->key] = $this->_post_args($row->key, ARGS_TYPE_STRING, $row->value);
		}
		
		if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/settings/system_settings_form_modal', $data, TRUE);
			
			if ($method == "ajax") {
                
                $output['html']	= $html;
				
                $this->_output_request($output, $redirect_url);
				
            } else {
                echo $html;
            }
			
        } else {
		
            $this->template->load('default', $data);
        }
	}
}