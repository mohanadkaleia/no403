<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    
/**
 * Class name : request
 * 
 * Description :
 * This class contain functions to deal with the request database table (Add , Edit , Delete)
 * 
 * Created date ; 9-2-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */    
    
    
class Request extends CI_Model
{
	
	//class variable
	var $id="";
	var $name = "";	
	var $email = "";
	var $program_name= "";
	var $program_url= "";
	var $program_description= "";
	var $approve = "";	
	var $note = "";
	
	
	
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
	 * Created date ; 9-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function add()
	 {
	 	
		$name = $this->name;
		$email = $this->email;
		$program_name = $this->program_name;
		$program_description = $this->program_description;
		$program_url = $this->program_url;		
		
		//get user id from session		
		$user_id = $this->session->userdata('user_id');
		
	 	$query = "insert into request 
	 			  (name , email , program_name , program_url , program_description , request_date )
	 			  values
	 			  ('{$name}' , '{$email}' , '{$program_name}' , '{$program_url}' , '{$program_description}' , CURDATE()) 
	 				";	
		$this->db->query($query);
	 }
	
	
	
	
	 
	 /**
	 * function name : approve
	 * 
	 * Description : 
	 * approve a request by putting approve field to be true
	 * 		
	 * Created date ; 9-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function approve()
	 {
	 	$id=$this->id;
	 		
		//get user id from session		
		$user_id = $this->session->userdata('user_id');
		 	
	 	$query = "update request set
	 			  approved = 'T' , 
	 			  respond_date = CURDATE()	 
	 			  where id = {$id}";
		$this->db->query($query);
	 }	
	 
	 
	 /**
	 * function name : delete
	 * 
	 * Description : 
	 * delete a request
	 * 		
	 * Created date ; 9-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function delete()
	 {
	 	$id=$this->id;
	 	
	 	$query = "update request set
	 			  is_deleted = 'T' 	 			  	 
	 			  where id = {$id}";
		$this->db->query($query);
	 }
	 
	 
	 /**
	 * function name : getAll
	 * 
	 * Description : 
	 * get all requests from the database
	 * 		
	 * Created date ; 9-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getWaitingRequests()
	 {
	 	$query = "select * from request where  iapproved='F' and is_deleted='F'";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	 
	 /**
	 * function name : getAll
	 * 
	 * Description : 
	 * get all requests from the database
	 * 		
	 * Created date ; 9-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getAll()
	 {
	 	$query = "select * from request where is_deleted='F'";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	
	/**
	 * function name : addNote
	 * 
	 * Description : 
	 * add to the database 
	 * 		
	 * Created date ; 9-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function addNote()
	 {
	 	$id=$this->id;
		$note = $this->note;			
		
		//get user id from session		
		$user_id = $this->session->userdata('user_id');
		
	 	$query = "update request set
	 			  note = '{$note}'	 			  	 
	 			  where id = {$id}";
		$this->db->query($query);
	 }	
}

?>