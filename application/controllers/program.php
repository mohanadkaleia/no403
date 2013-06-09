<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class name : Program
 * 
 * Description :
 * This class contain functions for Program
 * 
 * Created date ; 10-1-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia 
 * contact : ms.kaleia@gmail.com
 */
class Program extends CI_Controller {

	
	public function index()
	{
		//set the active tab page
		$data["program"] = "active";	
					
		
		//include header - nav - footer
		$this->load->view('gen/header');
		$this->load->view('gen/nav' , $data);
		$this->load->view('apps');							
		$this->load->view('gen/footer');
	}
	
	
	/**
	 * function name : managePrograms
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
	
	
	/**
	 * function name : addProgram
	 * 
	 * Description : 
	 * show program add view
	 * 
	 * Created date ; 9-6-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function addProgram($status_message=null)
	{			
		//set the active tab page
		$data["programs"] = "active";	
						
		//status message to be shown if the user has been added
		$data["status_message"] = $status_message;			
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('program_add');							
		$this->load->view('gen/footer_admin');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */