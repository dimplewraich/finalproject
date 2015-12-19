<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agencies extends Admin_Controller {

    public function __construct() {
        parent::__construct();
		
    }
	
	public function index($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'staff'));

        $params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();	
		
        $data = array(
			'page'					=> 'companies/listing'
			,'title'				=> 'Agencies'
			,'new_company_url'		=> site_url('agencies/create/'.serialize_object(array()))
			,'grid_action'			=> ($this->input->is_ajax_request()) ? site_url("agencies/getTable/".$pkey) : site_url("agencies/getTable/".$pkey)
			,'scripts'				=> array('companies/index.js')
		);

        if ($this->input->is_ajax_request()) {

            echo $this->template->raw_view('pages/companies/listing_modal', $data, TRUE);
			
        } else {
		
            $this->template->load('default', $data);
        }
    }
	
	public function getTable($pkey = '') {
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();	

		$input = array(
			'iDisplayStart' 	=> $this->_post_args('iDisplayStart', ARGS_TYPE_INT)
			,'iDisplayLength' 	=> $this->_post_args('iDisplayLength', ARGS_TYPE_INT, 0, array('gtzero' => FALSE))
			,'iSortCol_0' 		=> $this->_post_args('iSortCol_0', ARGS_TYPE_STRING)
			,'iSortingCols' 	=> $this->_post_args('iSortingCols', ARGS_TYPE_INT)
			,'sSearch' 			=> $this->_post_args('sSearch', ARGS_TYPE_STRING)
			,'sEcho' 			=> $this->_post_args('sEcho', ARGS_TYPE_STRING)
			
        );

        $listing = $this->company_m->ajax_get_parts($input);
		
		
        foreach ($listing['aaData'] as &$qrow) {
		
			$company_id = $qrow->company_id;
			$company_name = $qrow->company_name;
			
			$actions = array();
			
			$actions['view'] = array(
					'href' 		=> site_url('agencies/show/'.serialize_object(array( SYS_COMPANY_ID => $qrow->company_id))),
					'title'		=> 'Agency Detail (<small>'.$company_name.'</small>)',
					'text'		=> 'Agency Detail',
					'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Agency Detail <small>'.$company_name.'</small>", "modal" : {"buttons" : false}, "params" : "echo"}\'',
					'class'		=> array()
				);
				
			if($this->current_user->group_id == GROUP_ADMIN) {
				$actions['edit'] = array(
						'href' 		=> site_url('agencies/edit/'.serialize_object(array( SYS_COMPANY_ID => $qrow->company_id))),
						'title'		=> 'Agency Detail (<small>'.$company_name.'</small>)',
						'text'		=> 'Edit Agency',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Agency Detail <small>'.$company_name.'</small>", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "updateData();"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
						'class'		=> array()
					);
				
				
				$actions['delete'] = array(
						'href' 		=> site_url('agencies/delete/'.serialize_object(array( SYS_COMPANY_ID => $qrow->company_id))),
						'title'		=> 'Agency <small>'.$company_name.'</small>',
						'text'		=> 'Delete Agency',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Agency Detail <small>'.$company_name.'</small>", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "updateData();"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
						'class'		=> array()
					);
			
			} 
			/*
			if( in_array($this->current_user->group_id, array(GROUP_ADMIN)) ) {
				$actions['contacts'] = array(
							'href' 		=> site_url('contacts/index/'.serialize_object(array( SYS_REF_ID => $qrow->company_id, SYS_CONTACT_TYPE_ID => CONTACT_TYPE_COMPANY) )),
							'title'		=> 'Contacts <small>(Client: '.$company_name.')</small>',
							'text'		=> 'Contacts',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Contacts <small>(Agency: '.$company_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "gl.contact.listing.close_grid(g);", "callback" : "gl.contact.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
							'class'		=> array()
						);
			
			}
			
			if( in_array($this->current_user->group_id, array(GROUP_ADMIN)) ) {
				$actions['new_contact'] = array(
							'href' 		=> site_url('contacts/create/'.serialize_object(array( SYS_REF_ID => $qrow->company_id, SYS_CONTACT_TYPE_ID => CONTACT_TYPE_COMPANY))),
							'title'		=> 'Contact Detail <small>(Client: '.$company_name.')</small>',
							'text'		=> 'New Contact',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "POST", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Contact Detail <small>(Agency: '.$company_name.')</small>", "modal" : {"buttons" : true}, "params" : "echo"}\'',
							'class'		=> array()
						);
			
			}
			*/
			
			$qrow = array(
				$qrow->company_name, 
				$qrow->address,
				!empty($qrow->gmt_offset) ? _date_lang_shorttag($qrow->gmt_offset) : '', 
				($this->current_user->group_id == GROUP_ADMIN) ? theme_anchor_button(array(
						'type'		=> BUTTON_TYPE_ANCHOR,
						'href' 		=> gtzero_integer($qrow->active) ? site_url("agencies/deactivate/".serialize_object(array( SYS_COMPANY_ID => $qrow->company_id))) : site_url("agencies/activate/". serialize_object(array( SYS_COMPANY_ID => $qrow->company_id))),
						'title'		=> gtzero_integer($qrow->active) ? 'De-activate Agency' : 'Activate Agency',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "'.( gtzero_integer($qrow->active) ? 'Deactivate' : 'Activate').' Agency <small>'.$company_name.'</small>", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "updateData();"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
						'class'		=> implode(' ', array(NOICON_BUTTON,( gtzero_integer($qrow->active) ? 'btn-success' : 'btn-danger'), 'btn-xs btip')),
						'icon'		=> ICON_STATUS_CHANGE.' mr5',
						'text'		=> (gtzero_integer($qrow->active) ? 'Active' : 'Inactive')
					)) : (gtzero_integer($qrow->active) ? 'Active' : 'Inactive'),
				local_time($qrow->created_on,'M d, Y @ h:ia'),
				$qrow->created_by_name,
				theme_button_dropdown($actions)
			);
        }

        echo json_encode($listing);
    }
    
	public function create($pkey='', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$this->form_validation->set_rules('name', 'Agency Name', 'required|callback__check_name[0]|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
        //$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
        //$this->form_validation->set_rules('contact_first_name', 'Contact First Name', 'trim|xss_clean');
		//$this->form_validation->set_rules('contact_last_name', 'Contact Last Name', 'trim|xss_clean');
        //$this->form_validation->set_rules('contact_email', 'Contact Email', 'xss_clean|valid_email');
		//$this->form_validation->set_rules('gmt_offset', 'Timezone', 'required|xss_clean');
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
		
			$input = array(
                'name'                  	=> $this->_post_args('name', ARGS_TYPE_STRING)
                , 'address'               	=> $this->_post_args('address', ARGS_TYPE_STRING)
                //, 'phone'                 	=> $this->_post_args('phone', ARGS_TYPE_STRING)
				, 'active' 					=> $this->_post_args('active', ARGS_TYPE_INT)
				,'created_by' 				=> $this->current_user->user_id
            );
			
			$company_logo = $this->_post_args('company_logo_img', ARGS_TYPE_STRING);
			
			if( array_key_exists('company_logo_img', $_POST) && !empty($company_logo) ){
				$input['logo'] = $company_logo;
			} elseif( ($company_logo = $this->upload_logo()) && empty($company_logo['error']) && !empty($company_logo['file_name']) ) {
				$input['logo'] = $company_logo['file_name'];
			}

            $company_id = $this->company_m->add_company($input);
			
			if( $company_id> 0 ){
				
				$this->company_m->update_company_settings(array(
					'gmt_offset' 	=> $this->_post_args('gmt_offset', ARGS_TYPE_STRING, $this->cfg->gmt_offset, array('override' => TRUE))
				), $company_id);
				
			
				/*$this->load->model('contact_model', 'contact_m');
				
				$contact_id = $this->contact_m->add(array(
					'contact_type_id' 	=> CONTACT_TYPE_COMPANY
					, 'first_name' 		=> $this->_post_args('contact_first_name', ARGS_TYPE_STRING)
					, 'last_name' 		=> $this->_post_args('contact_last_name', ARGS_TYPE_STRING)
					, 'address' 		=> $this->_post_args('contact_address', ARGS_TYPE_STRING)
					, 'email' 			=> $this->_post_args('contact_email', ARGS_TYPE_STRING)
					, 'phone' 			=> $this->_post_args('contact_phone', ARGS_TYPE_STRING)
					, 'mobile' 			=> $this->_post_args('contact_mobile', ARGS_TYPE_STRING)
					, 'fax' 			=> $this->_post_args('contact_fax', ARGS_TYPE_STRING)
					,'created_by'		=> $this->current_user->user_id
				));
				
				$this->contact_m->update_company_contact($company_id, $contact_id, 1);
				
				$this->load->model('notes_model', 'notes_m');
				
				$note_id = $this->notes_m->add_note(array(
					'note_type_id' 		=> NOTE_TYPE_COMPANY
					,'note' 			=> $this->_post_args('notes', ARGS_TYPE_STRING)
					,'created_by'		=> $this->current_user->user_id
				));
				
				$this->notes_m->add_company_note($company_id, $note_id);*/
			
				$output['message'] 		= sprintf('The Agency "%s" was added.', $input['name']);
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['company_id'] 	= $company_id;
				
				/*trigger_trip("new_company", 0, array('company_id' => $company_id, 'created_by' => $this->current_user->user_id));*/
			} else {
				$output['message'] 	= sprintf('Unable to Create Account Information for Agency "%s". Please report the issue to %s', $input['name'], $this->cfg->contact_email);
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
			'form_action'				=> site_url('agencies/create/'.$pkey)
			,'cancel_url'				=> $redirect_url
            , 'page' 					=> 'companies/form'
            , 'title' 					=> 'Agency Detail'
			, 'submit_btn_text'			=> 'Save changes'
			
			, 'logo'					=> $this->_post_args('company_logo_img', ARGS_TYPE_STRING)
			
			, 'name' 					=> $this->_post_args('name', ARGS_TYPE_STRING)
			, 'address' 				=> $this->_post_args('address', ARGS_TYPE_STRING)
			//, 'phone' 					=> $this->_post_args('phone', ARGS_TYPE_STRING)
			, 'active' 					=> $this->_post_args('active', ARGS_TYPE_INT, 1)
			, 'gmt_offset' 				=> $this->_post_args('gmt_offset', ARGS_TYPE_STRING, $this->cfg->gmt_offset)
			
			//, 'contact_first_name' 		=> $this->_post_args('contact_first_name', ARGS_TYPE_STRING)
			//, 'contact_last_name' 		=> $this->_post_args('contact_last_name', ARGS_TYPE_STRING)
			//, 'contact_address' 		=> $this->_post_args('contact_address', ARGS_TYPE_STRING)
			//, 'contact_email' 			=> $this->_post_args('contact_email', ARGS_TYPE_STRING)
			//, 'contact_phone' 			=> $this->_post_args('contact_phone', ARGS_TYPE_STRING)
			//, 'contact_mobile' 			=> $this->_post_args('contact_mobile', ARGS_TYPE_STRING)
			//, 'contact_fax' 			=> $this->_post_args('contact_fax', ARGS_TYPE_STRING)

			, 'scripts'					=> array('companies/form.js')
			, 'hiddenvars'				=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/companies/form_modal', $data, TRUE);

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
	
	public function edit($pkey='', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = (isset($params[SYS_COMPANY_ID]) && gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$company_info = $this->company_m->details($company_id);
		
		if( !$company_info ) {
			$this->show_permission_denied_error($method);
		}
		
		$this->form_validation->set_rules('name', 'Agency Name', 'required|callback__check_name['.$company_id.']|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
        //$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
        //$this->form_validation->set_rules('contact_first_name', 'Contact First Name', 'trim|xss_clean');
		//$this->form_validation->set_rules('contact_last_name', 'Contact Last Name', 'trim|xss_clean');
        //$this->form_validation->set_rules('contact_email', 'Contact Email', 'xss_clean|valid_email');
		//$this->form_validation->set_rules('gmt_offset', 'Timezone', 'required|xss_clean');
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
		
			$input = array(
                'name'                  	=> $this->_post_args('name', ARGS_TYPE_STRING)
                , 'address'               	=> $this->_post_args('address', ARGS_TYPE_STRING)
                //, 'phone'                 	=> $this->_post_args('phone', ARGS_TYPE_STRING)
				, 'active' 					=> $this->_post_args('active', ARGS_TYPE_INT)
            );
			
			$company_logo = $this->_post_args('company_logo_img', ARGS_TYPE_STRING);
			
			if( array_key_exists('company_logo_img', $_POST) && !empty($company_logo) ){
				$input['logo'] = $company_logo;
			} elseif( ($company_logo = $this->upload_logo()) && empty($company_logo['error']) && !empty($company_logo['file_name']) ) {
				$input['logo'] = $company_logo['file_name'];
			}

            $is_record_updated = $this->company_m->update($input, $company_id);
			
			$this->company_m->update_company_settings(array(
				'gmt_offset' 	=> $this->_post_args('gmt_offset', ARGS_TYPE_STRING, $this->cfg->gmt_offset, array('override' => TRUE))
			), $company_id);
			
		
			/*$this->load->model('contact_model', 'contact_m');
			
			$contact_id = 0;$is_default = 0;
			if( gtzero_integer($company_info->contact_id) ){
			
				$this->contact_m->update(array(
					'first_name' 		=> array_key_exists('contact_first_name', $_POST) ? $this->_post_args('contact_first_name', ARGS_TYPE_STRING) : $company_info->contact_first_name
					, 'last_name' 		=> array_key_exists('contact_last_name', $_POST) ? $this->_post_args('contact_last_name', ARGS_TYPE_STRING) : $company_info->contact_last_name
					, 'address' 		=> array_key_exists('contact_address', $_POST) ? $this->_post_args('contact_address', ARGS_TYPE_STRING) : $company_info->contact_address
					, 'email' 			=> array_key_exists('contact_email', $_POST) ? $this->_post_args('contact_email', ARGS_TYPE_STRING) : $company_info->contact_email
					, 'phone' 			=> array_key_exists('contact_phone', $_POST) ? $this->_post_args('contact_phone', ARGS_TYPE_STRING) : $company_info->contact_phone
					, 'mobile' 			=> array_key_exists('contact_mobile', $_POST) ? $this->_post_args('contact_mobile', ARGS_TYPE_STRING) : $company_info->contact_mobile
					, 'fax' 			=> array_key_exists('contact_fax', $_POST) ? $this->_post_args('contact_fax', ARGS_TYPE_STRING) : $company_info->contact_fax
				), $company_info->contact_id);
				
				$contact_id = $company_info->contact_id;
				$is_default = $company_info->is_default;
			} else {
			
				$contact_id = $this->contact_m->add(array(
					'contact_type_id' 	=> CONTACT_TYPE_COMPANY
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
				
			$this->contact_m->update_company_contact($company_id, $contact_id, $is_default);*/
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The Agency "%s" was updated.', $company_info->name);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['company_id'] 	= $company_id;
				
				/*trigger_trip("company_updated", 0, array('company_id' => $company_id, 'updated_by' => $this->current_user->user_id));*/
			} else {
				$output['message'] 	= sprintf('Unable to Update Account Information for Agency "%s". Please report the issue to %s', $company_info->name, $this->cfg->contact_email);
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= strip_tags(validation_errors());
                $output['status'] 	= ERROR_MESSAGE;
			}
			
		}
		
		$doc_key =  $this->_post_args('doc_key', ARGS_TYPE_STRING) ?  $this->_post_args('doc_key', ARGS_TYPE_STRING) : keygen();
		$csrf = _get_csrf_nonce();

        $data = array(
			'form_action'				=> site_url('agencies/edit/'.$pkey)
			,'cancel_url'				=> $redirect_url
            , 'page' 					=> 'companies/form'
            , 'title' 					=> 'Edit Agency'
			, 'submit_btn_text'			=> 'Save Changes'
			
			, 'logo'					=> $company_info->logo
			
			, 'name' 					=> $this->_post_args('name', ARGS_TYPE_STRING, $company_info->name)
			, 'address' 				=> $this->_post_args('address', ARGS_TYPE_STRING, $company_info->address)
			//, 'phone' 					=> $this->_post_args('phone', ARGS_TYPE_STRING, $company_info->phone)
			, 'active' 					=> $this->_post_args('active', ARGS_TYPE_INT, $company_info->active)
			, 'gmt_offset' 				=> $this->_post_args('gmt_offset', ARGS_TYPE_STRING, $this->cfg->gmt_offset)
			
			//, 'contact_first_name' 		=> $this->_post_args('contact_first_name', ARGS_TYPE_STRING, $company_info->contact_first_name)
			//, 'contact_last_name' 		=> $this->_post_args('contact_last_name', ARGS_TYPE_STRING, $company_info->contact_last_name)
			//, 'contact_address' 		=> $this->_post_args('contact_address', ARGS_TYPE_STRING, $company_info->contact_address)
			//, 'contact_email' 			=> $this->_post_args('contact_email', ARGS_TYPE_STRING, $company_info->contact_email)
			//, 'contact_phone' 			=> $this->_post_args('contact_phone', ARGS_TYPE_STRING, $company_info->contact_phone)
			//, 'contact_mobile' 			=> $this->_post_args('contact_mobile', ARGS_TYPE_STRING, $company_info->contact_mobile)
			//, 'contact_fax' 			=> $this->_post_args('contact_fax', ARGS_TYPE_STRING, $company_info->contact_fax)

			, 'scripts'					=> array('companies/form.js')
			, 'hiddenvars'				=> array_merge($csrf, array('redirect_url' => $redirect_url))
			, 'doc_key'					=> $doc_key
        );
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/companies/form_modal', $data, TRUE);

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
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = (isset($params[SYS_COMPANY_ID]) && gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$company_info = $this->company_m->details($company_id);
		
		if( !$company_info ) {
			$this->show_permission_denied_error($method);
		}
		
		$doc_key =  $this->_post_args('doc_key', ARGS_TYPE_STRING) ?  $this->_post_args('doc_key', ARGS_TYPE_STRING) : keygen();
		$csrf = _get_csrf_nonce();
		
		$data = array(
			'form_action'				=> site_url('agencies/edit/'.$pkey)
			,'cancel_url'				=> $redirect_url
            , 'page' 					=> 'companies/show'
            , 'title' 					=> 'Edit Agency'
			, 'submit_btn_text'			=> 'Save Changes'
			
			, 'logo'					=> $company_info->logo
			
			, 'name' 					=> $company_info->name
			, 'address' 				=> $company_info->address
			//, 'phone' 					=> $company_info->phone
			, 'active' 					=> $company_info->active
			, 'gmt_offset' 				=> $company_info->gmt_offset
			
			//, 'contact_name' 			=> $company_info->contact_name
			//, 'contact_first_name' 		=> $company_info->contact_first_name
			//, 'contact_last_name' 		=> $company_info->contact_last_name
			//, 'contact_address' 		=> $company_info->contact_address
			//, 'contact_email' 			=> $company_info->contact_email
			//, 'contact_phone' 			=> $company_info->contact_phone
			//, 'contact_mobile' 			=> $company_info->contact_mobile
			//, 'contact_fax' 			=> $company_info->contact_fax

			, 'scripts'					=> array('companies/show.js')
			, 'hiddenvars'				=> array_merge($csrf, array('redirect_url' => $redirect_url))
			, 'doc_key'					=> $doc_key
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/companies/show_modal', $data, TRUE);

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
	
	public function activate($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = (isset($params[SYS_COMPANY_ID]) && gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$company_info = $this->company_m->details($company_id);
		
		if( !$company_info ) {
			$this->show_permission_denied_error($method);
		}
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			$input = array(
                'active' => 1
            );

            $is_record_updated = $this->company_m->update($input, $company_id);
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The agency "%s" has been activated.', $company_info->name);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['company_id'] 	= $company_id;
			
				/*trigger_trip("company_activated", $company_id, array('company_id' => $company_id, 'updated_by' => $this->current_user->user_id));*/
				
			} else {
				$output['message'] 	= sprintf('Error occurred while trying to activate agency "%s".', $company_info->name);
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
		
		//array($this->security->get_csrf_token_name() => $this->security->get_csrf_hash())
		
		$data = array(
			'form_action'			=> site_url('agencies/activate/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'companies/confirm'
			, 'title' 				=> 'Activate Agency'
			, 'display_message'		=> sprintf('Are you sure you want to activate agency "%s"?', $company_info->name)
			, 'display_heading'		=> sprintf('Activate Agency', $company_info->name)
			, 'submit_btn_text'		=> "Save Changes"
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/companies/confirm_modal', $data, TRUE);

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
	
	public function deactivate($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = (isset($params[SYS_COMPANY_ID]) && gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$company_info = $this->company_m->details($company_id);
		
		if( !$company_info ) {
			$this->show_permission_denied_error($method);
		}
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			$input = array(
                'active' => 0
            );

            $is_record_updated = $this->company_m->update($input, $company_id);
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The agency "%s" has been deactivated.', $company_info->name);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['company_id'] 	= $company_id;
			
				/*trigger_trip("agency_activated", $company_id, array('company_id' => $company_id, 'updated_by' => $this->current_user->user_id));*/
				
			} else {
				$output['message'] 	= sprintf('Error occurred while trying to deactivated agency "%s".', $company_info->name);
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
			'form_action'			=> site_url('agencies/deactivate/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'companies/confirm'
			, 'title' 				=> 'Deactivate Agency'
			, 'display_message'		=> sprintf('Are you sure you want to deactivate agency "%s"?', $company_info->name)
			, 'display_heading'		=> sprintf('Deactivate Agency', $company_info->name)
			, 'submit_btn_text'		=> "Save Changes"
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/companies/confirm_modal', $data, TRUE);

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
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = (isset($params[SYS_COMPANY_ID]) && gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$company_info = $this->company_m->details($company_id);
		
		if( !$company_info ) {
			$this->show_permission_denied_error($method);
		}
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			$is_record_updated = $this->company_m->delete($company_id);
			
			if($is_record_updated){
				$output['message'] 		= sprintf('The Agency "%s" has been deleted.', $company_info->name);
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['company_id'] 	= $company_id;
			
				/*trigger_trip("company_deleted", 0, array('company_id' => $company_id, 'deleted_by' => $this->current_user->user_id));*/
				
			} else {
				$output['message'] 	= sprintf('Unable to Delete Agency "%s" record. Please report the issue to %s', $company_info->name, $this->cfg->contact_email);
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
			'form_action'			=> site_url('agencies/delete/' . $pkey)
			, 'cancel_url'			=> $redirect_url
            , 'page' 				=> 'companies/delete'
			, 'title' 				=> 'Delete Agency'
			, 'display_message'		=> sprintf('Are you sure you want to delete Agency "%s"?', $company_info->name)
			, 'display_heading'		=> sprintf('Delete Agency', $company_info->name)
			, 'submit_btn_text'		=> 'Save Changes'
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/companies/delete_modal', $data, TRUE);

            if ($method == 'ajax') {
			
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

    public function get_all_companies() {
		_has_user_access_permission(TRUE, array('admin'));
	
		companies_dropdown('ajax');
    }

    public function refresh_settings($method = 'echo') {
		_has_user_access_permission(TRUE, array('admin'));
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => '', 'status' => '');
		
        if ($this->form_validation->run() == TRUE) {
		
			$is_record_updated = true;
			
			_clean_cache();
			_clean_cache(CACHE_DRIVER_FILE);
			
			if($is_record_updated){
				$output['message'] 		= sprintf('The system cache refreshed.');
                $output['status'] 		= SUCCESS_MESSAGE;
				
			} else {
				$output['message'] 	= sprintf('Error occurred while trying to delete system cache');
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$data = array(
			'form_action'			=> site_url('agencies/refresh_settings')
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'companies/delete'
			, 'title' 				=> 'Refresh Cache'
			, 'display_message'		=> sprintf('Are you sure you want to refresh cache?')
			, 'display_heading'		=> sprintf('Refresh Cache')
			, 'submit_btn_text'		=> 'Save Changes'
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/companies/delete_modal', $data, TRUE);

            if ($method == 'ajax') {
			
				$output['html']	= $html;
                $this->_output_request($output, $redirect_url);
				
            } else {
                echo $html;
            }
        } else {
		
            $this->template->load('default', $data);
        }
    }
	
	public function upload(){
		_has_user_access_permission(TRUE, array('admin'));
		
		$company_logo = $this->upload_logo();
				
		if( empty($company_logo['error']) && !empty($company_logo['file_name'])){
			
			$output = array(
				'status' 	=> SUCCESS_MESSAGE
				,'message'	=> 'Agency logo uploaded successfully'
				,'logo'		=> $company_logo['file_name']
			);
		} else {
			$output = array(
				'status' 	=> ERROR_MESSAGE
				,'message'	=> $company_logo['error']
			);
		}
		
		echo json_encode($output);
		
	}
	
	public function setting_detail($company_id = 0) {
		_has_user_access_permission(TRUE, array('admin', 'management_company'));
		
		$company_id = ($this->current_user->group_id == 1) ? $company_id : $this->current_user->company_id;
		
		$params = array(
			'com_settings' => $this->company_m->company_settings($company_id)
		);
		
		header('Content-Type: application/json');
		echo json_encode($params);
		die;
    }
	
	/**
	 * Callback method that checks the name of the category
	 *
	 * @param string $name The name to check
	 *
	 * @return bool
	 */
	public function _check_name($name = '', $company_id) {
		
		if ($this->company_m->check_name($name, $company_id)) {
		
			$this->form_validation->set_message('_check_name', sprintf('A Agency with the name "%s" already exists.', $name));

			return false;
		}

		return true;
	}
	
	protected function upload_logo(){
		
		$new_file_name = '';$error = '';
        if (isset($_FILES['company_logo']) && $_FILES['company_logo']['error'] == 0) {
           
			//upload and update the file
            $config['upload_path'] = './documents/companylogo/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            $config['max_size'] = '300'; // in KB


            $new_file_name = uniqid() . '.' . $this->get_file_extension($_FILES['company_logo']['name']);

            $config['file_name'] = $new_file_name;

            $this->load->library('upload', $config);
 
            if (!$this->upload->do_upload('company_logo')) {
				$new_file_name = '';
                $error = $this->upload->display_errors('', '');;
				
            } else {
			
                //Image Resizing
                $config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 300;
                $config['height'] = 110;

                $upload_data = $this->upload->data();
				
				 $this->load->library('image_lib', $config);

                 if (!$this->image_lib->resize()) {
                    $this->session->set_flashdata('message', $this->image_lib->display_errors('<p class="error">', '</p>'));
                } else {
                    
					$this->load->library('docs');
					$error = ( ($status = $this->docs->s3_upload($upload_data, 'companylogo/')) && $status) ? '' : 'Problem with CDN transfer';
					
				}
            }
        }
		
		return array('file_name' => $new_file_name, 'error' => $error);
	}

    protected function get_file_extension($file_name) {
	
        $image_array = explode('.', $file_name);
        return end($image_array);
		
    }
}

?>