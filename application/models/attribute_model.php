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
    
    
class Attribute_model extends CI_Model
{
	
	//class variable
	var $id="";
	var $name = "";
	var $value = "";
	var $description = "";	
	var $user_id;
	
	
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
	 * add attribute to the database 
	 * 		
	 * Created date ; 6-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function add()
	 {
	 	
		//assign user id
	 	$this->user_id = $this->session->userdata('user_id');
	 	
		$name = $this->name;
		$value= $this->value;
		$description = $this->description;
		
	 	$query = "insert into attribute 
	 			  (name , value , description , creator_id , created_date  ,  is_deleted)
	 			  values
	 			  ('{$name}' , '{$value}' , '{$description}' , {$this->user_id} , CURDATE() , 'F' ) 
	 				";	
		$this->db->query($query);
	 }
	
	
	
	/**
	 * function name : edit
	 * 
	 * Description : 
	 * edit attribute to the database 
	 * 		
	 * Created date ; 6-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function edit()
	 {
	 	//assign user id
	 	$this->user_id = $this->session->userdata('user_id');
		
	 	$id= $this->id;
		$name = $this->name;
		$value= $this->value;
		
	 	$query = "update attribute set
	 			  name = '{$name}' , 
	 			  value = '{$value}' ,
	 			  modifier_id = {$this->user_id},
	 			  modified_date = CURDATE()	 	 			  
	 			  where id = {$id}";
		$this->db->query($query);
	 }	
	 
	 
	 /**
	 * function name : delete
	 * 
	 * Description : 
	 * delete attribute by make is_deleted field to be true
	 * 		
	 * Created date ; 6-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function delete()
	 {
	 	//assign user id
	 	$this->user_id = $this->session->userdata('user_id');
		
	 	$id=$this->id;
	 		 	
	 	$query = "update attribute set
	 			  is_deleted = 'T',
	 			  modifier_id = {$this->user_id}
	 			  where id = {$id}";
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
	 	$query = "select * from attribute where is_deleted='F'";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	 
	 
	 /**
	 * function name : chkAttrIsExist
	 * 
	 * Description : 
	 * Check the user is in the database or not  
	 * if there is a record of the same email address then return true	
	 * and if there is a given id then execlude this id from checking
	 *  					
	 * Created date ; 16-10-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function chkAttrIsExist($id=null)
	{		
		$query = "select * from attribute where name='{$this->name}'";		
		
		if(isset($id) & $id!=null)
		{			
			$query.=" and id<>{$id}";
		}
			
		$result = $this->db->query($query);
		
		// if there is a record of the same email address then return false				
		if($result->num_rows() > 0)
			return TRUE;
		else 
		{
			return FALSE;
		}
	} 
	
	
	/**
	 * function name : getById
	 * 
	 * Description : 
	 * get all category from the database
	 * 		
	 * Created date ; 7-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getById($id)
	 {
	 	$query = "select * from attribute where is_deleted='F' and id={$id}";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	
}

?>