<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function ajax_get_parts($params) {

        $aColumns = array('com.name', 'com.address', 'st.gmt_offset', 'com.active', 'created_by_name', 'com.created_on', 'com.id');
		
		$cc_ct = sprintf("(SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct");
		
		$this->db
			->select('SQL_CALC_FOUND_ROWS com.id as company_id', FALSE)
			->select('com.name AS company_name, com.address, st.gmt_offset, com.created_on, com.active')
			->select("CONCAT(`u`.`first_name`,' ',`u`.`last_name`) AS created_by_name", FALSE)
			->select("CONCAT(`cc_ct`.`first_name`,' ',`cc_ct`.`last_name`) AS contact_name", FALSE)
			->select('cc_ct.email AS contact_email')
			->from('companies com')
			->join('users u', 'com.created_by = u.id', 'LEFT')
			->join($cc_ct, 'com.id = cc_ct.company_id', 'LEFT')
			->join('company_settings st', 'com.id = st.company_id', 'LEFT')
			->where('com.is_deleted', 0);

        if (isset($params['iDisplayStart']) && $params['iDisplayLength'] != '-1') {
            $this->db->limit($this->db->escape_str($params['iDisplayLength']), $this->db->escape_str($params['iDisplayStart']));
        }
        if (isset($params['iSortCol_0'])) {
            
			for ($i = 0; $i < intval($params['iSortingCols']); $i++) {
                $iSortCol = $this->input->get_post('iSortCol_' . $i, true);
                $bSortable = $this->input->get_post('bSortable_' . intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_' . $i, true);

                if ($bSortable == 'true') {
                    if($aColumns[intval($this->db->escape_str($iSortCol))] == 'default_contact_name'){
						$this->db->_protect_identifiers = FALSE;
						$this->db->order_by(sprintf("CONCAT(`cc_ct`.`first_name`,' ',`cc_ct`.`last_name`)"), $this->db->escape_str($sSortDir));
						$this->db->_protect_identifiers = TRUE;
					}elseif($aColumns[intval($this->db->escape_str($iSortCol))] == 'created_by_name'){
						$this->db->_protect_identifiers = FALSE;
						$this->db->order_by(sprintf("CONCAT(`u`.`first_name`,' ',`u`.`last_name`)"), $this->db->escape_str($sSortDir));
						$this->db->_protect_identifiers = TRUE;
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
					
					if($aColumns[$i] == 'default_contact_name'){
						$where[] = sprintf("CONCAT(cc_ct.first_name,' ',cc_ct.last_name) LIKE '%s' ", $sSearch);
					}elseif($aColumns[$i] == 'created_by_name'){
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

        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;

        $iTotal = $this->ajax_get_parts_count($params);
        
		$output = array(
            'sEcho' 				=> intval($params['sEcho']),
            'iTotalRecords' 		=> $iTotal,
            'iTotalDisplayRecords' 	=> $iFilteredTotal,
            'aaData' 				=> $rResult->result()
        );

        return $output;
    }
	
	public function ajax_get_parts_count($params) {
		
		$this->db
				->from('companies com')
				->where('com.is_deleted', 0);

        return $this->db->count_all_results();
    }
	
    public function add_company($input) {
	
		$input['created_on'] = curr_timestamp();
	
        $this->db->insert("companies", $input);
		
		$primary_key = $this->db->insert_id();
		
		if( gtzero_integer($primary_key) ){
		
			_delete_cache('', CACHE_KEY_COMPANY_DDL_LIST);
			
			return to_int($primary_key);
		}
		
		return 0;
    }

    public function update($input, $company_id) {
	
        $this->db->where('id', to_int($company_id));
        
		$return = $this->db->update('companies', $input);
		
		_delete_cache('', CACHE_KEY_COMPANY_DDL_LIST);
		_delete_cache($company_id, CACHE_KEY_COMPANY_INFO);
		
		return $return;
    }

    public function delete($company_id) {
        
		$this->db->where('id', to_int($company_id));
		$input = array('is_deleted' => 1);
		
		$return = $this->db->update('companies', $input);
		
		_delete_cache('', CACHE_KEY_COMPANY_DDL_LIST);
		_delete_cache($company_id, CACHE_KEY_COMPANY_INFO);
		
		return $return;
        
    }
    
    public function details($company_id) {
		
		$cc_ct = sprintf("(SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=%d) cc_ct", $company_id);
		
		$this->db
				->select('com.*, st.gmt_offset')
				->select("CONCAT(`u`.`first_name`,' ',`u`.`last_name`) AS created_by_name", FALSE)
				->select("CONCAT(`cc_ct`.`first_name`,' ',`cc_ct`.`last_name`) AS contact_name", FALSE)
				->select('cc_ct.contact_id,cc_ct.email AS contact_email,cc_ct.first_name AS contact_first_name, cc_ct.last_name AS contact_last_name, cc_ct.address AS contact_address, cc_ct.phone AS contact_phone, cc_ct.mobile AS contact_mobile, cc_ct.fax AS contact_fax, cc_ct.is_default')
				->from('companies com')
				->join('users u', 'com.created_by = u.id', 'LEFT')
				->join($cc_ct, 'com.id = cc_ct.company_id', 'LEFT')
				->join('company_settings st', 'com.id = st.company_id', 'LEFT')
				->where('com.id', to_int($company_id));

        $company_info = $this->db->get()->row();
		
		return $company_info;
    }
	
	public function get_companies_list() {
	
		if( ($qrows = _get_cache('', CACHE_KEY_COMPANY_DDL_LIST)) && $qrows !== FALSE){
			return $qrows;
		}

        $this->db
				->select('id,name')
				->from('companies')
				->where('is_deleted', 0);
		
        $query = $this->db->get();

        $qrows = $query->result();
		
		_set_cache('', $qrows , CACHE_KEY_COMPANY_DDL_LIST);
		
		return $qrows;
    }
	
	/**
	 * Callback method for updating company record
	 *
	 * @param array 
	 * @param int    $id    The company id
	 *
	 * @return true/false
	 * CALLED FROM
	 * 	- profile/set_timezone
	 */
	public function update_company_settings($input, $company_id = 0){
		
		$flag = FALSE;
		
		if( gtzero_integer($company_id) ){
			
			$this->db
					->from('company_settings')
					->where("company_id", to_int($company_id));
			

			$flag = ($this->db->count_all_results() == 1) ? TRUE : FALSE;
		}
		
		if($flag){
			$this->db->where("company_id", to_int($company_id));
			
			$return = $this->db->update('company_settings', $input);
		} else {
			$input['company_id'] = $company_id;
			$return = $this->db->insert('company_settings', $input);
		}
		
		if( gtzero_integer($company_id) ){
			_delete_cache($company_id, CACHE_KEY_COMPANY_SETTINGS);
		}
		
		return $return;
	}
	
	/**
	 * Callback method for validating the title
	 *
	 * @param string $title The title to validate
	 * @param int    $id    The id to check
	 *
	 * @return mixed
	 */
	public function check_name($name = '', $id = 0) {
	
		return (bool)$this->db
								->where('name', $name)
								->where('id != ', to_int($id))
								->from('companies')
								->count_all_results();
	}
	
	/* NEW FUNCTION ABOVE THIS */
	
    public function get_companies($filter = array()) {
        
		if (count($filter)) {
            $this->db->where($filter);
        }

        $this->db->select('com.*,u.username as created_by_name');
        $this->db->from('companies com');
        $this->db->join('user_company uc', 'com.id = uc.company_id', 'left');
        $this->db->join('users u', 'com.created_by = u.id', 'left');
		$this->db->where('com.is_deleted', 0);
        $result = $this->db->get();

        if (isset($filter['comp.id'])) {
            return $result->row_array();
        } else {
            return $result->result_array();
        }
    }
    
    public function get_company_dropdown($firstrow = FALSE){
        $companies_list = '';
		
		if($firstrow == FALSE){
			$companies_list = array(0 => 'All');
		} else {
			$companies_list = array('' => $firstrow);
		}
        
        $companies = $this->get_companies();
        
        foreach ($companies as $company){
            $companies_list[$company['id']] = $company['name'];
        }
        
        return $companies_list;
    }

    public function get_user_company($user_id) {
        $this->db->select('c.*');
        $this->db->from('companies c');
        $this->db->join('users u', 'u.company_id = c.id', 'left');
        $this->db->where('u.id', $user_id);
        return $this->db->get->row_array();
    }

    //put your code here
    // add a new company from modal in create user page

    public function get_company() {
        return $this->db->query("SELECT id,name from companies")->result_array();
    }

    public function get_company_by_client($client_id) {
        
		$this->db
				->select('com.*')
				->from('companies com')
				->join('clients cl', 'com.id = cl.company_id', 'INNER')
				->where('cl.id', to_int($client_id));


        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return FALSE;
        }
    }

	
	public function is_company_exist($id) {
	
        $this->db->from('companies')->where('id',$id);
        
        return ($this->db->count_all_results() > 0)? TRUE : FALSE;
    }
	
	/**
	 * Callback method for updating company record
	 *
	 * @param array 
	 * @param int    $id    The company id
	 *
	 * @return true/false
	 * CALLED FROM
	 * 	- profile/set_timezone
	 */
	
	public function delete_company_settings($company_id) {
	
		if( gtzero_integer($company_id) ){
	
			$this->db->where('company_id', $company_id);
			$this->db->delete('company_settings');
			
			return TRUE;
		}
		
		return FALSE;
		
    }
	
	public function add_company_settings($input) {
	
        return $this->db->insert('company_settings', $input);
    }
	 
}

?>
