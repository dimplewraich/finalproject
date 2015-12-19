<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function ajax_gets($params) {

        $aColumns = array('full_name', 'ct.email', 'ct.address', 'ct.phone', 'ct.mobile', 'is_default', 'created_by_name', 'ct.created_on');

		$type_id = array_key_exists('type_id', $params) ? to_int($params['type_id']) : 0;
		$ref_id = array_key_exists('ref_id', $params) ? to_int($params['ref_id']) : 0;
		
        $this->db
				->select('SQL_CALC_FOUND_ROWS ct.id as contact_id', FALSE)
				->select("CONCAT(ct.first_name,' ',ct.last_name) AS full_name", FALSE)
				->select('ct.address,ct.postcode,ct.email,ct.phone,ct.created_on,ct.mobile,ct.fax,ct.contact_type_id')
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->from('contacts ct')
				->join('users u', 'ct.created_by = u.id','LEFT');
				
		if($type_id == CONTACT_TYPE_COMPANY){
			
			$this->db
					->select('cc.company_id AS ref_id, cc.is_default')
					->join('company_contacts cc', 'ct.id=cc.contact_id','INNER')
					->where('cc.company_id', $ref_id);
		} elseif($type_id == CONTACT_TYPE_CLIENT){
			
			$this->db
					->select('cc.client_id AS ref_id, cc.is_default')
					->join('client_contacts cc', 'ct.id=cc.contact_id','INNER')
					->where('cc.client_id', $ref_id);
		} elseif($type_id == CONTACT_TYPE_SITE){
			
			$this->db
					->select('cc.site_id AS ref_id, cc.is_default')
					->join('site_contacts cc', 'ct.id=cc.contact_id','INNER')
					->where('cc.site_id', $ref_id);
		} else{
			$this->db
					->select('\'0\' AS ref_id, \'0\' AS is_default')
					->where('ct.id', 0);
		}
		$this->db->where("ct.is_deleted", 0);
		

        $this->db->group_by('ct.id');

        if (isset($params['iDisplayStart']) && $params['iDisplayLength'] != '-1') {
            $this->db->limit($this->db->escape_str($params['iDisplayLength']), $this->db->escape_str($params['iDisplayStart']));
        }

        if (isset($params['iSortCol_0'])) {
            for ($i = 0; $i < intval($params['iSortingCols']); $i++) {
                $iSortCol = $this->input->get_post('iSortCol_' . $i, true);
                $bSortable = $this->input->get_post('bSortable_' . intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_' . $i, true);

                if ($bSortable == 'true') {
				
					if($aColumns[intval($this->db->escape_str($iSortCol))] == 'is_default') continue;
                    
					if($aColumns[intval($this->db->escape_str($iSortCol))] == 'full_name'){
					
						$this->db->order_by(sprintf("CONCAT(`ct`.`first_name`,' ',`ct`.`last_name`)"), $this->db->escape_str($sSortDir), FALSE);
						
					} elseif($aColumns[intval($this->db->escape_str($iSortCol))] == 'created_by_name'){
					
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
				
					if($aColumns[$i] == 'is_default') continue;
					
					if($aColumns[$i] == 'full_name'){
						$where[] = sprintf("CONCAT(`ct`.first_name,' ',`ct`.last_name) LIKE '%s' ", $sSearch);
					} elseif($aColumns[$i] == 'created_by_name'){
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

        $iTotal = $this->ajax_gets_count($params);
        
		$output = array(
            'sEcho' 				=> intval($params['sEcho']),
            'iTotalRecords' 		=> $iTotal,
            'iTotalDisplayRecords' 	=> $iFilteredTotal,
            'aaData' 				=> $rResult->result()
        );

        return $output;
    }
	
	public function ajax_gets_count($params) {
	
		$type_id = array_key_exists('type_id', $params) ? to_int($params['type_id']) : 0;
		$ref_id = array_key_exists('ref_id', $params) ? to_int($params['ref_id']) : 0;
        
        $this->db
				->from('contacts ct')
				->join('users u', 'ct.created_by = u.id','LEFT');
				
		if($type_id == CONTACT_TYPE_COMPANY){
			
			$this->db
					->join('company_contacts cc', 'ct.id=cc.contact_id','INNER')
					->where('cc.company_id', $ref_id);
		} elseif($type_id == NOTE_TYPE_CLIENT){
			
			$this->db
					->join('client_contacts cc', 'ct.id=cc.contact_id','INNER')
					->where('cc.client_id', $ref_id);
		} elseif($type_id == CONTACT_TYPE_SITE){
			
			$this->db
					->join('site_contacts cc', 'ct.id=cc.contact_id','INNER')
					->where('cc.site_id', $ref_id);
		} else{
			$this->db->where('ct.id', 0);
		}
		$this->db->where("ct.is_deleted", 0);

        return $this->db->count_all_results();
    }

    public function add($input) {
	
		$flag = FALSE;
		foreach(array('first_name', 'last_name', 'address', 'postcode', 'email', 'phone', 'mobile', 'fax' ) AS $key){
			
			if(array_key_exists($key, $input) && !empty($input[$key])){
				$flag = TRUE;
			}
		}
	
		if( !$flag ) return 0;
	
		$input['created_on'] = curr_timestamp();
        
        $this->db->insert('contacts', $input);
		
		$primary_key = $this->db->insert_id();
		
		if( gtzero_integer($primary_key) ){
			
			return to_int($primary_key);
		}
		
		return 0;
       
    }
	
	public function details($contact_id, $ref_id, $type_id) {
	
		$this->db
				->select('ct.id,ct.first_name,ct.last_name,ct.address,ct.postcode,ct.email,ct.phone,ct.created_on,ct.mobile,ct.fax,ct.contact_type_id')
				->select("CONCAT(ct.first_name,' ',ct.last_name) AS contact_name", FALSE)
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->from('contacts ct')
				->join('users u', 'ct.created_by = u.id','LEFT')
				->where('ct.id', to_int($contact_id));
				
		if($type_id == CONTACT_TYPE_COMPANY){
			
			$this->db
					->select('cc.company_id AS ref_id, cc.is_default')
					->join('company_contacts cc', 'ct.id=cc.contact_id','INNER')
					->where('cc.company_id', $ref_id);
		} elseif($type_id == CONTACT_TYPE_CLIENT){
			
			$this->db
					->select('cc.client_id AS ref_id, cc.is_default')
					->join('client_contacts cc', 'ct.id=cc.contact_id','INNER')
					->where('cc.client_id', $ref_id);
		} elseif($type_id == CONTACT_TYPE_SITE){
			
			$this->db
					->select('cc.site_id AS ref_id, cc.is_default')
					->join('site_contacts cc', 'ct.id=cc.contact_id','INNER')
					->where('cc.site_id', $ref_id);
		} else{
			$this->db
					->select('\'0\' AS ref_id, \'0\' AS is_default')
					->where('ct.id', 0);
		}
                        
		return $this->db->get()->row();
    }
    
    public function update($input, $id) {
	
        $this->db->where('id', to_int($id));
        
		return $this->db->update('contacts', $input);
    }
    
    public function delete($id) {
	
        $this->db->where('id', to_int($id) );
		
        return $this->db->update('contacts', array('is_deleted' => 1));
    }
	
	/* CONTACT_TYPE_COMPANY*/
	public function update_company_contact($company_id, $contact_id, $is_default){
		
		if( !gtzero_integer($company_id) || !gtzero_integer($contact_id)) return 0;
		
		 $this->db
				->from('company_contacts')
				->where("company_id", to_int($company_id))
				->where("contact_id", to_int($contact_id));

        $is_record_exist = ($this->db->count_all_results() > 0);
		
		if( !$is_record_exist){
			
			$input = array(
				'company_id'	=> $company_id
				,'contact_id'	=> $contact_id
				,'is_default'	=> $is_default
			);
			
			$this->db->insert('company_contacts', $input);
			
		} else {
			
			$this->db->where('contact_id', to_int($contact_id));
			$this->db->where("company_id", to_int($company_id));
        
			$this->db->update('company_contacts', array('is_default' => $is_default) );
		}
		
		if( gtzero_integer($is_default) ) {
		
			$this->db->where('contact_id !=', to_int($contact_id));
			$this->db->where("company_id", to_int($company_id));
			
			$return = $this->db->update('company_contacts', array('is_default' => 0));
		}
	}
	
	/* CONTACT_TYPE_CLIENT*/
	public function update_client_contact($client_id, $contact_id, $is_default){
		
		if( !gtzero_integer($client_id) || !gtzero_integer($contact_id)) return 0;
		
		 $this->db
				->from('client_contacts')
				->where("client_id", to_int($client_id))
				->where("contact_id", to_int($contact_id));

        $is_record_exist = ($this->db->count_all_results() > 0);
		
		if( !$is_record_exist){
			
			$input = array(
				'client_id'		=> $client_id
				,'contact_id'	=> $contact_id
				,'is_default'	=> $is_default
			);
			
			$this->db->insert('client_contacts', $input);
			
		} else {
			
			$this->db->where('contact_id', to_int($contact_id));
			$this->db->where("client_id", to_int($client_id));
        
			$this->db->update('client_contacts', array('is_default' => $is_default) );
		}
		
		if( gtzero_integer($is_default) ) {
		
			$this->db->where('contact_id !=', to_int($contact_id));
			$this->db->where("client_id", to_int($client_id));
			
			$return = $this->db->update('client_contacts', array('is_default' => 0));
		}
	}
	
	/* CONTACT_TYPE_SITE*/
	public function update_site_contact($site_id, $contact_id, $is_default){
		
		if( !gtzero_integer($site_id) || !gtzero_integer($contact_id)) return 0;
		
		 $this->db
				->from('site_contacts')
				->where("site_id", to_int($site_id))
				->where("contact_id", to_int($contact_id));

        $is_record_exist = ($this->db->count_all_results() > 0);
		
		if( !$is_record_exist){
			
			$input = array(
				'site_id'		=> $site_id
				,'contact_id'	=> $contact_id
				,'is_default'	=> $is_default
			);
			
			$this->db->insert('site_contacts', $input);
			
		} else {
			
			$this->db->where('contact_id', to_int($contact_id));
			$this->db->where("site_id", to_int($site_id));
        
			$this->db->update('site_contacts', array('is_default' => $is_default) );
		}
		
		if( gtzero_integer($is_default) ) {
		
			$this->db->where('contact_id !=', to_int($contact_id));
			$this->db->where("site_id", to_int($site_id));
			
			$return = $this->db->update('site_contacts', array('is_default' => 0));
		}
	}
		
	public function get_by_many($params = array(), $return = 'RESULT'){
		
		
		$this->db
				->select('ct.*')
				->select("CONCAT(ct.first_name,' ',ct.last_name) AS contact_name", FALSE)
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->from('contacts ct')
				->join('users u', 'ct.created_by = u.id','LEFT')
				->where('ct.is_deleted', 0);

		if( array_key_exists('ref_id', $params) ){
			$this->db->where('ct.ref_id', to_int($params['ref_id']));
		}
		
		if( array_key_exists('contact_type_id', $params) ){
			$this->db->where('ct.contact_type_id', to_int($params['contact_type_id']));
		}
		
		if( array_key_exists('name', $params) && !empty($params['name']) ){
			$this->db->like(sprintf("CONCAT(`ct`.first_name,' ',`ct`.last_name) LIKE '%s' ", $params['name']));
		}
		
		if( array_key_exists('contact_id_not', $params) && !empty($params['contact_id_not']) ){
			$this->db->where('ct.id !=',$params['contact_id_not'], FALSE);
		}
		
		if($return == 'RESULT'){
			return $this->db->get()->result();
		} elseif($return == 'ROW'){
			$this->db->limit(1);
			return $this->db->get()->row();
		} elseif($return == 'COUNT'){
			return $this->db->count_all_results();
		} else{
			return $this->db->get()->result();
		}
	}
	
	
}