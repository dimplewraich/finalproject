<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('survey_model', 'survey_m');
    }

    public function index($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		
        $data = array(
			'page'				=> 'survey/sforms'
			,'title'			=> 'Site Forms'
			,'plugins'			=> array()
			,'new_site_form_url'=> site_url('survey/sfcreate/'.serialize_object())
			//,'grid_action'		=> ($this->input->is_ajax_request()) ? site_url("sites/getTable/".$pkey) : site_url("sites/getTable")
			,'sform_rows'		=> $this->survey_m->get_site_forms()
			,'scripts'			=> array('survey/index.js')
		);

        if ($this->input->is_ajax_request()) {

            echo $this->template->raw_view('pages/survey/sforms_modal', $data, TRUE);
			
        } else {
		
            $this->template->load('default', $data);
        }
    }
	
	public function sfcreate($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
			
			$input = array(
				'name'	=> $this->_post_args('name', ARGS_TYPE_STRING)
            );

            $form_type_id = $this->survey_m->add_form_type($input);
			
			if( $form_type_id > 0 ){
				
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['message'] 		= sprintf('The site form "%s" was added.', $input['name']);
				$output['form_type_id'] 	= $form_type_id;
				
			} else {
				$output['message'] 		= sprintf('Unable to create site form record "%s". Please report the issue to %s', $input['name'], $this->cfg->contact_email);
                $output['status'] 		= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
			
		}
		
		$doc_key =  $this->input->post('doc_key') ?  $this->input->post('doc_key') : keygen();
		$csrf = _get_csrf_nonce();

        $data = array(
			'form_action'					=> site_url('survey/sfcreate/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'survey/sfform'
            , 'title' 						=> 'Site Form Detail'
			, 'submit_btn_text'				=> 'Save Changes'
			, 'name' 						=> $this->_post_args('name', ARGS_TYPE_STRING)
			
			, 'scripts'						=> array('survey/sfform.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/survey/sfform_modal', $data, TRUE);

            if ($method == "ajax") {
                
                $output['html']	= $html;
                $this->_output_request($output, $redirect_url);
				
            } else {
                echo $html;
            }
        } else {
		
			if(!empty($output['status']) ) set_flash_data($output['status'], $output['message'], FALSE);

            $this->template->load('default', $data);
        }
	}
	
	public function sfedit($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$form_info = $this->survey_m->form_type_details($form_type_id);
		
		$this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
			
			$input = array(
				'name'	=> $this->_post_args('name', ARGS_TYPE_STRING)
            );

            $is_record_updated = $this->survey_m->update_form_type($input, $form_type_id);
			
			if( $is_record_updated > 0 ){
				
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['message'] 		= sprintf('The site form "%s" was updated.', $input['name']);
				$output['form_type_id'] 	= $form_type_id;
				
			} else {
				$output['message'] 		= sprintf('Unable to update site form record "%s". Please report the issue to %s', $form_info->name, $this->cfg->contact_email);
                $output['status'] 		= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
			
		}
		
		$doc_key =  $this->input->post('doc_key') ?  $this->input->post('doc_key') : keygen();
		$csrf = _get_csrf_nonce();

        $data = array(
			'form_action'					=> site_url('survey/sfedit/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'survey/sfform'
            , 'title' 						=> 'Site Form Detail'
			, 'submit_btn_text'				=> 'Save Changes'
			, 'name' 						=> $this->_post_args('name', ARGS_TYPE_STRING, $form_info->name)
			
			, 'scripts'						=> array('survey/sfform.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/survey/sfform_modal', $data, TRUE);

            if ($method == "ajax") {
                
                $output['html']	= $html;
                $this->_output_request($output, $redirect_url);
				
            } else {
                echo $html;
            }
        } else {
		
			if(!empty($output['status']) ) set_flash_data($output['status'], $output['message'], FALSE);

            $this->template->load('default', $data);
        }
	}

    public function sfdelete($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$form_info = $this->survey_m->form_type_details($form_type_id);
		
		if( !$form_info) {
			$this->show_permission_denied_error($method);
		}
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			$is_record_updated = $this->survey_m->delete_form_type($form_type_id);
			
			if($is_record_updated){
				$output['message'] 		= sprintf('The site form "%s" has been deleted.', $form_info->name);
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['form_type_id'] = $form_type_id;
				
			} else {
				$output['message'] 	= sprintf('Unable to delete site "%s". Please report the issue to %s', $form_info->name, $this->cfg->contact_email);
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$csrf = _get_csrf_nonce();
		
		$data = array(
			'form_action'			=> site_url('survey/sfdelete/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'survey/delete'
			, 'title' 				=> 'Delete Form'
			, "display_message"		=> sprintf('Are you sure you want to delete form "%s"?',$form_info->name)
			, "display_heading"		=> sprintf('Delete Form', $form_info->name)
			, "submit_btn_text"		=> "Save Changes"
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url, 'confirm' => 1))
        );
		

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/survey/delete_modal', $data, TRUE);

            if ($method == "ajax") {
			
				$output['html']	= $html;
                $this->_output_request($output, $redirect_url);
				
            } else {
                echo $html;
            }
        } else {
		
			if(!empty($output['status']) ) set_flash_data($output['status'], $output['message'], FALSE);
		
            $this->template->load('default', $data);
        }
    }

	/* Question Function */

    public function questions($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$form_info = $this->survey_m->form_type_details($form_type_id);
		
		if( !$form_info) {
			$this->show_permission_denied_error($method);
		}
		
        $data = array(
			'page'				=> 'survey/question_listing'
			,'title'			=> 'Site Form Questions'
			,'plugins'			=> array()
			,'new_qcreate_url'	=> site_url('survey/qcreate/'.serialize_object(array(SYS_FORM_TYPE_ID => $form_type_id)))
			,'question_sort_update_url' => site_url('survey/sort_question/'.serialize_object(array(SYS_FORM_TYPE_ID => $form_type_id)))
			,'questions_url' => site_url('survey/qgetTable/'.serialize_object(array(SYS_FORM_TYPE_ID => $form_type_id)))
			,'qrows'			=> $this->survey_m->get_questions_by_form_id($form_type_id)
			,'form_type_id'		=> $form_type_id
			,'scripts'			=> array('survey/questions.js')
		);

        if ($this->input->is_ajax_request()) {

            echo $this->template->raw_view('pages/survey/question_listing_modal', $data, TRUE);
			
        } else {
		
            $this->template->load('default', $data);
        }
    }
	
	public function sort_question($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$form_info = $this->survey_m->form_type_details($form_type_id);
		
		$this->form_validation->set_rules('sort_ids', 'Sort Order', '');
		
		$output = array( 'message' => "", 'status' => "");
		
		$sort_ids = $this->_post_args('sort_ids', ARGS_TYPE_ARRAY);
		
		
        if (is_array($sort_ids) && count($sort_ids) > 0) {
		
			$index = 1;
			foreach($sort_ids AS $_index=>$question_id){
				
				$this->survey_m->update_qsort($index, $question_id, $form_type_id);
				
				$index++;
			}
			
			$is_record_updated = 1;
			if( $is_record_updated > 0 ){
				
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['message'] 		= sprintf('The sort order for questions was updated.');
				$output['form_type_id'] 	= $form_type_id;
				$output['sort_ids'] 	= $sort_ids;
				
			} else {
				$output['message'] 		= sprintf('Unable to update sort order for questions. Please report the issue to %s', $this->cfg->contact_email);
                $output['status'] 		= ERROR_MESSAGE;
			}
		} else {
			
			$output['message'] 		= sprintf('Unable to update sort order for questions. Please report the issue to %s', $this->cfg->contact_email);
			$output['status'] 		= ERROR_MESSAGE;
			
		}
		
		$this->_output_request($output, $redirect_url);
	}
	
    public function qgetTable($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$form_info = $this->survey_m->form_type_details($form_type_id);
		
		if( !$form_info) {
			$this->show_permission_denied_error($method);
		}
		
        $data = array(
			'page'				=> 'survey/question_listing'
			,'title'			=> 'Site Form Questions'
			,'plugins'			=> array()
			,'new_qcreate_url'	=> site_url('survey/qcreate/'.serialize_object(array(SYS_FORM_TYPE_ID => $form_type_id)))
			,'question_sort_update_url' => site_url('survey/sort_question/'.serialize_object(array(SYS_FORM_TYPE_ID => $form_type_id)))
			,'questions_url' 	=> site_url('survey/qgetTable/'.serialize_object(array(SYS_FORM_TYPE_ID => $form_type_id)))
			,'qrows'			=> $this->survey_m->get_questions_by_form_id($form_type_id)
			,'form_type_id'		=> $form_type_id
			,'scripts'			=> array('survey/questions.js')
		);
		
		 echo $this->template->raw_view('pages/survey/questions', $data, TRUE);
    }
    
	public function qcreate($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$form_info = $this->survey_m->form_type_details($form_type_id);
		
		$this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
		$this->form_validation->set_rules('help_text', 'Help Text', 'trim|xss_clean');
		$this->form_validation->set_rules('question_type', 'Question Type', 'required|xss_clean');
		$this->form_validation->set_rules('allowed_types', 'Allowed Types', 'callback__allowed_types');
		$this->form_validation->set_rules('max_size', 'Max  Size', 'callback__max_size');
		$this->form_validation->set_rules('db_table', 'Table', 'callback__db_table');
		$this->form_validation->set_rules('options', 'options', 'callback__seloptions');
		$this->form_validation->set_rules('sort_order', 'Sort Order', '');
		
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
			
			$question_type = $this->_post_args('question_type', ARGS_TYPE_STRING);
			
			$input = array(
				'form_type_id'					=> $form_type_id
				, 'form_section_id'				=> $this->_post_args('form_section_id', ARGS_TYPE_INT)
				, 'description' 				=> $this->_post_args('description', ARGS_TYPE_STRING)
				, 'help_text' 					=> $this->_post_args('help_text', ARGS_TYPE_STRING)
				, 'type' 						=> $this->_post_args('question_type', ARGS_TYPE_STRING, 'text')
				, 'allowed_types' 				=> ($question_type == 'upload') ? implode('|', $this->_post_args('allowed_types', ARGS_TYPE_ARRAY)) : ''
				, 'max_size' 					=> ($question_type == 'upload') ? $this->_post_args('max_size', ARGS_TYPE_STRING) : 0
				, 'table' 						=> ($question_type == 'database_table') ? $this->_post_args('db_table', ARGS_TYPE_STRING) : ''
				, 'options' 					=> in_array($question_type, array('radio', 'checkbox','select')) ? $this->_post_args('options', ARGS_TYPE_STRING) : ''
				, 'sort_order' 					=> $this->_post_args('sort_order', ARGS_TYPE_INT)
            );

            $is_record_updated = $this->survey_m->qcreate($input);
			
			if( $is_record_updated > 0 ){
				
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['message'] 		= sprintf('The question for site form "%s" was added.', $form_info->name);
				$output['form_type_id'] 	= $form_type_id;
				
			} else {
				$output['message'] 		= sprintf('Unable to add question for site form record "%s". Please report the issue to %s', $form_info->name, $this->cfg->contact_email);
                $output['status'] 		= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
			
		}
		
		$doc_key =  $this->input->post('doc_key') ?  $this->input->post('doc_key') : keygen();
		$csrf = _get_csrf_nonce();

        $data = array(
			'form_action'					=> site_url('survey/qcreate/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'survey/qform'
            , 'title' 						=> 'Question Detail'
			, 'submit_btn_text'				=> 'Save Changes'
			, 'form_section_id'				=> $this->_post_args('form_section_id', ARGS_TYPE_INT)
			, 'description' 				=> $this->_post_args('description', ARGS_TYPE_STRING)
			, 'help_text' 					=> $this->_post_args('help_text', ARGS_TYPE_STRING)
			, 'question_type' 				=> $this->_post_args('question_type', ARGS_TYPE_STRING, 'text')
			, 'allowed_types' 				=> $this->_post_args('allowed_types', ARGS_TYPE_ARRAY)
			, 'max_size' 					=> $this->_post_args('max_size', ARGS_TYPE_STRING)
			, 'db_table' 					=> $this->_post_args('db_table', ARGS_TYPE_STRING)
			, 'options' 					=> $this->_post_args('options', ARGS_TYPE_STRING)
			, 'sort_order' 					=> $this->_post_args('sort_order', ARGS_TYPE_INT)
			
			, 'scripts'						=> array('survey/qform.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/survey/qform_modal', $data, TRUE);

            if ($method == "ajax") {
                
                $output['html']	= $html;
                $this->_output_request($output, $redirect_url);
				
            } else {
                echo $html;
            }
        } else {
		
			if(!empty($output['status']) ) set_flash_data($output['status'], $output['message'], FALSE);

            $this->template->load('default', $data);
        }
	}
	
	public function qedit($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$question_id = (isset($params[SYS_QUESTION_ID]) && gtzero_integer($params[SYS_QUESTION_ID])) ? to_int($params[SYS_QUESTION_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$form_info = $this->survey_m->form_type_details($form_type_id);
		
		$question_info = $this->survey_m->get_question_detail($question_id, $form_type_id);

		$this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
		$this->form_validation->set_rules('help_text', 'Help Text', 'trim|xss_clean');
		$this->form_validation->set_rules('question_type', 'Question Type', 'required|xss_clean');
		$this->form_validation->set_rules('allowed_types', 'Allowed Types', 'callback__allowed_types');
		$this->form_validation->set_rules('max_size', 'Max  Size', 'callback__max_size');
		$this->form_validation->set_rules('db_table', 'Table', 'callback__db_table');
		$this->form_validation->set_rules('options', 'options', 'callback__seloptions');
		$this->form_validation->set_rules('sort_order', 'Sort Order', '');
		
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
			
			$question_type = $this->_post_args('question_type', ARGS_TYPE_STRING);
			
			$input = array(
				'form_type_id'					=> $form_type_id
				, 'form_section_id'				=> $this->_post_args('form_section_id', ARGS_TYPE_INT)
				, 'description' 				=> $this->_post_args('description', ARGS_TYPE_STRING)
				, 'help_text' 					=> $this->_post_args('help_text', ARGS_TYPE_STRING)
				, 'type' 						=> $this->_post_args('question_type', ARGS_TYPE_STRING, 'text')
				, 'allowed_types' 				=> ($question_type == 'upload') ? implode('|', $this->_post_args('allowed_types', ARGS_TYPE_ARRAY)) : ''
				, 'max_size' 					=> ($question_type == 'upload') ? $this->_post_args('max_size', ARGS_TYPE_STRING) : 0
				, 'table' 						=> ($question_type == 'database_table') ? $this->_post_args('db_table', ARGS_TYPE_STRING) : ''
				, 'options' 					=> in_array($question_type, array('radio', 'checkbox','select')) ? $this->_post_args('options', ARGS_TYPE_STRING) : ''
				, 'sort_order' 					=> $this->_post_args('sort_order', ARGS_TYPE_INT)
            );

            $is_record_updated = $this->survey_m->qupdate($input, $question_id);
			
			if( $is_record_updated > 0 ){
				
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['message'] 		= sprintf('The question for site form "%s" was updated.', $form_info->name);
				$output['form_type_id'] 	= $form_type_id;
				
			} else {
				$output['message'] 		= sprintf('Unable to update question for site form record "%s". Please report the issue to %s', $form_info->name, $this->cfg->contact_email);
                $output['status'] 		= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
			
		}
		
		$doc_key =  $this->input->post('doc_key') ?  $this->input->post('doc_key') : keygen();
		$csrf = _get_csrf_nonce();

        $data = array(
			'form_action'					=> site_url('survey/qedit/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'survey/qform'
            , 'title' 						=> 'Question Detail'
			, 'submit_btn_text'				=> 'Save Changes'
			, 'form_type_id'				=> $form_type_id
			, 'form_section_id'				=> $this->_post_args('form_section_id', ARGS_TYPE_INT, $question_info->form_section_id)
			, 'description' 				=> $this->_post_args('description', ARGS_TYPE_STRING, $question_info->description)
			, 'help_text' 					=> $this->_post_args('help_text', ARGS_TYPE_STRING, $question_info->help_text)
			, 'question_type' 				=> $this->_post_args('question_type', ARGS_TYPE_STRING, $question_info->type)
			, 'allowed_types' 				=> $this->_post_args('allowed_types', ARGS_TYPE_ARRAY, !empty($question_info->allowed_types) ? explode('|', $question_info->allowed_types) : array())
			, 'max_size' 					=> $this->_post_args('max_size', ARGS_TYPE_STRING, $question_info->max_size)
			, 'db_table' 					=> $this->_post_args('db_table', ARGS_TYPE_STRING, $question_info->table)
			, 'options' 					=> $this->_post_args('options', ARGS_TYPE_STRING, $question_info->options)
			, 'sort_order' 					=> $this->_post_args('sort_order', ARGS_TYPE_INT, $question_info->sort_order)
			
			, 'scripts'						=> array('survey/qform.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/survey/qform_modal', $data, TRUE);

            if ($method == "ajax") {
                
                $output['html']	= $html;
                $this->_output_request($output, $redirect_url);
				
            } else {
                echo $html;
            }
        } else {
		
			if(!empty($output['status']) ) set_flash_data($output['status'], $output['message'], FALSE);

            $this->template->load('default', $data);
        }
	}
	
	public function qdelete($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$question_id = (isset($params[SYS_QUESTION_ID]) && gtzero_integer($params[SYS_QUESTION_ID])) ? to_int($params[SYS_QUESTION_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$form_info = $this->survey_m->form_type_details($form_type_id);
		
		$question_info = $this->survey_m->get_question_detail($question_id, $form_type_id);
		
		if( !$form_info) {
			$this->show_permission_denied_error($method);
		}
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			$is_record_updated = $this->survey_m->delete_question($question_id);
			
			if($is_record_updated){
				$output['message'] 		= sprintf('The question "%s" has been deleted.', $question_info->description);
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['question_id'] = $question_id;
				
			} else {
				$output['message'] 	= sprintf('Unable to delete question "%s". Please report the issue to %s', $question_info->description, $this->cfg->contact_email);
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$csrf = _get_csrf_nonce();
		
		$data = array(
			'form_action'			=> site_url('survey/qdelete/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'survey/delete'
			, 'title' 				=> 'Delete Question'
			, "display_message"		=> sprintf('Are you sure you want to delete question "%s"?', $question_info->description)
			, "display_heading"		=> sprintf('Delete Question', $question_info->description)
			, "submit_btn_text"		=> "Save Changes"
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url, 'confirm' => 1))
        );
		

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/survey/delete_modal', $data, TRUE);

            if ($method == "ajax") {
			
				$output['html']	= $html;
                $this->_output_request($output, $redirect_url);
				
            } else {
                echo $html;
            }
        } else {
		
			if(!empty($output['status']) ) set_flash_data($output['status'], $output['message'], FALSE);
		
            $this->template->load('default', $data);
        }
    }
	
	public function _allowed_types($val){
	
		$question_type = $this->_post_args('question_type', ARGS_TYPE_STRING);
		$allowed_types = $this->_post_args('allowed_types', ARGS_TYPE_ARRAY);
		
		if ($question_type == 'upload' && (!is_array($allowed_types) || count($allowed_types) <= 0)){
			$this->form_validation->set_message('_allowed_types', 'The %s field is required');
			return FALSE;
		}
		
		return TRUE;
	}
	
	public function _max_size($val){
	
		$question_type = $this->_post_args('question_type', ARGS_TYPE_STRING);
		$max_size = $this->_post_args('max_size', ARGS_TYPE_INT);
		
		if ($question_type == 'upload' && !validate_integer($max_size)){
			$this->form_validation->set_message('_max_size', 'The %s field needs to be numeric value');
			return FALSE;
		} elseif ($question_type == 'upload' && $max_size <= 0){
			$this->form_validation->set_message('_max_size', 'The %s field is required');
			return FALSE;
		}
		
		return TRUE;
	}
	
	public function _db_table($val){
	
		$question_type = $this->_post_args('question_type', ARGS_TYPE_STRING);
		$db_table = $this->_post_args('db_table', ARGS_TYPE_STRING);
		
		if ($question_type == 'database_table' && empty($db_table)){
			$this->form_validation->set_message('_db_table', 'The %s field is required');
			return FALSE;
		}
		
		return TRUE;
	}
	
	public function _seloptions($val){
	
		$question_type = $this->_post_args('question_type', ARGS_TYPE_STRING);
		$options = $this->_post_args('options', ARGS_TYPE_STRING);
		
		if ( in_array($question_type, array('radio', 'checkbox','select')) && empty($options)){
			$this->form_validation->set_message('_seloptions', 'The %s field is required');
			return FALSE;
		}
		
		return TRUE;
	}
}

?>