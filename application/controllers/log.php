<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
	
/**
 * Class name : Log
 * 
 * Description :
 * This class contain functions for Log page
 * 
 * Created date ; 14-2-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia 
 * contact : ms.kaleia@gmail.com
 */
    
class Log extends CI_Controller  
{
	public function index()
	{
		$this->showLog();
	}
	
	/**
	 * function name : showLog
	 * 
	 * Description : 
	 * show log view
	 * 
	 * Created date ; 14-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function showLog()
	{
			
		//set the active tab page
		$data["log"] = "active";	
					
		$this->load->model('User');
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('log');							
		$this->load->view('gen/footer_admin');
	}


}
   
   
   
    
?>