<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
	
/**
 * Class name : Settings
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
    
class Settings extends CI_Controller  
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
		$this->manageCategories();
	}
	
	/**
	 * function name : manageCategories
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
	public function manageCategories()
	{
		
		
			
		//set the active tab page
		$data["settings"] = "active";	
					
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('cat_admin');							
		$this->load->view('gen/footer_admin');
	}
	
	
	/**
	 * function name : addCategory
	 * 
	 * Description : 
	 * show settings view
	 * 
	 * Created date ; 24-5-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function addCategory($status_message=null)
	{			
		//set the active tab page
		$data["settings"] = "active";	
						
		//status message to be shown if the user has been added
		$data["status_message"] = $status_message;			
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('cat_add');							
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
	public function addCategoryData()
	{
			
										
		//load user model	
		$this->load->model('category_model');
			
		// assign values to the model variable
		$this->category_model->name = $this->input->post('cat_name');	
		$this->category_model->code =  $this->input->post('cat_code');
		$this->category_model->type =  $this->input->post('cat_type');
		$this->category_model->url =  $this->input->post('cat_url');
		$this->category_model->description = $this->input->post('cat_desc');				
		
		
		
		if($this->validateCat()==FALSE) //if there is a problem with the data then redirect to the same page
		{													
			$this->addCategory();			
		}		
		else // else then add the user to the database
		{													
			// insret the data to the database
			$this->category_model->add();									
			
			//if the use has added succefully then show a message of that
			$status_message = $this->input->post('cat_name') . " has been added succesfully :)"; 
			$this->addCategory($status_message);			
		}		
	}	
	
	
	/**
	 * function name : validateCat
	 * 
	 * Description : 
	 * validate new caategory form 
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
	public function validateCat($id = null)
	{
		// load validation library								
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cat_name', 'Category name', 'required|callback_chkCat['.$id.']');
		$this->form_validation->set_rules('cat_type', 'Category type', 'required');	
			
		
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
	 * function name : chkCat
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
	public function  chkCat($cat_name , $id = null)
	{										
		// if there is no record with the same email address then user can add one		
		if($this->category_model->chkCatIsExist($id) == True)
		{
			$this->form_validation->set_message('chkCat' , 'The category you want to add is already exist !!');
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
	
	
	/**
	 * function name : manageAttributes
	 * 
	 * Description : 
	 * show attribute view
	 * 
	 * Created date ; 7-6-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function manageAttributes()
	{
		
		
			
		//set the active tab page
		$data["settings"] = "active";	
					
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('attr_admin');							
		$this->load->view('gen/footer_admin');
	}
	
	
	/**
	 * function name : addAttribute
	 * 
	 * Description : 
	 * show settings view
	 * 
	 * Created date ; 24-5-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function addAttribute($status_message=null)
	{			
		//set the active tab page
		$data["settings"] = "active";	
						
		//status message to be shown if the user has been added
		$data["status_message"] = $status_message;			
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('attr_add');							
		$this->load->view('gen/footer_admin');
	}
	

	/**
	 * function name : addAttributeData
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
	public function addAttributeData()
	{
			
										
		//load user model	
		$this->load->model('attribute_model');
			
		// assign values to the model variable
		$this->attribute_model->name = $this->input->post('attr_name');	
		$this->attribute_model->value =  $this->input->post('attr_val');
		$this->attribute_model->description =  $this->input->post('attr_desc');					
		
		
		
		if($this->validateAttr()==FALSE) //if there is a problem with the data then redirect to the same page
		{													
			$this->addAttribute();			
		}		
		else // else then add the user to the database
		{													
			// insret the data to the database
			$this->attribute_model->add();									
			
			//if the use has added succefully then show a message of that
			$status_message = $this->input->post('attr_name') . " has been added succesfully :)"; 
			$this->addAttribute($status_message);			
		}		
	}	
	
	
	
	/**
	 * function name : validateAttr
	 * 
	 * Description : 
	 * validate new caategory form 
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
	public function validateAttr($id = null)
	{
		// load validation library								
		$this->load->library('form_validation');
		$this->form_validation->set_rules('attr_name', 'Attribute name', 'required|callback_chkAttr['.$id.']');		
			
		
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
	 * function name : chkAttr
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
	public function chkAttr($attr_name , $id = null)
	{										
		// if there is no record with the same email address then user can add one		
		if($this->attribute_model->chkAttrIsExist($id) == True)
		{
			$this->form_validation->set_message('chkAttr' , 'The attribute you want to add is already exist !!');
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
	public function ajaxGetAttr()
	{										
		//load user model to get data from it
		$this->load->model('attribute_model');
		
		//load grid library
		$this->load->library('grid');				
		
		//grid option
		$this->grid->option['title'] = "Attribute";   //  grid title
		$this->grid->option['id'] = "id";         // database table id
		$this->grid->option['sortable'] = FALSE;  // is sortable
		$this->grid->option['page_size'] = 5;    //records per page
		$this->grid->option['row_number'] = true; //show the row number		
		$this->grid->option['add_button'] = true; //show add button
		$this->grid->option['add_url'] = base_url()."settings/addAttribute"; //add url
		$this->grid->option['add_title'] = "Add new"; //add title
			
		$this->grid->columns = array('id' , 'name' , 'value' , 'description' , 'created_date');
		
		//get the data	
		$this->grid->data = $this->attribute_model->getAll();
		
		//grid controls
		$this->grid->control = array(
									  array("title" => "Edit" , "icon"=>"icon-pencil" , "url"=>base_url()."settings/editAttribute" , "message_type"=>null , "message"=>"") , 
									  array("title" => "Delete" , "icon"=>"icon-trash" ,"url"=>base_url()."settings/deleteAttribute" , "message_type"=>"confirm" , "message"=>"Are you sure?")
									);												
						
		//render our grid :)
		echo $this->grid->gridRender();											
	}
	
	
	/**
	 * function name : editAttribute
	 * 
	 * Description : 
	 * edit attribute call view 
	 * 
	 * Created date ; 8-6-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function editAttribute($attr_id , $status_message=null)
	{
		//set the active tab page
		$data["settings"] = "active";	
		
		//status message to be shown if the user has been added
		$data["status_message"] = $status_message;
		
		//load user model
		$this->load->model('attribute_model');
				
		//get user information
		$attr_info = $this->attribute_model->getById($attr_id);
		
		//assign user information to data array to be passed for the view
		$data['attr_info'] = $attr_info;
		
		//include header - nav - footer
		$this->load->view('gen/header_admin');
		$this->load->view('gen/nav_admin' , $data);
		$this->load->view('attr_edit' , $data);							
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
	public function editAttributeData()
	{
		//load user model	
		$this->load->model('attribute_model');
			
		// assign values to the model variable
		$this->attribute_model->id = $this->input->post('attr_id');			
		$this->attribute_model->name = $this->input->post('attr_name');	
		$this->attribute_model->value =  $this->input->post('attr_val');
		$this->attribute_model->description =  $this->input->post('attr_desc');
									
		
		if($this->validateAttr($this->input->post('attr_id'))==FALSE) //if there is a problem with the data then redirect to the same page
		{													
			$this->editAttribute($this->input->post('attr_id'));			
		}		
		else // else then edit the user to the database
		{													
			// insret the data to the database
			$this->attribute_model->edit();									
			
			//if the use has added succefully then show a message of that
			$status_message = $this->input->post('attr_name') . " has been modified succesfully :)"; 
			$this->editAttribute($this->input->post('attr_id') , $status_message);		
		}
	}



	/**
	 * function name : deleteAttr
	 * 
	 * Description : 
	 * delete the attribute
	 * 
	 * parameters:
	 * 	id : attribute id to be delete 
	 * 		
	 * Created date ; 8-6-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	public function deleteAttribute($id)
	{		
		$this->load->model('attribute_model');
		// assign values to the model variable
		$this->attribute_model->id = $id;
		
		$this->attribute_model->delete();
		
		//return back to the main user page
		redirect(base_url() . 'settings/manageAttributes');
	}	


}
   
   
   
    
?>