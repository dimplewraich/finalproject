<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends Admin_Controller {

    public function __construct() {
        parent::__construct();
		
        $this->load->model('document_model');
        $this->load->library('s3');
		$this->load->library('docs');
    }
	
	public function index($method = "echo"){
		
		$company_id = ($this->current_user->group_id == 1) ? ($this->input->post('company_id') ? $this->input->post('company_id') : 0) : $this->current_user->company_id;
		$client_id = $this->input->post('client_id') ? $this->input->post('client_id') : 0;
		$site_id = $this->input->post('site_id') ? $this->input->post('site_id') : 0;
		$job_id = $this->input->post('job_id') ? $this->input->post('job_id') : 0;
		$quote_id = $this->input->post('quote_id') ? $this->input->post('quote_id') : 0;
		$equipment_id = $this->input->post('equipment_id') ? $this->input->post('equipment_id') : 0;
		$option_type = ( ($option_type = $this->input->post('option_type')) && gtzero_integer($option_type)) ? (INT)$option_type : 0;
		
		$document_type_id = 9;
		if(gtzero_integer($company_id)){
			$document_type_id = 6;
		}
		
		if(gtzero_integer($client_id)){
			$document_type_id = 7;
		}
		
		if(gtzero_integer($site_id)){
			$document_type_id = 8;
		}
		
		if(gtzero_integer($job_id)){
			$document_type_id = 1;
		}
		
		if(gtzero_integer($quote_id)){
			$document_type_id = 2;
		}
		
		if(gtzero_integer($equipment_id)){
			$document_type_id = 10;
		}
		
		/*print_r(array(
			'company_id'			=> $company_id
			,'document_type_id'		=> $document_type_id
			,'client_id'			=> $client_id
			,'site_id'				=> $site_id
			,'job_id'				=> $job_id
			,'quote_id'				=> $quote_id
			,'equipment_id'			=> $equipment_id
			,'option_type'			=> $option_type
		));die;*/
		$files = $this->document_model->get_docs_by_many(array(
			'company_id'			=> $company_id
			,'document_type_id'		=> $document_type_id
			,'client_id'			=> $client_id
			,'site_id'				=> $site_id
			,'job_id'				=> $job_id
			,'quote_id'				=> $quote_id
			,'equipment_id'			=> $equipment_id
		));
		
		$folders = $this->document_model->get_doc_types_by_many(array(
			'company_id'			=> $company_id
			,'document_type_id'		=> $document_type_id
			,'client_id'			=> $client_id
			,'site_id'				=> $site_id
			,'job_id'				=> $job_id
			,'quote_id'				=> $quote_id
			,'equipment_id'			=> $equipment_id
			,'option_type'			=> $option_type
		));
		//print_r($folders);die;
		$document_types = array("" => "", '1' => 'job', '2' => 'quote', '4' => 'Email Attachments');
		
		if($this->current_user->group_id == 1){
			//$document_types['']
		}
		
		$data = array(
            'page' 				=> 'docs/form'
            , 'title' 			=> 'Documents'
			, 'folders'			=> $folders
			, 'files'			=> $files
			, 'companies'		=> ($this->current_user->group_id == 1) ? companies_dropdown('return', TRUE, "") : FALSE
			, 'document_types'	=>  $document_types
            , 'company_id'		=> $company_id
			, 'client_id'		=> $client_id
			, 'site_id'			=> $site_id
			, 'job_id'			=> $job_id
			, 'quote_id'		=> $quote_id
			, 'equipment_id'	=> $equipment_id
			, 'plugins' 		=> array('gallery','dropzone')
			, 'js_files'		=> array('docs/index.js')
        );

        if ($this->input->is_ajax_request()) {
			
            $html = $this->template->raw_view('pages/docs/listing', $data, TRUE);

            if ($method == "ajax") {
                
                $output['html']	= $html;
                $this->_output_request($output,'document');
				
            } else {
                echo $html;
            }
        } else {

            $this->template->load('default', $data);
        }
	}
	
	public function upload(){
	
		$this->load->library('docs');
	
		$document_type_id = 9;
		$ref_id = 0;
		$permission = array();
		
		$company_id = ($this->current_user->group_id == 1) ? ($this->input->post('company_id') ? $this->input->post('company_id') : 0) : $this->current_user->company_id;
		$client_id = $this->input->post('client_id') ? $this->input->post('client_id') : 0;
		$site_id = $this->input->post('site_id') ? $this->input->post('site_id') : 0;
		$job_id = $this->input->post('job_id') ? $this->input->post('job_id') : 0;
		$quote_id = $this->input->post('quote_id') ? $this->input->post('quote_id') : 0;
		$equipment_id = $this->input->post('equipment_id') ? $this->input->post('equipment_id') : 0;
		$file_element_name = $this->input->post('file_element_name') ? $this->input->post('file_element_name') : 'dfile';
		
		$remember_code = $this->input->post('doc_key') ? $this->input->post('doc_key') : NULL;
		$document_type_id =  $this->input->post('document_type_id') ? $this->input->post('document_type_id') : 0;
		
		$doc_secret_key = wdp_arr_decode($this->input->post('doc_secret_key'));

		if($doc_secret_key){
		
			$ref_id = isset($doc_secret_key[WDP_REF_ID]) ? $doc_secret_key[WDP_REF_ID] : $ref_id;
			$remember_code = isset($doc_secret_key[WDP_DOC_REF]) ? $doc_secret_key[WDP_DOC_REF] : $remember_code;
			$document_type_id = isset($doc_secret_key[WDP_TYPE_ID]) ? $doc_secret_key[WDP_TYPE_ID] : $document_type_id;
			
			$permission = array(
				"groups_allowed" => array(2,3)
			);
			
			if(gtzero_integer($document_type_id) && (INT)$document_type_id == 1){
				
				if( gtzero_integer($ref_id) && empty($remember_code) ){
					$this->load->model('jobs_model', 'job_m');
					
					$job_info = $this->job_m->details($ref_id);
					$company_id = $job_info->company_id;
					unset($job_info);
				}
				
				$permission = array(
					"groups_allowed" => array(2,3,5,6)
				);
			}
			
			if(gtzero_integer($document_type_id) && (INT)$document_type_id == 2){
				$permission = array(
					"groups_allowed" => array(2,3)
				);
			}
			
			if(gtzero_integer($document_type_id) && (INT)$document_type_id == 10){
				$permission = array(
					"groups_allowed" => array(2,3)
				);
			}
			
		}else if(gtzero_integer($document_type_id)){
		
			$ref_id = $this->input->post('ref_id') ? $this->input->post('ref_id') : 0;
			
			$permission = array(
				"groups_allowed" => array(2,3)
			);
		
		} else {
			
			if(gtzero_integer($company_id)){
				
				$document_type_id = 6;
				$ref_id = $company_id;
				$permission = array(
					"groups_allowed" => array(2,3)
				);
			}
			
			if(gtzero_integer($client_id)){
				$document_type_id = 7;
				$ref_id = $client_id;
				$permission = array(
					"groups_allowed" => array(2,3,5,6)
				);
			}
			
			if(gtzero_integer($site_id)){
				$document_type_id = 8;
				$ref_id = $site_id;
				$permission = array(
					"groups_allowed" => array(2,3,5,6)
				);
			}
			
			if(gtzero_integer($job_id)){
				$document_type_id = 1;
				$ref_id = $job_id;
				$permission = array(
					"groups_allowed" => array(2,3,5,6)
				);
			}
			
			if(gtzero_integer($quote_id)){
				$document_type_id = 2;
				$ref_id = $quote_id;
				$permission = array(
					"groups_allowed" => array(2,3)
				);
			}
			
			if(gtzero_integer($equipment_id)){
				$document_type_id = 10;
				$ref_id = $quote_id;
				$permission = array(
					"groups_allowed" => array(2,3)
				);
			}
		}
		
		$output = array( 'message' => "", 'status' => "");

        $output = $this->docs->_upload_doc($company_id, $this->current_user->user_id, $document_type_id, $ref_id, $file_element_name, $permission, $remember_code);
		
		$output['gallery_url'] = site_url('document/index');
		
		$output['post_vars'] 	= $_POST;
		
		//header('Content-Type: application/json');
		echo json_encode($output);
	}

    public function upload_document() {

        $status = "";
        $msg = "";
		
        $file_element_name = 'userfile';
		
		$document_type_id = $this->input->post('document_type_id') ? $this->input->post('document_type_id') : 1;

        if (empty($_POST['ref_id'])) {
            $status = "error";
            $msg = "No ref_id found";
        }
	
		$file_id = false;
	
        if ($status != "error") {

            $this->load->library('upload');

            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
                $this->session->set_flashdata('message', $msg);
            } else {
                $data = $this->upload->data();

                $thumbnail_name = '';

                //create a thumbnail if it's an image
                if ($data['is_image']) {
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $data['full_path'];
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 112;
                    $config['height'] = 87;

                    $this->load->library('image_lib', $config);

                    if (!$this->image_lib->resize()) {
                        $this->session->set_flashdata('message', $this->image_lib->display_errors('<p class="error">', '</p>'));
                    }

                    $thumbnail_name = $data['raw_name'] . $this->image_lib->thumb_marker . $data['file_ext'];
                } else {
                    //not an image so set the thumbnail to be standard

                    switch ($data['file_ext']) {
                        case '.avi':
                            $thumbnail_name = 'avi.png';
                            break;
                        case '.doc':
                            $thumbnail_name = 'doc.png';
                            break;
                        case '.docx':
                            $thumbnail_name = 'docx.png';
                            break;
                        case '.pdf':
                            $thumbnail_name = 'pdf.png';
                            break;
                        case '.ppt':
                            $thumbnail_name = 'ppt.png';
                            break;
                        case '.pptx':
                            $thumbnail_name = 'pptx.png';
                            break;
                        case '.psd':
                            $thumbnail_name = 'psd.png';
                            break;
                        case '.txt':
                            $thumbnail_name = 'txt.png';
                            break;
                        case '.xls':
                            $thumbnail_name = 'xls.png';
                            break;
                        case '.xlsx':
                            $thumbnail_name = 'xlsx.png';
                            break;
                        case '.dwg':
                            $thumbnail_name = 'dwg.png';
                            break;

                        default:
                            $thumbnail_name = 'file.png';
                            break;
                    }
                }

                $file_data = array(
                    'document_type_id' 			=> $document_type_id //job doc
                    ,'ref_id' 					=> $this->input->post('ref_id')
                    ,'document_name' 			=> $data['file_name']
                    ,'original_name' 			=> $data['orig_name']
                    ,'uploaded_by_user_id' 		=> $this->current_user->user_id
                    ,'mime_type' 				=> $data['file_type']
                    ,'is_image' 				=> $data['is_image']
                    ,'thumbnail_name' 			=> $thumbnail_name
                );

                $file_id = $this->document_model->insert_file($file_data);
                
				if ($file_id) {
                    
					$status = "success";
                    $msg = "File successfully uploaded";
					
					if(validate_integer($document_type_id) && (INT)$document_type_id == 1){
						
						$job_id = $this->input->post('ref_id');
						
						if(validate_integer($job_id) && (INT)$job_id == 1){
							
							$this->load->model('job_model', 'job_m');
							
							$job = $this->job_m->get_job_by_id($job_id);
						
							trigger_trip("new_job_document", $job['company_id'], array('document_id' => $file_id,'job_id' => $job_id, 'created_by' => $this->current_user->user_id));
						}
					}
					
					if(ENVIRONMENT == "production" || ENVIRONMENT == 'testing') {
						
						try
						{

							//move the file  
							//upload it to s3 also...
							$this->load->library('s3');

							//$input_file = $this->s3->inputFile($file_element_name);
							$bucket = 'workdeskpro';


							$input = $this->s3->inputResource(fopen($data['full_path'], "rb"), filesize($data['full_path']));

							if ($this->s3->putObject($input, $bucket, DOCUMENT_FOLDER . $data['file_name'], S3::ACL_PUBLIC_READ)) {
								//remove the locally uploaded file
								@unlink($data['full_path']);
								
								if ($data['is_image']){
									//do same with thumbnail...
									$input = $this->s3->inputResource(fopen($data['file_path'].$thumbnail_name, "rb"), filesize($data['file_path'].$thumbnail_name));
									$this->s3->putObject($input, $bucket, DOCUMENT_FOLDER . $thumbnail_name, S3::ACL_PUBLIC_READ);
									@unlink($data['file_path'].$thumbnail_name);
								 
								}
								
							} else {
								$status = "error";
								$msg = "File successfully uploaded, but transfer to CDN failed";
							}
							
						} catch (Exception $e) {
							$status = "error";
							$msg = "File successfully uploaded, but transfer to CDN failed";
						}
					}
					
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
		
        echo json_encode(array('status' => $status, 'msg' => $msg, 'file_id' => $file_id));
    }

    public function show_files($pkey = '') {
	
		$document_type_id = 9;$ref_id = 0;$doc_ref = FALSE;
		
		$params = (($params = wdp_arr_decode($pkey)) && is_array($params)) ? $params : array();
		
		if($params){
		
			$ref_id = (array_key_exists(WDP_REF_ID, $params) && gtzero_integer($params[WDP_REF_ID])) ? to_int($params[WDP_REF_ID]) : 0;
			$document_type_id = (array_key_exists(WDP_TYPE_ID, $params) && gtzero_integer($params[WDP_TYPE_ID])) ? to_int($params[WDP_TYPE_ID]) : 0;
		
		} else {
		
			$doc_secret_key = wdp_arr_decode($this->input->post('doc_secret_key'));
			
			
			if($doc_secret_key){
			
				$ref_id = isset($doc_secret_key[WDP_REF_ID]) ? $doc_secret_key[WDP_REF_ID] : FALSE;
				$doc_ref = isset($doc_secret_key[WDP_DOC_REF]) ? $doc_secret_key[WDP_DOC_REF] : FALSE;
				$document_type_id = isset($doc_secret_key[WDP_TYPE_ID]) ? $doc_secret_key[WDP_TYPE_ID] : 0;
				
			} else {
				$ref_id = $this->input->post('ref_id');
				$doc_ref = $this->input->post('doc_ref');
				$document_type_id = $this->input->post('document_type_id') ? $this->input->post('document_type_id') : 0;
			}
		} 
        
		$files = $this->document_model->get_files(array(
			'ref_id'			=> $ref_id
			,'doc_ref'			=> $doc_ref
			,'document_type_id'	=> $document_type_id
		));
		
        $this->template->raw_view('pages/docs/files', array('files' => $files, 'ref_id' => $ref_id));
    }
	
	/* 
	 * Below function is used for showing email attachments for websites
	*/
	public function attachments(){
	
		$ref_id = $this->input->post('ref_id');
		$doc_ref = $this->input->post('doc_ref');
		
		$files = $this->document_model->get_files_by_many(array(
			'ref_id' 			=> $ref_id, 
			'document_type_id' 	=> 4, 
			'remember_code' 	=> $doc_ref
		));
        
		return $this->template->raw_view('pages/docs/attachments', array('files' => $files, 'ref_id' => $ref_id));
	}

	public function delete($id, $method = 'echo') {

        $details = $this->document_model->details($id);
		
		$this->form_validation->set_rules('confirm', 'confirm', 'trim|required');
		
		$output = array( 'message' => "", 'status' => "");
		
        if ($this->form_validation->run() == TRUE) {
			
			$permission = doc_delete_permission($details, $this->current_user);
			
			if($permission) {
		
				$is_record_updated = $this->document_model->delete_file($id);
				
				if($is_record_updated){
					$output['message'] 		= sprintf('The document "%s" has been deleted.', $details->original_name);
					$output['status'] 		= SUCCESS_MESSAGE;
					$output['document_id'] 	= $id;
				
					/* Implement Trigger here and record the transaction in DB and send email for this */
					/*trigger_trip("client_deleted", $details->company_id, array('client_id' => $id, 'deleted_by' => $this->current_user->user_id));*/
					
				} else {
					$output['message'] 	= sprintf('Error occurred while trying to delete document "%s".', $details->original_name);
					$output['status'] 	= ERROR_MESSAGE;
				}
			} else {
				$output['message'] 	= sprintf('You don\'t have required permission to delete document "%s".', $details->original_name);
				$output['status'] 	= ERROR_MESSAGE;
			}
			
			$this->_output_request($output,'document');
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$data = array(
			'form_action'			=> site_url('document/delete/' . $id)
			,'cancel_url'			=> site_url('document')
            , 'page' 				=> 'docs/delete'
			, 'title' 				=> 'Delete Document'
			, "display_message"		=> sprintf('Are you sure you want to delete document "%s"?',$details->original_name)
			, "display_heading"		=> sprintf('Delete Document',$details->original_name)
			, "submit_btn_text"		=> "Save Changes"
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/docs/delete_modal', $data, TRUE);

            if ($method == "ajax") {
			
				$output['html']	= $html;
                $this->_output_request($output,'document');
				
            } else {
                echo $html;
            }
        } else {
		
            $this->template->load('default', $data);
        }
    }
	
    public function delete_file() {

        if ($this->input->post('json')) {

            $file_id = $this->input->post('document_id');
            $return = $this->document_model->delete_file($file_id);

            echo json_encode($return);
            exit;
        }
    }
	
	/* 
	 * Below function is used for uploading job documents from mobile type devices 
	*/
	public function job_document(){
		
		$job_id = $this->input->post('job_id') ? $this->input->post('job_id') : 0;
		$file_element_name = $this->input->post('file_element_name') ? $this->input->post('file_element_name') : 'userfile_regular';
		$document_type_id = 1;
		
		$permission = array(
			"groups_allowed" => array(2,3,5,6)
		);
		
		$this->load->model('jobs_model');
		$job = $this->jobs_model->get_job_by_id($job_id);
		$company_id = $job['company_id'];
		
		$output = array( 'message' => "", 'status' => "");

        $output = $this->docs->_upload_doc($company_id, $this->current_user->user_id, $document_type_id, $job_id, $file_element_name, $permission, NULL);
		
		redirect("job/show/{$job_id}");
	}
    
	public function permission($id, $method = "echo") {
	
		ensure_user_access(TRUE, array('admin', 'management_company', 'user_company'));
	
		$output = array( 'message' => "", 'status' => "");
		
		$details = $this->document_model->details($id);
		
		$company_id = $this->input->post('company_id', TRUE) ? $this->input->post('company_id', TRUE) : $details->company_id;

		$this->form_validation->set_rules('users_allowed', 'Users Allowed', '');
        $this->form_validation->set_rules('groups_allowed', 'Groups Allowed', '');

        if ($this->form_validation->run() == TRUE) {
			$groups_allowed = $this->input->post('groups_allowed');
			
			if(empty($groups_allowed)){
				$groups_allowed = array();
			} elseif(!is_array($groups_allowed)){
				$groups_allowed = array($groups_allowed);
			}
			
			$users_allowed = $this->input->post('users_allowed');
			
			if(empty($users_allowed)){
				$users_allowed = array();
			} elseif(!is_array($users_allowed)){
				$users_allowed = array($users_allowed);
			}
		
			$d_per = array(
				"groups_allowed" 	=> $groups_allowed
				,"users_allowed"	=> $users_allowed
			);
		
			$is_record_updated = $this->document_model->update_permission_by_id($id,serialize($d_per));
			
			if($is_record_updated){
				$output['message'] 		= 'The Document Permission was updated.';
                $output['status'] 		= SUCCESS_MESSAGE;
				$output['document_id'] 	= $id;
			} else {
				$output['message'] 		= 'An error occurred.';
                $output['status'] 		= ERROR_MESSAGE;
			}
			
			$this->_output_request($output,'');
			
		} else {
			
			if(validation_errors()){
				$output['message'] 	= validation_errors();
                $output['status'] 	= ERROR_MESSAGE;
			}
        }
		
		$data = array(
			'form_action'				=> site_url('document/permission/'.$id)
			,'cancel_url'				=> site_url('document')
            , 'page' 					=> 'docs/permission_form'
            , 'title' 					=> 'Edit Permission'
			, 'submit_btn_text'			=> 'Save Changes'
            , 'company_id' 				=> $company_id
			, 'document_name'			=> $details->original_name
			, 'document_type'			=> $details->document_type
			, 'document_permission'		=> get_doc_permission($details->permission, $details->document_type_id)
			, 'groups'					=> groups_dropdown('return', TRUE, '')
			, 'js_files'				=> array('docs/per.form.js')
        );

        if ($this->input->is_ajax_request()) {

            $html = $this->template->raw_view('pages/docs/permission_form', $data, TRUE);

            if ($method == "ajax") {
			
				$output['html']	= $html;
                $this->_output_request($output,'');
				
            } else {
                echo $html;
            }
        } else {
		
            $this->template->load('default', $data);
        }
	}
}

?>
