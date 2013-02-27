<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    
/**
 * Class name : Login_model
 * 
 * Description :
 * This class contain functions to deal with the database and mae login functions
 * 
 * Created date ; 20/12/2012
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */    
    
    
class Login_model extends CI_Model
{
	//class variable
	var $id="";
	var $username = "";
	var $password = "";
	var $email =  "";
	var $permission = "";
	
	
	/**
     * Constructor
    **/	
	function __construct()
    {
        parent::__construct();
    }
	
	
	
	/**
	 * function name : canLogin
	 * 
	 * Description : 
	 * Check the user is in the database or not  
	 * if there is a record of the same email address then return true	
	 * and if there is a given id then execlude this id from checking
	 *  					
	 * Created date ; 21-12-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function canLogin()
	{
			
			
		$this->email = $this->input->post("email");
		$this->password = md5($this->input->post("password"));	
			
		$query = "select * from users 
				  where 
				  email='{$this->email}' and
				  password = '{$this->password}' and
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
	
	/**
	 * function name : getUserInfo
	 * 
	 * Description : 
	 * this function will get user by some parameter  
	 * and will return user infro	
	 * 
	 *  					
	 * Created date ; 22-12-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function getUserInfo($id = null , $username = null ,  $email = null)
	{
		$query = "select * from users where ";
						
		if(isset($id))
			$query.="id= {$id} and";
		
		if(isset($username))
			$query.="username = '{$username}' and";
		
		if(isset($email))
			$query.="email = '{$email}' and";
			
		$query .=" is_deleted = 'F'";
		
		$result = $this->db->query($query);
		
		return $result->result_array();
	}
}

?>