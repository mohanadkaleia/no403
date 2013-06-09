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
class Contact extends CI_Controller {

	
	public function index()
	{
		//set the active tab page
		$data["contact"] = "active";	
					
		
		//include header - nav - footer
		$this->load->view('gen/header');
		$this->load->view('gen/nav' , $data);
		$this->load->view('contact');							
		$this->load->view('gen/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */