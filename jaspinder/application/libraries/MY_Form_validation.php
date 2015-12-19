<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	//public $CI;
	
	public function __construct($rules = array()) {
        parent::__construct($rules);
    }
	
	/*public function _validate_date($date)
	{
		$format = 'Y-m-d H:i:s';
		$date = str_replace('/', '-', $date);
		
		$d = DateTime::createFromFormat($format, $date);
		return ($d && $d->format($format) == $date) ? TRUE : FALSE;
	}*/

    public function is_unique($str, $field) {
	
        if (substr_count($field, '.') == 3) {
            list($table, $field, $id_field, $id_val) = explode('.', $field);
            $query = $this->CI->db->limit(1)->where($field, $str)->where($id_field . ' != ', $id_val)->get($table);
			
        } else {
		
            list($table, $field) = explode('.', $field);
            $query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
        }

        return $query->num_rows() === 0;
    }

    public function money($str) {
        //First check if decimal
        if (!parent::decimal($str)) {
            //Now check if integer
            return (bool) parent::integer($str);
        }

        return TRUE;
    }
	
	public function is_money($input) {
         return (bool) preg_match('/^[0-9]+(\.[0-9]{0,2})?$/', $input);
	}
	
	public function company1($str, $current_user_group) {
	echo $current_user_group;
		if($current_user_group == 1){
		
			if(trim($str) == ''){
				$this->CI->form_validation->set_message('company', "This company field is required.");
				return FALSE;
			}
			
			return FALSE;
		}
		
		return FALSE;
	}

}

// END MY Form Validation Class

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */ 