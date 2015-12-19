<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends MY_Model{
    
    public function __construct() {
        parent::__construct();
    }
	
	public function _apply_filters($data) {
	   
        switch ($data['group_id']) {
            case GROUP_ADMIN:
				break;
				
            case GROUP_MANAGEMENT_COMPANY:
                
				$this->db->where('com.id', $data['users_company_id']);
                break;
				
            case GROUP_USER_COMPANY:
				
				$this->db->where('com.id', $data['users_company_id']);
				
				if($data['regions']['company'] || $data['regions']['client']) {
					
					$this->db->join('sites s', 'cl.id = s.client_id', 'INNER');
					$this->db->join('region_sites rs', 's.id = rs.site_id', 'INNER');
				}
				
				if($data['regions']['company']) {
					$this->db->where_in('rs.region_id', $data['regions']['company']);
				}
				if($data['regions']['client']) {
					$this->db->or_where_in('rs.region_id', $data['regions']['client']);
				}
				
                break;
				
            case GROUP_CLIENT_USER:
                
				$this->db->where_in('cl.id', $data['user_clients']);
                break;
				
            case GROUP_SUBCONTRACTOR:
            case GROUP_TECHNICIAN:
			
				$this->db->join('sites s', 'cl.id = s.client_id', 'INNER');
				$this->db->join('jobs j', 's.id = j.site_id', 'INNER');
				$this->db->join('job_resources res', 'j.id = res.job_id', 'INNER');
                $this->db->where('res.resource_user_id', to_int($data['user_id']));
                break;
				
            case GROUP_SITE_USER:
				
				$this->db->join('sites s', 'cl.id = s.client_id', 'INNER');
                $this->db->where_in('s.id', $data['user_sites']);
                break;
				
            default:
                break;
        }
    }
	
	public function ajax_gets($params, $hiddenColms = array()) {

        $aColumns = array('full_name', 'com.name' ,'cl.address', 'cl.phone', 'cl.postcode', 'cc_ct.email', 'created_by_name','cl.created_on');
		
		if( _has_company_group_access($this->current_user->group_id) ){
			
			unset($aColumns[1]);
			
			$aColumns = array_values($aColumns);
		}
		
		$data = $this->_build_filters();
		
		$cc_ct = sprintf("(SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM client_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct");

        $this->db
				->select('SQL_CALC_FOUND_ROWS cl.id as client_id', FALSE)
				->select('com.name as company_name , cl.created_on')
				->select("CONCAT(cl.first_name,' ',cl.last_name) AS full_name", FALSE)
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->select('cl.address,cl.phone, cl.postcode')
				->select("CONCAT(`cc_ct`.`first_name`,' ',`cc_ct`.`last_name`) AS contact_name", FALSE)
				->select('cc_ct.email AS contact_email')
				->from('clients cl')
				->join('companies com', 'cl.company_id = com.id','INNER')
				->join($cc_ct, 'cl.id = cc_ct.client_id', 'LEFT')
				->join('users u', 'cl.created_by = u.id','LEFT')
				->where("cl.is_deleted",0)
				->where("com.is_deleted",0);
				
		//$this->_apply_filters($data);
        
        if(array_key_exists('company_id', $params) && $params['company_id'] ){
            
            $this->db->where("cl.company_id", to_int($params['company_id']));
        }
		
		if(array_key_exists('name', $params) && $params['name'] ){
            
            $this->db->like("cl.name", $params['name']);
        }
		
		if(array_key_exists('postcode', $params) && $params['postcode'] ){
            
            $this->db->like("cl.postcode",$params['postcode']);
        }
		
		if(array_key_exists('contact_name', $params) && $params['contact_name'] ){
            
            $this->db->like("cl.default_contact_name",$params['contact_name']);
        }
		

        $this->db->group_by('cl.id');

        if (isset($params['iDisplayStart']) && $params['iDisplayLength'] != '-1') {
            $this->db->limit($this->db->escape_str($params['iDisplayLength']), $this->db->escape_str($params['iDisplayStart']));
        }

        if (isset($params['iSortCol_0'])) {
            for ($i = 0; $i < intval($params['iSortingCols']); $i++) {
                $iSortCol = $this->input->get_post('iSortCol_' . $i, true);
                $bSortable = $this->input->get_post('bSortable_' . intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_' . $i, true);

                if ($bSortable == 'true') {
                    if($aColumns[intval($this->db->escape_str($iSortCol))] == 'full_name'){
					
						$this->db->order_by(sprintf("CONCAT(cl.first_name,' ',cl.last_name)"), $this->db->escape_str($sSortDir), FALSE);
						
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
		
			$where = array();;
            for ($i = 0; $i < count($aColumns); $i++) {
                $bSearchable = $this->input->get_post('bSearchable_' . $i, true);

                if (isset($bSearchable) && $bSearchable == 'true') {
					
					if($aColumns[$i] == 'full_name'){
						$where[] = sprintf("CONCAT(cl.first_name,' ',cl.last_name) LIKE '%s' ", $sSearch);
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
				->from('clients cl')
				->join('companies com', 'cl.company_id = com.id','INNER')
				->join('users u', 'cl.created_by = u.id','LEFT')
				->where("cl.is_deleted",0)
				->where("com.is_deleted",0);
				
		$this->_apply_filters($data);
        
        if(array_key_exists('company_id', $params) && $params['company_id'] ){
            
            $this->db->where("cl.company_id", to_int($params['company_id']));
        }
		
		if(array_key_exists('name', $params) && $params['name'] ){
            
            $this->db->like("cl.name", $params['name']);
        }
		
		if(array_key_exists('postcode', $params) && $params['postcode'] ){
            
            $this->db->like("cl.postcode", $params['postcode']);
        }
		
		if(array_key_exists('contact_name', $params) && $params['contact_name'] ){
            
            $this->db->like("cl.default_contact_name", $params['contact_name']);
        }

        return $this->db->count_all_results();
    }
        
	public function dropdown_list($company_id, $params = array()) {
	
        $this->db
			->select('cl.id as client_id')
			->select('CONCAT(`cl`.`first_name`, \'\', `cl`.`last_name`) as client_name', FALSE)
			->from('clients cl')
			->join('companies com','cl.company_id = com.id')
			->where('cl.company_id', to_int($company_id))
			->where("cl.is_deleted", 0)
			->where("com.is_deleted", 0);
		
		if( array_key_exists('name', $params) && $params['name'] ){
            
            $this->db->like("cl.name", $params['name']);
        }
		
		if( array_key_exists('client_ids', $params) && is_array($params['client_ids']) && count($params['client_ids']) ){
            
            $this->db->where_in("cl.id", $params['client_ids']);
        }
		
		if( array_key_exists('limit', $params) ){
            
			$limit = validate_integer($params['limit']) ? to_int($params['limit']) : 0;
			
            $this->db->limit($limit);
        }
		
        return $this->db->get()->result();
    }
    
    public function add_client($input) {
	
		$input['created_on'] = curr_timestamp();
	
       $this->db->insert("clients", $input);
	   
	   $primary_key = $this->db->insert_id();
		
		if( gtzero_integer($primary_key) ){
			
			return to_int($primary_key);
		}
		
		return 0;
    }
	
	public function details($client_id, $company_id = 0) {
	
		$cc_ct = sprintf("(SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM client_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.client_id=%d) cc_ct", $client_id);
	
		/*if($company_id > 0 ){
			$this->db->where('companies.id', $company_id, FALSE);
		}*/
	
        $this->db
				->select('cl.*,com.name AS company_name')
				->select("CONCAT(cl.first_name,' ',cl.last_name) AS full_name", FALSE)
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->select("CONCAT(`cc_ct`.`first_name`,' ',`cc_ct`.`last_name`) AS contact_name", FALSE)
				->select('cc_ct.contact_id,cc_ct.email AS contact_email,cc_ct.first_name AS contact_first_name, cc_ct.last_name AS contact_last_name, cc_ct.address AS contact_address, cc_ct.phone AS contact_phone, cc_ct.mobile AS contact_mobile, cc_ct.fax AS contact_fax, cc_ct.is_default')
				->from('clients cl')
				->join('companies com', 'cl.company_id = com.id','INNER')
				->join($cc_ct, 'cl.id = cc_ct.client_id', 'LEFT')
				->join('users u', 'cl.created_by = u.id','LEFT')
				->where('cl.id', to_int($client_id));
        
        return $this->db->get()->row();
    }
    
    public function update($input, $client_id) {
	
        $this->db->where('id', to_int($client_id));
        
		return $this->db->update('clients', $input);
    }
    
    public function delete($client_id) {
	
        $this->db->where('id', to_int($client_id));
		
        return $this->db->update('clients', array('is_deleted' => 1));
    }
	
	/* NEW FUNCTION ABOVE THIS */
		
    public function get_clients($filter = array()) {
	
        $this->db->where($filter);
        $this->db->where("is_deleted",0);
        return $this->db->get('clients')->result_array();
    }
    
    public function client_listing($filter = array()) {
        
        if(isset($filter['company_id']) &&  is_array($filter) && count($filter)) {
		
			if(isset($filter['company_id']) && !$filter['company_id']) {
				unset($filter['company_id']);
				unset($filter['json']);
			}
          
			if(isset($filter['json'])) {
				unset($filter['json']);
               
				//$this->db->join('company_clients cc','c.id = cc.client_id');
				//$this->db->join('companies com','cc.company_id = com.id');
			}
           
			$this->db->where($filter,NULL,false);
		}
      
		$this->db
				->select(' c.*,u.username as created_by,com.name as company_name')
				->from(' clients c')
				->join('users u','c.created_by = u.id')
				->join('companies com','c.company_id = com.id')
				->where("c.is_deleted",0)
				->where("com.is_deleted",0);

		return $this->db->get()->result_array();
    }
    
    public function get_user_client(){
        //TODO GET CLIENTS
    }
    
     // add a new client from modal in create user page
    
    
    public function get_all_clients() {
        return $this->db->query("SELECT id,name from clients WHERE is_deleted=0")->result_array();
    }
    
    
    
    
    //function associate_client_with_company($ccdata)
    //{
    //    return $this->db->insert('company_has_clients', $ccdata); 
    //}
    
    
    
    
    // function to edit a Client- Clients Page
    
	
	// function to edit a Client- Clients Page
    public function client_details_by_id($company_id, $client_id) {
	
        $this->db->select('c.*');
        $this->db->from('clients c');
        $this->db->where('id',$client_id);
		$this->db->where('company_id',$company_id);
        
        return $this->db->get()->row();
    }
	
	public function is_client_exist($id) {
	
        $this->db->from('clients')->where('id',$id)->where('is_deleted', 0);
        
        return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
    }
    
    public function delete_company_client_data($id) {
	
        $this->db->where('client_id',$id);
        return $this->db->delete('company_has_clients');
    }
	
	public function get_by_many($params = array(), $company_id = 0, $return = 'RESULT'){
		
		
		$this->db
				->select('cl.*')
				->select('companies.name AS company_name')
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->from('clients cl')
				->join("companies","cl.company_id=companies.id","INNER")
				->join('users u', 'cl.created_by = u.id','LEFT')
				->where('cl.is_deleted', 0);

		if( isset($params['name']) && !empty($params['name']) ){
			$this->db->like('cl.name',$params['name']);
		}
		
		if( isset($params['postcode']) && !empty($params['postcode']) ){
			$this->db->like('cl.postcode',$params['postcode']);
		}
		
		if( isset($params['contact_name']) && !empty($params['contact_name']) ){
			$this->db->like('cl.default_contact_name',$params['contact_name']);
		}
		
		if( isset($params['client_id_not']) && !empty($params['client_id_not']) ){
			$this->db->where('cl.id !=',$params['client_id_not'], FALSE);
		}
		
		if($company_id > 0){
			$this->db->where('cl.company_id', $company_id, FALSE);
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

?>
