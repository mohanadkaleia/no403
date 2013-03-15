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
	public function ajaxGetUsers($page_number = 1)
	{
		//load user model to get data from it
		$this->load->model('user_model');
		
		//load grid library
		$this->load->library('grid');
		
		//grid option
		$this->grid->option['title'] = "Users";   //  grid title
		$this->grid->option['id'] = "id";         // database table id
		$this->grid->option['sortable'] = FALSE;  // is sortable
		$this->grid->option['page_size'] = 10;    //records per page
		$this->grid->option['row_number'] = true; //show the row number
		$this->grid->option['add_button'] = true; //show add button
		$this->grid->option['add_url'] = base_url()."user/addUser"; //add url
		$this->grid->option['add_title'] = "Add new"; //add title
			
		
		//get the data
		$this->grid->data = $this->user_model->getAll();
		
		//grid controls
		$this->grid->control = array(
									  array("title" => "Edit" , "icon"=>"icon-pencil" , "url"=>base_url()."user/editUser" , "message_type"=>null , "message"=>"") , 
									  array("title" => "Delete" , "icon"=>"icon-trash" ,"url"=>base_url()."user/deleteUser" , "message_type"=>"confirm" , "message"=>"Are you sure?")
									);
		
		//set private attribute
		$this->grid->current_page = $page_number;
		
				
		//render our grid :)
		echo $this->grid->gridRender();				
							
	}
	
	
	/**
	 * function name : addUser
	 * 
	 * Description : 
	 * addUser call view function
	 * 
	 * Created date ; 3-3-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function addUser($status_message=null)
	{
		//set the active tab page
		$data["user"] = "active";	
		
		//status message to be shown if the user has been added
		$data["status_message"] = $status_message;
		
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('user_add');							
		$this->load->view('gen/footer_admin');
	}
	
	/**
	 * function name : editUser
	 * 
	 * Description : 
	 * addUser call view function
	 * 
	 * Created date ; 3-3-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function editUser($user_id , $status_message=null)
	{
		//set the active tab page
		$data["user"] = "active";	
		
		//status message to be shown if the user has been added
		$data["status_message"] = $status_message;
		
		//load user model
		$this->load->model('user_model');
				
		//get user information
		$user_info = $this->user_model->getById($user_id);
		
		//assign user information to data array to be passed for the view
		$data['user_info'] = $user_info;
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('user_edit' , $data);							
		$this->load->view('gen/footer_admin');
	}
	
	
	/**
	 * function name : addUserData
	 * 
	 * Description : 
	 * add user to the database 
	 * 		
	 * Created date ; 4-10-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function addUserData()
	{
		//load user model	
		$this->load->model('user_model');
			
		// assign values to the model variable
		$this->user_model->username = $this->input->post('username');	
		$this->user_model->password =  $this->input->post('password');
		$this->user_model->email = $this->input->post('email');									
		
		if($this->validateUser()==FALSE) //if there is a problem with the data then redirect to the same page
		{													
			$this->addUser();			
		}		
		else // else then add the user to the database
		{													
			// insret the data to the database
			$this->user_model->add();									
			
			//if the use has added succefully then show a message of that
			$status_message = $this->input->post('username') . " has been added succesfully :)"; 
			$this->addUser($status_message);			
		}
	}	
	
	/**
	 * function name : editUserData
	 * 
	 * Description : 
	 * edit user to the database 
	 * 		
	 * Created date ; 4-10-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function editUserData()
	{
		//load user model	
		$this->load->model('user_model');
			
		// assign values to the model variable
		$this->user_model->id = $this->input->post('user_id');
		$this->user_model->username = $this->input->post('username');	
		$this->user_model->password =  $this->input->post('password');
		$this->user_model->email = $this->input->post('email');									
		
		if($this->validateUser($this->input->post('user_id'))==FALSE) //if there is a problem with the data then redirect to the same page
		{													
			$this->editUser($this->input->post('user_id'));			
		}		
		else // else then edit the user to the database
		{													
			// insret the data to the database
			$this->user_model->edit();									
			
			//if the use has added succefully then show a message of that
			$status_message = $this->input->post('username') . " has been modified succesfully :)"; 
			$this->editUser($this->input->post('user_id') , $status_message);		
		}
	}
	
	
	/**
	 * function name : deleteUser
	 * 
	 * Description : 
	 * delete the user 
	 * 		
	 * Created date ; 13-12-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function deleteUser($id)
	{		
		$this->load->model('user_model');
		// assign values to the model variable
		$this->user_model->id = $id;
		
		$this->user_model->delete();
		
		//return back to the main user page
		redirect(base_url() . 'user/manageUser');
	}
	
	
	
	/**
	 * function name : validate_user
	 * 
	 * Description : 
	 * validate new user form 
	 * 
	 * Parameters:
	 * 		id (null by default) this is used with edit user data to specify 
	 * 		there is email address similar to user email address
	 * 		so it will search for all emails except this with given id 
	 * 				
	 * Created date ; 14-10-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function validateUser($id = null)
	{
		// load validation library								
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_chkUser['.$id.']');	
		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');	
		$this->form_validation->set_rules('password_confirm', 'Password confirm', 'required|matches[password]');	
		
		if ($this->form_validation->run() == TRUE)
		{			
			return true;
		}
		else
		{
			return false;
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
	public function  chkUser($email , $id = null)
	{										
		// if there is no record with the same email address then user can add one		
		if($this->user_model->chkUserIsExist($id) == True)
		{
			$this->form_validation->set_message('chkUser' , 'Your email address is already exist !!');
			return FALSE;
		}			
		else 
		{			
			return TRUE;
		}		 						
	}
	
}  
    
    
    
?>