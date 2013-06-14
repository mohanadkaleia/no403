<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    
/**
 * Class name : category
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
    
    
class Category_model extends CI_Model
{
	
	//class variable
	var $id="";
	var $name = "";
	var $description = "";
	var $type = "";
	var $code = "";
	var $url = "";	
	
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
	 	//assign user id
	 	$this->user_id = $this->session->userdata('user_id');
			 	
		$name = $this->name;
		$description= $this->description;
		$code= $this->code;
		$type= $this->type;
		$url= $this->url;
		
	 	$query = "insert into category 
	 			  (name , code , type , url , description , creator_id , created_date  ,  is_deleted)
	 			  values
	 			  ('{$name}' , '{$code}' , '{$type}' , '{$url}'  , '{$description}' , {$this->user_id} , CURDATE() , 'F' ) 
	 				";	
		$this->db->query($query);
	 }
	
	
	
	/**
	 * function name : edit
	 * 
	 * Description : 
	 * edit category to the database 
	 * 		
	 * Created date ; 7-2-2013
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
		$description = $this->description;
		$code= $this->code;
		$type= $this->type;
		$url= $this->url;
		
	 	$query = "update category set
	 			  name = '{$name}' , 
	 			  code = '{$code}' ,
	 			  type = '{$type}' ,
	 			  url = '{$url}' ,
	 			  description = '{$description}' ,
	 			  modifier_id = {$this->user_id},
	 			  modified_date = CURDATE()	 			  
	 			  where id = {$id}";
		$this->db->query($query);
	 }	
	 
	 
	 /**
	 * function name : delete
	 * 
	 * Description : 
	 * delete category by make is_deleted field to be true
	 * 		
	 * Created date ; 7-2-2013
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
	 		 	
	 	$query = "update category set
	 			  is_deleted = 'T' , 
	 			  modifier_id = {$this->user_id} ,
	 			  modified_date = CURDATE()	 
	 			  
	 			  where id = {$id}";
		$this->db->query($query);
	 }	
	 
	 
	 /**
	 * function name : getAll
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
	 public function getAll()
	 {
	 	$query = "select * from category where is_deleted='F'";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	 
	 /**
	 * function name : getTypes
	 * 
	 * Description : 
	 * get all category from the database
	 * 		
	 * Created date ; 10-6-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getTypes()
	 {
	 	$query = "select DISTINCT type from category where is_deleted='F'";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	 
	 /**
	 * function name : getCategoryByType
	 * 
	 * Description : 
	 * get all category from the database
	 * 		
	 * Created date ; 10-6-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getCategoryByType($type)
	 {
	 	$query = "select * from category where is_deleted='F' and type='{$type}'";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	 
	 
	 /**
	 * function name : chkUserIsExist
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
	public function chkCatIsExist($id=null)
	{		
		$query = "select * from category where name='{$this->name}'";		
		
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
	 	$query = "select * from category where is_deleted='F' and id={$id}";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	
}

?>