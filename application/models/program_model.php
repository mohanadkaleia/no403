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
    
    
class Program_model extends CI_Model
{
	
	//class variable
	var $id=0; 			 		// program id
	var $cat_id=Array(); 		//array of categories id
	var $name = "";				//program name
	var $physical_name = ""; 	//program physical name
	var $version = "";			//program version
	var $download_url="";		//download url
	var $website = "";			//source program website ex. "www.sourceforge.com"
	var $produced_by ="";		//company who create the program
	var $multi_version = FALSE; //is it multi version or not !!
	var $next_version_date = "";//next vesion date 
	var $size = "";				//size
	var $picture = "";			//picture
	var $description = "";		//program description
	var $download_num = 0;		//download number
	
	
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
		$physical_name= $this->physical_name;
		$version= $this->version;
		$website= $this->website;
		$picture= $this->picture;		
		$description = $this->description;
		$multi_version= $this->multi_version;
		$next_version_date= $this->picture;
		$size= $this->size;
		$producer = $this->produced_by;
		$download_url = $this->download_url;
		$cat = $this->cat_id;
		
		//get user id from session		
		$user_id = $this->session->userdata('user_id');
		
		//add program information to program table
	 	$query = "insert into program 
	 			  (name , physical_name , picture , website   , version , download_url , multi_version , next_version_date, size ,  description , creator_id ,  created_date)
	 			  values
	 			  ('{$name}' , '{$physical_name}' , '{$picture}' , '{$website}'  , '{$version}' , '{$download_url}' , '{$multi_version}' , '{$next_version_date}' , '{$size}' , '{$description}' ,  {$user_id} ,  CURDATE()) 
	 				";											
		$this->db->query($query);
		
		$this->id =  $this->db->insert_id();
		
		
		
		//add program's categories to database
		for( $i=0 ; $i<count($cat) ; $i++)
		{
			$query = "insert into programCategory 
					  (prog_id , cat_id)
					  values
					  ({$this->id} , {$cat[$i]})";
		    $this->db->query($query);	
		} 
		
		
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
		$physical_name= $this->physical_name;
		$version= $this->version;
		$website= $this->website;
		$picture= $this->picture;		
		$description = $this->description;
		$multi_version= $this->multi_version;
		$next_version_date= $this->picture;
		$size= $this->size;
		
		//get user id from session		
		$user_id = $this->session->userdata('user_id');
		
	 	$query = "update program set
	 			  name = '{$name}' , 
	 			  physical_name = '{$physical_name}' ,
	 			  picture = '{$picture}' ,
	 			  source_website = '{$website}' ,
	 			  version = '{$version}' ,
	 			  multi_version = '{$multi_version}' ,
	 			  multi_version_date = '{$multi_version_date}' ,
	 			  size = '{$size}' ,
	 			  description = '{$description}' ,
	 			  modifier_id = {$user_id} ,
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
	 	
	 	//get user id from session		
		$user_id = $this->session->userdata('user_id');
			 	
	 	$query = "update program set
	 			  is_deleted = 'T' , 
	 			  modifier_id = {$user_id},
	 			  modified_date = CURDATE()	 
	 			  where id = {$id}";
		$this->db->query($query);
	 }	
	 
	 
	 /**
	 * function name : getAll
	 * 
	 * Description : 
	 * get all program from the database
	 * 		
	 * Created date ; 9-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getAll()
	 {
	 	$query = "select * from progam where is_deleted='F'";	
		$query = $this->db->query($query);
		return $query->result_array();
		//return $query->result(); 		
	 }
	
	
	
	
	
	/**
	 * function name : chkProgramIsExist
	 * 
	 * Description : 
	 * Check the user is in the database or not  
	 * if there is a record of the same program name is exist then return true		 
	 *  					
	 * Created date ; 9-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function chkProgIsExist($id=null)
	{		
		$query = "select * from program where name='{$this->name}'";		
		
		if(isset($id) & $id!=null)
		{			
			$query.=" and id<>{$id}";
		}
			
		$result = $this->db->query($query);
		
		// if there is a record of the same name then return false				
		if($result->num_rows() > 0)
			return TRUE;
		else 
		{
			return FALSE;
		}
	} 
	
	
	/**
	 * function name : incDownloadNum
	 * 
	 * Description : 
	 * Check the user is in the database or not  
	 * When download a program then the download number will increase by one	 
	 *  					
	 * Created date ; 9-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function incDownloadNum()
	{
		
		$id=$this->id;
	 	
	 	//get user id from session		
		$user_id = $this->session->userdata('user_id');
			
		$query = "update program set
	 			  dowunload_num = (select download_num from program where id = {$id})  + 1, 
	 			  modifier_id = {$user_id},
	 			  modified_date = CURDATE()	 
	 			  where id = {$id}";	
			
		$result = $this->db->query($query);			
	} 
	
	
	
	/**
	 * function name : addProgramCategory
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
	 public function addProgramCategory()
	 {
	 	
		$program_id = $this->id;
		$category_id = $this->cat_id;			
		
		for($i=0 ; $i<count($category_id) ; $i++)
		{
			$query = "insert into programCategory
					  (prog_id , cat_id)
					  values
					  ( {$program_id} ,{$category_id[$i]} )";	
		}
					 
		$this->db->query($query);
	 }
	 
	 
	 /**
	 * function name : deleteProgramCategory
	 * 
	 * Description : 
	 * delete all category to the database 
	 * 		
	 * Created date ; 9-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function deleteProgramCategory()
	 {
	 	
		$program_id = $this->id;				
				
		$query = "delete from programCategory
				  where prog_id = {$program_id}";	
				  
		$this->db->query($query);							 
	 }
	 
	
}

?>