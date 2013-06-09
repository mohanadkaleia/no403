<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class name : Home
 * 
 * Description :
 * This class contain functions for Home page
 * 
 * Created date ; 10-1-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia 
 * contact : ms.kaleia@gmail.com
 */
class Request extends CI_Controller {

	//for show request view for visitors
	public function index()
	{
		$this->requestProgram();
	}
	
	
	/**
	 * function name : requestProgram
	 * 
	 * Description : 
	 * call request view
	 * 
	 * Created date ; 14-2-2013
	 * Modification date : ----
	 * Modfication reason : 
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function requestProgram()
	{
		//set the active tab page
		$data["request"] = "active";	
					
		
		//include header - nav - footer
		$this->load->view('gen/header');
		$this->load->view('gen/nav' , $data);
		$this->load->view('request');							
		$this->load->view('gen/footer');
	}
	
	
	
	
	/**
	 * function name : manageRequests
	 * 
	 * Description : 
	 * show wainting request
	 * 
	 * Created date ; 14-2-2013
	 * Modification date : ----
	 * Modfication reason : 
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function manageRequests()
	{
		//set the active tab page
		$data["request"] = "active";	
					
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('request_admin');							
		$this->load->view('gen/footer_admin');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */