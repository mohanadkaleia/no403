<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
	
/**
 * Class name : Setting
 * 
 * Description :
 * This class contain functions for setting page
 * 
 * Created date ; 14-2-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia 
 * contact : ms.kaleia@gmail.com
 */
    
class Setting extends CI_Controller  
{
	public function index()
	{
		$this->manageSetting();
	}
	
	/**
	 * function name : manageSettings
	 * 
	 * Description : 
	 * show settings view
	 * 
	 * Created date ; 29-12-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function manageSetting()
	{
		
		
			
		//set the active tab page
		$data["setting"] = "active";	
					
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('setting');							
		$this->load->view('gen/footer_admin');
	}


}
   
   
   
    
?>