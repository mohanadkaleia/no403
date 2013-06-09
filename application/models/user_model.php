<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    
/**
 * Class name : User_model
 * 
 * Description :
 * This class contain functions to deal with the user database table (Add , Edit , Delete)
 * 
 * Created date ; 5-10-2012
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */    
    
    
class User_model extends CI_Model
{
	
	//class variable
	var $id;
	var $username = "";
	var $password = "";
	var $email =  "";
	var $permission = "ADMIN"; //by default there is no permission other the admin
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
	 * add user to the database 
	 * 		
	 * Created date ; 5-10-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function add()
	 {
	 	//assign user id
	 	$this->user_id = $this->session->userdata('user_id');
		
	 	$query = "insert into users 
	 			  (name , password , email , permission , creator_id ,  created_date  ,  is_deleted)
	 			  values
	 			  ('{$this->username}' , '{$this->password}' , '{$this->email}' , '{$this->permission}' , {$this->user_id} , CURDATE() , 'F' ) 
	 				";	
		$this->db->query($query);
	 }
	 
	 
	 /**
	 * function name : edit
	 * 
	 * Description : 
	 * edit user to the database 
	 * 		
	 * Created date ; 23-11-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function edit()
	 {
	 	
		//assign user id
	 	$this->user_id = $this->session->userdata('user_id');
		
	 	$query = "update users set
	 			  name = '{$this->username}' , 
	 			  password = '{$this->password}' , 
	 			  email = '{$this->email}' , 
	 			  permission = '{$this->permission}' , 
	 			  modifier_id =  {$this->user_id} ,
	 			  modified_date = CURDATE()	 
	 			  where id = {$this->id}";

						  
		//echo $query;
		$this->db->query($query);
	 }
	 
	 
	 /**
	 * function name : delete
	 * 
	 * Description : 
	 * delete user by make is_deleted field to be true
	 * 		
	 * Created date ; 23-11-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function delete()
	 {
	 	//assign user id
	 	$this->user_id = $this->session->userdata('user_id');
			 	
	 	$query = "update users set
	 			  is_deleted = 'T' , 
	 			  modifier_id =  {$this->user_id}
	 			  where id = {$this->id}";
		$this->db->query($query);
	 }
	 
	 
	 
	 /**
	 * function name : changePassword
	 * 
	 * Description : 
	 * change user password
	 * 		
	 * Created date ; 6-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function changePassword()
	 {	 	
	 	$query = "update users set
	 			  password = '{$this->password}'
	 			  where id = {$this->id}";
		$this->db->query($query);
	 }
	 
	 
	 /**
	 * function name : getAll
	 * 
	 * Description : 
	 * get all users from the database
	 * 		
	 * Created date ; 22-10-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getAll()
	 {
	 	$query = "select * from users where is_deleted='F'";	
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
	public function chkUserIsExist($id=null)
	{		
		$query = "select * from users where email='{$this->email}' and is_deleted='F'";
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
	 * get user by id
	 * 		
	 * Created date ; 16-11-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getById($id)
	 {
	 	$query = "select * from users where id={$id}";	
		$query = $this->db->query($query);
		return $query->result_array();			
	 }
	 
	 
	 
	 
	 /**
	 * function name : getPermission
	 * 
	 * Description : 
	 * get permission to enable login , user can log using email and password
	 * if there is a user with these email\password and user is admin then give permssion to login	
	 * Created date ; 6-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	 public function getPermission()
	 {	 	
		$email = $this->email;
		$password = $this->password;
		
		$query = "select * from users 
				  where 
				  email='{$email}' and
				  password = '{$password}' and
				  permission = 'ADMIN' and
				  is_deleted = 'F'";
				  						
		$result = $this->db->query($query);
		
		// if there is a record that have username\passord then return true				
		if($result->num_rows() > 0)
			return TRUE;
		else 
		{
			return FALSE;
		}							
	 }
	 
	 
	 
	
}    
    
    
    
    
    
?>