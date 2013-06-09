<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
	
/**
 * Class name : Menu
 * 
 * Description :
 * This class contain functions that refer to pages like go to page -- and pass data to it.
 * 
 * Created date ; 2-10-2012
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
class Dashboard extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		if($this->session->userdata('is_logged_in')!=1)
			redirect(base_url().'login');					
	}
	
	
	
	public function index()
	{
		$this->showDashboard();
	}
	
	
	
	/**
	 * function name : showDashboard
	 * 
	 * Description : 
	 * call dashboard view
	 * 
	 * Created date ; 2-10-2012
	 * Modification date : 28-12-2012
	 * Modfication reason : Change function name from dashboard to showDashboard
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function showDashboard()
	{
			
		//if the user have no permission
		/*
		if($this->session->userdata('is_logged_in')!=1)
		{
			$this->load->view('gen/403.php');
			return FALSE;
		}		
		*/	
		// here we will pass in data object the active menu	
		$data["dashboard"] = "active";	
				
		// call header
		$this->load->view('gen/header_admin');
		
		//call navigation and activate the dashboard menu
		$this->load->view('gen/nav_admin' , $data);

		//view dashboard body
		$this->load->view('dashboard');

		//$this->load->view('dashboards/dashboard');
		$this->load->view('gen/footer_admin');		
	}	
	

			
}
	
	
?>