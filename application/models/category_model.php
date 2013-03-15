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
    
    
class Category extends CI_Model
{
	
	//class variable
	var $id="";
	var $name = "";
	var $description = "";
	var $type = "";
	var $code = "";
	var $url = "";	
	
	
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
	 	
		$name = $this->name;
		$value= $this->description;
		$code= $this->code;
		$type= $this->type;
		$url= $this->url;
		
	 	$query = "insert into category 
	 			  (name , code , type , url , description ,  created_date  ,  is_deleted)
	 			  values
	 			  ('{$name}' , '{$code}' , '{$type}' , '{$type}' , '{$description}' ,  CURDATE() , 'F' ) 
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
	 	$id= $this->id;
		$name = $this->name;
		$value= $this->description;
		$code= $this->code;
		$type= $this->type;
		$url= $this->url;
		
	 	$query = "update category set
	 			  name = '{$name}' , 
	 			  code = '{$code}' ,
	 			  type = '{$type}' ,
	 			  url = '{$url}' ,
	 			  description = '{$description}' ,
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
	 	$id=$this->id;
	 		 	
	 	$query = "update category set
	 			  is_deleted = 'T' , 
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
	
}

?>