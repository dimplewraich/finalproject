<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('notes_model', 'notes_m');
    }

    public function index($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'location_manager', 'location_user'));
        
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		
		$note_type_id = ((isset($params[SYS_NOTE_TYPE_ID]) && gtzero_integer($params[SYS_NOTE_TYPE_ID])) ? (INT)$params[SYS_NOTE_TYPE_ID] : 0);
		$ref_id = ((isset($params[SYS_REF_ID]) && gtzero_integer($params[SYS_REF_ID])) ? (INT)$params[SYS_REF_ID] : 0);
		
        $data = array(
			'new_note_url'		=> site_url('notes/create/'.serialize_object(array( SYS_NOTE_TYPE_ID => $note_type_id, SYS_REF_ID => $ref_id)))
			,'page'				=> 'notes/listing'
			,'title'			=> 'Notes'
			,'plugins'			=> array('flot','datatables', 'wizard', 'gallery','tinymce','timepicker','leaflet')
			,'params'			=> $params
			,'pkey'				=> $pkey
			,'grid_action'		=> ($this->input->is_ajax_request()) ? site_url("notes/getTable/".$pkey) : site_url("notes/getTable/".$pkey)
			,'scripts'			=> array('notes/index.js')
		);

        if ($this->input->is_ajax_request()) {

            echo $this->template->raw_view('pages/notes/listing_modal', $data, TRUE);
			
        } else {
		
            $this->template->load('default', $data);
        }
    }

    public function getTable($pkey = '') {
		_has_user_access_permission(TRUE, array('admin', 'location_manager', 'location_user'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		
		$note_type_id = ((isset($params[SYS_NOTE_TYPE_ID]) && gtzero_integer($params[SYS_NOTE_TYPE_ID])) ? (INT)$params[SYS_NOTE_TYPE_ID] : 0);
		$ref_id = ((isset($params[SYS_REF_ID]) && gtzero_integer($params[SYS_REF_ID])) ? (INT)$params[SYS_REF_ID] : 0);
		
		$params = array(
			'iDisplayStart' 	=> $this->input->post('iDisplayStart', true)
			,'iDisplayLength' 	=> $this->input->post('iDisplayLength', true)
			,'iSortCol_0' 		=> $this->input->post('iSortCol_0', true)
			,'iSortingCols' 	=> $this->input->post('iSortingCols', true)
			,'sSearch' 			=> $this->input->post('sSearch', true)
			,'sEcho' 			=> $this->input->post('sEcho', true)
			,'note_type_id' 	=> $note_type_id
			,'ref_id' 			=> $ref_id
        );
        
        $qrows = $this->notes_m->ajax_gets($params);

        foreach ($qrows['aaData'] as &$qrow) {
			
			$qrow = array(
				$qrow['note_description']
				,$qrow['created_by_name']
				,local_time($qrow['created_on'],'M d, Y')
				,theme_button_groups(array(
					'view'		=> array(
						'href' 		=> site_url('notes/show/'.serialize_object(array( SYS_NOTE_ID => $qrow['ID']/* , SYS_NOTE_TYPE_ID => $qrow['note_type_id']*/ ))),
						'title'		=> 'Note Detail',
						'text'		=> 'View Note',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Note Detail", "modal" : {"buttons" : false, "footer" : false}, "params" : "echo"}\'',
						'class'		=> array()
					)
				))
			);
        }

        echo json_encode($qrows);
    }
    
	public function create($pkey = '', $method = "echo") {
		_has_user_access_permission(TRUE, array('admin', 'location_manager', 'location_user'));
		
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		$note_type_id = ((isset($params[SYS_NOTE_TYPE_ID]) && gtzero_integer($params[SYS_NOTE_TYPE_ID])) ? (INT)$params[SYS_NOTE_TYPE_ID] : 0);
		$ref_id = ((isset($params[SYS_REF_ID]) && gtzero_integer($params[SYS_REF_ID])) ? (INT)$params[SYS_REF_ID] : 0);
		
		$this->form_validation->set_rules('description', 'Notes', 'trim|required|xss_clean');
		
		$output = array( 'message' => "", 'status' => "");

        if ($method != 'echo' && $this->form_validation->run() == TRUE) {
		
			$input = array(
                "note_type_id" 		=> $note_type_id
                ,"ref_id" 			=> $ref_id
                ,"note" 			=> $this->input->post('description')
				,'created_by'			=> $this->current_user->user_id
            );
			
            $note_id = $this->notes_m->add_note($input);
			
			if( gtzero_integer($note_id) ){
			
				$output['message'] 	= sprintf('The note "%d" was added.', $note_id);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['note_id'] 	= $note_id;
				
			} else {
				$output['message'] 	= 'An error occured.';
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output,'notes');
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
			
		}

        $data = array(
			'form_action'				=> site_url('notes/create/'.$pkey)
			,'cancel_url'				=> site_url('notes')
            , 'page' 					=> 'notes/form'
            , 'title' 					=> 'Note Detail'
			, 'submit_btn_text'			=> 'Add Note'
			, 'description' 			=> $this->input->post('description', TRUE)
			, 'hiddenvars'				=> array()
			, 'scripts'				=> array('notes/form.js')
        );
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/notes/form_modal', $data, TRUE);

            if ($method == "ajax") {
                
                $output['html']	= $html;
                $this->_output_request($output,'notes');
				
            } else {
                echo $html;
            }
        } else {

            $this->template->load('default', $data);
        }
	}
	
	public function show($pkey=''){
		_has_user_access_permission(TRUE, array('admin', 'location_manager', 'location_user'));
	
		$params = (($params = unserialize_object($pkey)) && is_array($params)) ? $params : array();
		
		$note_id 	= ((isset($params[SYS_NOTE_ID]) && gtzero_integer($params[SYS_NOTE_ID])) ? (INT)$params[SYS_NOTE_ID] : 0);
		$note_type_id 	= ((isset($params[SYS_NOTE_TYPE_ID]) && gtzero_integer($params[SYS_NOTE_TYPE_ID])) ? (INT)$params[SYS_NOTE_TYPE_ID] : 0);
		
		$note_info = $this->notes_m->get_note_by_id($note_id);
		
		echo $note_info->note;
		
	}
}

?>
