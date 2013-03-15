<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    
/**
 * Class name : Respond
 * 
 * Description :
 * This class contain functions to deal with the respond database table (Add , Edit , Delete)
 * 
 * Created date ; 10-2-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */    
    
    
class Respond extends CI_Model
{
	
	//class variable
	var $id="";
	var $type = "message"; //{message , request} the respond can be either for message from contact us page or respond to a request from request page.
	var $message_id = 0;
	var $body = "";	
	
	
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
	 * add respond to the database 
	 * 		
	 * Created date ; 10-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function add()
	 {
	 	
		$type = $this->type;
		$body= $this->body;
		$message_id = $this->message_id;
		
		//get user id from session		
		$user_id = $this->session->userdata('user_id');
		
		
	 	$query = "insert into respond 
	 			  (message_id , type , body ,user_id , respond_date  ,  is_deleted)
	 			  values
	 			  ('{$message_id}' , '{$type}' , '{$user_id}' , CURDATE() , 'F' ) 
	 				";	
		$this->db->query($query);
	 }
	
	
	 
	 /**
	 * function name : getAll
	 * 
	 * Description : 
	 * get all attribute from the database
	 * 		
	 * Created date ; 6-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getAll()
	 {
	 	$query = "select * from respond where is_deleted='F'";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	 
	 /**
	 * function name : getByMessage
	 * 
	 * Description : 
	 * Get all active responds that correspond to a spesicifc message or request.
	 * 		
	 * Created date ; 6-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getByMessage()
	 {
	 	$type = $this->type;		
		$message_id = $this->message_id;	
			
	 	$query = "select * from respond	 			
	 			  where 
	 			  message_id = {$message_id} and 
	 			  type = '{$type}' and
	 			  is_deleted='F'";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	
}

?>