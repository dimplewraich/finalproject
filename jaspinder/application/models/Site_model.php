<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Site_model extends MY_Model{
    
    public function __construct() {
        parent::__construct();
    }
	
	public function ajax_gets($params, $hiddenColms = array()) {

        $aColumns = array('s.code', 'com.name' ,'s.address', 's.street', 's.town', 's.postcode', 's.upload_date', 'created_by_name','s.created_on');
		
		if( _has_company_group_access($this->current_user->group_id) ){
			
			unset($aColumns[1]);
			
			$aColumns = array_values($aColumns);
		}
		
		$data = $this->_build_filters();
		
		$cc_ct = sprintf("(SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct");

        $this->db
				->select('SQL_CALC_FOUND_ROWS s.id as site_id', FALSE)
				->select('com.name as company_name ')
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->select('s.address,s.street,s.town, s.postcode,s.upload_date,s.code AS site_code, s.created_on')
				->select("CONCAT(`cc_ct`.`first_name`,' ',`cc_ct`.`last_name`) AS contact_name", FALSE)
				->select('cc_ct.email AS contact_email')
				->from('sites s')
				->join('companies com', 's.company_id = com.id','INNER')
				->join($cc_ct, 's.id = cc_ct.site_id', 'LEFT')
				->join('users u', 's.created_by = u.id','LEFT')
				->where("s.is_deleted",0)
				->where("com.is_deleted",0);
				
		//$this->_apply_filters($data);
        
        if(array_key_exists('company_id', $params) && $params['company_id'] ){
            
            $this->db->where("s.company_id", to_int($params['company_id']));
        }
		

        $this->db->group_by('s.id');

        if (isset($params['iDisplayStart']) && $params['iDisplayLength'] != '-1') {
            $this->db->limit($this->db->escape_str($params['iDisplayLength']), $this->db->escape_str($params['iDisplayStart']));
        }

        if (isset($params['iSortCol_0'])) {
            for ($i = 0; $i < intval($params['iSortingCols']); $i++) {
                $iSortCol = $this->input->get_post('iSortCol_' . $i, true);
                $bSortable = $this->input->get_post('bSortable_' . intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_' . $i, true);

                if ($bSortable == 'true') {
                    if($aColumns[intval($this->db->escape_str($iSortCol))] == 'created_by_name'){
					
						$this->db->order_by(sprintf("CONCAT(`u`.`first_name`,' ',`u`.`last_name`)"), $this->db->escape_str($sSortDir), FALSE);
						
					} else {
						$this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
					}
                }
            }
        }

        if (isset($params['sSearch']) && !empty($params['sSearch'])) {
		
			$sSearch = '%'.$this->db->escape_like_str( $params['sSearch'] ).'%';
		
			$where = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                $bSearchable = $this->input->get_post('bSearchable_' . $i, true);

                if (isset($bSearchable) && $bSearchable == 'true') {
					
					if($aColumns[$i] == 'created_by_name'){
						$where[] = sprintf("CONCAT(u.first_name,' ',u.last_name) LIKE '%s' ", $sSearch);
					} else {
						$where[] = sprintf($aColumns[$i]." LIKE '%s' ", $sSearch);
					}
                    
                }
            }
			
			if( count($where) > 1){
				$this->db->where('('.implode(' OR ', $where).')');
			}
        }


        $rResult = $this->db->get();

        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;

        // Total data set length
        $iTotal = $this->ajax_gets_count($params, $data); //needs to change to the specific query.
        
		// Output
        $output = array(
            'sEcho' 				=> intval($params['sEcho']),
            'iTotalRecords' 		=> $iTotal,
            'iTotalDisplayRecords' 	=> $iFilteredTotal,
            'aaData' 				=> $rResult->result()
        );

        return $output;
    }
	
	public function ajax_gets_count($params, $data) {

		$this->db
				->from('sites s')
				->join('companies com', 's.company_id = com.id','INNER')
				->join('users u', 's.created_by = u.id','LEFT')
				->where("s.is_deleted",0)
				->where("com.is_deleted",0);
				
		//$this->_apply_filters($data);
        
        if(array_key_exists('company_id', $params) && $params['company_id'] ){
            
            $this->db->where("s.company_id", to_int($params['company_id']));
        }

        return $this->db->count_all_results();
    }
	
	public function site_count() {

		$this->db
				->from('sites s')
				->join('companies com', 's.company_id = com.id','INNER')
				->join('users u', 's.created_by = u.id','LEFT')
				->where("s.is_deleted",0)
				->where("com.is_deleted",0);
				
		if(!in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER))){
			$this->db->where("s.company_id", $this->current_user->company_id);
		}

        return $this->db->count_all_results();
    }
        
	public function dropdown_list($company_id, $params = array()) {
	
        $this->db
			->select('s.id as site_id,s.code AS site_code, s.site_ref')
			->from('sites s')
			->join('companies com','s.company_id = com.id')
			//->where('s.company_id', to_int($company_id))
			->where("s.is_deleted", 0)
			->where("com.is_deleted", 0);
		
		if( array_key_exists('site_ids', $params) && is_array($params['site_ids']) && count($params['site_ids']) ){
            
            $this->db->where_in("s.id", $params['site_ids']);
        }
		
		if( array_key_exists('limit', $params) ){
            
			$limit = validate_integer($params['limit']) ? to_int($params['limit']) : 0;
			
            $this->db->limit($limit);
        }
		
        return $this->db->get()->result();
    }
    
    public function add_site($input) {
	
		$input['created_on'] = curr_timestamp();
	
       $this->db->insert("sites", $input);
	   
	   $primary_key = $this->db->insert_id();
		
		if( gtzero_integer($primary_key) ){
			
			return to_int($primary_key);
		}
		
		return 0;
    }
	
	public function add_site_form($input) {
	
		$this->db->insert("site_forms", $input);
	   
	   $primary_key = $this->db->insert_id();
		
		if( gtzero_integer($primary_key) ){
			
			return to_int($primary_key);
		}
		
		return 0;
    }
	
	public function update_site_form($input, $site_form_id, $site_id, $form_type_id) {
	
		$this->db->where('id', to_int($site_form_id));
        $this->db->where('site_id', to_int($site_id));
		$this->db->where('form_type_id', to_int($form_type_id));
        
		return $this->db->update('site_forms', $input);
    }
	
	public function add_site_form_feedback($input) {
	
		$this->db->where('site_form_id', to_int($input['site_form_id']));
		$this->db->where('site_id', to_int($input['site_id']));
		$this->db->where('form_type_id', to_int($input['form_type_id']));
		$this->db->where('question_id', to_int($input['question_id']));
		$this->db->delete("site_form_feedback");
	
		$this->db->insert("site_form_feedback", $input);
	   
	   return TRUE;
    }
	
	public function details($site_id, $company_id = 0) {
	
		$cc_ct = sprintf("(SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=%d) cc_ct", $site_id);
	
		/*if($company_id > 0 ){
			$this->db->where('companies.id', $company_id, FALSE);
		}*/
	
        $this->db
				->select('s.*,s.code AS site_code')
				->select('com.name AS company_name')
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->select("CONCAT(`cc_ct`.`first_name`,' ',`cc_ct`.`last_name`) AS contact_name", FALSE)
				->select('cc_ct.contact_id,cc_ct.email AS contact_email,cc_ct.first_name AS contact_first_name, cc_ct.last_name AS contact_last_name, cc_ct.address AS contact_address, cc_ct.phone AS contact_phone, cc_ct.mobile AS contact_mobile, cc_ct.fax AS contact_fax, cc_ct.is_default')
				->from('sites s')
				->join('companies com', 's.company_id = com.id','INNER')
				->join($cc_ct, 's.id = cc_ct.site_id', 'LEFT')
				->join('users u', 's.created_by = u.id','LEFT')
				->where('s.id', to_int($site_id));
        
        $site_info = $this->db->get()->row();
		
		$this->db
				->select('sf.*,ft.name AS form_name')
				->select("CONCAT(u.first_name,' ',u.last_name) AS added_by_name", FALSE)
				->select("CONCAT(uu.first_name,' ',uu.last_name) AS completed_by_name", FALSE)
				->select("CONCAT(usb.first_name,' ',usb.last_name) AS submitted_by_name", FALSE)
				->from('sites s')
				->join('site_forms sf', 's.id = sf.site_id','INNER')
				->join('form_types ft', 'sf.form_type_id = ft.id','INNER')
				->join('users u', 'sf.added_by = u.id','LEFT')
				->join('users uu', 'sf.completed_by = uu.id','LEFT')
				->join('users usb', 'sf.submitted_by = usb.id','LEFT')
				->where('s.id', to_int($site_id))
				->order_by('sf.id', 'ASC');
				
		$site_info->{'site_forms'} = $this->db->get()->result();
		
		return $site_info;
    }
	
	public function site_form_detail($id){
	
		$this->db
				->select('sf.*,ft.name AS form_name')
				->select("CONCAT(u.first_name,' ',u.last_name) AS added_by_name", FALSE)
				->select("CONCAT(uu.first_name,' ',uu.last_name) AS completed_by_name", FALSE)
				->select("CONCAT(usb.first_name,' ',usb.last_name) AS submitted_by_name", FALSE)
				->from('sites s')
				->join('site_forms sf', 's.id = sf.site_id','INNER')
				->join('form_types ft', 'sf.form_type_id = ft.id','INNER')
				->join('users u', 'sf.added_by = u.id','LEFT')
				->join('users uu', 'sf.completed_by = uu.id','LEFT')
				->join('users usb', 'sf.submitted_by = usb.id','LEFT')
				->where('sf.id', to_int($id))
				->order_by('sf.id', 'ASC');
		return $this->db->get()->row();
	}
    
    public function update($input, $site_id) {
	
        $this->db->where('id', to_int($site_id));
        
		return $this->db->update('sites', $input);
    }
    
    public function delete($site_id) {
	
        $this->db->where('id', to_int($site_id));
		
        return $this->db->update('sites', array('is_deleted' => 1));
    }
	
	public function custom_table_list($table = '') {

		if($table == 'form_section'){
			$this->db
				->select('id AS value, name AS text')
				->from($table)
				->where('is_deleted', 0);
		} else {
	
			$this->db
				->select('id, text, value')
				->from($table)
				->where('is_deleted', 0);
		}
		
        $query = $this->db->get();

        return $query->result();
    }
	
	public function form_types_dropdown_list($site_id) {
	
        $this->db
			->select('ft.id as form_type_id,ft.name AS form_type_name')
			->from('form_types ft')
			//->where(sprintf('ft.id NOT IN (SELECT form_type_id FROM site_forms WHERE site_id=%d)', to_int($site_id)))
			->where("ft.is_deleted", 0);
		
        return $this->db->get()->result();
    }
	
	public function district_dropdown_list() {
	
        $this->db
			->select('s.district_no as id,s.district_no AS name')
			->from('sites s')
			->join('companies com','s.company_id = com.id')
			->where("s.is_deleted", 0)
			->where("com.is_deleted", 0)
			->group_by('s.district_no')
			->order_by('s.district_no', 'ASC');
		
        return $this->db->get()->result();
    }
	
	public function postcode_dropdown_list() {
	
        $this->db
			->select('s.postcode as id,s.postcode AS name')
			->from('sites s')
			->join('companies com','s.company_id = com.id')
			->where("s.is_deleted", 0)
			->where("com.is_deleted", 0)
			->group_by('s.postcode')
			->order_by('s.postcode', 'ASC');
		
        return $this->db->get()->result();
    }
	
	public function site_field_dropdown_list($params = array()) {
	
        $this->db
			->select('s.'.$params['field_name'].' as id,s.'.$params['field_name'].' AS name')
			->from('sites s')
			->join('companies com','s.company_id = com.id')
			->where("s.is_deleted", 0)
			->where("com.is_deleted", 0)
			->group_by('s.'.$params['field_name'])
			->order_by('s.'.$params['field_name'], 'ASC');
		
        return $this->db->get()->result();
    }
	
	public function get_by_many($params) {
	
		if(
			array_key_exists('site_code', $params) && empty($params['site_code']) 
			&& array_key_exists('site_ref', $params) && empty($params['site_ref']) 
			&& array_key_exists('site_district', $params) && empty($params['site_district']) 
			&& array_key_exists('site_postcode', $params) && empty($params['site_postcode']) 
		){
			return array();
		}
		
		$cc_ct = sprintf("(SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct");

        $this->db
				->select('s.id as site_id')
				->select('com.name as company_name ')
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->select('s.*')
				->select("CONCAT(`cc_ct`.`first_name`,' ',`cc_ct`.`last_name`) AS contact_name", FALSE)
				->select('cc_ct.email AS contact_email')
				->from('sites s')
				->join('companies com', 's.company_id = com.id','INNER')
				->join($cc_ct, 's.id = cc_ct.site_id', 'LEFT')
				->join('users u', 's.created_by = u.id','LEFT')
				->where("s.is_deleted",0)
				->where("com.is_deleted",0);
        
		$where = array();
		
        if(array_key_exists('site_code', $params) && !empty($params['site_code']) ){
            
			$where[] = sprintf("s.code ='%s'", $params['site_code']);
			
            //$this->db->where("s.code", $params['site_code']);
        }
		
		if(array_key_exists('site_ref', $params) && !empty($params['site_ref']) ){
            
			$where[] = sprintf("s.site_ref ='%s'", $params['site_ref']);
            //$this->db->or_where("s.site_ref", $params['site_ref']);
        }
		
		if(array_key_exists('site_district', $params) && !empty($params['site_district']) ){
            
			$where[] = sprintf("s.district_no ='%s'", $params['site_district']);
            //$this->db->or_where("s.district_no", $params['site_district']);
        }
		
		if(array_key_exists('site_postcode', $params) && !empty($params['site_postcode']) ){
            
			$where[] = sprintf("s.postcode ='%s'", $params['site_postcode']);
            //$this->db->or_where("s.postcode", $params['site_postcode']);
        }
		//print_r($where);die;
		$this->db->where(sprintf("(".implode(' OR ', $where).")"));
		
		$this->db->group_by('s.id');
		
		$qrows = $this->db->get()->result();
		
		foreach($qrows AS &$qrow){
			
			$this->db
				->select('sf.*,ft.name AS form_name')
				->select("CONCAT(u.first_name,' ',u.last_name) AS added_by_name", FALSE)
				->select("CONCAT(uu.first_name,' ',uu.last_name) AS completed_by_name", FALSE)
				->from('sites s')
				->join('site_forms sf', 's.id = sf.site_id','INNER')
				->join('form_types ft', 'sf.form_type_id = ft.id','INNER')
				->join('users u', 'sf.added_by = u.id','LEFT')
				->join('users uu', 'sf.completed_by = uu.id','LEFT')
				->where('s.id', to_int($qrow->site_id))
				->where_not_in('sf.status', array(2,3));
				
			$qrow->{'site_forms'} = $this->db->get()->result();
			
		}
		
		return $qrows;
    }
	
	public function get_question_by_many($params = array(), $return = 'result'){
		
		$srv = sprintf("(SELECT
	`sf`.`id` AS `site_form_id`,`sf`.`site_id`, `q`.`id` AS `question_id`, `q`.`description` AS `question_desc`, `q`.`help_text`,`q`.`type` AS `question_type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`options`
	, `q`.`table` AS `question_table`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`sort_order`	
FROM site_forms sf
	INNER JOIN questions q ON sf.form_type_id =q.form_type_id
WHERE 
	sf.site_id=%d
	AND sf.form_type_id=%d) AS srv", $params['site_id'], $params['form_type_id']);
	
		$this->db
				->select('srv.*')
				->select('IFNULL(sff.answer, \'\') AS answer', FALSE)
				->select('IFNULL(sff.notes, \'\') AS notes', FALSE)
				->from('site_forms')
				->join($srv, 'site_forms.id=srv.site_form_id AND site_forms.site_id=srv.site_id AND site_forms.form_type_id=srv.form_type_id', 'INNER')
				->join('site_form_feedback sff', 'srv.site_form_id=sff.site_form_id AND srv.site_id=sff.site_id AND srv.form_type_id=sff.form_type_id AND srv.question_id=sff.question_id', 'LEFT')
				->where('site_forms.site_id', to_int($params['site_id']))
				->where('site_forms.form_type_id', to_int($params['form_type_id']))
				->where('site_forms.id', to_int($params['site_form_id']));
		
		if(array_key_exists('question_id', $params) && $params['question_id']){
			
			$this->db->where('srv.question_id', to_int($params['question_id']));
		}
		
		$this->db->order_by('srv.form_type_id', 'ASC');
		$this->db->order_by('srv.form_section_id', 'ASC');
		$this->db->order_by('srv.sort_order', 'ASC');
				
				
		return $return == 'row' ? $this->db->get()->row() : $this->db->get()->result();
		
	}

	public function submitted_form(){
		
		$this->db
				->select('sf.*,ft.name AS form_name')
				->select("CONCAT(u.first_name,' ',u.last_name) AS added_by_name", FALSE)
				->select("CONCAT(uu.first_name,' ',uu.last_name) AS completed_by_name", FALSE)
				->select("CONCAT(usb.first_name,' ',usb.last_name) AS submitted_by_name", FALSE)
				->from('sites s')
				->join('site_forms sf', 's.id = sf.site_id','INNER')
				->join('form_types ft', 'sf.form_type_id = ft.id','INNER')
				->join('users u', 'sf.added_by = u.id','LEFT')
				->join('users uu', 'sf.completed_by = uu.id','LEFT')
				->join('users usb', 'sf.submitted_by = usb.id','LEFT')
				->where("sf.submitted_by >", 0)
				->where("sf.completed_by", 0)
				->order_by('sf.submitted_on', 'DESC');
		
		if(!in_array($this->current_user->group_id, array(GROUP_ADMIN, GROUP_STAFF, GROUP_ENGINEER))){
			$this->db->where("s.company_id", $this->current_user->company_id);
		}
		
		return $this->db->get()->result();
		
	}
}

?>