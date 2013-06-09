<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
	
/**
 * Class name : Admin
 * 
 * Description :
 * This class contain functions that refer to pages like login
 * 
 * Created date ; 25-1-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
class Admin extends CI_Controller
{
	public function index()
	{
		 	
		$this->login();												
	}
	
	
	/**
	 * function name : login
	 * 
	 * Description : 
	 * Go to login page
	 * 		
	 * Created date ; 25-1-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function login()
	{
		redirect('login');		 
	}
}

?>