<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacturer_model extends MY_Model{
    
    public function __construct() {
        parent::__construct();
    }
	
	public function ajax_gets($params, $hiddenColms = array()) {

        $aColumns = array('m.name', 'full_name','c.created_on');
		
		if( in_array('company',$hiddenColms) ){
			
			unset($aColumns[1]);
			
			$aColumns = array_values($aColumns);
		}

        $this->db
				->select('SQL_CALC_FOUND_ROWS m.id as ID', FALSE)
				->select('m.name AS manufacturer_name')
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->from('manufacturers m')
				->join('users u', 'm.created_by = u.id','LEFT')
				->where("m.is_deleted",0);
		

        $this->db->group_by('m.id');

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

                // Individual column filtering
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


        $query = $this->db->get();

        $this->db->select('FOUND_ROWS() AS found_rows');
        $filtered_total = $this->db->get()->row()->found_rows;

        $total_records = $this->ajax_gets_count($params);
        
		$output = array(
            'sEcho' 				=> intval($params['sEcho']),
            'iTotalRecords' 		=> $total_records,
            'iTotalDisplayRecords' 	=> $filtered_total,
            'aaData' 				=> $query->result_array()
        );

        return $output;
    }
	
	public function ajax_gets_count($params) {

		 $this->db
				->from('manufacturers m')
				->where("m.is_deleted",0);
		

        return $this->db->count_all_results();
    }
	
	public function get_by_many($params = array(), $return = 'RESULT'){
		
		$this->db
				->select('m.*')
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->from('manufacturers m')
				->join('users u', 'm.created_by = u.id','LEFT')
				->where('m.is_deleted', 0);
				
		if( isset($params['name']) && !empty($params['name']) ){
			$this->db->where(sprintf("m.name LIKE '%s' ", $params['name']));
		}
		
		if( isset($params['manufacturer_id_not']) && !empty($params['manufacturer_id_not']) ){
			$this->db->where('m.id !=', to_int($params['manufacturer_id_not']));
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
	
	public function add_product($input) {
	
		$input['created_on'] = curr_timestamp();
	
		$this->db->insert("products",$input);
	   
		$primary_key = $this->db->insert_id();
		
		if( gtzero_integer($primary_key) ){
			
			return to_int($primary_key);
		}
		
		return 0;
    }
	
	public function details($product_id) {
	
        $this->db
				->select('p.*')
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->from('manufacturers m')
				->join('users u', 'm.created_by = u.id','LEFT')
				->where('m.is_deleted', 0)
				->where('m.id', to_int($product_id));
		
        
        $row = $this->db->get()->row();
        
        return $row;
    }
	
	public function update($details, $id) {
	
        $this->db->where('id',$id);
        
		return $this->db->update('manufacturer', $details);
    }
	
	public function delete($id) {
	
        $this->db->where('id',$id);
		
        return $this->db->update('manufacturer', array('is_deleted' => 1));
    }
     
}