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
class Apps extends CI_Controller {

	
	public function index()
	{
		//set the active tab page
		$data["apps"] = "active";	
					
		
		//include header - nav - footer
		$this->load->view('gen/header');
		$this->load->view('gen/nav' , $data);
		$this->load->view('apps');							
		$this->load->view('gen/footer');
	}
	
	
	/**
	 * function name : showRequests
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
	public function managePrograms()
	{
		//set the active tab page
		$data["program"] = "active";	
					
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('program_admin');							
		$this->load->view('gen/footer_admin');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */