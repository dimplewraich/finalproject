<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sites extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('site_model', 'site_m');
    }

    public function index($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'staff', 'engineer'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();		
		$company_id = ($this->current_user->group_id == 1) ? ((isset($params[SYS_COMPANY_ID]) && gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) : $this->current_user->company_id;
		
        $data = array(
			'page'				=> 'sites/listing'
			,'title'			=> 'Sites'
			,'company_id'		=> $company_id
			,'plugins'			=> array()
			,'new_site_url'	=> site_url('sites/create/'.serialize_object(array( SYS_COMPANY_ID => $company_id)))
			,'grid_action'		=> ($this->input->is_ajax_request()) ? site_url("sites/getTable/".$pkey) : site_url("sites/getTable")
			,'scripts'			=> array('sites/index.js')
		);

        if ($this->input->is_ajax_request()) {

            echo $this->template->raw_view('pages/sites/listing_modal', $data, TRUE);
			
        } else {
		
            $this->template->load('default', $data);
        }
    }

    public function getTable($pkey = '') {
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'staff', 'engineer'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();		
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? ((isset($params[SYS_COMPANY_ID]) && gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) : $this->current_user->company_id;
		
		$params = array(
			'iDisplayStart' 	=> $this->input->post('iDisplayStart', true)
			,'iDisplayLength' 	=> $this->input->post('iDisplayLength', true)
			,'iSortCol_0' 		=> $this->input->post('iSortCol_0', true)
			,'iSortingCols' 	=> $this->input->post('iSortingCols', true)
			,'sSearch' 			=> $this->input->post('sSearch', true)
			,'sEcho' 			=> $this->input->post('sEcho', true)
			,'company_id'		=> in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, $company_id) : $this->current_user->company_id
			,'name' 			=> $this->_post_args('name', ARGS_TYPE_STRING)
			,'postcode' 		=> $this->_post_args('postcode', ARGS_TYPE_STRING)
			,'contact_name' 	=> $this->_post_args('contact_name', ARGS_TYPE_STRING)
        );
        
        $qrows = $this->site_m->ajax_gets($params);

        foreach ($qrows['aaData'] as &$qrow) {
		
			$actions = array();

			if( in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_MANAGEMENT_COMPANY, GROUP_STAFF, GROUP_ENGINEER)) ) {
				$actions['view'] = array(
							'href' 		=> site_url('sites/show/'.serialize_object(array( SYS_SITE_ID => $qrow->site_id))),
							'title'		=> 'Site Detail<small>'.$qrow->site_code.'</small>',
							'text'		=> 'Site Detail',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Site Detail <small>'.$qrow->site_code.'</small>", "modal" : {"buttons" : false, "size" : "modal-lg", "footer" : true, "wizard" : false}, "params" : "echo"}\'',
							'class'		=> array()
						);
			
			}
			
			if( in_array($this->current_user->group_id, array(GROUP_ADMIN)) ) {
				$actions['edit'] = array(
							'href' 		=> site_url('sites/edit/'.serialize_object(array( SYS_SITE_ID => $qrow->site_id))),
							'title'		=> 'Site Detail<small>'.$qrow->site_code.'</small>',
							'text'		=> 'Edit Site',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Site Detail", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "modal_success_callback" : "gl.site.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
							'class'		=> array()
						);
			}
			
			if( in_array($this->current_user->group_id, array(GROUP_ADMIN)) ) {
				$actions['delete'] = array(
							'href' 		=> site_url('sites/delete/'.serialize_object(array( SYS_SITE_ID => $qrow->site_id))),
							'title'		=> 'Site <small>'.$qrow->site_code.'</small>',
							'text'		=> 'Delete Site',
							'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Delete Site <small>'.$qrow->site_code.'</small>", "modal" : {"buttons" : true, "override" : true, "modal_success_callback" : "gl.site.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "default"}}\'',
							'class'		=> array()
						);
			}
			
			$qrow = array(
				$qrow->site_code
				,$qrow->company_name
				,$qrow->address
				,$qrow->street
				,$qrow->town
				,$qrow->postcode
				,$qrow->upload_date
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
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = (in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER))) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		if( in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ) {
			$this->form_validation->set_rules('company_id', 'Company', 'required');
		}
		
		$this->form_validation->set_rules('site_code', 'Site ID', 'required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
		$this->form_validation->set_rules('street', 'Street', 'required|xss_clean');
		$this->form_validation->set_rules('town', 'Town', 'required|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim|xss_clean');
		$this->form_validation->set_rules('upload_date', 'Upload Date', 'trim|callback__validate_date');
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
		
			$upload_date = ( ($upload_date = $this->input->post("upload_date")) && $upload_date) ? _mysql_date_format($upload_date) : NULL;
			$embargo_start_date = ( ($embargo_start_date = $this->input->post("embargo_start_date")) && $embargo_start_date) ? $embargo_start_date : NULL;
			$power_build_pack_requested = ( ($power_build_pack_requested = $this->input->post("power_build_pack_requested")) && $power_build_pack_requested) ? $power_build_pack_requested : NULL;
			$power_build_pack_received_ttc = ( ($power_build_pack_received_ttc = $this->input->post("power_build_pack_received_ttc")) && $power_build_pack_received_ttc) ? $power_build_pack_received_ttc : NULL;
			$power_build_date = ( ($power_build_date = $this->input->post("power_build_date")) && $power_build_date) ? $power_build_date : NULL;
			$meter_build_date = ( ($meter_build_date = $this->input->post("meter_build_date")) && $upload_date) ? $meter_build_date : NULL;
		
			$input = array(
                'company_id' 					=> (in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER))) ? $company_id : $this->current_user->company_id
				
				, 'district_no' 				=> $this->_post_args('district_no', ARGS_TYPE_STRING)
				, 'code' 						=> $this->_post_args('site_code', ARGS_TYPE_STRING)
				, 'town' 						=> $this->_post_args('town', ARGS_TYPE_STRING)
				, 'address' 					=> $this->_post_args('address', ARGS_TYPE_STRING)
				, 'street' 						=> $this->_post_args('street', ARGS_TYPE_STRING)
				, 'postcode' 					=> $this->_post_args('postcode', ARGS_TYPE_STRING)
				, 'site_ref' 					=> $this->_post_args('site_ref', ARGS_TYPE_STRING)
				, 'upload_date' 				=> $upload_date
				
				, 'static_scroller' 			=> $this->_post_args('static_scroller', ARGS_TYPE_STRING)
				, 'shelter_fsu' 				=> $this->_post_args('shelter_fsu', ARGS_TYPE_STRING)
				, 'easting' 					=> $this->_post_args('easting', ARGS_TYPE_STRING)
				, 'northing' 					=> $this->_post_args('northing', ARGS_TYPE_STRING)
				, 'shelter_type' 				=> $this->_post_args('shelter_type', ARGS_TYPE_STRING)
				, 'site_configuration' 			=> $this->_post_args('site_configuration', ARGS_TYPE_STRING)
				, 'height' 						=> $this->_post_args('height', ARGS_TYPE_STRING)
				, 'panel' 						=> $this->_post_args('panel', ARGS_TYPE_STRING)
				, 'ranking' 					=> $this->_post_args('ranking', ARGS_TYPE_STRING)
				, 'embargo_start_date' 			=> $embargo_start_date
				, 'status' 						=> $this->_post_args('status', ARGS_TYPE_STRING)
				, 'power_build_pack_requested' 	=> $power_build_pack_requested
				, 'power_build_pack_received_ttc'	=> $power_build_pack_received_ttc
				, 'actual_power_cost' 			=> $this->_post_args('actual_power_cost', ARGS_TYPE_DECIMAL)
				, 'power_build_date' 			=> $power_build_date
				, 'meter_build_date' 			=> $meter_build_date
				
				, 'created_by' 					=> $this->current_user->user_id
            );

            $site_id = $this->site_m->add_site($input);
			
			if( $site_id > 0 ){
				
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['message'] 		= sprintf('The site "%s" was added.', $input['code']);
				$output['site_id'] 	= $site_id;
				
				/*trigger_trip("new_site", $company_id, array('site_id' => $site_id, 'created_by' => $this->current_user->user_id));*/
			} else {
				$output['message'] 		= sprintf('Unable to create site record "%s". Please report the issue to %s', $input['first_name'].' '.$input['last_name'], $this->cfg->contact_email);
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
			'form_action'					=> site_url('sites/create/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'sites/form'
            , 'title' 						=> 'Site Detail'
			, 'submit_btn_text'				=> 'Save Changes'
            , 'company_id' 					=> $company_id
			
			, 'district_no' 				=> $this->_post_args('district_no', ARGS_TYPE_STRING)
			, 'site_code' 					=> $this->_post_args('site_code', ARGS_TYPE_STRING)
			, 'town' 						=> $this->_post_args('town', ARGS_TYPE_STRING)
			, 'address' 					=> $this->_post_args('address', ARGS_TYPE_STRING)
			, 'street' 						=> $this->_post_args('street', ARGS_TYPE_STRING)
			, 'postcode' 					=> $this->_post_args('postcode', ARGS_TYPE_STRING)
			, 'site_ref' 					=> $this->_post_args('site_ref', ARGS_TYPE_STRING)
			, 'upload_date' 				=> $this->_post_args('upload_date', ARGS_TYPE_STRING, local_time(curr_timestamp(), 'd/m/Y'))
			
			
			, 'static_scroller' 			=> $this->_post_args('static_scroller', ARGS_TYPE_STRING)
			, 'shelter_fsu' 				=> $this->_post_args('shelter_fsu', ARGS_TYPE_STRING)
			, 'easting' 					=> $this->_post_args('easting', ARGS_TYPE_STRING)
			, 'northing' 					=> $this->_post_args('northing', ARGS_TYPE_STRING)
			, 'shelter_type' 				=> $this->_post_args('shelter_type', ARGS_TYPE_STRING)
			, 'site_configuration' 			=> $this->_post_args('site_configuration', ARGS_TYPE_STRING)
			, 'height' 						=> $this->_post_args('height', ARGS_TYPE_STRING)
			, 'panel' 						=> $this->_post_args('panel', ARGS_TYPE_STRING)
			, 'ranking' 					=> $this->_post_args('ranking', ARGS_TYPE_STRING)
			, 'embargo_start_date' 			=> $this->_post_args('embargo_start_date', ARGS_TYPE_STRING)
			, 'status' 						=> $this->_post_args('status', ARGS_TYPE_STRING)
			, 'power_build_pack_requested' 	=> $this->_post_args('power_build_pack_requested', ARGS_TYPE_STRING)
			, 'power_build_pack_received_ttc'	=> $this->_post_args('power_build_pack_received_ttc', ARGS_TYPE_STRING)
			, 'actual_power_cost' 			=> $this->_post_args('actual_power_cost', ARGS_TYPE_DECIMAL)
			, 'power_build_date' 			=> $this->_post_args('power_build_date', ARGS_TYPE_STRING)
			, 'meter_build_date' 			=> $this->_post_args('meter_build_date', ARGS_TYPE_STRING)
			
			, 'scripts'						=> array('sites/form.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/sites/form_modal', $data, TRUE);

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
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = (in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER))) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$site_id = (isset($params[SYS_SITE_ID]) && gtzero_integer($params[SYS_SITE_ID])) ? to_int($params[SYS_SITE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$site_info = $this->site_m->details($site_id, $company_id);
		
		if( !$site_info || (_has_company_group_access($this->current_user->group_id) && $site_info->company_id != $this->current_user->company_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = (in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER))) ? $this->_post_args('company_id', ARGS_TYPE_INT, $site_info->company_id ) : $this->current_user->company_id;
		
		if( in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ) {
			$this->form_validation->set_rules('company_id', 'Company', 'required');
		}
		
		$this->form_validation->set_rules('site_code', 'Site ID', 'required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
		$this->form_validation->set_rules('street', 'Street', 'required|xss_clean');
		$this->form_validation->set_rules('town', 'Town', 'required|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim|xss_clean');
		$this->form_validation->set_rules('upload_date', 'Upload Date', 'trim|callback__validate_date');
		
		$output = array( 'message' => "", 'status' => "");
        if ($this->form_validation->run() == TRUE) {
		
			$upload_date = ( ($upload_date = $this->input->post("upload_date")) && $upload_date) ? _mysql_date_format($upload_date) : NULL;
			$embargo_start_date = ( ($embargo_start_date = $this->input->post("embargo_start_date")) && $embargo_start_date) ? $embargo_start_date : NULL;
			$power_build_pack_requested = ( ($power_build_pack_requested = $this->input->post("power_build_pack_requested")) && $power_build_pack_requested) ? $power_build_pack_requested : NULL;
			$power_build_pack_received_ttc = ( ($power_build_pack_received_ttc = $this->input->post("power_build_pack_received_ttc")) && $power_build_pack_received_ttc) ? $power_build_pack_received_ttc : NULL;
			$power_build_date = ( ($power_build_date = $this->input->post("power_build_date")) && $power_build_date) ? $power_build_date : NULL;
			$meter_build_date = ( ($meter_build_date = $this->input->post("meter_build_date")) && $upload_date) ? $meter_build_date : NULL;
		
			$input = array(
                'company_id' 					=> in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $company_id : $this->current_user->company_id
				
				, 'district_no' 				=> $this->_post_args('district_no', ARGS_TYPE_STRING)
				, 'code' 						=> $this->_post_args('site_code', ARGS_TYPE_STRING)
				, 'town' 						=> $this->_post_args('town', ARGS_TYPE_STRING)
				, 'address' 					=> $this->_post_args('address', ARGS_TYPE_STRING)
				, 'street' 						=> $this->_post_args('street', ARGS_TYPE_STRING)
				, 'postcode' 					=> $this->_post_args('postcode', ARGS_TYPE_STRING)
				, 'site_ref' 					=> $this->_post_args('site_ref', ARGS_TYPE_STRING)
				, 'upload_date' 				=> $upload_date
				
				, 'static_scroller' 			=> $this->_post_args('static_scroller', ARGS_TYPE_STRING)
				, 'shelter_fsu' 				=> $this->_post_args('shelter_fsu', ARGS_TYPE_STRING)
				, 'easting' 					=> $this->_post_args('easting', ARGS_TYPE_STRING)
				, 'northing' 					=> $this->_post_args('northing', ARGS_TYPE_STRING)
				, 'shelter_type' 				=> $this->_post_args('shelter_type', ARGS_TYPE_STRING)
				, 'site_configuration' 			=> $this->_post_args('site_configuration', ARGS_TYPE_STRING)
				, 'height' 						=> $this->_post_args('height', ARGS_TYPE_STRING)
				, 'panel' 						=> $this->_post_args('panel', ARGS_TYPE_STRING)
				, 'ranking' 					=> $this->_post_args('ranking', ARGS_TYPE_STRING)
				, 'embargo_start_date' 			=> $embargo_start_date
				, 'status' 						=> $this->_post_args('status', ARGS_TYPE_STRING)
				, 'power_build_pack_requested' 	=> $power_build_pack_requested
				, 'power_build_pack_received_ttc'	=> $power_build_pack_received_ttc
				, 'actual_power_cost' 			=> $this->_post_args('actual_power_cost', ARGS_TYPE_DECIMAL)
				, 'power_build_date' 			=> $power_build_date
				, 'meter_build_date' 			=> $meter_build_date
            );
		
			$is_record_updated = $this->site_m->update($input, $site_id);
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The site "%s" was updated.', $site_info->site_code);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['site_id'] 	= $site_id;
			
				/*trigger_trip("site_updated", $company_id, array('site_id' => $site_id, 'updated_by' => $this->current_user->user_id));*/
			} else {
				$output['message'] 		= sprintf('Unable to Update Account Information for site "%s". Please report the issue to %s', $site_info->site_code, $this->cfg->contact_email);
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
			'form_action'					=> site_url('sites/edit/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'sites/form'
            , 'title' 						=> 'Site Detail'
			, 'submit_btn_text'				=> 'Save Changes'
            , 'company_id' 					=> $company_id
			
			, 'district_no' 				=> $this->_post_args('district_no', ARGS_TYPE_STRING, $site_info->district_no)
			, 'site_code' 					=> $this->_post_args('site_code', ARGS_TYPE_STRING, $site_info->site_code)
			, 'town' 						=> $this->_post_args('town', ARGS_TYPE_STRING, $site_info->town)
			, 'address' 					=> $this->_post_args('address', ARGS_TYPE_STRING, $site_info->address)
			, 'street' 						=> $this->_post_args('street', ARGS_TYPE_STRING, $site_info->street)
			, 'postcode' 					=> $this->_post_args('postcode', ARGS_TYPE_STRING, $site_info->postcode)
			, 'site_ref' 					=> $this->_post_args('site_ref', ARGS_TYPE_STRING, $site_info->site_ref)
			, 'upload_date' 				=> $this->_post_args('upload_date', ARGS_TYPE_STRING, !empty($site_info->upload_date) ? valid_date($site_info->upload_date, 'd/m/Y') : local_time(curr_timestamp(), 'd/m/Y'))
			
			
			, 'static_scroller' 			=> $this->_post_args('static_scroller', ARGS_TYPE_STRING, $site_info->static_scroller)
			, 'shelter_fsu' 				=> $this->_post_args('shelter_fsu', ARGS_TYPE_STRING, $site_info->shelter_fsu)
			, 'easting' 					=> $this->_post_args('easting', ARGS_TYPE_STRING, $site_info->easting)
			, 'northing' 					=> $this->_post_args('northing', ARGS_TYPE_STRING, $site_info->northing)
			, 'shelter_type' 				=> $this->_post_args('shelter_type', ARGS_TYPE_STRING, $site_info->shelter_type)
			, 'site_configuration' 			=> $this->_post_args('site_configuration', ARGS_TYPE_STRING, $site_info->site_configuration)
			, 'height' 						=> $this->_post_args('height', ARGS_TYPE_STRING, $site_info->height)
			, 'panel' 						=> $this->_post_args('panel', ARGS_TYPE_STRING, $site_info->panel)
			, 'ranking' 					=> $this->_post_args('ranking', ARGS_TYPE_STRING, $site_info->ranking)
			, 'embargo_start_date' 			=> $this->_post_args('embargo_start_date', ARGS_TYPE_STRING, $site_info->embargo_start_date)
			, 'status' 						=> $this->_post_args('status', ARGS_TYPE_STRING, $site_info->status)
			, 'power_build_pack_requested' 	=> $this->_post_args('power_build_pack_requested', ARGS_TYPE_STRING, $site_info->power_build_pack_requested)
			, 'power_build_pack_received_ttc'	=> $this->_post_args('power_build_pack_received_ttc', ARGS_TYPE_STRING, $site_info->power_build_pack_received_ttc)
			, 'actual_power_cost' 			=> $this->_post_args('actual_power_cost', ARGS_TYPE_DECIMAL, $site_info->actual_power_cost)
			, 'power_build_date' 			=> $this->_post_args('power_build_date', ARGS_TYPE_STRING, $site_info->power_build_date)
			, 'meter_build_date' 			=> $this->_post_args('meter_build_date', ARGS_TYPE_STRING, $site_info->meter_build_date)
			
			, 'scripts'						=> array('sites/form.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/sites/form_modal', $data, TRUE);

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
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'staff', 'engineer'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$site_id = (isset($params[SYS_SITE_ID]) && gtzero_integer($params[SYS_SITE_ID])) ? to_int($params[SYS_SITE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$site_info = $this->site_m->details($site_id, $company_id);
		
		if( !$site_info || (_has_company_group_access($this->current_user->group_id) && $site_info->company_id != $this->current_user->company_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, $site_info->company_id ) : $this->current_user->company_id;

		
		$doc_key =  $this->_post_args('doc_key', ARGS_TYPE_STRING) ?  $this->_post_args('doc_key', ARGS_TYPE_STRING) : keygen();
		$csrf = _get_csrf_nonce();
		
		$data = array(
			"site_id"						=> $site_id
			, 'notes_listing_url'			=> site_url('notes/index/'.serialize_object(array( SYS_REF_ID => $site_id, SYS_NOTE_TYPE_ID => NOTE_TYPE_SITE) ))
			, 'form_action'					=> site_url('sites/show/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'sites/show'
            , 'title' 						=> 'Site Detail'
			, 'submit_btn_text'				=> 'Save Changes'
            , 'company_id' 					=> $company_id
			, 'company_name' 				=> $site_info->company_name
			
			, 'site_id' 					=> $site_info->id
			, 'district_no' 				=> $site_info->district_no
			, 'site_code' 					=> $site_info->site_code
			, 'town' 						=> $site_info->town
			, 'address' 					=> $site_info->address
			, 'street' 						=> $site_info->street
			, 'postcode' 					=> $site_info->postcode
			, 'site_ref' 					=> $site_info->site_ref
			, 'upload_date' 				=> !empty($site_info->upload_date) ? valid_date($site_info->upload_date, 'd/m/Y') : local_time(curr_timestamp(), 'd/m/Y')
			
			
			, 'static_scroller' 			=> $site_info->static_scroller
			, 'shelter_fsu' 				=> $site_info->shelter_fsu
			, 'easting' 					=> $site_info->easting
			, 'northing' 					=> $site_info->northing
			, 'shelter_type' 				=> $site_info->shelter_type
			, 'site_configuration' 			=> $site_info->site_configuration
			, 'height' 						=> $site_info->height
			, 'panel' 						=> $site_info->panel
			, 'ranking' 					=> $site_info->ranking
			, 'embargo_start_date' 			=> $site_info->embargo_start_date
			, 'status' 						=> $site_info->status
			, 'power_build_pack_requested' 	=> $site_info->power_build_pack_requested
			, 'power_build_pack_received_ttc'	=> $site_info->power_build_pack_received_ttc
			, 'actual_power_cost' 			=> $site_info->actual_power_cost
			, 'power_build_date' 			=> $site_info->power_build_date
			, 'meter_build_date' 			=> $site_info->meter_build_date
			
			, 'site_forms'					=> $site_info->site_forms
			, 'site_statuses'				=> array('' => '', 1 => 'OPEN', 2 => 'SUBMITTED', 3 => 'COMPLETED')
			
			, 'scripts'						=> array('sites/show.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/sites/show_modal', $data, TRUE);

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
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$site_id = (isset($params[SYS_SITE_ID]) && gtzero_integer($params[SYS_SITE_ID])) ? (INT)$params[SYS_SITE_ID] : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$site_info = $this->site_m->details($site_id, $company_id);
		
		if( !$site_info || (_has_company_group_access($this->current_user->group_id) && $site_info->company_id != $this->current_user->company_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, $site_info->company_id ) : $this->current_user->company_id;
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			$is_record_updated = $this->site_m->delete($site_id);
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The site "%s" has been deleted.', $site_info->site_code);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['site_id'] 	= $site_id;
			
				/*trigger_trip("site_deleted", $details->company_id, array('site_id' => $site_id, 'deleted_by' => $this->current_user->user_id));*/
				
			} else {
				$output['message'] 	= sprintf('Unable to delete site "%s". Please report the issue to %s', $site_info->site_code, $this->cfg->contact_email);
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
			'form_action'			=> site_url('sites/delete/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'sites/delete'
			, 'title' 				=> 'Delete Site'
			, "display_message"		=> sprintf('Are you sure you want to delete site "%s"?',$site_info->site_code)
			, "display_heading"		=> sprintf('Delete Site', $site_info->site_code)
			, "submit_btn_text"		=> "Save Changes"
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url, 'confirm' => 1))
        );
		

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/sites/delete_modal', $data, TRUE);

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

	public function add_form($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'staff'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$site_id = (isset($params[SYS_SITE_ID]) && gtzero_integer($params[SYS_SITE_ID])) ? to_int($params[SYS_SITE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$site_info = $this->site_m->details($site_id, $company_id);
		
		if( !$site_info || (_has_company_group_access($this->current_user->group_id) && $site_info->company_id != $this->current_user->company_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, $site_info->company_id ) : $this->current_user->company_id;
		
		$this->form_validation->set_rules('form_type_id', 'Form Types', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
		
			$input = array(
                'site_id' 						=> $site_info->id				
				, 'form_type_id' 				=> $this->_post_args('form_type_id', ARGS_TYPE_INT)
				, 'status' 						=> 1
				, 'added_on' 					=> curr_timestamp()
				, 'added_by' 					=> $this->current_user->user_id
            );

            $site_form_id = $this->site_m->add_site_form($input);
			
			if( $site_id > 0 ){
				
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['message'] 		= sprintf('The form for site "%s" was added.', $site_info->code);
				$output['site_form_id'] = $site_form_id;
			} else {
				$output['message'] 		= sprintf('Unable to add form to site record "%s". Please report the issue to %s', $site_info->code, $this->cfg->contact_email);
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
			'form_action'					=> site_url('sites/add_form/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'sites/site_form'
            , 'title' 						=> 'Site Form Detail'
			, 'submit_btn_text'				=> 'Save Changes'
            , 'company_id' 					=> $company_id
			, 'site_id' 					=> $site_info->id
			
			, 'form_type_id' 				=> $this->_post_args('form_type_id', ARGS_TYPE_INT)
			
			, 'scripts'						=> array('sites/form.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/sites/site_form_modal', $data, TRUE);

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
	
	public function survey($pkey='', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin','staff', 'engineer'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$site_form_id = (isset($params[SYS_SITE_FORM_ID]) && gtzero_integer($params[SYS_SITE_FORM_ID])) ? to_int($params[SYS_SITE_FORM_ID]) : 0;
		$site_id = (isset($params[SYS_SITE_ID]) && gtzero_integer($params[SYS_SITE_ID])) ? to_int($params[SYS_SITE_ID]) : 0;
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$doc_key =  $this->input->post('doc_key') ?  $this->input->post('doc_key') : keygen();
		$csrf = _get_csrf_nonce();
		
		$site_rows = array();$form_questions = array();$form_question = array();$survey_completed = false;$site_info = array();
		if($site_form_id>0 && $site_id > 0 && $form_type_id > 0){
			
			$site_info = $this->site_m->details($site_id, $company_id);
			
			$question_id = $this->_post_args('question_id', ARGS_TYPE_INT);
			$answer = $this->_post_args('answer', ARGS_TYPE_STRING);
			$notes = $this->_post_args('notes', ARGS_TYPE_STRING);
			$previous_question = array();
			
			$form_questions = $this->site_m->get_question_by_many(array(
				'site_form_id'		=> $site_form_id
				,'site_id'			=> $site_id
				,'form_type_id'		=> $form_type_id
			));
			
			if($question_id <= 0) {
				$form_question = $form_questions[0];
			} else {
				
				$flag = FALSE;
				foreach($form_questions AS $index=>$row){
				
					if( $row->question_id == $question_id){
						$previous_question = $row;
					}
					
					if($flag) continue;
					
					if( isset($form_questions[$index-1]) && $form_questions[$index-1]->question_id == $question_id){
						$form_question = $row;
					}
				}
			}
			
				
			if($question_id > 0) {
			
				$question_info = $this->site_m->get_question_by_many(array(
										'site_form_id'		=> $site_form_id
										,'site_id'			=> $site_id
										,'form_type_id'		=> $form_type_id
										,'question_id'		=> $question_id
									), 'row');
			
				if($question_info && $question_info->question_type == 'yes_no' && $answer != 'Yes' && $answer != 'No'){
					$answer = 'NA';
				} elseif($question_info && $question_info->question_type == 'upload') {
				
					$answer = $question_info->answer;
				
					$upload_data = $this->upload_file($question_info);
					
					if( empty($upload_data['error']) && !empty($upload_data['file_name']) ){
						$answer = $upload_data['file_name'];
					}
				}
				
				$this->site_m->add_site_form_feedback(array(
					'site_form_id'	=> $site_form_id
					,'site_id'		=> $site_id
					,'form_type_id'	=> $form_type_id
					,'question_id'	=> $question_id
					,'answer'		=> $answer
					,'notes'		=> $notes
				));
				
			}
			
			if($question_id > 0 && $question_id == $form_questions[count($form_questions)-1]->question_id) {
			
				$form_questions = $this->site_m->update_site_form(array(
					'submitted_on'		=> curr_timestamp()
					,'submitted_by'		=> $this->current_user->user_id
					,'status'			=> 2
				), $site_form_id, $site_id, $form_type_id);
				
				$survey_completed = TRUE;
				
			}
			
		} else {
		
			$site_code = $this->_post_args('site_code', ARGS_TYPE_STRING);
			$site_ref = $this->_post_args('site_ref', ARGS_TYPE_STRING);
			$site_district = $this->_post_args('site_district', ARGS_TYPE_STRING);
			$site_postcode = $this->_post_args('postcode', ARGS_TYPE_STRING);
			
			$site_rows = $this->site_m->get_by_many(array(
				'site_code'			=> $site_code
				,'site_ref'			=> $site_ref
				,'site_district'	=> $site_district
				,'site_postcode'	=> $site_postcode
			));
		}

        $data = array(
			'form_action'					=> site_url('sites/survey/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'sites/survey_form'
            , 'title' 						=> 'Site Form'
			, 'submit_btn_text'				=> 'Save Changes'
            , 'company_id' 					=> $company_id
			, 'site_form_id'				=> $site_form_id
			, 'site_id'						=> $site_id
			, 'form_type_id'				=> $form_type_id
			, 'site_info'					=> $site_info
			, 'site_rows'					=> $site_rows
			, 'form_question'				=> $form_question
			, 'survey_completed'			=> $survey_completed
			, 'scripts'						=> array('sites/survey.js')
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
        );
		
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/sites/survey_form_modal', $data, TRUE);

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
	
	public function feedback($pkey='', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'management_company', 'staff', 'engineer'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$site_form_id = (isset($params[SYS_SITE_FORM_ID]) && gtzero_integer($params[SYS_SITE_FORM_ID])) ? to_int($params[SYS_SITE_FORM_ID]) : 0;
		$site_id = (isset($params[SYS_SITE_ID]) && gtzero_integer($params[SYS_SITE_ID])) ? to_int($params[SYS_SITE_ID]) : 0;
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$doc_key =  $this->input->post('doc_key') ?  $this->input->post('doc_key') : keygen();
		$csrf = _get_csrf_nonce();
		
		$site_info = $this->site_m->details($site_id, $company_id);
		$site_form_info = $this->site_m->site_form_detail($site_form_id);
		
		$form_questions = $this->site_m->get_question_by_many(array(
			'site_form_id'		=> $site_form_id
			,'site_id'			=> $site_id
			,'form_type_id'		=> $form_type_id
		));

        $data = array(
			'form_action'					=> site_url('sites/feedback/'.$pkey)
			, 'cancel_url'					=> $redirect_url
            , 'page' 						=> 'sites/feedback_form'
            , 'title' 						=> 'Site Form'
			, 'submit_btn_text'				=> 'Save Changes'
            , 'company_id' 					=> $company_id
			, 'site_id'						=> $site_id
			, 'form_type_id'				=> $form_type_id
			, 'site_info'					=> $site_info
			, 'site_form_info'				=> $site_form_info
			, 'form_questions'				=> $form_questions
			, 'hiddenvars'					=> array_merge($csrf, array('redirect_url' => $redirect_url))
			,'scripts'						=> array('sites/feedback.js')
        );
		
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/sites/feedback_form_modal', $data, TRUE);

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

    public function sfstatus($pkey, $method = "echo") {
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$site_form_id = (isset($params[SYS_SITE_FORM_ID]) && gtzero_integer($params[SYS_SITE_FORM_ID])) ? to_int($params[SYS_SITE_FORM_ID]) : 0;
		$site_id = (isset($params[SYS_SITE_ID]) && gtzero_integer($params[SYS_SITE_ID])) ? to_int($params[SYS_SITE_ID]) : 0;
		$form_type_id = (isset($params[SYS_FORM_TYPE_ID]) && gtzero_integer($params[SYS_FORM_TYPE_ID])) ? to_int($params[SYS_FORM_TYPE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		
		$doc_key =  $this->input->post('doc_key') ?  $this->input->post('doc_key') : keygen();
		$csrf = _get_csrf_nonce();
		
		$site_info = $this->site_m->details($site_id, $company_id);
		$site_form_info = $this->site_m->site_form_detail($site_form_id);
		
		if( !$site_info || (_has_company_group_access($this->current_user->group_id) && $site_info->company_id != $this->current_user->company_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, $site_info->company_id ) : $this->current_user->company_id;
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			$is_record_updated = $this->site_m->update_site_form(array(
					'completed_on'		=> curr_timestamp()
					,'completed_by'		=> $this->current_user->user_id
					,'status'			=> 3
				), $site_form_id, $site_id, $form_type_id);
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The site form "%s" for site "%s" has been marked as completed.', $site_form_info->form_name,$site_info->site_code);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['site_form_info'] 	= $site_form_info;
				
			} else {
				$output['message'] 	= sprintf('Unable to mark form "%s" for site "%s" as completed. Please report the issue to %s', $site_form_info->form_name,$site_info->site_code, $this->cfg->contact_email);
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
			'form_action'			=> site_url('sites/sfstatus/' . $pkey)
			,'cancel_url'			=> $redirect_url
            , 'page' 				=> 'sites/delete'
			, 'title' 				=> $site_info->site_code.'('.$site_form_info->form_name.')'
			, "display_message"		=> sprintf('Are you sure you want mark form "%s" for site "%s" as completed?', $site_form_info->form_name,$site_info->site_code)
			, "display_heading"		=> sprintf($site_info->site_code.'('.$site_form_info->form_name.')')
			, "submit_btn_text"		=> "Save Changes"
			, 'hiddenvars'			=> array_merge($csrf, array('redirect_url' => $redirect_url, 'confirm' => 1))
        );
		

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/sites/delete_modal', $data, TRUE);

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
	
	public function download($pkey, $method = "echo"){
		_has_user_access_permission(TRUE, array('admin'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, ((array_key_exists(SYS_COMPANY_ID, $params) &&  gtzero_integer($params[SYS_COMPANY_ID])) ? to_int($params[SYS_COMPANY_ID]) : 0) ) : $this->current_user->company_id;
		$site_id = (isset($params[SYS_SITE_ID]) && gtzero_integer($params[SYS_SITE_ID])) ? to_int($params[SYS_SITE_ID]) : 0;
		$redirect_url = $this->_post_args('redirect_url', ARGS_TYPE_STRING, $this->agent->referrer());
		$site_statuses = array('' => '', 1 => 'OPEN', 2 => 'SUBMITTED', 3 => 'COMPLETED');
		$site_info = $this->site_m->details($site_id, $company_id);
		
		if( !$site_info || (_has_company_group_access($this->current_user->group_id) && $site_info->company_id != $this->current_user->company_id)) {
			$this->show_permission_denied_error($method);
		}
		
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT, $site_info->company_id ) : $this->current_user->company_id;

		
		$doc_key =  $this->_post_args('doc_key', ARGS_TYPE_STRING) ?  $this->_post_args('doc_key', ARGS_TYPE_STRING) : keygen();
		$csrf = _get_csrf_nonce();
	
		$headings = array(
			"SITE","FORM","DATE ADDED","ADDED BY", "STATUS", "DATE SUBMITTED", "SUBMITTED BY", "DATE COMPLETED", "COMPLETED BY"
		);
		
		$this->load->library('PHPExcel');
		$this->load->library('PHPExcel/IOFactory');
        
		
		// Create a new PHPExcel object 
		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->getActiveSheet()->setTitle('List of Site Forms'); 

		$rowNumber = 1; 
		$col = 'A'; 
		foreach($headings as $heading) { 
		   $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading); 
		   $col++; 
		} 

		// Loop through the result set 
		$rowNumber = 2; 
		foreach ($site_info->site_forms AS $site_form) {
			
			$col = 'A';
			
			$objPHPExcel->getActiveSheet()->setCellValue(($col++).$rowNumber, $site_info->site_code);
			$objPHPExcel->getActiveSheet()->setCellValue(($col++).$rowNumber, $site_form->form_name);
			$objPHPExcel->getActiveSheet()->setCellValue(($col++).$rowNumber, _validate_date($site_form->added_on, 'Y-m-d H:i:s') ? local_time($site_form->added_on,'M d, Y @ h:ia') : '');
			$objPHPExcel->getActiveSheet()->setCellValue(($col++).$rowNumber, $site_form->added_by_name);
			$objPHPExcel->getActiveSheet()->setCellValue(($col++).$rowNumber, $site_statuses[$site_form->status]);
			$objPHPExcel->getActiveSheet()->setCellValue(($col++).$rowNumber, _validate_date($site_form->submitted_on, 'Y-m-d H:i:s') ? local_time($site_form->submitted_on,'M d, Y @ h:ia') : '');
			$objPHPExcel->getActiveSheet()->setCellValue(($col++).$rowNumber, $site_form->submitted_by_name);
			$objPHPExcel->getActiveSheet()->setCellValue(($col++).$rowNumber, _validate_date($site_form->completed_on, 'Y-m-d H:i:s') ? local_time($site_form->completed_on,'M d, Y @ h:ia') : '');
			$objPHPExcel->getActiveSheet()->setCellValue(($col++).$rowNumber, $site_form->completed_by_name);
			
			$rowNumber++; 
		}
		
		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
		
		// We'll be outputting an excel file
		header('Content-type: application/vnd.ms-excel');

		// It will be called file.xls
		header('Content-Disposition: attachment; filename="'.date('Ymd').'.xls"');

		// Write file to the browser
		$objWriter->save('php://output');
	
	}
	
    public function get_sites_by_company_id() {
	
		$company_id = in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER)) ? $this->_post_args('company_id', ARGS_TYPE_INT) : $this->current_user->company_id;
	
        sites_dropdown(
			'ajax'
			,array( 'company_id' => $company_id)
		);
		
    }
		
	protected function upload_file($question_info){
		
		$new_file_name = "";$error = "";
        if (isset($_FILES['answer']) && $_FILES['answer']['error'] == 0) {
           
			$config = array(
				'upload_path' 		=> './documents/'
				,'allowed_types' 	=> $question_info->allowed_types
				,'overwrite' 		=> FALSE
				,'remove_spaces' 	=> TRUE
				,'max_size' 		=> $question_info->max_size
			);

            $new_file_name = uniqid() . '.' . $this->get_file_extension($_FILES['answer']['name']);

            $config['file_name'] = $new_file_name;

            $this->load->library('upload', $config);
 
            if (!$this->upload->do_upload('answer')) {
				$new_file_name = "";
                $error = $this->upload->display_errors('', '');
				
            } else {
			
                $config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 60;
                $config['height'] = 60;

                $upload_data = $this->upload->data();
                
                /*$this->load->library('image_lib', $config);

                 if (!$this->image_lib->resize()) {
                    $this->session->set_flashdata('message', $this->image_lib->display_errors('<p class="error">', '</p>'));
                } else {
                    
					$this->load->library('docs');
					$error = ( ($status = $this->docs->s3_upload($upload_data, 'profile/')) && $status) ? '' : 'Problem with CDN transfer';
					
				}*/
            }
        } else {
			$error = 'you have not choose any file';
		}
		
		return array("file_name" => $new_file_name, "error" => $error);
	}

    protected function get_file_extension($file_name) {
	
        $image_array = explode('.', $file_name);
        return end($image_array);
		
    }
	
	public function _validate_date($date){
	
		if( empty($date) ) return TRUE;
		
		$_is_mobile = ( isset($this->agent) && $this->agent->is_mobile() ) ? TRUE : FALSE;
		$_is_ipad = ( isset($this->agent) && $this->agent->is_ipad() ) ? TRUE : FALSE;
		
		$format = 'd-m-Y';
		
		if($_is_mobile && !$_is_ipad){
			$format = 'Y-m-d';
		}
		$date = str_replace('/', '-', $date);
		$date = str_replace('T', ' ', $date);
		
		$version = explode('.', phpversion());
		if (((int) $version[0] >= 5 && (int) $version[1] >= 2 && (int) $version[2] > 17)) {
			$d = DateTime::createFromFormat($format, $date);
		} else {
			$d = new DateTime(date($format, strtotime($date)));
		}
	
		$flag = ($d && $d->format($format) == $date) ? TRUE: FALSE;
		
		if (!$flag){
			$this->form_validation->set_message('_validate_date', 'The date must be valid.'.$d->format($format).' : '.$date);
			return FALSE;
		}
		
		return TRUE;
	}
}

?>