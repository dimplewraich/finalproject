<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model', 'user_m');
    }

	public function index($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin','management_company'));

		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();		
		$company_id = ($this->current_user->group_id == 1) ? ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) : $this->current_user->company_id;

        $data = array(
			'page'				=> 'user/listing'
			,'title'			=> 'Users'
			,'company_id'		=> $company_id
			,'plugins'			=> array()
			,'params'			=> $params
			,'new_user_url'		=> site_url('users/create/'.serialize_object(array( SYS_COMPANY_ID => $company_id)))
			,'grid_action'		=> ($this->input->is_ajax_request()) ? site_url("users/getTable/".$pkey) : site_url("users/getTable/".$pkey)
			,'scripts'			=> array('user/index.js')
		);

        if ($this->input->is_ajax_request()) {

            echo $this->template->raw_view('pages/user/listing_modal', $data, TRUE);
			
        } else {
		
            $this->template->load('default', $data);
        }
	}
	
	public function getTable($pkey = '') {
		_has_user_access_permission(TRUE, array('admin', 'management_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = ($this->current_user->group_id == 1) ? ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) : $this->current_user->company_id;
		
		$input = array(
			'iDisplayStart' 	=> $this->_post_args('iDisplayStart', ARGS_TYPE_INT)
			,'iDisplayLength' 	=> $this->_post_args('iDisplayLength', ARGS_TYPE_INT, 0, array('gtzero' => FALSE))
			,'iSortCol_0' 		=> $this->_post_args('iSortCol_0', ARGS_TYPE_STRING)
			,'iSortingCols' 	=> $this->_post_args('iSortingCols', ARGS_TYPE_INT)
			,'sSearch' 			=> $this->_post_args('sSearch', ARGS_TYPE_STRING)
			,'sEcho' 			=> $this->_post_args('sEcho', ARGS_TYPE_STRING)
			,'company_id'		=> ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT, $company_id, array('override' => TRUE)) : $this->current_user->company_id
			,'group_id'			=> $this->_post_args('group_id', ARGS_TYPE_INT)
        );
        
        $qrows = $this->user_m->ajax_gets($input);

        foreach ($qrows['aaData'] as &$qrow) {
		
			$actions = array(
				'view'		=> array(
					'href' 		=> site_url('users/show/'.serialize_object(array( SYS_USER_ID => $qrow->user_id))),
					'title'		=> 'User Detail (<small>'.$qrow->full_name.'</small>)',
					'text'		=> 'User Detail',
					'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "User Detail <small>'.$qrow->full_name.'</small>", "modal" : {"buttons" : false, "size" : ""}, "params" : "echo"}\'',
					'class'		=> array()
				),
				'edit'		=> array(
					'href' 		=> site_url('users/edit/'.serialize_object(array( SYS_USER_ID => $qrow->user_id))),
					'title'		=> 'User Detail (<small>'.$qrow->full_name.'</small>)',
					'text'		=> 'Edit User',
					'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "User Detail <small>'.$qrow->full_name.'</small>", "modal" : {"buttons" : true, "override" : true, "size" : "", "modal_success_callback" : "gl.user.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
					'class'		=> array()
				),
				'delete'	=> array(
					'href' 		=> site_url('users/delete/'.serialize_object(array( SYS_USER_ID => $qrow->user_id))),
					'title'		=> 'User <small>'.$qrow->full_name.'</small>',
					'text'		=> 'Delete User',
					'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "User Detail <small>'.$qrow->full_name.'</small>", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.user.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
					'class'		=> array()
				)
			);
			
			$qrow = array(
				$qrow->company_name
				,$qrow->full_name
				,$qrow->email
				,$qrow->phone
				,$qrow->group_description
				,($qrow->user_id == $this->current_user->user_id) ? (gtzero_integer($qrow->active) ? 'Active' : 'Inactive') : theme_anchor_button(array(
						'type'		=> BUTTON_TYPE_ANCHOR,
						'href' 		=> gtzero_integer($qrow->active) ? site_url("users/deactivate/".serialize_object(array( SYS_USER_ID => $qrow->user_id))) : site_url("users/activate/". serialize_object(array( SYS_USER_ID => $qrow->user_id))),
						'title'		=> gtzero_integer($qrow->active) ? 'De-activate User' : 'Activate User',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "'.( gtzero_integer($qrow->active) ? 'Deactivate' : 'Activate').' User <small>'.$qrow->full_name.'</small>", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.user.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
						'class'		=> implode(' ', array(NOICON_BUTTON,( gtzero_integer($qrow->active) ? 'btn-success' : 'btn-danger'), 'btn-xs btip')),
						'icon'		=> ICON_STATUS_CHANGE.' mr5',
						'text'		=> gtzero_integer($qrow->active) ? 'Active' : 'Inactive'
					))
				,local_time($qrow->created_on,'M d, Y @ h:ia')
				,($qrow->user_id == $this->current_user->user_id) ? '' : theme_button_dropdown($actions)
			);
			
			if(_check_company_user_access()){
				unset($qrow[0]);
				$qrow = array_values($qrow);
			}
        }

        echo json_encode($qrows);
    }
    
	public function create($pkey='', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'management_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = ($this->current_user->group_id == 1) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$group_id = $this->_post_args("group_id", ARGS_TYPE_INT);
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$this->form_validation->set_rules('group_id', 'Group', 'required|callback__check_user_group');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
		//$this->form_validation->set_rules('postcode', 'Postcode', 'trim|xss_clean');
		
		if( $this->current_user->group_id == GROUP_ADMIN ){
			$this->form_validation->set_rules('company_id', 'Agency', 'callback__check_user_company');
		}
        
        $this->form_validation->set_rules('client_ids', 'Client', 'callback__check_user_company_clients');
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
		
			$company_info = $this->company_m->company_detail($company_id);
			$company_settings = $this->company_m->company_settings($company_id);

            $username 	= strtolower($this->_post_args('first_name', ARGS_TYPE_STRING) . ' ' . $this->_post_args('last_name', ARGS_TYPE_STRING));
            $email 		= $this->_post_args('email', ARGS_TYPE_STRING);
            $password 	= $this->_post_args('password', ARGS_TYPE_STRING);
			//$gmt_offset = $this->_post_args('gmt_offset', ARGS_TYPE_STRING, ( $this->current_user->group_id == GROUP_ADMIN ) ? $this->current_user->gmt_offset : $company_settings->gmt_offset, array('override' => TRUE));
			
            $additional_data = array(
                'first_name' 		=> $this->_post_args('first_name', ARGS_TYPE_STRING)
                ,'last_name' 		=> $this->_post_args('last_name', ARGS_TYPE_STRING)
                ,'phone' 			=> $this->_post_args('phone', ARGS_TYPE_STRING)
                //,'workhours' 		=> $this->_post_args('workhours', ARGS_TYPE_STRING)
				//,'postcode' 		=> $this->_post_args('postcode', ARGS_TYPE_STRING)
				//,'gps_device_id' 	=> $this->_post_args('gps_device_id', ARGS_TYPE_STRING)
				//,'hourly_rate' 		=> $this->_post_args('hourly_rate', ARGS_TYPE_DECIMAL)
				,'gmt_offset'		=> $this->_post_args('gmt_offset', ARGS_TYPE_STRING, $this->cfg->gmt_offset, array('override' => TRUE))
            );
			
			/*$user_avatar = $this->_post_args('user_avatar_img', ARGS_TYPE_STRING);
			
			if( array_key_exists('user_avatar_img', $_POST) && !empty($user_avatar) ){
				
				$additional_data['avatar'] = $user_avatar;
			
			} elseif( ($user_avatar = $this->upload_avatar()) && empty($user_avatar['error']) && !empty($user_avatar['file_name']) ) {
				
				$additional_data['avatar'] = $user_avatar['file_name'];
			}*/

            $group = array($group_id);
		
            $user_id = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
			
			if( gtzero_integer($user_id) ){
			
				/**
				 *  if the user has a company and/or client associated with it, add them in their respective tables.
				 */
				if ( _has_company_group_access($group_id) && !_has_company_non_resources($group_id) ) {
					
					/* IF GROUP IS NOT CLIENT OR SITE USER , THEN DO THIS : */
					$this->user_m->update_user_company($user_id, $company_id, $group_id);
				}
				/**
				 *  if the user is a client or site user, add them in their respective tables.
				 */
				elseif (_has_company_non_resources($group_id)) {
					
					/* 
					 * IF GROUP IS CLIENT OR SITE USER , THEN DO THIS : 
					 * THIS STEP IS COMMENTED AS THIS NO LONGER NEEDED FOR SUCH CASES
					 * REMOVED AS NOT ADDING COMPANY FOR SITE OR CLIENT USERS
					 */
					
					$client_ids	= $this->_post_args('client_ids', ARGS_TYPE_ARRAY);
					$this->user_m->update_user_clients($user_id, $client_ids, $company_id);
				}
				
				$output['message'] 	= sprintf('The User "%s" was added.', $additional_data['first_name'].' '.$additional_data['last_name']);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['user_id'] 	= $user_id;
				
				//trigger_trip("new_user", $company_id, array('user_id' => $user_id, 'created_by' => $this->current_user->user_id));

			} else {
				$output['message'] 	= sprintf('Unable to create user "%s". Please report the issue to %s', $additional_data['first_name'].' '.$additional_data['last_name'], $this->cfg->contact_email);;
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
				$output['post_vars'] 	= $_POST;
			}
			
		}

		$doc_key =  $this->input->post('doc_key') ?  $this->input->post('doc_key') : keygen();
		$csrf = _get_csrf_nonce();
		
        $data = array(
			'user_id'				=> FALSE
			, 'form_action_type'		=> FORM_ACTION_ADD
			, 'form_action'				=> site_url('users/create/'.$pkey)
			, 'cancel_url'				=> $redirect_url
            , 'page' 					=> 'user/form'
            , 'title' 					=> 'User Detail'
			, 'submit_btn_text'			=> 'Save Changes'
			, 'company_id' 				=> $company_id
			, 'first_name' 				=> $this->_post_args('first_name', ARGS_TYPE_STRING)
			, 'last_name' 				=> $this->_post_args('last_name', ARGS_TYPE_STRING)
			, 'email' 					=> $this->_post_args('email', ARGS_TYPE_STRING)
			, 'phone' 					=> $this->_post_args('phone', ARGS_TYPE_STRING)
			//, 'gps_device_id' 			=> $this->_post_args('gps_device_id', ARGS_TYPE_STRING)
			//, 'workhours' 				=> $this->_post_args('workhours', ARGS_TYPE_STRING)
			//, 'postcode' 				=> $this->_post_args('postcode', ARGS_TYPE_STRING)
			, 'password' 				=> $this->_post_args('password', ARGS_TYPE_STRING)
			, 'password_confirm' 		=> $this->_post_args('password_confirm')
			, 'client_ids' 				=> $this->_post_args('client_ids', ARGS_TYPE_ARRAY)
			, 'group_id' 				=> $this->_post_args('group_id', ARGS_TYPE_INT)
			//, 'hourly_rate' 			=> $this->_post_args('hourly_rate', ARGS_TYPE_DECIMAL)
			//, 'gmt_offset'				=> $this->_post_args('gmt_offset', ARGS_TYPE_STRING, 'UTC', array('override' => TRUE))
			, 'scripts'					=> array('user/form.js')
			, 'hiddenvars'				=> array_merge($csrf, array('redirect_url' => $redirect_url))
			, 'doc_key'					=> $doc_key
        );
		
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/user/form_modal', $data, TRUE);

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
	
	public function edit($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'management_company'));
		
		$output = array( 'message' => "", 'status' => "");
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = ($this->current_user->group_id == GROUP_ADMIN) ? 0 : $this->current_user->company_id;
		$user_id = (isset($params[SYS_USER_ID]) && gtzero_integer($params[SYS_USER_ID])) ? to_int($params[SYS_USER_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$user_info = $this->user_m->details($user_id);
		
		if( !$user_info || (_has_company_group_access($this->current_user->group_id) && $user_info->company_id!= $this->current_user->company_id) || ($this->current_user->user_id == $user_id)) {
			$this->show_permission_denied_error($method);
		}

		$group_id = $this->_post_args("group_id", ARGS_TYPE_INT, $user_info->group_id);
		$company_id = ($this->current_user->group_id == GROUP_ADMIN) ? $this->_post_args('company_id', ARGS_TYPE_INT, $user_info->company_id) : $this->current_user->company_id;
		
		$this->form_validation->set_rules('group_id', 'Group', 'required|callback__check_user_group');
		
		if( $this->current_user->group_id == GROUP_ADMIN ){
			$this->form_validation->set_rules('company_id', 'Agency', 'callback__check_user_company');
		}
        
        $this->form_validation->set_rules('client_ids', 'Client', 'callback__check_user_company_clients');
		
		if( $this->current_user->group_id == GROUP_ADMIN ){
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[users.email.id.'.$user_id.']');
		}
		
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|xss_clean|min_length[3]');
		
		//$this->form_validation->set_rules('postcode', 'Postcode', 'trim|xss_clean');
		//$this->form_validation->set_rules('workhours', 'Working Hours', 'trim|xss_clean');
        
		
		if ($this->input->post('password')) {
			
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
		}

        if ($this->form_validation->run() == TRUE) {
		
			$company_id = ($this->current_user->group_id == GROUP_ADMIN) ? $this->_post_args('company_id', ARGS_TYPE_INT) : $this->current_user->company_id;
		
			//$company_info = $this->company_m->company_detail($company_id);
			//$company_settings = $this->company_m->company_settings($company_id);
			
			//$gmt_offset = ( _check_company_user_access($group_id) && $company_id > 0) ? $company_settings->gmt_offset : ( ( $this->current_user->group_id == GROUP_ADMIN ) ? $this->current_user->gmt_offset : $this->current_user->company_settings->gmt_offset);
			
			$input_data = array(
				'email'			=> ( $this->current_user->group_id == GROUP_ADMIN ) ? $this->_post_args('email', ARGS_TYPE_STRING) : $user_info->email,
                'first_name' 	=> $this->_post_args('first_name', ARGS_TYPE_STRING),
                'last_name' 	=> $this->_post_args('last_name', ARGS_TYPE_STRING),
                'phone' 		=> $this->_post_args('phone', ARGS_TYPE_STRING),
				//'postcode' 		=> $this->_post_args('postcode', ARGS_TYPE_STRING),
				//'workhours' 	=> $this->_post_args('workhours', ARGS_TYPE_STRING),
				//'gps_device_id' => $this->_post_args('gps_device_id', ARGS_TYPE_STRING),
				//'hourly_rate' 	=> $this->_post_args('hourly_rate', ARGS_TYPE_DECIMAL),
				'gmt_offset'	=> $this->_post_args('gmt_offset', ARGS_TYPE_STRING, $this->cfg->gmt_offset, array('override' => TRUE))
            );
			
			if ($this->_post_args('password', ARGS_TYPE_STRING)) {

                $input_data['password'] = $this->_post_args('password', ARGS_TYPE_STRING);
            }
			
			/*$user_avatar = $this->_post_args('user_avatar_img', ARGS_TYPE_STRING);
			
			if( array_key_exists('user_avatar_img', $_POST) && !empty($user_avatar) ){
				
				$additional_data['avatar'] = $user_avatar;
			
			} elseif( ($user_avatar = $this->upload_avatar()) && empty($user_avatar['error']) && !empty($user_avatar['file_name']) ) {
				
				$additional_data['avatar'] = $user_avatar['file_name'];
			}*/

			$is_record_updated = $this->ion_auth->update($user_id, $input_data);
			
			$group = array($group_id);
			$this->user_m->update_user_group($user_id, $group_id);
			
			if ( _has_company_resources($group_id) ) {
				
				if( gtzero_integer($user_info->company_id) && $user_info->company_id != $company_id){
				
					$this->user_m->delete_user_company($user_id);
				}
			
				$this->user_m->update_user_company($user_id, $company_id, $group_id);

				$this->user_m->delete_user_clients($user_id);
				
			} 
			
			elseif ( _has_company_non_resources($group_id) ) {
			
				$this->user_m->delete_user_company($user_id);
				
				$client_ids	= $this->_post_args('client_ids', ARGS_TYPE_ARRAY);
				$this->user_m->update_user_clients($user_id, $client_ids, $company_id);

			}
			
			/* if the group is changed to admin, delete any associated company and/or client with it. */
			elseif ($group_id == GROUP_ADMIN) {
			
				$this->user_m->delete_user_clients($user_id);
				$this->user_m->delete_user_company($user_id);
			}
			
			if($is_record_updated){
				$output['message'] 		= sprintf('The user "%s" was updated.', $user_info->first_name. ' ' . $user_info->last_name);
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['user_id'] 		= $user_id;
				
				$this->user_m->clear_user_profile_cache(array(
						'user_id' 			=> $user_id
						,'company_id'		=> $company_id
						,'old_company_id'	=> $user_info->company_id
					));
					
				//trigger_trip("user_updated", $company_id, array('user_id' => $user_id, 'updated_by' => $this->current_user->user_id));
				
			} else {
				$output['message'] 		= sprintf('Unable to Update Account Information for user "%s". Please report the issue to %s', $user_info->first_name. ' ' . $user_info->last_name, $this->cfg->contact_email);
                $output['status'] 		= ERROR_MESSAGE;
			}
			
			$this->_output_request($output, $redirect_url);
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$company_settings = $this->company_m->company_settings($company_id);
		$doc_key =  $this->_post_args('doc_key', ARGS_TYPE_STRING) ?  $this->_post_args('doc_key', ARGS_TYPE_STRING) : keygen();
		$csrf = _get_csrf_nonce();
		$gmt_offset = ( _check_company_user_access($group_id) && $company_id > 0) ? $company_settings->gmt_offset : ( ( $this->current_user->group_id == GROUP_ADMIN ) ? $this->current_user->gmt_offset : $this->current_user->company_settings->gmt_offset);
		
		$data = array(
			"user_id"					=> $user_id
			, 'form_action_type'		=> FORM_ACTION_EDIT
			, 'form_action'				=> site_url('users/edit/'.$pkey)
			, 'cancel_url'				=> $redirect_url
            , 'page' 					=> 'user/form'
            , 'title' 					=> 'User Detail'
			, 'submit_btn_text'			=> 'Save Changes'
			
			, 'first_name' 				=> $this->_post_args('first_name', ARGS_TYPE_STRING, $user_info->first_name)
			, 'last_name' 				=> $this->_post_args('last_name', ARGS_TYPE_STRING, $user_info->last_name)
			, 'email' 					=> $this->_post_args('email', ARGS_TYPE_STRING, $user_info->email)
			, 'phone' 					=> $this->_post_args('phone', ARGS_TYPE_STRING, $user_info->phone)
			//, 'workhours' 				=> $this->_post_args('workhours', ARGS_TYPE_STRING, $user_info->workhours)
			//, 'postcode' 				=> $this->_post_args('postcode', ARGS_TYPE_STRING, $user_info->postcode)
			//, 'gps_device_id' 			=> $this->_post_args('gps_device_id', ARGS_TYPE_STRING, $user_info->gps_device_id)
			//, 'hourly_rate' 			=> $this->_post_args('hourly_rate', ARGS_TYPE_DECIMAL, $user_info->hourly_rate)
			, 'password' 				=> ''
			, 'password_confirm' 		=> ''
			
			, 'company_id' 				=> $company_id
			, 'client_ids' 				=> $this->_post_args('client_ids', ARGS_TYPE_ARRAY, isset($user_info->client_ids) ? $user_info->client_ids : array())
			, 'group_id' 				=> $this->_post_args('group_id', ARGS_TYPE_INT, $user_info->group_id)
			, 'gmt_offset' 				=> $this->_post_args('gmt_offset', ARGS_TYPE_STRING, !empty($user_info->gmt_offset) ? $user_info->gmt_offset :$gmt_offset )
			//, 'avatar' 					=> $this->_post_args('avatar',  ARGS_TYPE_STRING, $user_info->avatar)
			
			, 'scripts'					=> array('user/form.js')
			, 'hiddenvars'				=> array_merge($csrf, array('redirect_url' => $redirect_url))
			, 'doc_key'					=> $doc_key
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/user/form_modal', $data, TRUE);

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
		_has_user_access_permission(TRUE, array('admin','management_company'));
		
		$output = array( 'message' => "", 'status' => "");
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = ($this->current_user->group_id == 1) ? 0 : $this->current_user->company_id;
		$user_id = (isset($params[SYS_USER_ID]) && gtzero_integer($params[SYS_USER_ID])) ? to_int($params[SYS_USER_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$user_info = $this->user_m->details($user_id);
		
		if( !$user_info || (_has_company_group_access($this->current_user->group_id) && $user_info->company_id!= $this->current_user->company_id) || ($this->current_user->user_id == $user_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$doc_key =  $this->_post_args('doc_key', ARGS_TYPE_STRING) ?  $this->_post_args('doc_key', ARGS_TYPE_STRING) : keygen();
		$csrf = _get_csrf_nonce();
		
		$data = array(
			"user_id"						=> $user_id
			, 'form_action_type'			=> FORM_ACTION_SHOW
			, 'form_action'					=> site_url('users/edit/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'user/show'
            , 'title' 						=> 'User Detail'
			, 'submit_btn_text'				=> 'Save Changes'
			, 'company_name' 				=> $user_info->company_name
			, 'group_name' 					=> $user_info->group_description
            , 'first_name' 					=> $user_info->first_name
			, 'last_name' 					=> $user_info->last_name
			, 'phone' 						=> $user_info->phone
			, 'email' 						=> $user_info->email
			//, 'workhours' 					=> $user_info->workhours
			//, 'postcode' 					=> $user_info->postcode
			//, 'gmt_offset' 					=> $user_info->gmt_offset
			//, 'gps_device_id' 				=> $user_info->gps_device_id
			//, 'hourly_rate' 				=> $user_info->hourly_rate
			, 'group_id' 					=> $user_info->group_id
			
			, 'company_id' 					=> $company_id
			, 'client_ids' 					=> $user_info->client_ids
			, 'group_id' 					=> $user_info->group_id
			//, 'avatar' 						=> $user_info->avatar
			
			, 'scripts'						=> array('user/show.js')
			, 'hiddenvars'					=> array()
			, 'doc_key'						=> $doc_key
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/user/show_modal', $data, TRUE);

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
		_has_user_access_permission(TRUE, array('admin', 'management_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = ($this->current_user->group_id == 1) ? 0 : $this->current_user->company_id;
		$user_id = (isset($params[SYS_USER_ID]) && gtzero_integer($params[SYS_USER_ID])) ? to_int($params[SYS_USER_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$user_info = $this->user_m->details($user_id);
		
		if( !$user_info || (_has_company_group_access($this->current_user->group_id) && $user_info->company_id!= $this->current_user->company_id) || ($this->current_user->user_id == $user_id) ) {
			$this->show_permission_denied_error($method);
		}
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			if($this->current_user->user_id == $user_id){
			
				$output['message'] 	= 'Unable to process request. you are logged-en with same user credential';
				$output['status'] 	= ERROR_MESSAGE;
			
			} else {
		
				$is_record_updated = $this->user_m->delete_user($user_id);
				
				if($is_record_updated){
					$output['message'] 	= sprintf('The user "%s" has been deleted.', $user_info->first_name.' '.$user_info->last_name);
					$output['status'] 	= SUCCESS_MESSAGE;
					$output['user_id'] 	= $user_id;
					
					$this->user_m->clear_user_profile_cache(array(
								'user_id' 		=> $user_id
								,'company_id'	=> $user_info->company_id
							));
				
					/*trigger_trip("client_deleted", $details->company_id, array('client_id' => $user_id, 'deleted_by' => $this->current_user->user_id));*/
					
				} else {
					$output['message'] 	= sprintf('Unable to delete user "%s". Please report the issue to %s', $user_info->first_name. ' ' . $user_info->last_name, $this->cfg->contact_email);
					$output['status'] 	= ERROR_MESSAGE;
				}
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
			'form_action'			=> site_url('users/delete/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'users/delete'
			, 'title' 				=> 'Delete User'
			, "display_message"		=> sprintf('Are you sure you want to delete user "%s"?',$user_info->first_name.' '.$user_info->last_name)
			, "display_heading"		=> sprintf('Delete User',$user_info->first_name.' '.$user_info->last_name)
			, "submit_btn_text"		=> "Save Changes"
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/user/delete_modal', $data, TRUE);

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
		_has_user_access_permission(TRUE, array('admin', 'management_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = ($this->current_user->group_id == GROUP_ADMIN) ? 0 : $this->current_user->company_id;
		$user_id = (isset($params[SYS_USER_ID]) && gtzero_integer($params[SYS_USER_ID])) ? to_int($params[SYS_USER_ID]) : 0;
		$code = (isset($params['code']) && !empty($params['code'])) ? $params['code'] : FALSE;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$user_info = $this->user_m->details($user_id);
		
		if( !$user_info || (_has_company_group_access($this->current_user->group_id) && $user_info->company_id!= $this->current_user->company_id) || ($this->current_user->user_id == $user_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = $user_info->company_id;
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			/*if ($this->_valid_csrf_nonce() === FALSE || $user_id != $this->input->post('id'))
			{
				show_error('This form post did not pass our security checks.');
			}*/
		
			$is_record_updated = FALSE;
			if ($code !== FALSE)
			{
				$is_record_updated = $this->ion_auth->activate($user_id, $code);
			}
			else if($this->ion_auth->is_admin())
			{
				$is_record_updated = $this->ion_auth->activate($user_id);
			}
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The user "%s" has been activated.', $user_info->full_name);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['user_id'] 	= $user_id;
			
				/*trigger_trip("user_activated", $user_info->company_id, array('user_id' => $user_id, 'updated_by' => $this->current_user->user_id));*/
				
			} else {
				$output['message'] 	= sprintf('Error occurred while trying to activate user "%s".', $user_info->full_name);
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
			'form_action'			=> site_url('users/activate/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'user/confirm'
			, 'title' 				=> 'Activate User'
			, 'display_message'		=> sprintf('Are you sure you want to activate user "%s"?', $user_info->full_name)
			, 'display_heading'		=> sprintf('Activate User', $user_info->full_name)
			, 'submit_btn_text'		=> "Save Changes"
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/user/confirm_modal', $data, TRUE);

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
		_has_user_access_permission(TRUE, array('admin', 'management_company'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = ($this->current_user->group_id == GROUP_ADMIN) ? 0 : $this->current_user->company_id;
		$user_id = (isset($params[SYS_USER_ID]) && gtzero_integer($params[SYS_USER_ID])) ? to_int($params[SYS_USER_ID]) : 0;
		$code = (isset($params['code']) && !empty($params['code'])) ? $params['code'] : FALSE;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$user_info = $this->user_m->details($user_id);
		
		if( !$user_info || (_has_company_group_access($this->current_user->group_id) && $user_info->company_id!= $this->current_user->company_id) || ($this->current_user->user_id == $user_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = $user_info->company_id;
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			/*if ($this->_valid_csrf_nonce() === FALSE || $user_id != $this->input->post('id'))
			{
				show_error('This form post did not pass our security checks.');
			}*/
		
			$is_record_updated = $this->ion_auth->deactivate($user_id);
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The user "%s" has been deactivated.', $user_info->full_name);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['user_id'] 	= $user_id;
			
				/*trigger_trip("user_activated", $user_info->company_id, array('user_id' => $user_id, 'updated_by' => $this->current_user->user_id));*/
				
			} else {
				$output['message'] 	= sprintf('Error occurred while trying to deactivated user "%s".', $user_info->full_name);
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
			'form_action'			=> site_url('users/deactivate/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'user/confirm'
			, 'title' 				=> 'Deactivate User'
			, 'display_message'		=> sprintf('Are you sure you want to deactivate user "%s"?', $user_info->full_name)
			, 'display_heading'		=> sprintf('Deactivate User', $user_info->full_name)
			, 'submit_btn_text'		=> "Save Changes"
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/user/confirm_modal', $data, TRUE);

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
		
	public function upload(){
		_has_user_access_permission(TRUE, array('admin','management_company'));
		
		$user_avatar = $this->upload_avatar();
				
		if( empty($user_avatar['error'])){
			
			$output = array(
				'status' 	=> SUCCESS_MESSAGE
				,'message'	=> "User avatar uploaded successfully"
				,'avatar'	=> $user_avatar['file_name']
			);
		} else {
			$output = array(
				'status' 	=> ERROR_MESSAGE
				,'message'	=> $user_avatar['error']
			);
		}
		
		echo json_encode($output);
	}
	
	protected function upload_avatar(){
		
		$new_file_name = "";$error = "";
        if (isset($_FILES['user_avatar']) && $_FILES['user_avatar']['error'] == 0) {
           
			$config['upload_path'] = './documents/profile/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            $config['max_size'] = '300';

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

    protected function get_file_extension($file_name) {
	
        $image_array = explode('.', $file_name);
        return end($image_array);
		
    }
	
	/* CALLBACK FUNCTION USED BY FORM VALIDATION */
	
    public function _check_user_group($group_id) {
        $groups = groups_dropdown('return');

        $group_types = array();

        foreach ($groups as $id=>$group_name) {
		
            $group_types[] = $id;
        }
		
        if (!in_array($group_id, $group_types)) {
            $this->form_validation->set_message('_check_user_group', 'Sorry, no such user group found');
            return false;
        }
    }
	
    public function _check_user_company($company_id) {
        
		if( _has_company_group_access($this->current_user->group_id)) return TRUE;
		
		$group_id = $this->_post_args("group_id", ARGS_TYPE_INT);
		$company_id = $this->_post_args("company_id", ARGS_TYPE_INT);
		
        if( _has_company_group_access($group_id) && $company_id <= 0) {
		
            $this->form_validation->set_message('_check_user_company', 'The %s field is required.');
            return false;
        }
    }
	
    public function _check_user_company_clients($ids) {
        
		$client_ids	= $this->_post_args('client_ids', ARGS_TYPE_ARRAY);
		$group_id = $this->_post_args("group_id", ARGS_TYPE_INT);
		
		if ($group_id == GROUP_CLIENT_USER) {
            
			if(!is_array($client_ids) || count($client_ids) <= 0){
				
				$this->form_validation->set_message('_check_user_company_clients', 'The %s field is required.');
				return FALSE;
				
			}
			
        }
		
		return TRUE;
    }
}