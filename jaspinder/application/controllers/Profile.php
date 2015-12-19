<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller {

    public function __construct() {
        parent::__construct();
		
        $this->load->model('user_model', 'user_m');
    }

    public function index() {

        $data = array(
			'page_id'			=> now()
			,'page' 			=> 'user/profile'
			,'title' 			=> 'My Profile'
			,'submit_btn_text'	=> 'Save Changes'
			,'cancel_url'		=> site_url('dashboard')
		);

        $this->template->load('default', $data);
    }

    public function update() {

        $new_file_name = "";
		
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|xss_clean');
        
		if ($this->input->post('password')) {
			
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

		}
		
		if ($this->form_validation->run() == TRUE) {
		
			$gmt_offset = ( $this->current_user->group_id == GROUP_ADMIN ) ? $this->current_user->gmt_offset : $this->current_user->company_settings->gmt_offset;
		
			$input = array(
				'first_name' 	=> $this->_post_args('first_name', ARGS_TYPE_STRING)
				,'last_name' 	=> $this->_post_args('last_name', ARGS_TYPE_STRING)
				,'phone' 		=> $this->_post_args('phone', ARGS_TYPE_STRING)
				,'gmt_offset'	=> $this->_post_args('gmt_offset', ARGS_TYPE_STRING, $gmt_offset, array('override' => TRUE))
			);
			
			if( ($user_avatar = $this->upload_avatar()) && empty($user_avatar['error']) && !empty($user_avatar['file_name']) ) {
				
				$input['avatar'] = $user_avatar['file_name'];
			}

			if (isset($new_file_name) && $new_file_name != "") {
				$input['avatar'] = $new_file_name;
			}
			
			if ($this->input->post('password')) {
				$input['password'] = $this->_post_args('password', ARGS_TYPE_STRING);
			}
			
			if($this->ion_auth->update($this->current_user->user_id, $input)){
				
				$this->user_m->clear_user_profile_cache(array(
						'user_id' 			=> $this->current_user->user_id
						,'company_id'		=> $this->current_user->company_id
						,'old_company_id'	=> $this->current_user->company_id
					));
			
				set_flash_data(SUCCESS_MESSAGE, 'Profile Saved');
				//die();
				//redirect("profile", 'refresh');
				//exit;
				?> 
					<script>
							window.location="<?php echo base_url() ?>profile";
					</script>
				<?php 
				die();
			}
		
		}
		
		$this->index();
    }
	
	
	
	protected function upload_avatar(){
		
		$new_file_name = "";$error = "";
        if (isset($_FILES['user_avatar']) && $_FILES['user_avatar']['error'] == 0) {
           
			$config['upload_path'] = './documents/profile/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            $config['max_size'] = 300;

            $new_file_name = uniqid() . '.' . $this->get_file_extension($_FILES['user_avatar']['name']);

            $config['file_name'] = $new_file_name;

            $this->load->library('upload', $config);
 
            if (!$this->upload->do_upload('user_avatar')) {
				$new_file_name = "";
                $error = $this->upload->display_errors('', '');;
				
            } else {
			
                $config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 60;
                $config['height'] = 60;

                $upload_data = $this->upload->data();
                
                $this->load->library('image_lib', $config);

                 if (!$this->image_lib->resize()) {
                    $this->session->set_flashdata('message', $this->image_lib->display_errors('<p class="error">', '</p>'));
                } else {
                    
					$this->load->library('docs');
					$error = ( ($status = $this->docs->s3_upload($upload_data, 'profile/')) && $status) ? '' : 'Problem with CDN transfer';
					
				}
            }
        }
		
		return array("file_name" => $new_file_name, "error" => $error);
	}
	
	public function set_timezone($method = 'echo'){
	
		$this->lang->load('date');
		
		$front_gmt_offset = $this->input->post("front_gmt_offset");
		$this->form_validation->set_rules('gmt_offset', 'Timezone', 'required|xss_clean');
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
		
			$input = array(
				'gmt_offset' => $this->input->post("gmt_offset")
            );

            $is_record_updated = $this->ion_auth->update($this->current_user->user_id, $input);
			
			if($this->current_user->group_id == 2) {
			
				$all_resources = (($all_resources = $this->input->post("all_resources")) && gtzero_integer($all_resources)) ? $all_resources : 0;
				$company_setting_offset = (($company_setting_offset = $this->input->post("company_setting_offset")) && gtzero_integer($company_setting_offset)) ? $company_setting_offset : 0;
				
				if($all_resources == 1){
					$this->user_profile_m->update_timezones_per_company($this->current_user->company_id, $input['gmt_offset']);
				}
				
				if($company_setting_offset == 1){
					
					/*$details = $this->company_m->company_settings($this->current_user->company_id);
					
					$input_cfg = array(
						"vat" 								=> $details->vat
						,"company_id" 						=> $this->current_user->company_id
						,"remedial_notes_plant_item" 		=> $details->remedial_notes_plant_item
						,"allowed_cost_for_technicians" 	=> $details->allowed_cost_for_technicians
						,"allowed_quote_for_technicians" 	=> $details->allowed_quote_for_technicians
						,"allowed_invoice_for_technicians" 	=> $details->allowed_invoice_for_technicians
						,"allowed_job_for_clients_sites"	=> $details->allowed_job_for_clients_sites
						,"show_alternative_job_number"		=> $details->show_alternative_job_number
						,"show_custom_job_tags"				=> $details->show_custom_job_tags
						,"quote_condition_section_text"		=> $details->quote_condition_section_text
						,"gmt_offset" 						=> $input['gmt_offset']
						,"sequencial_number_id"				=> $details->sequencial_number_id
					);
					
					$this->company_m->delete_company_settings($this->current_user->company_id);
					$this->company_m->add_company_settings($input_cfg);*/
					
					$this->company_m->updatde_company_settings(array(
						"gmt_offset" 	=> $input['gmt_offset']
					), $this->current_user->company_id);
				}
			}
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The company "%s" was added.', $this->lang->line($input['gmt_offset']));
                $output['status'] 	= SUCCESS_MESSAGE;
				
			} else {
				$output['message'] 	= 'An error occured.';
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
			
		}
		
		
        $data = array(
			'form_action'				=> site_url('profile/set_timezone')
			,'cancel_url'				=> site_url('dashboard')
            , 'page' 					=> 'user/timezone'
            , 'title' 					=> 'Create Company'
			, 'submit_btn_text'			=> 'Set Timezone'
			, 'front_gmt_offset'		=> $this->lang->line($front_gmt_offset)
			, 'gmt_offset' 				=> $this->input->post('gmt_offset', TRUE) ? $this->input->post('gmt_offset', TRUE) : $this->current_user->gmt_offset
        );
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/user/timezone', $data, TRUE);

            if ($method == "ajax") {
                
                $output['html']	= $html;
                $this->_output_request($output,'dashboard');
				
            } else {
                echo $html;
            }
        } else {

            $this->template->load('default', $data);
        }
	}
	
	public function synctimezone(){
		
		$front_gmt_offset = $this->input->post("front_gmt_offset");
		$recheck = (($recheck = $this->input->post("recheck")) && gtzero_integer($recheck) ) ? TRUE : FALSE;
		
		$user_info = $this->user_m->get_user_info($this->current_user->user_id);
		
		$gmt_options = $this->session->userdata('gmt_options');
		
		if( !empty($gmt_options)) {
			$this->session->unset_userdata('gmt_options');
		}
			
		$gmt_options = array(
			//'user_gmt_offset' => $user_info->gmt_offset,
			//'front_gmt_offset' => $front_gmt_offset,
			'recheck' => $recheck
		);
			
		$this->session->set_userdata('gmt_options', serialize_object($gmt_options));
		
		header('Content-Type: application/json');
        echo json_encode(array('gmt_options' => $gmt_options));
		die;
	}
	
    protected function get_file_extension($file_name) {
	
        $image_array = explode('.', $file_name);
        return end($image_array);
		
    }

}