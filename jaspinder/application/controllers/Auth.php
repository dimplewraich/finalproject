<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	public $cp_theme_type = 'cp_theme';

	public function __construct() {
		parent::__construct();
		
		$this->load->model('user_model', 'user_m');
		
	}

	public function index() {

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		
		redirect('dashboard', 'refresh');
	}

	public function login() {
   	$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true) {
		
			$remember = TRUE; /*(bool) $this->input->post('remember');*/

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
			
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				
				$redirect_to = is_mobile() ? 'sites/survey' : 'dashboard';
				
				redirect($redirect_to, 'refresh');
			} else {
			
				set_flash_data(ERROR_MESSAGE, $this->ion_auth->errors()); 
				redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
			
		} else {

			$data['message'] = (validation_errors()) ? strip_tags(validation_errors()) : $this->session->flashdata('message');
		}
		
		$doc_key =  $this->input->post('doc_key') ?  $this->input->post('doc_key') : keygen();
	
		$data = array(
			'page' 					=> 'login/form'
            , 'title' 				=> 'Login'
			, 'identity'			=> $this->form_validation->set_value('identity')
			, 'password'			=> ''
			, 'scripts'				=> array('login/form.js')
			, 'hiddenvars'			=> array()
			, 'doc_key'				=> $doc_key
		);
		

		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/login/form_modal', $data, TRUE);

            if ($method == "ajax") {
                
                $output['html']	= $html;
                $this->_output_request($output, 'auth/login');
				
            } else {
                echo $html;
            }
        } else {
			
			if(!empty($output['status']) ) set_flash_data($output['status'], $output['message'], FALSE);
			
            $this->template->load('login', $data);
        }
	}

	//log the user out
	public function logout() {
	
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth/login', 'refresh');
	}
}
