<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_User_agent extends CI_User_agent {

	/**
	 * List of tablets to compare against current user agent
	 *
	 * @var array
	 */
	public $tablets = array();
	
	public $is_tablet = FALSE;
	public $tablet = '';

    public function __construct(){
        parent::__construct();
		
		if ($this->agent !== NULL && $this->_load_agent_file())
		{
			$this->_compile_data();
		}
		
		$this->_set_tablet();
		
    }
	
	// --------------------------------------------------------------------

	/**
	 * Compile the User Agent Data
	 *
	 * @return	bool
	 */
	protected function _load_agent_file() {
	
		if (($found = file_exists(APPPATH.'config/user_agents.php')))
		{
			include(APPPATH.'config/user_agents.php');
		}

		if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/user_agents.php'))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/user_agents.php');
			$found = TRUE;
		}

		if ($found !== TRUE)
		{
			return FALSE;
		}

		$return = FALSE;

		if (isset($platforms))
		{
			$this->platforms = $platforms;
			unset($platforms);
			$return = TRUE;
		}

		if (isset($browsers))
		{
			$this->browsers = $browsers;
			unset($browsers);
			$return = TRUE;
		}

		if (isset($mobiles))
		{
			$this->mobiles = $mobiles;
			unset($mobiles);
			$return = TRUE;
		}

		if (isset($tablets))
		{
			$this->tablets = $tablets;
			unset($tablets);
			$return = TRUE;
		}

		if (isset($robots))
		{
			$this->robots = $robots;
			unset($robots);
			$return = TRUE;
		}

		return $return;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Set the tablets
	 *
	 * @return	bool
	 */
	protected function _set_tablet(){
	
		if (is_array($this->tablets) && count($this->tablets) > 0){
		
			foreach ($this->tablets as $key => $_regex){
			
				if (FALSE !== ($this->match($_regex, $this->agent))) {
					
					$this->is_tablet = TRUE;
					$this->tablet = $key;
					return TRUE;
				}
			}
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	
	protected function match($regex, $userAgent = null){
	
        return (bool) preg_match(sprintf('#%s#is', $regex), (false === empty($userAgent) ? $userAgent : $this->agent), $matches);
    }

	// --------------------------------------------------------------------


    public function is_ipad(){
	
        return (bool) strpos(@$_SERVER['HTTP_USER_AGENT'],'iPad');
    }

	// --------------------------------------------------------------------

	/**
	 * Is Mobile
	 *
	 * @param	string	$key
	 * @return	bool
	 */
	public function is_tablet($key = NULL)
	{
		if ( ! $this->is_tablet)
		{
			return FALSE;
		}

		// No need to be specific, it's a mobile
		if ($key === NULL)
		{
			return TRUE;
		}

		// Check for a specific robot
		return (isset($this->tablets[$key]) && $this->tablet === $this->tablets[$key]);
	}
}
// END MY User agent

/* End of file MY_User_agent.php */
/* Location: ./application/libraries/MY_User_agent.php */ 