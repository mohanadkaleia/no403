<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
	
/**
 * Class name : login
 * 
 * Description :
 * This class contain functions that refer to pages like go to page -- and pass data to it.
 * 
 * Created date ; 14-12-2012
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
class Login extends CI_Controller
{
	
	public function index()
	{
		//load library	
		$this->load->library('form_validation');
											
		// call header		
		$this->load->view('gen/header_admin');
				
		// call login view
		$this->load->view('login');
		
		//call footer
		//$this->load->view('gen/footer');
	}
	
	
	
	/**
	 * function name : validateLogin
	 * 
	 * Description : 
	 * validate login
	 * 		
	 * Created date ; 20-12-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function validateLogin()
	{
		
		// load validation library								
		$this->load->library('form_validation');		
		
		//check validation
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_chkUser');	
		$this->form_validation->set_rules('password', 'password', 'required|md5');				
		
		//load login model
		$this->load->model('login_model');
		
		if ($this->form_validation->run() == TRUE)
		{
				
			$email = 	$this->input->post('email');
			$user_info = $this->login_model->getUserInfo(null , null , $email );
			$username = $user_info[0]['username'];
			//set session info
			$data = array(
				'username' => $username,
				'email' => $email ,
				'is_logged_in' => 1				
			);
			$this->session->set_userdata($data);
				
			//redirect to dashboard page
			redirect('adminpanel/dashboard');		
			return true;
		}
		else
		{
			//redirect to login page again
			$this->loginUser();						
		}				
	}	
	
	
	/**
	 * function name : chkUser
	 * 
	 * Description : 
	 * Check the user is in the database or not  
	 * if there is a record of the same email address then return false	,  
	 * if an id is entered then check all record but not the record with the given id
	 * 		
	 * Created date ; 14-10-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function  chkUser($email)
	{
		$this->load->model('login_model');											
		// if there is no record with the same email address then user can add one		
		if($this->login_model->canLogin() == True)
		{			
			return True;
		}			
		else 
		{
			$this->form_validation->set_message('chkUser' , 'email address and/or password is wrong :(');			
			return FALSE;
		}		 						
	}
	
	/**
	 * function name : logout
	 * 
	 * Description : 
	 * logout and return back to the login page
	 * 		
	 * Created date ; 22-12-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function  logout()
	{				
		//destroy the session	
		$this->session->sess_destroy();
		
		//redirect to login page
		$this->loginUser();
	}	
}
	
	
?>