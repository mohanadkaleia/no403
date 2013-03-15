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
    
    
class Attribute extends CI_Model
{
	
	//class variable
	var $id="";
	var $name = "";
	var $value = "";	
	
	
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
	 	
		$name = $this->name;
		$value= $this->value;
		
	 	$query = "insert into attribute 
	 			  (name , value , created_date  ,  is_deleted)
	 			  values
	 			  ('{$name}' , '{$value}' , CURDATE() , 'F' ) 
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
	 	$id= $this->id;
		$name = $this->name;
		$value= $this->value;
		
	 	$query = "update attribute set
	 			  name = '{$name}' , 
	 			  value = '{$value}' ,
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
	 	$id=$this->id;
	 		 	
	 	$query = "update attribute set
	 			  is_deleted = 'T'
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
	
}

?>