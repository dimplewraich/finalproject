<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('contact_model', 'contact_m');
    }

    public function index($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'location_manager', 'user_company'));
        
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		
		$type_id = ((isset($params[SYS_CONTACT_TYPE_ID]) && gtzero_integer($params[SYS_CONTACT_TYPE_ID])) ? to_int($params[SYS_CONTACT_TYPE_ID]) : 0);
		$ref_id = ((isset($params[SYS_REF_ID]) && gtzero_integer($params[SYS_REF_ID])) ? to_int($params[SYS_REF_ID]) : 0);
		
        $data = array(
			'new_contact_create'=> site_url('contacts/create/'.serialize_object(array( SYS_REF_ID => $ref_id, SYS_CONTACT_TYPE_ID => $type_id)))
			,'page'				=> 'contacts/listing'
			,'title'			=> 'Contact'
			,'plugins'			=> array()
			,'params'			=> $params
			,'grid_action'		=> ($this->input->is_ajax_request()) ? site_url("contacts/getTable/".$pkey) : site_url("contacts/getTable/".$pkey)
			,'scripts'			=> array("contact/index.js")
		);

        if ($this->input->is_ajax_request()) {

            echo $this->template->raw_view('pages/contacts/listing_modal', $data, TRUE);
			
        } else {
		
            $this->template->load('default', $data);
        }
    }

    public function getTable($pkey = '') {
		_has_user_access_permission(TRUE, array('admin', 'location_manager', 'user_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		
		$type_id = ((isset($params[SYS_CONTACT_TYPE_ID]) && gtzero_integer($params[SYS_CONTACT_TYPE_ID])) ? to_int($params[SYS_CONTACT_TYPE_ID]) : 0);
		$ref_id = ((isset($params[SYS_REF_ID]) && gtzero_integer($params[SYS_REF_ID])) ? to_int($params[SYS_REF_ID]) : 0);
		
		$params = array(
			'iDisplayStart' 	=> $this->input->post('iDisplayStart', true)
			,'iDisplayLength' 	=> $this->input->post('iDisplayLength', true)
			,'iSortCol_0' 		=> $this->input->post('iSortCol_0', true)
			,'iSortingCols' 	=> $this->input->post('iSortingCols', true)
			,'sSearch' 			=> $this->input->post('sSearch', true)
			,'sEcho' 			=> $this->input->post('sEcho', true)
			,'type_id' 			=> $type_id
			,'ref_id' 			=> $ref_id
        );
        
        $qrows = $this->contact_m->ajax_gets($params);

        foreach ($qrows['aaData'] as &$qrow) {
			
			$qrow = array(
				$qrow->full_name
				,$qrow->email
				,$qrow->address
				,$qrow->phone
				,$qrow->mobile
				,(to_int($qrow->is_default) == 1) ? 'Yes' : 'No'
				,$qrow->created_by_name
				,local_time($qrow->created_on,'M d, Y')
				,theme_button_groups(array(
					'edit'		=> array(
						'href' 		=> site_url('contacts/edit/'.serialize_object(array( SYS_CONTACT_ID => $qrow->contact_id, SYS_REF_ID => $qrow->ref_id, SYS_CONTACT_TYPE_ID => $qrow->contact_type_id)) ),
						'title'		=> 'Contact Detail <small>'.$qrow->full_name.'</small>',
						'text'		=> 'Edit Contact',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Contact Detail (<small>'.$qrow->full_name.'</small>)", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.contact.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
						'class'		=> array()
					),
					'delete'	=> array(
						'href' 		=> site_url('contacts/delete/'.serialize_object(array( SYS_CONTACT_ID => $qrow->contact_id, SYS_REF_ID => $qrow->ref_id, SYS_CONTACT_TYPE_ID => $qrow->contact_type_id)) ),
						'title'		=> 'Delete Contact <small>'.$qrow->full_name.'</small>',
						'text'		=> 'Delete Contact',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Contact (<small>'.$qrow->full_name.'</small>)", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.contact.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
						'class'		=> array()
					)
				))
			);
        }

        echo json_encode($qrows);
    }
    
	public function create($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'user_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$type_id = ((isset($params[SYS_CONTACT_TYPE_ID]) && gtzero_integer($params[SYS_CONTACT_TYPE_ID])) ? to_int($params[SYS_CONTACT_TYPE_ID]) : 0);
		$ref_id = ((isset($params[SYS_REF_ID]) && gtzero_integer($params[SYS_REF_ID])) ? to_int($params[SYS_REF_ID]) : 0);
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|xss_clean');
		$this->form_validation->set_rules('fax', 'Fax', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
		$this->form_validation->set_rules('is_default', 'Default', 'trim');
		
		$output = array( 'message' => "", 'status' => "");

        if ($method != 'echo' && $this->form_validation->run() == TRUE) {
			
			$is_default	= (($is_default = $this->input->post('is_default')) && gtzero_integer($is_default)) ? 1 : 0;
			
			$input = array(
                "contact_type_id" 	=> $type_id
				,"first_name" 		=> $this->_post_args('first_name', ARGS_TYPE_STRING)
				,"last_name" 		=> $this->_post_args('last_name', ARGS_TYPE_STRING)
                ,"address" 			=> $this->_post_args('address', ARGS_TYPE_STRING)
                ,"postcode" 		=> $this->_post_args('postcode', ARGS_TYPE_STRING)
				,"email" 			=> $this->_post_args('email', ARGS_TYPE_STRING)
				,"phone" 			=> $this->_post_args('phone', ARGS_TYPE_STRING)
				,"mobile" 			=> $this->_post_args('mobile', ARGS_TYPE_STRING)
				,"fax" 				=> $this->_post_args('fax', ARGS_TYPE_STRING)
				,'created_by'		=> $this->current_user->user_id
            );
			
            $contact_id = $this->contact_m->add($input);
			
			if( gtzero_integer($contact_id) ){
			
				if($type_id == CONTACT_TYPE_COMPANY){
					
					$this->contact_m->update_company_contact($ref_id, $contact_id, $is_default);
					
				} elseif($type_id == CONTACT_TYPE_CLIENT){
					
					$this->contact_m->update_client_contact($ref_id, $contact_id, $is_default);
					
				} elseif($type_id == CONTACT_TYPE_SITE){
					
					$this->contact_m->update_site_contact($ref_id, $contact_id, $is_default);
				}
			
				$output['message'] 	= sprintf('The contact "%s" was added.', $input['first_name'].' '.$input['last_name']);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['contact_id'] 	= $contact_id;
				
			} else {
				$output['message'] 	= sprintf('Unable to create contact record "%s". Please report the issue to %s', $input['first_name'].' '.$input['last_name'], $this->cfg->contact_email);
                $output['status'] 	= ERROR_MESSAGE;
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
			'form_action'			=> site_url('contacts/create/'.$pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'contacts/form'
            , 'title' 				=> 'Contact Detail'
			, 'submit_btn_text'		=> 'Save Changes'
			
			, "first_name" 			=> $this->_post_args('first_name', ARGS_TYPE_STRING)
			, "last_name" 			=> $this->_post_args('last_name', ARGS_TYPE_STRING)
			, "address" 			=> $this->_post_args('address', ARGS_TYPE_STRING)
			, "postcode" 			=> $this->_post_args('postcode', ARGS_TYPE_STRING)
			, "email" 				=> $this->_post_args('email', ARGS_TYPE_STRING)
			, "phone" 				=> $this->_post_args('phone', ARGS_TYPE_STRING)
			, "mobile" 				=> $this->_post_args('mobile', ARGS_TYPE_STRING)
			, "fax" 				=> $this->_post_args('fax', ARGS_TYPE_STRING)
			, "is_default" 			=> ($this->input->post('is_default') == 'Y') ? 1 : 0
			
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url))
			, 'scripts'				=> array('contact/form.js')
        );
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/contacts/form_modal', $data, TRUE);

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
	
	public function edit($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'user_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$type_id = ((isset($params[SYS_CONTACT_TYPE_ID]) && gtzero_integer($params[SYS_CONTACT_TYPE_ID])) ? to_int($params[SYS_CONTACT_TYPE_ID]) : 0);
		$ref_id = ((isset($params[SYS_REF_ID]) && gtzero_integer($params[SYS_REF_ID])) ? to_int($params[SYS_REF_ID]) : 0);
		$contact_id = ((isset($params[SYS_CONTACT_ID]) && gtzero_integer($params[SYS_CONTACT_ID])) ? to_int($params[SYS_CONTACT_ID]) : 0);
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());

		$contact_info = $this->contact_m->details($contact_id, $ref_id, $type_id);
		
		if( !$contact_info) {
			$this->show_permission_denied_error($method);
		}

		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|xss_clean');
		$this->form_validation->set_rules('fax', 'Fax', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'Contact Email', 'trim|xss_clean');
		$this->form_validation->set_rules('is_default', 'Default', 'trim');
		
		$output = array( 'message' => "", 'status' => "");
        if ($this->form_validation->run() == TRUE) {
		
			$pis_default = to_int($contact_info->is_default);
			$is_default	= (($is_default = $this->input->post('is_default')) && gtzero_integer($is_default)) ? 1 : 0;
			
			$input = array(
				"first_name" 		=> $this->_post_args('first_name', ARGS_TYPE_STRING)
				,"last_name" 		=> $this->_post_args('last_name', ARGS_TYPE_STRING)
                ,"address" 			=> $this->_post_args('address', ARGS_TYPE_STRING)
                ,"postcode" 		=> $this->_post_args('postcode', ARGS_TYPE_STRING)
				,"email" 			=> $this->_post_args('email', ARGS_TYPE_STRING)
				,"phone" 			=> $this->_post_args('phone', ARGS_TYPE_STRING)
				,"mobile" 			=> $this->_post_args('mobile', ARGS_TYPE_STRING)
				,"fax" 				=> $this->_post_args('fax', ARGS_TYPE_STRING)
            );
		
			$is_record_updated = $this->contact_m->update($input, $contact_id);
			
			if($type_id == CONTACT_TYPE_COMPANY){
					
				$this->contact_m->update_company_contact($ref_id, $contact_id, $is_default);
				
			} elseif($type_id == CONTACT_TYPE_CLIENT){
				
				$this->contact_m->update_client_contact($ref_id, $contact_id, $is_default);
					
			} elseif($type_id == CONTACT_TYPE_SITE){
				
				$this->contact_m->update_site_contact($ref_id, $contact_id, $is_default);
			}
			
			if($is_record_updated){
			
				$contact_info = $this->contact_m->details($contact_id, $ref_id, $type_id);
			
				$output['message'] 		= sprintf('The contact "%s" was updated.', $contact_info->contact_name);
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['contact_id'] 	= $contact_id;
				
			} else {
				$output['message'] 		= sprintf('Unable to contact "%s". Please report the issue to %s', $contact_info->contact_name, $this->cfg->contact_email);
                $output['status'] 		= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$doc_key =  $this->_post_args('doc_key', ARGS_TYPE_STRING) ?  $this->_post_args('doc_key', ARGS_TYPE_STRING) : keygen();
		$csrf = _get_csrf_nonce();
		
		$data = array(
			'form_action'				=> site_url('contacts/edit/'.$pkey)
			, 'cancel_url'				=> $redirect_url
            , 'page' 					=> 'contacts/form'
            , 'title' 					=> 'Contact Detail'
			, 'submit_btn_text'			=> 'Save Changes'
			
			, "first_name" 				=> $this->_post_args('first_name', ARGS_TYPE_STRING, $contact_info->first_name)
			, "last_name" 				=> $this->_post_args('last_name', ARGS_TYPE_STRING, $contact_info->last_name)
			, "address" 				=> $this->_post_args('address', ARGS_TYPE_STRING, $contact_info->address)
			, "postcode" 				=> $this->_post_args('postcode', ARGS_TYPE_STRING, $contact_info->postcode)
			, "email" 					=> $this->_post_args('email', ARGS_TYPE_STRING, $contact_info->email)
			, "phone" 					=> $this->_post_args('phone', ARGS_TYPE_STRING, $contact_info->phone)
			, "mobile" 					=> $this->_post_args('mobile', ARGS_TYPE_STRING, $contact_info->mobile)
			, "fax" 					=> $this->_post_args('fax', ARGS_TYPE_STRING, $contact_info->fax)
			, 'is_default' 				=> $this->_post_args('is_default', ARGS_TYPE_INT, $contact_info->is_default)
			, 'hiddenvars'				=> array_merge($csrf, array('redirect_url' => $redirect_url))
			, 'doc_key'					=> $doc_key
			, 'scripts'					=> array('contact/form.js')
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/contacts/form_modal', $data, TRUE);

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

    public function delete($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'location_manager', 'user_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$type_id = ((isset($params[SYS_CONTACT_TYPE_ID]) && gtzero_integer($params[SYS_CONTACT_TYPE_ID])) ? to_int($params[SYS_CONTACT_TYPE_ID]) : 0);
		$ref_id = ((isset($params[SYS_REF_ID]) && gtzero_integer($params[SYS_REF_ID])) ? to_int($params[SYS_REF_ID]) : 0);
		$contact_id = ((isset($params[SYS_CONTACT_ID]) && gtzero_integer($params[SYS_CONTACT_ID])) ? to_int($params[SYS_CONTACT_ID]) : 0);
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());

		$contact_info = $this->contact_m->details($contact_id, $ref_id, $type_id);
		
		if( !$contact_info) {
			$this->show_permission_denied_error($method);
		}
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			$is_record_updated = $this->contact_m->delete($contact_id);
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The contact "%s" has been deleted.', $contact_info->contact_name);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['contact_id'] 	= $contact_id;
				
			} else {
				$output['message'] 	= sprintf('Error occurred while trying to delete contact "%s".', $contact_info->contact_name);
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$doc_key =  $this->_post_args('doc_key', ARGS_TYPE_STRING) ?  $this->_post_args('doc_key', ARGS_TYPE_STRING) : keygen();
		$csrf = _get_csrf_nonce();
		
		$data = array(
			'form_action'			=> site_url('contacts/delete/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'contacts/delete'
			, 'title' 				=> 'Contact "'.$contact_info->contact_name.'"'
			, "display_message"		=> sprintf('Are you sure you want to delete contact "%s"?',$contact_info->contact_name)
			, "display_heading"		=> sprintf('Delete contact', $contact_info->contact_name)
			, "submit_btn_text"		=> "Save Changes"
			, 'hiddenvars'				=> array_merge($csrf, array('redirect_url' => $redirect_url))
			, 'doc_key'					=> $doc_key
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/contacts/delete_modal', $data, TRUE);

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
}

?>
