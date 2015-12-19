<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gcolumns extends Admin_Controller {

    public function __construct() {
        parent::__construct();
		
		$this->load->model('setting_model', 'setting_m');
    }
	
	public function index($pkey = '', $method='echo') {
	
		ensure_user_access(TRUE, array('admin', 'management_company'));	
		
		$params = (($params = wdp_arr_decode($pkey)) && is_array($params)) ? $params : array();	
		$company_id = ($this->current_user->group_id == 1) ? 0 : $this->current_user->company_id;
		$grid_column_type_id = (isset($params[GRID_CTYPE]) && gtzero_integer($params[GRID_CTYPE])) ? to_int($params[GRID_CTYPE]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$params = array('user_id' => $this->current_user->user_id, 'grid_column_type_id' => $grid_column_type_id);
		
		if(_check_company_user_access()){
			$params['company_id'] = $company_id;
		}
		
		$grid_columns = $this->setting_m->grid_columns_by_many($params);
		
		if(!$grid_columns) $this->show_permission_denied_error($method);

        $this->form_validation->set_rules('grid_column_rows', '', '');
		
		$output = array( 'message' => "", 'status' => "");
        if ($this->form_validation->run() == TRUE) {
			
			$grid_column_rows = $this->_post_args('grid_column_rows', ARGS_TYPE_ARRAY);
			
			
			if($this->current_user->group_id == 2){
				
				$this->setting_m->delete_company_grid_columns($company_id, $grid_column_type_id);
				
				foreach($grid_column_rows AS $grid_column_id=>$is_visible){
						
					$this->setting_m->add_company_grid_columns(array(
						'company_id' 			=> $company_id
						,'grid_column_id'		=> $grid_column_id
						,'grid_column_type_id'	=> $grid_column_type_id
						,'visible'				=> to_int($is_visible)
					));
					
				}
				
				$this->setting_m->user_grid_columns_by_many($company_id, array(
						'company_id' 			=> $company_id
						, 'grid_column_type_id' => $grid_column_type_id 
					), TRUE);

			} else {
			
				$this->setting_m->delete_user_grid_columns($this->current_user->user_id, $grid_column_type_id);
			
				foreach($grid_column_rows AS $grid_column_id=>$is_visible){
						
					$this->setting_m->add_user_grid_columns(array(
						'user_id' 				=> $this->current_user->user_id
						,'grid_column_id'		=> $grid_column_id
						,'grid_column_type_id'	=> $grid_column_type_id
						,'visible'				=> to_int($is_visible)
					));
					
				}
				
				$this->setting_m->user_grid_columns_by_many($company_id, array(
						'user_id' 				=> $this->current_user->user_id
						, 'grid_column_type_id' => $grid_column_type_id 
					), TRUE);
				
			}
			
			$gparams = array(
				'grid_column_type_id' 	=> $grid_column_type_id
				, 'user_id' 			=> $this->current_user->user_id
			);
			
			if(_check_company_user_access()){
				$gparams['company_id'] = $this->current_user->company_id;
			}
			
			$grid_columns = $this->setting_m->user_grid_columns_by_many($this->current_user->company_id, $gparams);
			
			$output['message'] 		= 'Setting Saved';
			$output['status'] 		= SUCCESS_MESSAGE;
			$output['grid_columns'] = $grid_columns;
			
			
            //$output['redirect'] 	= $redirect_url;
			
			$this->_output_request($output, $redirect_url);
			
        } else {
		
            if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$details = $this->company_m->company_settings($company_id);
		
		$data = array(
			'form_action'						=> site_url('settings/gcolumns/index/'.$pkey)
			, 'cancel_url'						=> $redirect_url
			, 'page' 							=> 'settings/my_grid_permission'
			, 'title' 							=> 'Grid Setting'
			, 'submit_btn_text'					=> 'Save Changes'
			, 'company_id'						=> $company_id
			, 'grid_columns'					=> $grid_columns->columns
			, 'js_files'						=> array('settings/gcolumns.js')
			, 'hiddenvars'						=> array('redirect_url' => $redirect_url)
		);
		
        if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/settings/my_grid_permission_modal', $data, TRUE);

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