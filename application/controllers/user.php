<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
	
/**
 * Class name : User
 * 
 * Description :
 * This class contain functions to deal with the user (Add , Edit , Delete)
 * 
 * Created date ; 4-10-2012
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia 
 * contact : ms.kaleia@gmail.com
 */
    
class User extends CI_Controller  
{
	
	
	public function index()
	{
		$this->login();	
		
	}
	
	/**
	 * function name : login
	 * 
	 * Description : 
	 * call login view
	 * 
	 * Created date ; 14-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function login()
	{
		//load library	
		$this->load->library('form_validation');
											
		// call header		
		$this->load->view('gen/header_admin');
				
		// call login view
		$this->load->view('login');
	}
	
	
	/**
	 * function name : manageUser
	 * 
	 * Description : 
	 * manage user information
	 * 
	 * Created date ; 14-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function manageUser()
	{				
			
			
		//set the active tab page
		$data["user"] = "active";	
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('user_admin');							
		$this->load->view('gen/footer_admin');
	}
	
	
	/**
	 * function name : ajaxGetUsers
	 * 
	 * Description : 
	 * get users information from database
	 * 
	 * Created date ; 25-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function ajaxGetUsers()
	{
	
		
	}
	
	
	
	
}  
    
    
    
    
    
?>