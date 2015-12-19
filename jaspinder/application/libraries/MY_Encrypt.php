<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_Encrypt extends CI_Encrypt {

	public function __construct() {
		parent::__construct();
	}
	
    public function safe_b64encode($string) 
	{
	
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

	public function safe_b64decode($string) 
	{
	
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
	
	public function encode($data, $key = '')
	{
		return $this->safe_b64encode($this->mcrypt_encode($data, $this->get_key($key)));
	}
	
	public function decode($string, $key = '')
	{
		if (preg_match('/[^a-zA-Z0-9\/\+=_-]/', $string) OR $this->safe_b64encode($this->safe_b64decode($string)) !== $string)
		{
			return FALSE;
		}

		return $this->mcrypt_decode($this->safe_b64decode($string), $this->get_key($key));
	}
}