<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('client_model', 'client_m');
    }

    public function index($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'user_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();		
		$company_id = ($this->current_user->group_id == 1) ? ((isset($params[SYS_COMPANY_ID]) && gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) : $this->current_user->company_id;
		
        $data = array(
			'page'				=> 'clients/listing'
			,'title'			=> 'Clients'
			,'company_id'		=> $company_id
			,'plugins'			=> array()
			,'new_client_url'	=> site_url('clients/create/'.serialize_object(array( SYS_COMPANY_ID => $company_id)))
			,'grid_action'		=> ($this->input->is_ajax_request()) ? site_url("clients/getTable/".$pkey) : site_url("clients/getTable")
			,'scripts'			=> array('clients/index.js')
		);

        if ($this->input->is_ajax_request()) {

            echo $this->template->raw_view('pages/clients/listing_modal', $data, TRUE);
			
        } else {
		
            $this->template->load('default', $data);
        }
    }

    public function getTable($pkey = '') {
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'user_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();		
		$company_id = ($this->current_user->group_id == 1) ? ((isset($params[SYS_COMPANY_ID]) && gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) : $this->current_user->company_id;
		
		$params = array(
			'iDisplayStart' 	=> $this->input->post('iDisplayStart', true)
			,'iDisplayLength' 	=> $this->input->post('iDisplayLength', true)
			,'iSortCol_0' 		=> $this->input->post('iSortCol_0', true)
			,'iSortingCols' 	=> $this->input->post('iSortingCols', true)
			,'sSearch' 			=> $this->input->post('sSearch', true)
			,'sEcho' 			=> $this->input->post('sEcho', true)
			,'company_id'		=> ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT, $company_id) : $this->current_user->company_id
			,'name' 			=> $this->_post_args('name', ARGS_TYPE_STRING)
			,'postcode' 		=> $this->_post_args('postcode', ARGS_TYPE_STRING)
			,'contact_name' 	=> $this->_post_args('contact_name', ARGS_TYPE_STRING)
        );
        
        $qrows = $this->client_m->ajax_gets($params);

        foreach ($qrows['aaData'] as &$qrow) {
		
			$actions = array();

			if( in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) {
				$actions['view'] = array(
							'href' 		=> site_url('clients/show/'.serialize_object(array( SYS_CLIENT_ID => $qrow->client_id))),
							'title'		=> 'Client Detail<small>'.$qrow->full_name.'</small>',
							'text'		=> 'Client Detail',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Client Detail <small>'.$qrow->full_name.'</small>", "modal" : {"buttons" : false, "size" : "modal-lg", "footer" : false, "wizard" : true}, "params" : "echo"}\'',
							'class'		=> array()
						);
			
			}
			
			if( in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) {
				$actions['edit'] = array(
							'href' 		=> site_url('clients/edit/'.serialize_object(array( SYS_CLIENT_ID => $qrow->client_id))),
							'title'		=> 'Client Detail<small>'.$qrow->full_name.'</small>',
							'text'		=> 'Edit Client',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Client Detail", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "modal_success_callback" : "gl.client.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
							'class'		=> array()
						);
			}
			
			if( in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) {
				$actions['delete'] = array(
							'href' 		=> site_url('clients/delete/'.serialize_object(array( SYS_CLIENT_ID => $qrow->client_id))),
							'title'		=> 'Client <small>'.$qrow->full_name.'</small>',
							'text'		=> 'Delete Client',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Delete Client <small>'.$qrow->full_name.'</small>", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.client.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
							'class'		=> array()
						);
			}
			
			/*if( in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) {
				$actions['notes'] = array(
							'href' 		=> site_url('notes/index/'.serialize_object(array( SYS_REF_ID => $qrow->client_id, SYS_NOTE_TYPE_ID => NOTE_TYPE_CLIENT) )),
							'title'		=> 'Notes <small>(Client: '.$qrow->full_name.')</small>',
							'text'		=> 'Notes',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Notes <small>(Client: '.$qrow->full_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "gl.note.listing.close_grid(g);", "callback" : "gl.note.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
							'class'		=> array()
						);
			
			}
			
			if( in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) {
				$actions['new_note'] = array(
							'href' 		=> site_url('notes/create/'.serialize_object(array( SYS_REF_ID => $qrow->client_id, SYS_NOTE_TYPE_ID => NOTE_TYPE_CLIENT))),
							'title'		=> 'New Note <small>(Client: '.$qrow->full_name.')</small>',
							'text'		=> 'New Note',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "POST", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Note Detail <small>(Client: '.$qrow->full_name.')</small>", "modal" : {"buttons" : true}, "params" : "echo"}\'',
							'class'		=> array()
						);
			
			}*/
			
			if( in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) {
				$actions['contacts'] = array(
							'href' 		=> site_url('contacts/index/'.serialize_object(array( SYS_REF_ID => $qrow->client_id, SYS_CONTACT_TYPE_ID => CONTACT_TYPE_CLIENT) )),
							'title'		=> 'Contacts <small>(Client: '.$qrow->full_name.')</small>',
							'text'		=> 'Contacts',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Contacts <small>(Client: '.$qrow->full_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "gl.contact.listing.close_grid(g);", "callback" : "gl.contact.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
							'class'		=> array()
						);
			
			}
			
			if( in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY)) ) {
				$actions['new_contact'] = array(
							'href' 		=> site_url('contacts/create/'.serialize_object(array( SYS_REF_ID => $qrow->client_id, SYS_CONTACT_TYPE_ID => CONTACT_TYPE_CLIENT))),
							'title'		=> 'Contact Detail <small>(Client: '.$qrow->full_name.')</small>',
							'text'		=> 'New Contact',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "POST", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Contact Detail <small>(Client: '.$qrow->full_name.')</small>", "modal" : {"buttons" : true}, "params" : "echo"}\'',
							'class'		=> array()
						);
			
			}
			
			$qrow = array(
				$qrow->full_name
				,$qrow->company_name
				,$qrow->address
				,$qrow->phone
				,$qrow->postcode
				,$qrow->contact_email
				,$qrow->created_by_name
				,local_time($qrow->created_on,'M d, Y @ h:ia')
				,theme_button_dropdown($actions)
			);
			
			if(_check_company_user_access()){
				unset($qrow[1]);
				$qrow = array_values($qrow);
			}
        }

        echo json_encode($qrows);
    }
    
	public function create($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'user_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		if( $this->current_user->group_id == 1 ) {
			$this->form_validation->set_rules('company_id', 'Company', 'required');
		}
		
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean');
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
		
			$input = array(
                'company_id' 				=> ($this->current_user->group_id == 1) ? $company_id : $this->current_user->company_id
				,'first_name' 				=> $this->_post_args('first_name', ARGS_TYPE_STRING)
				,'last_name' 				=> $this->_post_args('last_name', ARGS_TYPE_STRING)
                ,'address' 					=> $this->_post_args('address', ARGS_TYPE_STRING)
				,'postcode' 				=> $this->_post_args('postcode', ARGS_TYPE_STRING)
                ,'phone' 					=> $this->_post_args('phone', ARGS_TYPE_STRING)
				,'email' 					=> $this->_post_args('email', ARGS_TYPE_STRING)
                ,'created_by' 				=> $this->current_user->user_id
            );
			
			$profile_avatar = $this->_post_args('profile_avatar_img', ARGS_TYPE_STRING);
			
			if( array_key_exists('profile_avatar_img', $_POST) && !empty($profile_avatar) ){
				$input['avatar'] = $profile_avatar;
			} elseif( ($profile_avatar = $this->upload_avatar()) && empty($profile_avatar['error']) && !empty($profile_avatar['file_name']) ) {
				$input['avatar'] = $profile_avatar['file_name'];
			}

            $client_id = $this->client_m->add_client($input);
			
			if( $client_id > 0 ){
			
				$this->load->model('contact_model', 'contact_m');
				
				$contact_id = $this->contact_m->add(array(
					'contact_type_id' 	=> CONTACT_TYPE_CLIENT
					, 'first_name' 		=> $this->_post_args('contact_first_name', ARGS_TYPE_STRING)
					, 'last_name' 		=> $this->_post_args('contact_last_name', ARGS_TYPE_STRING)
					, 'address' 		=> $this->_post_args('contact_address', ARGS_TYPE_STRING)
					, 'email' 			=> $this->_post_args('contact_email', ARGS_TYPE_STRING)
					, 'phone' 			=> $this->_post_args('contact_phone', ARGS_TYPE_STRING)
					, 'mobile' 			=> $this->_post_args('contact_mobile', ARGS_TYPE_STRING)
					, 'fax' 			=> $this->_post_args('contact_fax', ARGS_TYPE_STRING)
					,'created_by'		=> $this->current_user->user_id
				));
				
				$this->contact_m->update_client_contact($client_id, $contact_id, 1);
				
				$this->load->model('notes_model', 'notes_m');
				
				$note_id = $this->notes_m->add_note(array(
					'note_type_id' 		=> NOTE_TYPE_CLIENT
					,'note' 			=> $this->_post_args('notes', ARGS_TYPE_STRING)
					,'created_by'		=> $this->current_user->user_id
				));
				
				$this->notes_m->add_client_note($client_id, $note_id);
				
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['message'] 		= sprintf('The client "%s" was added.', $input['first_name'].' '.$input['last_name']);
				$output['client_id'] 	= $client_id;
				
				/*trigger_trip("new_client", $company_id, array('client_id' => $client_id, 'created_by' => $this->current_user->user_id));*/
			} else {
				$output['message'] 		= sprintf('Unable to create client record "%s". Please report the issue to %s', $input['first_name'].' '.$input['last_name'], $this->cfg->contact_email);
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
			'form_action'				=> site_url('clients/create/'.$pkey)
			, 'cancel_url'				=> $redirect_url
            , 'page' 					=> 'clients/form'
            , 'title' 					=> 'Client Detail'
			, 'submit_btn_text'			=> 'Save Changes'
            , 'company_id' 				=> $company_id
			
			, 'first_name' 				=> $this->_post_args('first_name', ARGS_TYPE_STRING)
			, 'last_name' 				=> $this->_post_args('last_name', ARGS_TYPE_STRING)
			, 'address' 				=> $this->_post_args('address', ARGS_TYPE_STRING)
			, 'postcode' 				=> $this->_post_args('postcode', ARGS_TYPE_STRING)
			, 'phone' 					=> $this->_post_args('phone', ARGS_TYPE_STRING)
			, 'email' 					=> $this->_post_args('email', ARGS_TYPE_STRING)
			, 'avatar' 					=> ''
			
			, 'contact_first_name' 		=> $this->_post_args('contact_first_name', ARGS_TYPE_STRING)
			, 'contact_last_name' 		=> $this->_post_args('contact_last_name', ARGS_TYPE_STRING)
			, 'contact_address' 		=> $this->_post_args('contact_address', ARGS_TYPE_STRING)
			, 'contact_email' 			=> $this->_post_args('contact_email', ARGS_TYPE_STRING)
			, 'contact_phone' 			=> $this->_post_args('contact_phone', ARGS_TYPE_STRING)
			, 'contact_mobile' 			=> $this->_post_args('contact_mobile', ARGS_TYPE_STRING)
			, 'contact_fax' 			=> $this->_post_args('contact_fax', ARGS_TYPE_STRING)
			
			, 'notes' 					=> $this->_post_args('notes', ARGS_TYPE_STRING)
			
			, 'scripts'					=> array('clients/form.js')
			, 'hiddenvars'				=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/clients/form_modal', $data, TRUE);

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
		$company_id = ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$client_id = (isset($params[SYS_CLIENT_ID]) && gtzero_integer($params[SYS_CLIENT_ID])) ? (INT)$params[SYS_CLIENT_ID] : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		if( $this->current_user->group_id == 1 ) {
			$this->form_validation->set_rules('company_id', 'Company', 'required');
		}
		
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean');
		
		$client_info = $this->client_m->details($client_id, $company_id);
		
		if( !$client_info || (_has_company_group_access($this->current_user->group_id) && $client_info->company_id != $this->current_user->company_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT, $client_info->company_id ) : $this->current_user->company_id;

		$output = array( 'message' => "", 'status' => "");
        if ($this->form_validation->run() == TRUE) {
		
			$input = array(
                'company_id' 				=> ($this->current_user->group_id == 1) ? $company_id : $this->current_user->company_id
				,'first_name' 				=> $this->_post_args('first_name', ARGS_TYPE_STRING)
				,'last_name' 				=> $this->_post_args('last_name', ARGS_TYPE_STRING)
                ,'address' 					=> $this->_post_args('address', ARGS_TYPE_STRING)
				,'postcode' 				=> $this->_post_args('postcode', ARGS_TYPE_STRING)
                ,'phone' 					=> $this->_post_args('phone', ARGS_TYPE_STRING)
				,'email' 					=> $this->_post_args('email', ARGS_TYPE_STRING)
            );
			
			$profile_avatar = $this->_post_args('profile_avatar_img', ARGS_TYPE_STRING);
			
			if( array_key_exists('profile_avatar_img', $_POST) && !empty($profile_avatar) ){
				$input['avatar'] = $profile_avatar;
			} elseif( ($profile_avatar = $this->upload_avatar()) && empty($profile_avatar['error']) && !empty($profile_avatar['file_name']) ) {
				$input['avatar'] = $profile_avatar['file_name'];
			}
		
			$is_record_updated = $this->client_m->update($input, $client_id);
			
			$this->load->model('contact_model', 'contact_m');
			
			$contact_id = 0;$is_default = 0;
			if( gtzero_integer($client_info->contact_id) ){
			
				$this->contact_m->update(array(
					'first_name' 		=> array_key_exists('contact_first_name', $_POST) ? $this->_post_args('contact_first_name', ARGS_TYPE_STRING) : $client_info->contact_first_name
					, 'last_name' 		=> array_key_exists('contact_last_name', $_POST) ? $this->_post_args('contact_last_name', ARGS_TYPE_STRING) : $client_info->contact_last_name
					, 'address' 		=> array_key_exists('contact_address', $_POST) ? $this->_post_args('contact_address', ARGS_TYPE_STRING) : $client_info->contact_address
					, 'email' 			=> array_key_exists('contact_email', $_POST) ? $this->_post_args('contact_email', ARGS_TYPE_STRING) : $client_info->contact_email
					, 'phone' 			=> array_key_exists('contact_phone', $_POST) ? $this->_post_args('contact_phone', ARGS_TYPE_STRING) : $client_info->contact_phone
					, 'mobile' 			=> array_key_exists('contact_mobile', $_POST) ? $this->_post_args('contact_mobile', ARGS_TYPE_STRING) : $client_info->contact_mobile
					, 'fax' 			=> array_key_exists('contact_fax', $_POST) ? $this->_post_args('contact_fax', ARGS_TYPE_STRING) : $client_info->contact_fax
				), $client_info->contact_id);
				
				$contact_id = $client_info->contact_id;
				$is_default = $client_info->is_default;
			} else {
			
				$contact_id = $this->contact_m->add(array(
					'contact_type_id' 	=> CONTACT_TYPE_CLIENT
					, 'first_name' 		=> $this->_post_args('contact_first_name', ARGS_TYPE_STRING)
					, 'last_name' 		=> $this->_post_args('contact_last_name', ARGS_TYPE_STRING)
					, 'address' 		=> $this->_post_args('contact_address', ARGS_TYPE_STRING)
					, 'email' 			=> $this->_post_args('contact_email', ARGS_TYPE_STRING)
					, 'phone' 			=> $this->_post_args('contact_phone', ARGS_TYPE_STRING)
					, 'mobile' 			=> $this->_post_args('contact_mobile', ARGS_TYPE_STRING)
					, 'fax' 			=> $this->_post_args('contact_fax', ARGS_TYPE_STRING)
					,'created_by'		=> $this->current_user->user_id
				));
				
				$is_default = 1;
			}
				
			$this->contact_m->update_client_contact($client_id, $contact_id, $is_default);
			
			if($is_record_updated){
				$output['message'] 		= sprintf('The client "%s" was updated.', $client_info->full_name);
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['client_id'] 	= $client_id;
			
				/*trigger_trip("client_updated", $company_id, array('client_id' => $client_id, 'updated_by' => $this->current_user->user_id));*/
			} else {
				$output['message'] 		= sprintf('Unable to Update Account Information for client "%s". Please report the issue to %s', $client_info->full_name, $this->cfg->contact_email);
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
			"client_id"						=> $client_id
			, 'notes_listing_url'			=> site_url('notes/index/'.serialize_object(array( SYS_REF_ID => $client_id, SYS_NOTE_TYPE_ID => NOTE_TYPE_CLIENT) ))
			, 'form_action'					=> site_url('clients/edit/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'clients/form'
            , 'title' 						=> 'Client Detail'
			, 'submit_btn_text'				=> 'Save Changes'
            , 'company_id' 					=> $company_id
			
			, 'client_name' 				=> $client_info->full_name
			, 'first_name' 					=> $this->_post_args('first_name', ARGS_TYPE_STRING, $client_info->first_name)
			, 'last_name' 					=> $this->_post_args('last_name', ARGS_TYPE_STRING, $client_info->last_name)
			, 'address' 					=> $this->_post_args('address', ARGS_TYPE_STRING, $client_info->address)
			, 'postcode' 					=> $this->_post_args('postcode', ARGS_TYPE_STRING, $client_info->postcode)
			, 'phone' 						=> $this->_post_args('phone', ARGS_TYPE_STRING, $client_info->phone)
			, 'email' 						=> $this->_post_args('email', ARGS_TYPE_STRING, $client_info->email)
			, 'avatar' 						=> $client_info->avatar
			
			, 'contact_first_name' 			=> $this->_post_args('contact_first_name', ARGS_TYPE_STRING, $client_info->contact_first_name)
			, 'contact_last_name' 			=> $this->_post_args('contact_last_name', ARGS_TYPE_STRING, $client_info->contact_last_name)
			, 'contact_address' 			=> $this->_post_args('contact_address', ARGS_TYPE_STRING, $client_info->contact_address)
			, 'contact_email' 				=> $this->_post_args('contact_email', ARGS_TYPE_STRING, $client_info->contact_email)
			, 'contact_phone' 				=> $this->_post_args('contact_phone', ARGS_TYPE_STRING, $client_info->contact_phone)
			, 'contact_mobile' 				=> $this->_post_args('contact_mobile', ARGS_TYPE_STRING, $client_info->contact_mobile)
			, 'contact_fax' 				=> $this->_post_args('contact_fax', ARGS_TYPE_STRING, $client_info->contact_fax)
			
			, 'notes' 						=> $this->_post_args('notes', ARGS_TYPE_STRING)
			
			, 'scripts'						=> array('clients/form.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/clients/form_modal', $data, TRUE);

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
	
	public function show($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'user_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$client_id = (isset($params[SYS_CLIENT_ID]) && gtzero_integer($params[SYS_CLIENT_ID])) ? (INT)$params[SYS_CLIENT_ID] : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$client_info = $this->client_m->details($client_id, $company_id);
		
		if( !$client_info || (_has_company_group_access($this->current_user->group_id) && $client_info->company_id != $this->current_user->company_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT, $client_info->company_id ) : $this->current_user->company_id;

		
		$doc_key =  $this->_post_args('doc_key', ARGS_TYPE_STRING) ?  $this->_post_args('doc_key', ARGS_TYPE_STRING) : keygen();
		$csrf = _get_csrf_nonce();
		
		$data = array(
			"client_id"						=> $client_id
			, 'notes_listing_url'			=> site_url('notes/index/'.serialize_object(array( SYS_REF_ID => $client_id, SYS_NOTE_TYPE_ID => NOTE_TYPE_CLIENT) ))
			, 'form_action'					=> site_url('clients/edit/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'clients/show'
            , 'title' 						=> 'Client Detail'
			, 'submit_btn_text'				=> 'Save Changes'
            , 'company_id' 					=> $company_id
			, 'company_name' 				=> $client_info->company_name
			, 'client_name' 				=> $client_info->full_name
			, 'first_name' 					=> $client_info->first_name
			, 'last_name' 					=> $client_info->last_name
			, 'address' 					=> $client_info->address
			, 'postcode' 					=> $client_info->postcode
			, 'phone' 						=> $client_info->phone
			, 'email' 						=> $client_info->email
			, 'avatar' 						=> $client_info->avatar
			
			, 'contact_first_name' 			=> $client_info->contact_first_name
			, 'contact_last_name' 			=> $client_info->contact_last_name
			, 'contact_address' 			=> $client_info->contact_address
			, 'contact_email' 				=> $client_info->contact_email
			, 'contact_phone' 				=> $client_info->contact_phone
			, 'contact_mobile' 				=> $client_info->contact_mobile
			, 'contact_fax' 				=> $client_info->contact_fax
			
			, 'notes' 						=> $this->_post_args('notes', ARGS_TYPE_STRING)
			
			, 'scripts'						=> array('clients/show.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/clients/show_modal', $data, TRUE);

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
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'user_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$client_id = (isset($params[SYS_CLIENT_ID]) && gtzero_integer($params[SYS_CLIENT_ID])) ? (INT)$params[SYS_CLIENT_ID] : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$client_info = $this->client_m->details($client_id, $company_id);
		
		if( !$client_info || (_has_company_group_access($this->current_user->group_id) && $client_info->company_id != $this->current_user->company_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT, $client_info->company_id ) : $this->current_user->company_id;
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			$is_record_updated = $this->client_m->delete($client_id);
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The client "%s" has been deleted.', $client_info->full_name);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['client_id'] 	= $client_id;
			
				/*trigger_trip("client_deleted", $details->company_id, array('client_id' => $client_id, 'deleted_by' => $this->current_user->user_id));*/
				
			} else {
				$output['message'] 	= sprintf('Unable to delete client "%s". Please report the issue to %s', $client_info->full_name, $this->cfg->contact_email);
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
			'form_action'			=> site_url('clients/delete/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'clients/delete'
			, 'title' 				=> 'Delete Client'
			, "display_message"		=> sprintf('Are you sure you want to delete client "%s"?',$client_info->full_name)
			, "display_heading"		=> sprintf('Delete Client', $client_info->full_name)
			, "submit_btn_text"		=> "Save Changes"
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url, 'confirm' => 1))
        );
		

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/clients/delete_modal', $data, TRUE);

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

    public function get_clients_by_company_id() {
	
		$company_id = ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT) : $this->current_user->company_id;
	
        clients_dropdown(
			'ajax'
			,array( 'company_id' => $company_id)
		);
		
    }

    public function get_client_detail(){
		
		$company_id = $this->current_user->group_id == 1 ? $this->_post_args('company_id', ARGS_TYPE_INT) : $this->current_user->company_id;
		$client_id = $this->input->get_post('client_id', true);
		
		$details = $this->client_m->client_details_by_id($company_id,$client_id);
		
		echo json_encode($details);
	}
	
	public function upload(){
		_has_user_access_permission(TRUE, array('admin','management_company'));
		
		$profile_avatar = $this->upload_avatar();
				
		if( empty($profile_avatar['error'])){
			
			$output = array(
				'status' 	=> SUCCESS_MESSAGE
				,'message'	=> "Profile Image uploaded successfully"
				,'avatar'	=> $profile_avatar['file_name']
			);
		} else {
			$output = array(
				'status' 	=> ERROR_MESSAGE
				,'message'	=> $profile_avatar['error']
			);
		}
		
		echo json_encode($output);
	}
	
	protected function upload_avatar(){
		
		$new_file_name = "";$error = "";
        if (isset($_FILES['profile_avatar']) && $_FILES['profile_avatar']['error'] == 0) {
           
			$config['upload_path'] = './documents/profile/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            $config['max_size'] = '300';

            $new_file_name = uniqid() . '.' . $this->get_file_extension($_FILES['profile_avatar']['name']);

            $config['file_name'] = $new_file_name;

            $this->load->library('upload', $config);
 
            if (!$this->upload->do_upload('profile_avatar')) {
				$new_file_name = "";
                $error = $this->upload->display_errors('', '');;
				
            } else {
			
                $config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                $config['maintain_ratio'] = true;
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

    protected function get_file_extension($file_name) {
	
        $image_array = explode('.', $file_name);
        return end($image_array);
		
    }

    public function _is_valid_uk_postcode($postcode) {
	
        $pattern = "/^(GIR 0AA)|(((A[BL]|B[ABDHLNRSTX]?|C[ABFHMORTVW]|D[ADEGHLNTY]|E[HNX]?|F[KY]|G[LUY]?|H[ADGPRSUX]|I[GMPV]|JE|K[ATWY]|L[ADELNSU]?|M[EKL]?|N[EGNPRW]?|O[LX]|P[AEHLOR]|R[GHM]|S[AEGKLMNOPRSTY]?|T[ADFNQRSW]|UB|W[ADFNRSV]|YO|ZE)[1-9]?[0-9]|((E|N|NW|SE|SW|W)1|EC[1-4]|WC[12])[A-HJKMNPR-Y]|(SW|W)([2-9]|[1-9][0-9])|EC[1-9][0-9]) [0-9][ABD-HJLNP-UW-Z]{2})$/";
        
		if(empty($postcode)) return TRUE;
		
        if (preg_match($pattern, strtoupper($postcode))) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_is_valid_uk_postcode', 'Please enter a valid postcode');
            return FALSE;
        }
    }

    public function _validate_client_name($client_name, $pkey) {
	
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = (isset($params['company_id']) && gtzero_integer($params['company_id'])) ? (INT)$params['company_id'] : 0;
		$client_id = (isset($params['client_id']) && gtzero_integer($params['client_id'])) ? (INT)$params['client_id'] : 0;
	
		$count = $this->client_m->get_by_many(array('name' => $client_name, 'client_id_not' => $client_id), $company_id, 'COUNT');
		
        if( $count > 0 ) {
			$this->form_validation->set_message('_validate_client_name', 'The %s field must contain a unique value. Client name "'.$site_name.'" is already in use');
            return FALSE;
        }
		return TRUE;
    }
}

?>
