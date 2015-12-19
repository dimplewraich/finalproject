<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Docs {
	
	protected $CI;
	
	protected $file_element_name = 'feedback';
	
	public function __construct() {
		$this->CI =& get_instance();
	}
	
	public function _do_multi_upload($user_id , $file_element_name=''){
		
		$this->CI->load->library('upload');
		$this->CI->load->model('document_model');
	
		$output = array( 'status' => '', 'message' => '');
		$file_element_name = ($file_element_name == '') ? $this->file_element_name : $file_element_name;
		
		
	}
	
	public function _upload($user_id , $file_element_name=''){
		
		$this->CI->load->library('upload');
		$this->CI->load->model('document_model');
	
		$output = array( 'status' => '', 'message' => '');
		$file_element_name = ($file_element_name == '') ? $this->file_element_name : $file_element_name;
		
	
		
		if ( !$this->CI->upload->do_upload($file_element_name) ) {
			$output['status'] = ERROR_MESSAGE;
			$output['message'] = $this->CI->upload->display_errors('', '');
		} else {
			$data = $this->CI->upload->data();

			$thumbnail_name = '';

			//create a thumbnail if it's an image
			if ($data['is_image']) {
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = $data['full_path'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 112;
				$config['height'] = 87;

				$this->CI->load->library('image_lib', $config);

				if ( !$this->CI->image_lib->resize() ) {
					$output['status'] = ERROR_MESSAGE;
					$output['message'] = $this->CI->image_lib->display_errors('<p class="error">', '</p>');
				}

				$thumbnail_name = $data['raw_name'] . $this->CI->image_lib->thumb_marker . $data['file_ext'];
			} else {

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
				'document_type_id'			=> 3
				, 'ref_id'					=> 0
				, 'document_name' 			=> $data['file_name']
				, 'original_name' 			=> $data['orig_name']
				, 'uploaded_by_user_id' 	=> $user_id
				, 'mime_type' 				=> $data['file_type']
				, 'is_image' 				=> $data['is_image']
				, 'thumbnail_name' 			=> $thumbnail_name
				, 'raw_data'				=> serialize($data)
			);

			$file_id = $this->CI->document_model->insert_file($file_data);
			
			if ($file_id) {
			
				$output['status'] = SUCCESS_MESSAGE;
				$output['message'] = "File successfully uploaded";
				$output['file_id'] = $file_id;
				
			} else {
				@unlink($data['full_path']);
				$output['status'] = ERROR_MESSAGE;
				$output['message'] = "Something went wrong when saving the file, please try again.";
			}
		}
		@unlink($_FILES[$file_element_name]);
		
		return $output;
	}
	
	public function _upload_doc($company_id, $user_id, $document_type_id, $ref_id, $file_element_name, $permission, $remember_code){
		
		$this->CI->load->library('upload');
		$this->CI->load->model('document_model');
	
		$output = array( 'status' => '', 'message' => '');
	
		$qrows = array();
		
		$return_flag = $this->CI->upload->do_multi_upload($file_element_name);
	
		if($return_flag && $this->CI->upload->_multiple_upload == TRUE){
		
			$qrows = $this->CI->upload->_multiple_upload_data;
		
		} elseif($return_flag && $this->CI->upload->_multiple_upload == FALSE){
			$qrows[] = $this->CI->upload->data();
		}
		
		//if ( !$this->CI->upload->do_upload($file_element_name) ) {
		if ( !$return_flag ) {
		
			$output['status'] = ERROR_MESSAGE;
			$output['message'] = $this->CI->upload->display_errors('', '');
			$output['file_info'] = $this->CI->upload->data();
			
		} else {
			//$data = $this->CI->upload->data();
			//$output['file_info'] = $this->CI->upload->data();
			$this->CI->load->library('image_lib');
			
			$success_message_count = 0;
			
			foreach($qrows AS $data){
			
				$thumbnail_name = '';

				//create a thumbnail if it's an image
				if ($data['is_image']) {
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = $data['full_path'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 112;
					$config['height'] = 87;

					$this->CI->image_lib->clear();
					$this->CI->image_lib->initialize($config);

					if ( !$this->CI->image_lib->resize() ) {
						$output['status'] = ERROR_MESSAGE;
						$output['message'] = $this->CI->image_lib->display_errors('<p class="error">', '</p>');
					}

					$thumbnail_name = $data['raw_name'] . $this->CI->image_lib->thumb_marker . $data['file_ext'];
					
				} else {

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
					'company_id'				=> $company_id
					, 'document_type_id'		=> $document_type_id
					, 'ref_id'					=> $ref_id
					, 'document_name' 			=> $data['file_name']
					, 'original_name' 			=> $data['orig_name']
					, 'uploaded_by_user_id' 	=> $user_id
					, 'mime_type' 				=> $data['file_type']
					, 'is_image' 				=> $data['is_image']
					, 'thumbnail_name' 			=> $thumbnail_name
					, 'permission'				=> serialize($permission)
					, 'raw_data'				=> serialize($data)
					,'remember_code'			=> $remember_code
				);

				$file_id = $this->CI->document_model->insert_file($file_data);
				
				if ($file_id) {
					
					if(ENVIRONMENT == "production" || ENVIRONMENT == 'testing') {
						
						try {

							//move the file  
							//upload it to s3 also...
							$this->CI->load->library('s3');

							//$input_file = $this->s3->inputFile($file_element_name);
							$bucket = 'workdeskpro';

							$input = $this->CI->s3->inputResource(fopen($data['full_path'], "rb"), filesize($data['full_path']));

							if ($this->CI->s3->putObject($input, $bucket, DOCUMENT_FOLDER . $data['file_name'], S3::ACL_PUBLIC_READ)) {
								//remove the locally uploaded file
								@unlink($data['full_path']);
								
								if ($data['is_image']){
									//do same with thumbnail...
									$input = $this->CI->s3->inputResource(fopen($data['file_path'].$thumbnail_name, "rb"), filesize($data['file_path'].$thumbnail_name));
									$this->CI->s3->putObject($input, $bucket, DOCUMENT_FOLDER . $thumbnail_name, S3::ACL_PUBLIC_READ);
									@unlink($data['file_path'].$thumbnail_name);
								 
								}
								
								$output['status'] = SUCCESS_MESSAGE;
								$output['message'] = "File successfully uploaded";
								$success_message_count++;
								
							} else {
								$output['status'] = ERROR_MESSAGE;
								$output['message'] = "File successfully uploaded, but transfer to CDN failed";
							}
							
						} catch (Exception $e) {
							$output['status'] = ERROR_MESSAGE;
							$output['message'] = "File successfully uploaded, but transfer to CDN failed";
						}
						
					} else {
						
						$output['status'] = SUCCESS_MESSAGE;
						$output['message'] = "File successfully uploaded";
						$success_message_count++;
					}
					
				} else {
					@unlink($data['full_path']);
					$output['status'] = ERROR_MESSAGE;
					$output['message'] = "Something went wrong when saving the file, please try again.";
				}
				
			}
			
			if( $success_message_count > 0 ){
				
				$output['status'] = SUCCESS_MESSAGE;
				$output['message'] = $success_message_count . " file(s) successfully uploaded";
			} else {
				
				$output['status'] = ERROR_MESSAGE;
				$output['message'] = "Something went wrong when saving the file, please try again.";
			}
		}
		
		@unlink($_FILES[$file_element_name]);
		
		return $output;
	}
	
	public function _upload_ticket_attachments($company_id, $user_id, $document_type_id, $ref_id, $file_element_name, $permission, $remember_code){
		
		$this->CI->load->library('upload');
		$this->CI->load->model('ticket_attachment_model', 'ticket_attachment_m');
	
		$output = array( 'status' => '', 'message' => '');
	
		$qrows = array();
		$return_flag = $this->CI->upload->do_multi_upload($file_element_name);
		
		if($return_flag && $this->CI->upload->_multiple_upload == TRUE){
			
			$qrows = $this->CI->upload->_multiple_upload_data;
			
		} elseif($return_flag && $this->CI->upload->_multiple_upload == FALSE){
			$qrows[] = $this->CI->upload->data();
		}
		
		if ( !$return_flag ) {
			$output['status'] = ERROR_MESSAGE;
			$output['message'] = $this->CI->upload->display_errors('', '');
		} else {
			
			$error_message_count = 0;
			$success_message_count = 0;
			
			$this->CI->load->library('image_lib');
			
			foreach($qrows AS $data){ 

				$thumbnail_name = '';

				//create a thumbnail if it's an image
				if ($data['is_image']) {
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = $data['full_path'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 112;
					$config['height'] = 87;

					$this->CI->image_lib->clear();
					$this->CI->image_lib->initialize($config);

					if ( !$this->CI->image_lib->resize() ) {
						$output['status'] = ERROR_MESSAGE;
						$output['message'] = $this->CI->image_lib->display_errors('<p class="error">', '</p>');
					}

					$thumbnail_name = $data['raw_name'] . $this->CI->image_lib->thumb_marker . $data['file_ext'];
				
				} else {

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
					'company_id'				=> $company_id
					, 'attachment_type_id'		=> $document_type_id
					, 'ref_id'					=> $ref_id
					, 'document_name' 			=> $data['file_name']
					, 'original_name' 			=> $data['orig_name']
					, 'uploaded_by' 			=> $user_id
					, 'mime_type' 				=> $data['file_type']
					, 'is_image' 				=> $data['is_image']
					, 'thumbnail_name' 			=> $thumbnail_name
					, 'permission'				=> serialize($permission)
					, 'raw_data'				=> serialize($data)
					,'remember_code'			=> $remember_code
				);

				$file_id = $this->CI->ticket_attachment_m->insert_file($file_data);
				
				if ($file_id) {
						
					
					
					if(ENVIRONMENT == "production" || ENVIRONMENT == 'testing') {
						
						try{
							//move the file upload it to s3 also...
							$this->CI->load->library('s3');

							//$input_file = $this->s3->inputFile($file_element_name);
							$bucket = 'workdeskpro';


							$input = $this->CI->s3->inputResource(fopen($data['full_path'], "rb"), filesize($data['full_path']));

							if ($this->CI->s3->putObject($input, $bucket, DOCUMENT_FOLDER . $data['file_name'], S3::ACL_PUBLIC_READ)) {
								
								//remove the locally uploaded file
								@unlink($data['full_path']);
								
								if ($data['is_image']){
									
									//do same with thumbnail...
									$input = $this->CI->s3->inputResource(fopen($data['file_path'].$thumbnail_name, "rb"), filesize($data['file_path'].$thumbnail_name));
									$this->CI->s3->putObject($input, $bucket, DOCUMENT_FOLDER . $thumbnail_name, S3::ACL_PUBLIC_READ);
									@unlink($data['file_path'].$thumbnail_name);
								 
								}
								
								$output['status'] = SUCCESS_MESSAGE;
								$output['message'] = "File successfully uploaded";
								$success_message_count++;
								
							} else {
								
								$output['status'] = ERROR_MESSAGE;
								$output['message'] = "File successfully uploaded, but transfer to CDN failed";
							}
							
						} catch (Exception $e) {
							
							$output['status'] = ERROR_MESSAGE;
							$output['message'] = "File successfully uploaded, but transfer to CDN failed";
						}
					} else {
						
						$output['status'] = SUCCESS_MESSAGE;
						$output['message'] = "File successfully uploaded";
						$success_message_count++;
					}
					
				} else {
					
					@unlink($data['full_path']);
					$output['status'] = ERROR_MESSAGE;
					$output['message'] = "Something went wrong when saving the file, please try again.";
				}
				
			}
			
			if( $success_message_count > 0 ){
				
				$output['status'] = SUCCESS_MESSAGE;
				$output['message'] = $success_message_count . " file(s) successfully uploaded";
			} else {
				
				$output['status'] = ERROR_MESSAGE;
				$output['message'] = "Something went wrong when saving the file, please try again.";
			}
		}
		
		@unlink($_FILES[$file_element_name]);
		
		return $output;
	}
	
	public function s3_upload($params, $directory = ''){
	
		$this->CI->config->load('netlex_settings', TRUE);
		
		$is_s3_upload_allowed = $this->CI->config->item('s3_upload_allowed', 'netlex_settings');
		$bucket = $this->CI->config->item('s3_bucket', 'netlex_settings');
		$return = TRUE;
		
		try{
			
			$return = FALSE;
			if($is_s3_upload_allowed && (ENVIRONMENT == "production" || ENVIRONMENT == 'testing')) {


				$input = $this->CI->s3->inputResource(fopen($params['full_path'], "rb"), filesize($params['full_path']));

				if ($this->CI->s3->putObject($input, $bucket, DOCUMENT_FOLDER. $directory . $params['file_name'], S3::ACL_PUBLIC_READ)) {
					
					@unlink($params['full_path']);
					
					/*if ($params['is_image']){
						
						$input = $this->CI->s3->inputResource(fopen($params['file_path'].$thumbnail_name, "rb"), filesize($params['file_path'].$thumbnail_name));
						$this->CI->s3->putObject($input, $bucket, DOCUMENT_FOLDER . $thumbnail_name, S3::ACL_PUBLIC_READ);
						@unlink($params['file_path'].$thumbnail_name);
					 
					}*/
					
					$return = TRUE;
				}
			
			} else {
			
				$return = TRUE;
			}
				
		} catch (Exception $e) {
				
			$return = FALSE;
		}
		
		return $return;
		
	}
}
