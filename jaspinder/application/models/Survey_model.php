<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_model extends MY_Model{
    
    public function __construct() {
        parent::__construct();
    }
	
	public function get_site_forms() {
		
		$this->db
				->select('ft.*')
				->from('form_types ft')
				->where('ft.is_deleted', 0)
				->order_by('ft.id', 'ASC');

        return $this->db->get()->result();
    }
	
	public function add_form_type($input) {
	
		$this->db->insert("form_types", $input);
	   
		$primary_key = $this->db->insert_id();
		
		if( gtzero_integer($primary_key) ){
			
			return to_int($primary_key);
		}
		
		return 0;
    }
	
	public function update_form_type($input, $form_type_id) {
	
		$this->db->where('id', to_int($form_type_id));
        
		return $this->db->update('form_types', $input);
    }
	
	public function form_type_details($form_type_id) {
	
		$this->db
				->select('ft.*')
				->from('form_types ft')
				->where('ft.id', to_int($form_type_id));

        return $this->db->get()->row();
		
	}
	
	public function delete_form_type($form_type_id) {
	
		$this->db->where('id', to_int($form_type_id));
        
		return $this->db->update('form_types', array('is_deleted' => 1));
		
	}
	
	public function get_questions_by_form_id($form_type_id) {
		
		$this->db
				->select('q.id as question_id, q.form_type_id, q.form_section_id, q.description, q.help_text, q.type, q.allowed_types, q.max_size, q.table, q.options, q.sort_order')
				->select('ft.name AS form_name, fc.name AS section_name')
				->from('questions q')
				->join('form_types ft', 'q.form_type_id = ft.id','LEFT')
				->join('form_section fc', 'q.form_section_id = fc.id','LEFT')
				->where('q.is_deleted', 0)
				->where('ft.is_deleted', 0)
				//->order_by('q.form_section_id', 'ASC')
				->order_by('q.sort_order', 'ASC')
				->where("q.form_type_id", to_int($form_type_id));

        return $this->db->get()->result();
    }
	
	
	
	public function update_qsort($sort_order, $question_id, $form_type_id) {
	
		$input = array('sort_order' => $sort_order);
	
		$this->db->where('id', to_int($question_id));
		$this->db->where('form_type_id', to_int($form_type_id));
        
		return $this->db->update('questions', $input);
    }
	
	
	
	public function qcreate($input) {
	
		$this->db->insert("questions", $input);
	   
		$primary_key = $this->db->insert_id();
		
		if( gtzero_integer($primary_key) ){
			
			return to_int($primary_key);
		}
		
		return 0;
    }
	
	public function qupdate($input, $question_id) {
	
		$this->db->where('id', to_int($question_id));
        
		return $this->db->update('questions', $input);
    }
	
	public function delete_question($question_id) {
	
		$this->db->where('id', to_int($question_id));
        
		return $this->db->update('questions', array('is_deleted' => 1));
		
	}
	
	public function get_question_detail($question_id, $form_type_id){
		
		$this->db->where('id', to_int($question_id));
		$this->db->where('form_type_id', to_int($form_type_id));
		
		
		$this->db
				->select('q.id as question_id, q.form_type_id, q.form_section_id, q.description, q.help_text, q.type, q.allowed_types, q.max_size, q.table, q.options, q.sort_order')
				->from('questions q');
				
		return $this->db->get()->row();
				
	}
}

?>