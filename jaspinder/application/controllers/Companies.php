<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Companies extends Admin_Controller {

    public function __construct() {
        parent::__construct();
		
    }
	
	public function index() {
	
		ensure_user_access(TRUE, array('admin'));
	
		$data = array(
            'page' 				=> 'companies/listing'
            , 'title' 			=> 'Companies'
			, 'plugins'			=> array('datatables')
        );

        $this->template->load('default', $data);
    }
	
	public function getTable() {
	
		ensure_user_access(TRUE,array('admin'));

		$params = array(
			'iDisplayStart' 	=> $this->input->get_post('iDisplayStart', true)
			,'iDisplayLength' 	=> $this->input->get_post('iDisplayLength', true)
			,'iSortCol_0' 		=> $this->input->get_post('iSortCol_0', true)
			,'iSortingCols' 	=> $this->input->get_post('iSortingCols', true)
			,'sSearch' 			=> $this->input->get_post('sSearch', true)
			,'sEcho' 			=> $this->input->get_post('sEcho', true)
        );

        $listing = $this->company_m->ajax_get_parts($params);
		
		
        foreach ($listing['aaData'] as &$qrow) {
		
			$ID = $qrow['ID'];
			
			$company_name = $qrow['company_name'];
			
			/*$qrow[count($qrow)-3] = tz_text($qrow[count($qrow)-3]);*/
			
			/* data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Event permission <small>'.$company_name.'</small>", "modal" : {"buttons" : true}, "params" : "echo"}\'*/
			
			$qrow = array(
				$qrow['company_name'], 
				$qrow['phone'], 
				$qrow['default_contact'], 
				tz_text($qrow['gmt_offset']), 
				$qrow['created_by_name'],
				theme_button_dropdown(array(
					
					'edit'		=> array(
						'href' 		=> site_url('companies/edit/'.$ID),
						'title'		=> 'Edit Company',
						'text'		=> 'Edit Company',
						'params'	=> ' data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Edit Company <small>'.$company_name.'</small>", "modal" : {"buttons" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'delete'	=> array(
						'href' 		=> site_url('companies/delete/'.$ID),
						'title'		=> 'Delete Company',
						'text'		=> 'Delete Company',
						'params'	=> ' data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Delete Company <small>'.$company_name.'</small>", "modal" : {"buttons" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'notes'		=> array(
						'href' 		=> site_url('notes/index/'.wdp_arr_encode(array( WDP_REF_ID => $ID, WDP_NOTE_TYPE_ID => NOTE_TYPE_COMPANY) )),
						'title'		=> 'Notes <small>(Company: '.$company_name.')</small>',
						'text'		=> 'Notes',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Notes <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.notes.close_grid(g);", "callback" : "wdp.notes.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
						'class'		=> array()
					),
					'new_note'		=> array(
						'href' 		=> site_url('notes/create/'.wdp_arr_encode(array( WDP_REF_ID => $ID, WDP_NOTE_TYPE_ID => NOTE_TYPE_COMPANY))),
						'title'		=> 'Add Note <small>(Company: '.$company_name.')</small>',
						'text'		=> 'Add Note',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Note Detail <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'contacts'		=> array(
						'href' 		=> site_url('contacts/index/'.wdp_arr_encode(array( WDP_REF_ID => $ID, WDP_TYPE_ID => CONTACT_TYPE_COMPANY))),
						'title'		=> 'Show Contacts <small>(Company: '.$company_name.')</small>',
						'text'		=> 'Show Contacts',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Contacts <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.contacts.close_grid(g);", "callback" : "wdp.contacts.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
						'class'		=> array()
					),
					'new_contact'		=> array(
						'href' 		=> site_url('contacts/create/'.wdp_arr_encode(array( WDP_REF_ID => $ID, WDP_TYPE_ID => CONTACT_TYPE_COMPANY))),
						'title'		=> 'Contact Detail<small>(Company: '.$company_name.')</small>',
						'text'		=> 'Add Contact',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Contact Detail <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : true}, "params" : "echo"}\'',
						'class'		=> array()
					)
				), array(
					'detail_icon' => ICON_COMPANIES
				)).
				theme_button_dropdown(array(
					'settings'		=> array(
						'href' 		=> site_url('settings/triggers/index/'.$ID),
						'title'		=> 'Trigger Settings',
						'text'		=> 'Trigger Settings',
						'params'	=> '',
						'class'		=> array()
					),
					'account_settings'		=> array(
						'href' 		=> site_url('settings/myaccount/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID) )),
						'title'		=> 'Company Settings',
						'text'		=> 'Company Settings',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "POST", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Account Settings'.(($this->current_user->group_id == 1) ? ' ('.$qrow['company_name'].')' : '').'", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'permission_settings'		=> array(
						'href' 		=> site_url('settings/mygroups/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID) )),
						'title'		=> 'Permission Settings',
						'text'		=> 'Permission Settings',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "POST", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Account Permission Settings'.(($this->current_user->group_id == 1) ? ' ('.$qrow['company_name'].')' : '').'", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'cstfld_settings'		=> array(
						'href' 		=> site_url('settings/custom_fields/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID) )),
						'title'		=> 'Custom Field Settings',
						'text'		=> 'Custom Field Settings',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Custom Field Settings'.(($this->current_user->group_id == 1) ? ' ('.$qrow['company_name'].')' : '').'", "modal" : {"buttons" : true, "override" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'my_pdf_templates_settings'	=> array(
						'href' 		=> site_url('settings/pdf_templates/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID) )),
						'title'		=> 'PDF Template Settings',
						'text'		=> 'PDF Template Settings',
						'params'	=> '',
						'class'		=> array()
					),
					'timesheet'	=> array(
						'href' 		=> site_url('jobs/timesheet/index/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID) )),
						'title'		=> 'Timesheet',
						'text'		=> 'Timesheet',
						'params'	=> '', //'data-ajax="wdpajax" data-options=\'{"form_method" : "POST", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "PDF Template Settings", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'cost'			=> array(
						'href' 		=> site_url('cost/index/'.$ID),
						'title'		=> 'Unassigned Labour/Mileage',
						'text'		=> 'Unassigned Labour/Mileage',
						'params'	=> '',
						'class'		=> array()
					),
				), array(
					'detail_icon' 		=> ICON_SETTING,
					'detail_margin'		=> 'ml5',
					'group_seperator'	=> FALSE
				)).theme_button_dropdown(array(
					
					
					'clients'		=> array(
						'href' 		=> site_url('clients/index/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID ))),
						'title'		=> 'Clients <small>'.$company_name.'</small>',
						'text'		=> 'Clients',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Clients <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.clients.close_grid(g);", "callback" : "wdp.clients.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
						'class'		=> array()
					),
					'new_client'		=> array(
						'href' 		=> site_url('clients/create/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID))), 
						'title'		=> 'New Client <small>'.$company_name.'</small>',
						'text'		=> 'New Client',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Client Detail", "modal" : {"buttons" : true}, "params" : "echo", "form_data" : {"company_id" : '.$ID.'}}\'',
						'class'		=> array()
					),
					'invoices'		=> array(
						'href' 		=> site_url('invoices/index/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID ))),
						'title'		=> 'Invoices <small>'.$company_name.'</small>',
						'text'		=> 'Invoices',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Invoices <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.invoice.listing.close_grid(g);", "callback" : "wdp.invoice.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
						'class'		=> array()
					),
					'new_invoice'		=> array(
						'href' 		=> site_url('invoices/create/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID))), 
						'title'		=> 'New Invoice <small>'.$company_name.'</small>',
						'text'		=> 'New Invoice',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Invoice Detail", "modal" : {"buttons" : true}, "params" : "echo", "form_data" : {"company_id" : '.$ID.'}}\'',
						'class'		=> array()
					),
					'consumables'		=> array(
						'href' 		=> site_url('consumables/index/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID ))),
						'title'		=> 'Consumables <small>'.$company_name.'</small>',
						'text'		=> 'Consumables',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Consumables <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.consumable.listing.close_grid(g);", "callback" : "wdp.consumable.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
						'class'		=> array()
					),
					'new_consumable'=> array(
						'href' 		=> site_url('consumables/create/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID))), 
						'title'		=> 'New Consumable Set <small>'.$company_name.'</small>',
						'text'		=> 'New Consumable Set',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Consumable Set", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'suppliers'		=> array(
						'href' 		=> site_url('suppliers/index/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID ))),
						'title'		=> 'Suppliers <small>'.$company_name.'</small>',
						'text'		=> 'Suppliers',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Suppliers <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.supplier.listing.close_grid(g);", "callback" : "wdp.supplier.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
						'class'		=> array()
					),
					'new_supplier'=> array(
						'href' 		=> site_url('suppliers/create/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID))), 
						'title'		=> 'New Supplier <small>'.$company_name.'</small>',
						'text'		=> 'New Supplier',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Suppliers Detail", "modal" : {"buttons" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'parts'		=> array(
						'href' 		=> site_url('parts_list/index/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID ))),
						'title'		=> 'Parts <small>'.$company_name.'</small>',
						'text'		=> 'Parts',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Parts <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.parts.listing.close_grid(g);", "callback" : "wdp.parts.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
						'class'		=> array()
					),
					'new_part'=> array(
						'href' 		=> site_url('parts_list/create/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID))), 
						'title'		=> 'New Part <small>'.$company_name.'</small>',
						'text'		=> 'New Part',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Part Detail", "modal" : {"buttons" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'quotes'		=> array(
						'href' 		=> site_url('quotes/index/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID ))),
						'title'		=> 'Quotes <small>'.$company_name.'</small>',
						'text'		=> 'Quotes',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Quotes <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.quotes.listing.close_grid(g);", "callback" : "wdp.quotes.listing.load_grid(g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
						'class'		=> array()
					),
					'new_quote'=> array(
						'href' 		=> site_url('quotes/create/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID))), 
						'title'		=> 'New Quote <small>'.$company_name.'</small>',
						'text'		=> 'New Quote',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Quote Detail", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true}, "params" : "echo"}\'',
						'class'		=> array()
					),
					'jobs'		=> array(
						'href' 		=> site_url('summary/index/'.wdp_arr_encode(array( WDP_COMPANY_ID => $ID) )),
						'title'		=> 'Jobs <small>(Company: '.$company_name.')</small>',
						'text'		=> 'Jobs',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "GET", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Jobs <small>(Company: '.$company_name.')</small>", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true, "nopadd" : false, "modal_before_close_callback" : "wdp.jobs.close_grid(g);", "callback" : "wdp.jobs.fm(frm, g);"}, "params" : "echo", "grid" : {"_init" : true, "gType" : "next"}}\'',
						'class'		=> array()
					),
					'new_job'	=> array(
						'href' 		=> site_url('job/create'),
						'title'		=> 'Job Detail <small>(Company: '.$company_name.')</small>',
						'text'		=> 'New Job',
						'params'	=> 'data-ajax="wdpajax" data-options=\'{"form_method" : "POST", "data_type" : "HTML", "role" : "modal", "created_new" : true, "title" : "Job Detail", "modal" : {"buttons" : false, "footer" : false, "size" : "modal-lg", "wizard" : true, "override" : true}, "params" : "echo", "form_data" : {"company_id" : '.$ID.'}}\'',
						'class'		=> array()
					)
				), array(
					'detail_icon' 		=> ICON_TASKS,
					'detail_margin'		=> 'ml5',
					'group_seperator'	=> FALSE
				))
			);
        }

        echo json_encode($listing);
    }

    public function get_all_companies() {
	
		ensure_user_access(TRUE, array('admin'));
	
		companies_dropdown('ajax');
    }

    public function delete($id, $method = "echo") {
	
		ensure_user_access(TRUE, array('admin'));
		
		$details = $this->company_m->details($id);
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
		
			$is_record_updated = $this->company_m->delete($id);
			
			if($is_record_updated){
				$output['message'] 		= sprintf('The company "%s" has been deleted.', $details->name);
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['company_id'] 	= $id;
			
				trigger_trip("company_deleted", 0, array('company_id' => $id, 'deleted_by' => $this->current_user->user_id));
				
			} else {
				$output['message'] 	= sprintf('Error occurred while trying to delete company "%s".', $details->name);
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output,'companies');
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$data = array(
			'form_action'			=> site_url('companies/delete/' . $id)
			,'cancel_url'			=> site_url('companies')
            , 'page' 				=> 'companies/delete'
			, 'title' 				=> 'Delete Company'
			, "display_message"		=> sprintf("Are you sure you want to delete company \"%s\"?",$details->name)
			, "display_heading"		=> sprintf('Delete Company',$details->name)
			, 'submit_btn_text'		=> 'Save Changes'
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/companies/delete_modal', $data, TRUE);

            if ($method == "ajax") {
			
				$output['html']	= $html;
                $this->_output_request($output,'companies');
				
            } else {
                echo $html;
            }
        } else {
		
            $this->template->load('default', $data);
        }
    }
    
	public function create($method = "echo") {
	
		ensure_user_access(TRUE, array('admin'));
		
		$this->form_validation->set_rules('name', 'Company Name', 'required|callback__check_name[0]|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean');
        $this->form_validation->set_rules('default_contact_name', 'Default Contact Name', 'required|xss_clean');
        $this->form_validation->set_rules('default_contact_email', 'Default Contact Email', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('gmt_offset', 'Timezone', 'required|xss_clean');
		
		$output = array( 'message' => "", 'status' => "");

        if ($this->form_validation->run() == TRUE) {
		
			$input = array(
                "name"                  	=> $this->input->post("name")
                ,"address"               	=> $this->input->post("address")
                ,"phone"                 	=> $this->input->post("phone")
                ,"default_contact_name"  	=> $this->input->post("default_contact_name")
                ,"default_contact_email" 	=> $this->input->post("default_contact_email")
				,'gmt_offset'				=> $this->input->post("gmt_offset")
				,'created_by' 				=> $this->current_user->user_id
            );
			
			$company_logo = $this->input->post('company_logo_img');
			
			if($company_logo){
				$input['logo'] = $company_logo;
			} else {
				$company_logo = $this->upload_logo();
				$input['logo'] = $company_logo['file_name'];
			}

            $company_id = $this->company_m->add_company($input);
			
			if( $company_id> 0 ){
				$output['message'] 		= sprintf('The company "%s" was added.', $this->input->post('name'));
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['company_id'] 	= $company_id;
				
				trigger_trip("new_company", 0, array('company_id' => $company_id, 'created_by' => $this->current_user->user_id));
			} else {
				$output['message'] 	= 'An error occured.';
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output,'companies');
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
			
		}

        $data = array(
			'form_action'				=> site_url('companies/create')
			,'cancel_url'				=> site_url('companies')
            , 'page' 					=> 'companies/form'
            , 'title' 					=> 'Create Company'
			, 'submit_btn_text'			=> 'Add Comapny'
			, 'name' 					=> $this->input->post('name', TRUE)
			, 'address' 				=> $this->input->post('address', TRUE)
			, 'phone' 					=> $this->input->post('phone', TRUE)
			, 'default_contact_name' 	=> $this->input->post('default_contact_name', TRUE)
			, 'default_contact_email' 	=> $this->input->post('default_contact_email', TRUE)
			, 'gmt_offset' 				=> $this->input->post('gmt_offset', TRUE)
			, 'js_files'				=> array('companies/form.js')
        );
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/companies/form_modal', $data, TRUE);

            if ($method == "ajax") {
                
                $output['html']	= $html;
                $this->_output_request($output,'companies');
				
            } else {
                echo $html;
            }
        } else {

            $this->template->load('default', $data);
        }
	}
	
	public function edit($id = 0, $method = "echo") {
	
		ensure_user_access(TRUE, array('admin'));
		
		$output = array( 'message' => "", 'status' => "");
		
		$details = $this->company_m->details($id);
		
		$this->form_validation->set_rules('name', 'Company Name', 'required|callback__check_name['.$id.']|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean');
        $this->form_validation->set_rules('default_contact_name', 'Default Contact Name', 'required|xss_clean');
        $this->form_validation->set_rules('default_contact_email', 'Default Contact Email', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('gmt_offset', 'Timezone', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
		
			$input = array(
                "name"                  	=> $this->input->post("name")
                ,"address"               	=> $this->input->post("address")
                ,"phone"                 	=> $this->input->post("phone")
                ,"default_contact_name"  	=> $this->input->post("default_contact_name")
                ,"default_contact_email" 	=> $this->input->post("default_contact_email")
				,'gmt_offset'				=> $this->input->post("gmt_offset")
            );
			
			$company_logo = $this->input->post('company_logo_img');
			
			if($company_logo){
				$input['logo'] = $company_logo;
			} else {
				$company_logo = $this->upload_logo();
				
				if( empty($company_logo['error'])){
					$input['logo'] = $company_logo['file_name'];
				}
			}

            $is_record_updated = $this->company_m->update($input, $id);
			
			if($is_record_updated){
				$output['message'] 	= sprintf('The company "%s" was updated.', $details->name);
                $output['status'] 	= SUCCESS_MESSAGE;
				$output['company_id'] 	= $id;
				
				trigger_trip("company_updated", 0, array('company_id' => $id, 'updated_by' => $this->current_user->user_id));
			} else {
				$output['message'] 	= 'An error occured.';
                $output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output,'companies');
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= strip_tags(validation_errors());
                $output['status'] 	= ERROR_MESSAGE;
			}
			
		}

        $data = array(
			'form_action'				=> site_url('companies/edit/'.$id)
			,'cancel_url'				=> site_url('companies')
            , 'page' 					=> 'companies/form'
            , 'title' 					=> 'Edit Company'
			, 'submit_btn_text'			=> 'Save Changes'
			, 'name' 					=> $this->input->post('name', TRUE) ? $this->input->post('name', TRUE) : $details->name
			, 'address' 				=> $this->input->post('address', TRUE) ? $this->input->post('address', TRUE) : $details->address
			, 'phone' 					=> $this->input->post('phone', TRUE) ? $this->input->post('phone', TRUE) : $details->phone
			, 'default_contact_name' 	=> $this->input->post('default_contact_name', TRUE) ? $this->input->post('default_contact_name', TRUE) : $details->default_contact_name
			, 'default_contact_email' 	=> $this->input->post('default_contact_email', TRUE) ? $this->input->post('default_contact_email', TRUE) : $details->default_contact_email
			, 'gmt_offset' 				=> $this->input->post('gmt_offset', TRUE) ? $this->input->post('gmt_offset', TRUE) : $details->gmt_offset
			, 'logo'					=> $details->logo
			, 'js_files'				=> array('companies/form.js')
        );
		
		if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/companies/form_modal', $data, TRUE);

            if ($method == "ajax") {
                
                $output['html']	= $html;
                $this->_output_request($output,'companies');
				
            } else {
                echo $html;
            }
        } else {

            $this->template->load('default', $data);
        }
	}

    public function refresh_settings($method = "echo") {
	
		//ensure_user_access(TRUE, array('admin'));
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
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
			
			$this->_output_request($output, 'companies');
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$data = array(
			'form_action'			=> site_url('companies/refresh_settings')
			,'cancel_url'			=> site_url('companies')
            , 'page' 				=> 'companies/delete'
			, 'title' 				=> 'Refresh Cache'
			, "display_message"		=> sprintf("Are you sure you want to refresh cache?")
			, "display_heading"		=> sprintf('Refresh Cache')
			, 'submit_btn_text'		=> 'Save Changes'
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/companies/delete_modal', $data, TRUE);

            if ($method == "ajax") {
			
				$output['html']	= $html;
                $this->_output_request($output,'companies');
				
            } else {
                echo $html;
            }
        } else {
		
            $this->template->load('default', $data);
        }
    }
	
	public function upload(){
		
		ensure_user_access(TRUE, array('admin'));
		
		$company_logo = $this->upload_logo();
				
		if( empty($company_logo['error'])){
			
			$output = array(
				'status' 	=> SUCCESS_MESSAGE
				,'msg'		=> "File successfully uploaded"
				,'logo'		=> $company_logo['file_name']
			);
		} else {
			$output = array(
				'status' 	=> ERROR_MESSAGE
				,'msg'		=> $company_logo['error']
			);
		}
		
		
		
		echo json_encode($output);
		
	}
	
	public function setting_detail($company_id = 0) {
	
		ensure_user_access(TRUE, array('admin', 'management_company'));
		
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
		
			$this->form_validation->set_message('_check_name', sprintf('A company with the name "%s" already exists.', $name));

			return false;
		}

		return true;
	}
	
	protected function upload_logo(){
		
		$new_file_name = "";$error = "";
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
				$new_file_name = "";
                $error = $this->upload->display_errors('', '');;
				
            } else {
			
                //Image Resizing
                /*$config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 60;
                $config['height'] = 60;*/

                $upload_data = $this->upload->data();
                    
				if(ENVIRONMENT == "production" || ENVIRONMENT == 'testing') {
				
					//send to s3 and remove original                    
					$this->load->library('s3');
                    $bucket = 'workdeskpro';

                    $input = $this->s3->inputResource(fopen($upload_data['full_path'], "rb"), filesize($upload_data['full_path']));

                    if ($this->s3->putObject($input, $bucket, DOCUMENT_FOLDER . 'companylogo/' . $upload_data['file_name'], S3::ACL_PUBLIC_READ)) {
                        
						//remove the locally uploaded file
                        @unlink($upload_data['full_path']);
                    }
					
				}
            }
        }
		
		return array("file_name" => $new_file_name, "error" => $error);
	}

    protected function get_file_extension($file_name) {
	
        $image_array = explode('.', $file_name);
        return end($image_array);
		
    }
}

?>
