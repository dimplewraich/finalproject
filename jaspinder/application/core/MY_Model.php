<?php if (!defined('BASEPATH')) exit('No direct script access');

class MY_Model extends CI_Model {
	
	protected $primary_key = 'id';
	protected $msg_no_table = '';
	protected $msg_invalid_array = '';
	protected $cfg = null;
	
	public function __construct() {
		parent::__construct();
		
		
		$this->msg_invalid_array    =   "Data must be provided in the form of array";
        $this->msg_no_table         =   "Table does not exist in database";
	}
	
	public function core_settings(){
	
		$core_settings = FALSE;
	
		if( isset(ci()->cfg) && ci()->cfg) return ci()->cfg;
		
		if( (ci()->cfg = _get_cache('frlbz', CACHE_KEY_SYS_SETTINGS)) && ci()->cfg !== FALSE){
			
			return ci()->cfg;
		}
		
		$this->db
				->select("*")
				->from("settings");
		$qrows = $this->db->get()->result();
		
		ci()->cfg = new stdClass();
		
		foreach($qrows AS $qrow){
			
			if( strtolower($qrow->type) == 'int') {
			
				ci()->cfg->{$qrow->key} = to_int($qrow->value);
				
			} elseif( strtolower($qrow->type) == 'decimal') {
				
				ci()->cfg->{$qrow->key} = to_float($qrow->value);
				
			} else {
				ci()->cfg->{$qrow->key} = to_string($qrow->value);
			}
			
		}
		
		_set_cache('frlbz', ci()->cfg , CACHE_KEY_SYS_SETTINGS);
		
		return ci()->cfg;
		
	}
	
	public function update_core_settings($setting_key, $setting_value) {
	
		$this->db->where('key', $setting_key);
	
		$input = array('value' => $setting_value);
	
		$return = $this->db->update('settings', $input);
		
		ci()->cfg->{$setting_key} = to_string($setting_value);
		
		return $return;
    }
	
	public function clear_core_setting_cache() {
		
		_delete_cache('frlbz', CACHE_KEY_SYS_SETTINGS);
	
	}

    public function company_settings($company_id){
		
		if( ($data = _get_cache($company_id, CACHE_KEY_COMPANY_SETTINGS)) && $data !== FALSE){
			return $data;
		}
	
		$this->db
			->select('cs.*, com.name AS company_name')
			->from('company_settings cs')
			->join("companies com","cs.company_id=com.id")
			->where('cs.company_id', to_int($company_id));
        
		$query = $this->db->get();

		$cfg = false;
        if ($query->num_rows() > 0) {
			
			$company = $this->company_detail($company_id);
			
            $cfg =  $query->row();
			
			$cfg->invoice_auto_incrementer = $company->invoice_auto_incrementer;
			$cfg->calender_view = !empty($cfg->calender_view) ? unserialize($cfg->calender_view) : array(1);
			
			$cfg->working_hours_start_time = $this->valid_working_hours($cfg->working_hours_start_time);
			$cfg->working_hours_end_time = $this->valid_working_hours($cfg->working_hours_end_time);
			$cfg->resource_working_hours_from = $this->valid_working_hours($cfg->resource_working_hours_from);
			$cfg->resource_working_hours_to = $this->valid_working_hours($cfg->resource_working_hours_to);
			
			$cfg->allow_survey = to_int($cfg->allow_survey);
			$cfg->default_invitees = explode(',', $cfg->default_invitees);
			$cfg->default_timesheet_access = explode(',', $cfg->default_timesheet_access);
			
        } else {
		
			$company = $this->company_detail($company_id);
		
            $cfg = new StdClass;
			$cfg->company_name = isset($company->name) ? $company->name : '';
			$cfg->vat = 0;
			$cfg->show_alternative_job_number = 0;
			$cfg->show_custom_job_tags = 0;
			$cfg->gmt_offset = ci()->cfg->gmt_offset;
			$cfg->sequencial_number_id = 0;
			$cfg->allow_invoice_number_format = 0;
			$cfg->invoice_number_format = '';
			$cfg->invoice_auto_incrementer = isset($company->invoice_auto_incrementer) ? $company->invoice_auto_incrementer : 0;
			$cfg->invoice_merge_same_day_visit = 0;
			$cfg->calender_view = array(1);
			$cfg->body_font_color = '';
			$cfg->working_hours_start_time = '';
			$cfg->working_hours_end_time = '';
			$cfg->basic_number_of_hours = 0;
			$cfg->resource_working_hours_from = '';
			$cfg->resource_working_hours_to = '';
			$cfg->allow_survey = 1;
			$cfg->default_invitees = array();
			$cfg->default_timesheet_access = array();
        }
		
		_set_cache($company_id, $cfg , CACHE_KEY_COMPANY_SETTINGS);
		
		return $cfg;
	
	}

    public function company_custom_fields($company_id){
		
		if( ($custom_fields = _get_cache($company_id, CACHE_KEY_CUSTOM_FIELDS)) && $custom_fields !== FALSE){
			return $custom_fields;
		}
	
		$this->db
			->select('*')
			->from('custom_fields');
			
		$qrows = $this->db->get()->result();
		
		$custom_fields = new StdClass;
		
		foreach($qrows AS $qrow){
			
			$custom_fields->{$qrow->key} = $qrow->value;
			
		}
		
		if( gtzero_integer($company_id) ){
			
			$this->db
					->select('custom_fields.key,company_custom_fields.value')
					->from('custom_fields')
					->join('company_custom_fields', 'custom_fields.id=company_custom_fields.custom_field_id', 'INNER')
					->where('company_id', to_int($company_id));
			
			$qrows = $this->db->get()->result();
			
			foreach($qrows AS $qrow){
			
				$custom_fields->{$qrow->key} = !empty($qrow->value) ? $qrow->value : $custom_fields->{$qrow->key};
				
			}
		}
		
		_set_cache($company_id, $custom_fields , CACHE_KEY_CUSTOM_FIELDS);
		
		return $custom_fields;
	
	}
	
	public function company_detail($company_id) {
        
		if( ($company_info = _get_cache($company_id, CACHE_KEY_COMPANY_INFO)) && $company_info !== FALSE){
			return $company_info;
		}
        
		$this->db
				->select('*')
				->from('companies')
				->where('id', to_int($company_id));

        $company_info = $this->db->get()->row();
		
		_set_cache($company_id, $company_info , CACHE_KEY_COMPANY_INFO);
		
		return $company_info;
    }
	
	public function update_invoice_auto_incrementer($invoice_auto_incrementer, $company_id) {
	
		$input = array('invoice_auto_incrementer' => $invoice_auto_incrementer);
	
        $this->db->where('id', to_int($company_id));
        
		$return = $this->db->update('companies', $input);
		
		_delete_cache($company_id, CACHE_KEY_COMPANY_SETTINGS);
		_delete_cache($company_id, CACHE_KEY_COMPANY_INFO);
		
		return $return;
    }
	
	protected function user_company_by_user_id($user_id) {
		
		$uc = '(SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc';
		
		$this->db
			->select('uc.company_id')
			->from('users u')
			->join($uc, 'u.id=uc.user_id', 'INNER')
			->where('u.id', to_int($user_id));
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return to_int($query->row()->company_id);
		}
		
        return 0;
	}
	
	protected function _post_args($key, $type = ARGS_TYPE_STRING, $default = '', $params = array()){
		
		$value = '';$post_default='';
		
		$key_exist = array_key_exists($key, $_POST);
		$override = array_key_exists('override', $params) ? $params['override'] : FALSE;
		$entities_to_ascii = array_key_exists('entities_to_ascii', $params) ? $params['entities_to_ascii'] : FALSE;
		$gtzero = array_key_exists('gtzero', $params) ? $params['gtzero'] : TRUE;

		switch($type){
			case ARGS_TYPE_STRING:
				
				$post_default = $override ? $default : '';
				$value = $key_exist ? ($this->input->post($key, TRUE) ? $this->input->post($key, TRUE) : $post_default) : $default;
				if($entities_to_ascii) $value= entities_to_ascii($value);
				break;
				
			case ARGS_TYPE_INT:
				
				$default = validate_integer($default) ? to_int($default) : 0;
				$post_default = $override ? $default : 0;
				$value = $key_exist ? ( (($value = $this->input->post($key)) && gtzero_integer($value)) ? to_int($value) : $post_default ) : $default;
				break;
				
			case ARGS_TYPE_TRUE_FALSE:
				
				$default = validate_integer($default) ? ( gtzero_integer($default) ? TRUE : FALSE ) : FALSE;
				$post_default = $override ? $default : FALSE;
				$value = $key_exist ? ( (($value = $this->input->post($key)) && (($gtzero && gtzero_integer($value)) || (!$gtzero && validate_integer($value))) ) ? TRUE : $post_default ) : $default;
				break;
				
			case ARGS_TYPE_ARRAY:
				
				$value = $key_exist ? ( (($value = $this->input->post($key)) && is_array($value)) ? $value : array() ) : ( is_array($default) ? $default : array());
				break;
				
			case ARGS_TYPE_DECIMAL:
				
				$default = gtzero_decimal($default) ? to_float($default) : 0;
				$post_default = $override ? $default : 0;
				$value = $key_exist ? ( (($value = $this->input->post($key)) && gtzero_decimal($value)) ? to_float($value) : $post_default ) : $default;
				break;
				
			case ARGS_TYPE_DATE:
			
				$default = validate_date($default) ? $default : '';
				$post_default = $override ? $default : '';
				$value = $key_exist ? ( (($value = $this->input->post($key)) && validate_date($value)) ? $value : $post_default ) : $default;
				break;
				
			case ARGS_TYPE_DATETIME:
			
				$default = validate_datetime($default) ? $default : '';
				$post_default = $override ? $default : '';
				$value = $key_exist ? ( (($value = $this->input->post($key)) && validate_date($value)) ? $value : $post_default ) : $default;
				break;
				
			default:
				$post_default = $override ? $default : '';
				$value = $key_exist ? ($this->input->post($key, TRUE) ? $this->input->post($key, TRUE) : $post_default) : $default;
				break;
		}
		
		unset($post_default);
		
		return $value;
		
	}
	
	protected function valid_working_hours($working_hours){
		
		return (!empty($working_hours) && ($t = explode(':', $working_hours)) ) ? $t[0].':'.$t[1] : '';
		
	}
	
	protected function _build_filters($current_user_id = 0) {
	
        $data = _get_user_group($current_user_id);

        switch ($data['group_id']) {
            case GROUP_ADMIN: // admins: see all so no conditions
                break;
				
            case GROUP_MANAGEMENT_COMPANY: // contractor_management: see all for their company, and all regions
			
                $data['users_company_id'] = $this->user_company_by_user_id($data['user_id']);
				
                break;
				
            case GROUP_STAFF:
                break;
				
            case GROUP_ENGINEER:
                break;
            default:
                break;
        }
		
        return $data;
    }
}

/* End of file My_Model.php */
/* Location: ./application/core/My_Model.php */