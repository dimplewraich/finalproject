<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model {

	protected $_users = array();

    public function __construct() {
        parent::__construct();
    }
	
	public function clear_user_profile_cache($params) {
	
		$override = isset($params['override']) ? $params['override'] : FALSE;
		$user_id = to_int($params['user_id']);
		$company_id = array_key_exists('company_id', $params) ? to_int($params['company_id']) : ($override ? $this->user_company_by_user_id($user_id) : 0);
		$old_company_id = array_key_exists('old_company_id', $params) ? to_int($params['old_company_id']) : 0;
		
		_delete_cache($user_id, CACHE_KEY_USER_PROFILE, CACHE_DRIVER_FILE);
		unset($this->_users[$user_id]);
		
		if(gtzero_integer($company_id)){
			
			_delete_cache($company_id, CACHE_KEY_COMPANY_USERS_LIST, CACHE_DRIVER_FILE);
		}
		
		if(gtzero_integer($old_company_id) && $old_company_id != $company_id){
			
			_delete_cache($old_company_id, CACHE_KEY_COMPANY_USERS_LIST, CACHE_DRIVER_FILE);
		}
		
	}

    public function user_profile($user_id) {
	
		if( isset($this->_users[$user_id]) ) return $this->_users[$user_id];
		
		if( ($user_info = _get_cache($user_id, CACHE_KEY_USER_PROFILE, CACHE_DRIVER_FILE )) && $user_info !== FALSE){
			
			$this->_users[$user_id] = $user_info;
			return $user_info;
		}

		$this->db
				->select('u.id AS user_id, u.username, u.email, u.first_name, u.last_name, u.avatar, u.phone, u.postcode, u.gmt_offset, u.gps_device_id, u.hourly_rate,u.latitude, u.longitude')
				->select("CONCAT(u.first_name,' ', u.last_name) AS full_name", FALSE)
				->select('g.id as group_id, g.name as group_name, g.description as group_description')
                ->from('users u')
                ->join('users_groups ug', 'u.id = ug.user_id', 'INNER')
                ->join('groups g', 'ug.group_id = g.id', 'INNER')
                ->join('user_regions ur', 'u.id = ur.user_id', 'left')
                ->join('regions r', 'ur.region_id = r.id', 'left')
				->where('u.id', to_int($user_id))
                ->group_by('u.id');
		
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
			
			$user_info = $query->row();
			
			$user_info->{'user_id'} = to_int($user_info->user_id);
			$user_info->group_id = to_int($user_info->group_id);
			$user_info->hourly_rate = to_float($user_info->hourly_rate);
			$user_info->latitude = !is_null($user_info->latitude) ? $user_info->latitude : '';
			$user_info->longitude = !is_null($user_info->longitude) ? $user_info->longitude : '';
			$user_info->region_name = !is_null($user_info->region_name) ? $user_info->region_name : '';
			$user_info->avatar = !is_null($user_info->avatar) ? $user_info->avatar : '';
			$user_info->gmt_offset = ci()->cfg->gmt_offset;
			
			$user_info->{'company_id'} = 0;
			$user_info->{'client_ids'} = array();
			
			if( _has_company_group_access($user_info->group_id) ) {
				
				$user_info->{'company_id'} = $this->user_company_by_user_id($user_info->user_id);
			}
			
			if ($user_info->group_id == GROUP_CLIENT_USER) {
				
				$clients = array();
				if( ($clients = $this->get_client_by_user_id($user_info->user_id)) != FALSE){
					
					$user_info->{'client_ids'} = $clients;
				}
				unset($clients);
			}
			
			$this->_users[$user_id] = $user_info;
			
			_set_cache($user_id, $user_info , CACHE_KEY_USER_PROFILE, CACHE_DRIVER_FILE);
			
            return $user_info;
        }
		
		return FALSE;
    }
	
	public function get_client_by_user_id($user_id) {

        $this->db
				->select('cl.id AS client_id, cl.company_id')
                ->from('user_clients uc')
				->join('users u', 'uc.user_id=u.id', 'INNER')
				->join('clients cl', 'uc.client_id=cl.id', 'INNER')
				->join('companies com', 'cl.company_id=com.id', 'INNER')
                ->where('uc.user_id', to_int($user_id))
				->group_by('cl.id, cl.company_id');

        $query = $this->db->get();

		$clients = array();
        if ($query->num_rows() > 0) {
            $qrows = $query->result();
			
			foreach($qrows AS $qrow){
				$clients[]= $qrow->client_id;
			}
        }

        return $clients;
    }
	
	public function get_users_by_many($params = array() )  {
	
		if( !array_key_exists('company_id', $params) || !gtzero_integer($params['company_id']) ){
			return array();
		}
		
		if( ($qrows = _get_cache(to_int($params['company_id']), CACHE_KEY_COMPANY_USERS_LIST, CACHE_DRIVER_FILE )) && $qrows !== FALSE){
			
			return $qrows;
		}
	
		$uc = "(SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc";
		
		$this->db
				->select('u.id AS user_id')
				->select("CONCAT(u.first_name,' ', u.last_name) AS full_name", FALSE)
				->from('users u')
				->join($uc, 'u.id=uc.user_id', 'INNER')
				->join('companies com', 'uc.company_id = com.id', 'INNER')
				->where('u.is_deleted', 0);
				
		$this->db->where('uc.company_id', to_int($params['company_id']));

		$qrows = $this->db->get()->result();
		
		_set_cache(to_int($params['company_id']), $qrows , CACHE_KEY_COMPANY_USERS_LIST, CACHE_DRIVER_FILE);
		
		return $qrows;
	}
	
	public function get_user_group($user_id) {
        
		$this->db
				->select('ug.group_id')
				->from('groups g')
				->join('users_groups ug', 'g.id = ug.group_id', 'INNER')
				->where('ug.user_id', to_int($user_id));
				
		return to_int($this->db->get()->row()->group_id);
    }
	
	public function ajax_gets($params, $hiddenColms = array()){
	
		$aColumns = array('com.name' ,'full_name', 'u.email', 'u.phone', 'groups.description', 'u.active', 'created_on', 'u.id');
		
		if( _has_company_group_access($this->current_user->group_id) ){
			
			unset($aColumns[0]);
			
			$aColumns = array_values($aColumns);
		}
		
		$uc = "(SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc";
		
		$this->db
			->select('SQL_CALC_FOUND_ROWS u.id AS user_id',FALSE)
			->select('u.username, u.email, u.first_name, u.last_name, u.avatar, u.phone, u.postcode, u.gmt_offset, u.gps_device_id, u.hourly_rate,u.latitude, u.longitude, u.active, u.created_on')
			->select("CONCAT(first_name,' ', last_name) AS full_name", FALSE)
			->select('g.description AS group_description, g.id AS group_id')
			->select('com.name AS company_name')
			->from('users u')
			->join('users_groups ug', 'u.id = ug.user_id', 'LEFT')
			->join('groups g', 'ug.group_id = g.id', 'LEFT')
			->join($uc, 'u.id=uc.user_id', 'LEFT')
			->join('companies com', 'uc.company_id=com.id', 'LEFT')
			->where('u.is_deleted', 0);
		
		if( array_key_exists('company_id', $params) && gtzero_integer($params['company_id']) ) {
			
			$this->db->where("uc.company_id", to_int($params['company_id']));
		}
		
		if( array_key_exists('group_id', $params) && gtzero_integer($params['group_id']) ) {
			
			$this->db->where("g.id", to_int($params['group_id']));
		}
		
		if (isset($params['iDisplayStart']) && $params['iDisplayLength'] != -1) {
            $this->db->limit($this->db->escape_str($params['iDisplayLength']), $this->db->escape_str($params['iDisplayStart']));
        }

        if (isset($params['iSortCol_0'])) {
            
			for ($i = 0; $i < intval($params['iSortingCols']); $i++) {
                $iSortCol = $this->_post_args('iSortCol_' . $i, ARGS_TYPE_INT);
                $bSortable = $this->_post_args('bSortable_' . intval($iSortCol), ARGS_TYPE_STRING);
                $sSortDir = $this->_post_args('sSortDir_' . $i, ARGS_TYPE_STRING);

                if ($bSortable == 'true') {
					
					if($aColumns[intval($this->db->escape_str($iSortCol))] == 'full_name'){
						
						$this->db->order_by(sprintf("CONCAT(`u`.`first_name`,' ',`u`.`last_name`)"), $this->db->escape_str($sSortDir), FALSE);
						
					} else {
					
						$this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
					}
                }
            }
        }
		
		if (isset($params['sSearch']) && !empty($params['sSearch'])) {
		
			$sSearch = '%'.$this->db->escape_like_str( $params['sSearch'] ).'%';
				
			//$where = [];
			$where = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                
				$bSearchable = $this->_post_args('bSearchable_' . $i, ARGS_TYPE_STRING);

                if (isset($bSearchable) && $bSearchable == 'true') {
					
					if($aColumns[$i] == 'full_name'){
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
	
		$uc = "(SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc";

        $this->db
			->from('users u')
			->join('users_groups ug', 'u.id = ug.user_id', 'INNER')
			->join('groups g', 'ug.group_id = g.id', 'INNER')
			->join($uc, 'u.id=uc.user_id', 'LEFT')
			->join('companies com', 'uc.company_id=com.id', 'LEFT')
			->where('u.is_deleted', 0);
		
		if( array_key_exists('company_id', $params) && gtzero_integer($params['company_id']) ) {
			
			$this->db->where("uc.company_id", to_int($params['company_id']));
		}
		
		if( array_key_exists('group_id', $params) && gtzero_integer($params['group_id']) ) {
			
			$this->db->where("g.id", to_int($params['group_id']));
		}

        return $this->db->count_all_results();
    }

    public function check_if_company_exists($user_id) {
	
		$this->db
			->from('user_company')
			->where('user_company.user_id', to_int($user_id));

        return ($this->db->count_all_results() > 0);
    }

    public function update_user_company($user_id, $company_id, $group_id) {
	
		if( _has_company_non_resources($group_id) ) return FALSE;
		
		if( $this->check_if_company_exists($user_id) ){
		
			$this->db->where('user_id', to_int($user_id));
			
			$return = $this->db->update('user_company', array("company_id" => to_int($company_id)));
			
		} else {
		
			$return = $this->db->insert('user_company', array( "company_id" => to_int($company_id), "user_id" => to_int($user_id)));
			
		}
		
		return $return;
    }
	 
	protected function check_if_client_has_same_company($client_id, $company_id = 0) {
		
		$this->db->where('companies.id', to_int($company_id) );
	
        $this->db
				->from('clients')
				->join("companies","clients.company_id=companies.id","INNER")
				->where('clients.id', to_int($client_id) )
				->where('clients.is_deleted', 0);
        
        return ($this->db->count_all_results() > 0);
    }
	
	public function delete_user_clients($user_id) {
        
        return $this->db->delete('user_clients', array( "user_id" => to_int($user_id) ) );
    }
	
	public function update_user_clients($user_id, $client_ids, $company_id) {
	
		$this->delete_user_clients($user_id);
	
		if(is_array($client_ids) && count($client_ids) > 0){
			
			foreach($client_ids AS $client_id){
				
				if($this->check_if_client_has_same_company($client_id, $company_id)){
					
					$input = array("user_id" => to_int($user_id), "client_id" => to_int($client_id));
					$this->db->insert('user_clients', $input);
				}
			}
			
		} else if( is_string($client_ids) ){
			
			$client_id = $client_ids;
			
			if($this->check_if_client_has_same_company($client_id, $company_id)){
				
				$input = array("user_id" => to_int($user_id), "client_id" => to_int($client_id));
				$this->db->insert('user_clients', $input);
			}
		}
    } 
	
	public function update_user_group($user_id, $group_id) {
        
		$data = array(
            "group_id" => to_int($group_id)
        );
		
        $this->db->where('user_id', to_int($user_id));
        $this->db->update('users_groups', $data);
    }
	
	public function details($user_id) {
		
		$uc = "(SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc";
		
		$this->db
				->select('u.id, u.username, u.email, u.first_name, u.last_name, u.avatar, u.phone, g.id as group_id, u.postcode, u.gmt_offset, u.active, u.avatar, u.workhours, u.gps_device_id, u.hourly_rate, u.latitude, u.longitude, u.is_deleted')
				->select("CONCAT(u.first_name,' ', u.last_name) AS full_name", FALSE)
				->select('g.name as group_name, g.description as group_description, g.id as group_id')
				->select('com.id AS company_id, com.name AS company_name')
                ->from('users u')
                ->join('users_groups ug', 'u.id = ug.user_id', 'LEFT')
                ->join('groups g', 'ug.group_id = g.id', 'LEFT')
				->join($uc, 'u.id=uc.user_id', 'LEFT')
				->join('companies com', 'uc.company_id=com.id', 'LEFT')
				->where('u.id', to_int($user_id))
                ->group_by('u.id');
        
		$user_info = $this->db->get()->row();
		
		
		$user_info->id = to_int($user_info->id);
		$user_info->group_id = to_int($user_info->group_id);
		$user_info->hourly_rate = to_float($user_info->hourly_rate);
		$user_info->latitude = !is_null($user_info->latitude) ? $user_info->latitude : '';
		$user_info->longitude = !is_null($user_info->longitude) ? $user_info->longitude : '';
		//$user_info->region_name = !is_null($user_info->region_name) ? $user_info->region_name : '';
		$user_info->avatar = !is_null($user_info->avatar) ? $user_info->avatar : '';
		$user_info->active = to_int($user_info->active);
		$user_info->hourly_rate = to_float($user_info->hourly_rate);
		$user_info->is_deleted = to_float($user_info->is_deleted);
		
		$user_info->{'company_id'} = 0;
		$user_info->{'client_ids'} = array();
		
		if( _has_company_group_access($user_info->group_id) ) {
			
			$user_info->{'company_id'} = $this->user_company_by_user_id($user_info->id);
		}
		
		if ($user_info->group_id == GROUP_CLIENT_USER) {
			
			$clients = array();
			if( ($clients = $this->get_client_by_user_id($user_info->id)) != FALSE){
				
				$user_info->{'client_ids'} = $clients;
			}
			unset($clients);
		}
		
        return $user_info;
    }
	
	public function delete_user_company($user_id) {
        
        return $this->db->delete('user_company', array( "user_id" => to_int($user_id) ) );
    }
	
	public function delete_user($user_id) {
	
		$input = array('is_deleted'=> 1);

        $this->db->where('id', to_int($user_id));
        return $this->db->update('users', $input);
    }
	
	/* NEW FUNCTION ABOVE THIS */
	
	
	protected function get_clients_by_user_id($user_id) {

        $this->db
				->select('clients.id AS client_id, clients.company_id')
                ->from('user_clients')
				->join("users","user_clients.user_id=users.id","INNER")
				->join("clients","user_clients.client_id=clients.id","INNER")
				->join("companies","clients.company_id=companies.id","INNER")
                ->where('user_clients.user_id', to_int($user_id))
				->group_by('clients.id, clients.company_id');

        $query = $this->db->get();

		$clients = array();
        if ($query->num_rows() > 0) {
            $qrows = $query->result();
			
			foreach($qrows AS $qrow){
			
				$clients[]= to_int($qrow->client_id);
			}
        }

        return $clients;
    }

	public function get_user_profile($user_id) {
	
		if( ($data = _get_cache($user_id, CACHE_KEY_USER_PROFILE)) && $data !== FALSE){
			return $data;
		}
	
        $this->db
				->select('u.id AS user_id, u.username, u.email, u.first_name, u.last_name, u.avatar, u.phone, g.id as group_id, u.postcode')
                ->select('g.name as group_name, g.description as group_description, u.gmt_offset')
				->select("CONCAT(u.first_name,' ', u.last_name) AS user_full_name", FALSE)
                ->from('users u')
                ->join('users_groups ug', 'u.id = ug.user_id', 'INNER')
                ->join('groups g', 'ug.group_id = g.id', 'INNER')
				->where('u.id', to_int($user_id))
                ->group_by('u.id');
		
        $query = $this->db->get();

		$user_info = $query->row();
		
        if ($user_info) {
		
			$user_info->user_id = to_int($user_info->user_id);
			$user_info->group_id = to_int($user_info->group_id);
			$user_info->gmt_offset = ci()->cfg->gmt_offset;
			
			$user_info->{'company_id'} = $this->user_company_by_user_id($user_info->user_id, $user_info->group_id);
			$user_info->{'client_ids'} = FALSE;
			
			if($user_info->group_id == GROUP_CLIENT_USER){
				
				$user_info->{'client_ids'} = $clients;
				
			}
			
        }
		
		_set_cache($user_id, $user_info , CACHE_KEY_USER_PROFILE);
		
		return $user_info;
    }

}