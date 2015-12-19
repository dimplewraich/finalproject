<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notes_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function ajax_gets($params) {

        $aColumns = array('nt.note', 'created_by_name', 'nt.created_on', 'nt.id');

        $this->db
				->select('SQL_CALC_FOUND_ROWS nt.id as note_id', FALSE)
				->select('LEFT(nt.`note`, 256) as note_description , nt.created_on',FALSE)
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->from('notes nt')
				->join('users u', 'nt.created_by = u.id','LEFT');
		
		$note_type_id = array_key_exists('note_type_id', $params) ? to_int($params['note_type_id']) : 0;
		$ref_id = array_key_exists('ref_id', $params) ? to_int($params['ref_id']) : 0;
		
		$this->db->where("nt.note_type_id", $note_type_id);
		$this->db->where("nt.ref_id", $ref_id);
		$this->db->where("nt.is_deleted", 0);
        $this->db->group_by('nt.id');

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
        
        $this->db
				->from('notes nt');
		
		$note_type_id = array_key_exists('note_type_id', $params) ? to_int($params['note_type_id']) : 0;
		$ref_id = array_key_exists('ref_id', $params) ? to_int($params['ref_id']) : 0;
		
		$this->db->where("nt.note_type_id", $note_type_id);
		$this->db->where("nt.ref_id", $ref_id);
		$this->db->where("nt.is_deleted", 0);

        return $this->db->count_all_results();
    }

    public function add_note($input) {
	
		if( empty($input['note'])) return 0;
	
		$input['created_on'] = curr_timestamp();
        
        $this->db->insert('notes', $input);
		
		$primary_key = $this->db->insert_id();
		
		if( gtzero_integer($primary_key) ){
			
			return to_int($primary_key);
		}
		
		return 0;
       
    }
    
    public function details($id, $note_type_id) {
	
		$this->db
				->select('nt.id, nt.note AS note_description, nt.created_on, nt.created_by')
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->from('notes nt')
				->join('users u', 'nt.created_by = u.id','LEFT')
				->where("nt.note_type_id", to_int($note_type_id))
				->where('nt.id', to_int($id));
                        
		return $this->db->get()->row();
    }
	
	public function update($input, $id) {
	
        $this->db->where('id', to_int($id));
        
		return $this->db->update('notes', $input);
    }
    
    public function delete($id) {
	
        $this->db->where('id', to_int($id) );
		
        return $this->db->update('notes', array('is_deleted' => 1));
    }
	
	public function get_by_many($params = array(), $return = 'RESULT'){
		
		
		$this->db
				->select('nt.*')
				->select("CONCAT(u.first_name,' ',u.last_name) AS created_by_name", FALSE)
				->from('notes nt')
				->join('users u', 'nt.created_by = u.id','LEFT')
				->where('nt.is_deleted', 0);

		if( array_key_exists('ref_id', $params) ){
			$this->db->where('nt.ref_id', to_int($params['ref_id']));
		}
		
		if( array_key_exists('note_type_id', $params) ){
			$this->db->where('nt.note_type_id', to_int($params['note_type_id']));
		}
		
		if( array_key_exists('note_id_not', $params) && !empty($params['note_id_not']) ){
			$this->db->where('nt.id !=',$params['note_id_not'], FALSE);
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
	
	public function add_company_note($company_id, $note_id) {
	
		if( !gtzero_integer($company_id) || !gtzero_integer($note_id)) return 0;
	
		$input = array(
			'company_id'	=> $company_id
			,'note_id'		=> $note_id
		);
        
        return $this->db->insert('company_notes', $input);
       
    }
	
	public function add_client_note($client_id, $note_id) {
	
		if( !gtzero_integer($client_id) || !gtzero_integer($note_id)) return 0;
	
		$input = array(
			'client_id'	=> $client_id
			,'note_id'		=> $note_id
		);
        
        return $this->db->insert('client_notes', $input);
       
    }
}