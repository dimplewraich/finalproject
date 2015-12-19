<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function get_all(){
		
		$this->db
				->select("*")
				->from("settings");
				
		$qrows = $this->db->get()->result();
		
		foreach($qrows AS &$qrow){
			
			if($qrow->type == 'select') $qrow->options = (array)json_decode($qrow->options);
		}
		
		return $qrows;
	}
	
	public function update($key, $value){
		
		return $this->update_core_settings($key, $value);
	}
	
}