<?php defined('BASEPATH') OR exit('No direct script access allowed.');

// Name of Class as mentioned in $hook['post_controller]
class Db_log {

    public function __construct() {
       // Anything except exit() :P
    }

    // Name of function same as mentioned in Hooks Config
    public function logQueries($params = array()) {

        $ci = & get_instance();

        $filepath = APPPATH . 'logs/db-log-' . date('Y-m-d') . '.php'; // Creating Query Log file with today's date in application/logs folder
        $handle = fopen($filepath, "a+");                 // Opening file with pointer at the end of the file

        $times = $ci->db->query_times;                   // Get execution time of all the queries executed by controller
        foreach ($ci->db->queries as $key => $query) { 
            $sql = $query . " \n Execution Time:" . $times[$key]; // Generating SQL file alongwith execution time
			$line = "\n===============================================================================================================\n\n";
            fwrite($handle, $sql . $line);              // Writing it in the log file
        }

        fclose($handle);      // Close the file
    }

}