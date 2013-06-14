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
	public function addProgram($status_message=null , $status = null)
	{			
		//set the active tab page
		$data["programs"] = "active";	
			
		//get category information
		$this->load->model('category_model');	
		$cat_all = $this->category_model->getAll();
		$cat_types = $this->category_model->getTypes();
		$data["cat_types"] = $cat_types;
		$data["cat_all"] = $cat_all;
						
		//status message to be shown if the user has been added
		$data["status_message"] = $status_message;			
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('program_add');							
		$this->load->view('gen/footer_admin');
	}
	
	
	/**
	 * function name : addCategoryData
	 * 
	 * Description : 
	 * add category to the database 
	 * 		
	 * Created date ; 27-5-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function addProgramData()
	{
			
										
		//load user model	
		$this->load->model('program_model');
			
		// assign values to the model variable
		$this->program_model->name = $this->input->post('prog_name');	
		$this->program_model->version =  $this->input->post('prog_version');
		$this->program_model->physical_name =  $this->input->post('prog_pname');
		$this->program_model->picture =  $_FILES["prog_picture"]["name"];
		$this->program_model->download_url = $this->input->post('prog_url');				
		$this->program_model->website = $this->input->post('prog_website');
		$this->program_model->produced_by = $this->input->post('prog_produced');
		$this->program_model->cat_id = $this->input->post('prog_cat');
		$this->program_model->description = $this->input->post('prog_desc');	
		
		
		
		
		//upload the file
		$this->uploadFile('prog_picture' , "files/picture/");				
		
		//Copy file from remote server or URL
		$download_url = $this->input->post('prog_url');
		$dest_location = './files/program/';
		$dest_file_name = $this->input->post('prog_pname');
		$this->copyRemoteFile($download_url , $dest_location , $dest_file_name);
		
		
		
		if($this->validateProg()==FALSE) //if there is a problem with the data then redirect to the same page
		{													
			$this->addProgram();			
		}		
		else // else then add the user to the database
		{													
			// insret the data to the database
			$this->program_model->add();
			
			//if the use has added succefully then show a message of that
			$status_message = $this->input->post('prog_name') . " has been added succesfully :)"; 
			$this->addProgram($status_message);
		}		
		
	}	
	
	
	
	/**
	 * function name : uploadFile
	 * 
	 * Description : 
	 * upload file to spesific location
	 * 		
	 * Created date ; 13-6-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function uploadFile($file_input_name , $where_to_put_the_file)
	{
		//upload the file
		if ($_FILES[$file_input_name]["error"] > 0)
		{
			//echo "Error: " . $_FILES["prog_picture"]["error"] . "<br>";			
		}
		else
		{
			move_uploaded_file($_FILES[$file_input_name]["tmp_name"],$where_to_put_the_file . $_FILES[$file_input_name]["name"]);
		}
	}
	
	/**
	 * function name : copyRemoteFile
	 * 
	 * Description : 
	 * copy file from spesific url and put it in a directory
	 * 		
	 * Created date ; 13-6-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function copyRemoteFile($source_url , $destination_location , $destination_file_name)
	{
		set_time_limit(0); //Unlimited max execution time	
			
		//Copy file from remote server or URL
		$download_url = $source_url;
		$file_location =$destination_location.$destination_file_name;
		
		if ( copy($download_url, $file_location) ) 
		{
		    //echo "Copy success!";
		    return true;
		}
		else
		{		    
			//$status_message = "error in copy the file!! :(";						
			return false;
		}
	}
	
	
	/**
	 * function name : validateCat
	 * 
	 * Description : 
	 * validate new program form 
	 * 
	 * Parameters:
	 * 		id (null by default) this is used with edit user data to specify 
	 * 		there is email address similar to user email address
	 * 		so it will search for all emails except this with given id 
	 * 				
	 * Created date ; 27-5-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function validateProg($id = null)
	{
		// load validation library								
		$this->load->library('form_validation');
		$this->form_validation->set_rules('prog_name', 'Program name', 'required|callback_chkProg['.$id.']');
		$this->form_validation->set_rules('prog_version', 'Program version', 'required');	
		$this->form_validation->set_rules('prog_pname', 'Program physical name', 'required');
		$this->form_validation->set_rules('prog_url', 'Program download URL', 'required');
				
		
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
	 * function name : chkProg
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
	public function  chkProg($prog_name , $id = null)
	{										
		// if there is no record with the same email address then user can add one		
		if($this->program_model->chkProgIsExist($id) == True)
		{
			$this->form_validation->set_message('chkProg' , 'The program you want to add is already exist!!');
			return FALSE;
		}			
		else 
		{			
			return TRUE;
		}		 						
	}



	/**
	 * function name : ajaxGetCat
	 * 
	 * Description : 
	 * get categories information from database
	 * 
	 * Created date ; 4-6-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function ajaxGetCat()
	{										
		//load user model to get data from it
		$this->load->model('category_model');
		
		//load grid library
		$this->load->library('grid');				
		
		//grid option
		$this->grid->option['title'] = "Category";   //  grid title
		$this->grid->option['id'] = "id";         // database table id
		$this->grid->option['sortable'] = FALSE;  // is sortable
		$this->grid->option['page_size'] = 10;    //records per page
		$this->grid->option['row_number'] = true; //show the row number		
		$this->grid->option['add_button'] = true; //show add button
		$this->grid->option['add_url'] = base_url()."settings/addCategory"; //add url
		$this->grid->option['add_title'] = "Add new"; //add title
			
		$this->grid->columns = array('id' , 'name' , 'code' , 'type' , 'url' , 'description' , 'created_date');
		
		//get the data	
		$this->grid->data = $this->category_model->getAll();
		
		//grid controls
		$this->grid->control = array(
									  array("title" => "Edit" , "icon"=>"icon-pencil" , "url"=>base_url()."settings/editCategory" , "message_type"=>null , "message"=>"") , 
									  array("title" => "Delete" , "icon"=>"icon-trash" ,"url"=>base_url()."settings/deleteCategory" , "message_type"=>"confirm" , "message"=>"Are you sure?")
									);												
						
		//render our grid :)
		echo $this->grid->gridRender();											
	}



	/**
	 * function name : editCategory
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
	public function editCategory($cat_id , $status_message=null)
	{
		//set the active tab page
		$data["settings"] = "active";	
		
		//status message to be shown if the user has been added
		$data["status_message"] = $status_message;
		
		//load user model
		$this->load->model('category_model');
				
		//get user information
		$cat_info = $this->category_model->getById($cat_id);
		
		//assign user information to data array to be passed for the view
		$data['cat_info'] = $cat_info;
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('cat_edit' , $data);							
		$this->load->view('gen/footer_admin');
	}
	
	/**
	 * function name : editCategoryData
	 * 
	 * Description : 
	 * edit category to the database 
	 * 		
	 * Created date ; 4-10-2012
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function editCategoryData()
	{
		//load user model	
		$this->load->model('category_model');
			
		// assign values to the model variable
		$this->category_model->id = $this->input->post('cat_id');			
		$this->category_model->name = $this->input->post('cat_name');	
		$this->category_model->code =  $this->input->post('cat_code');
		$this->category_model->type =  $this->input->post('cat_type');
		$this->category_model->url =  $this->input->post('cat_url');
		$this->category_model->description = $this->input->post('cat_desc');									
		
		if($this->validateCat($this->input->post('cat_id'))==FALSE) //if there is a problem with the data then redirect to the same page
		{													
			$this->editCategory($this->input->post('cat_id'));			
		}		
		else // else then edit the user to the database
		{													
			// insret the data to the database
			$this->category_model->edit();									
			
			//if the use has added succefully then show a message of that
			$status_message = $this->input->post('cat_name') . " has been modified succesfully :)"; 
			$this->editCategory($this->input->post('cat_id') , $status_message);		
		}
	}	
	
	
	/**
	 * function name : deleteCat
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
	public function deleteCategory($id)
	{		
		$this->load->model('category_model');
		// assign values to the model variable
		$this->category_model->id = $id;
		
		$this->category_model->delete();
		
		//return back to the main user page
		redirect(base_url() . 'settings/manageCategories');
	}
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */