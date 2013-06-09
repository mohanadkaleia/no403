<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    
/**
 * Class name : Attribute
 * 
 * Description :
 * This class contain functions to deal with the attribute database table (Add , Edit , Delete)
 * 
 * Created date ; 6-2-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */    
    
    
class Log extends CI_Model
{
	
	//class variable
	var $id="";
	var $action = "";
	var $action_date = "";	
	
	
	/**
     * Constructor
    **/	
	function __construct()
    {
        parent::__construct();
    }
	
	
	/**
	 * function name : add
	 * 
	 * Description : 
	 * add to the database 
	 * 		
	 * Created date ; 7-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function add()
	 {
	 	
		//log action 
		$action = $this->action;
		
		//get user id from session		
		$user_id = $this->session->userdata('user_id');
		
		//insert query
		$query = "insert into log 
	 			  (user_id , action , date ,  is_deleted)
	 			  values
	 			  ('{$user_id}' , '{$action}' , CURDATE() , 'F' ) 
	 				";	
		$this->db->query($query);
	 }
	
	
	
	 
	 
	 /**
	 * function name : getAll
	 * 
	 * Description : 
	 * get all logs from the database
	 * 		
	 * Created date ; 7-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getAll()
	 {
	 	$query = "select * from log where is_deleted='F'";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	
}

?>