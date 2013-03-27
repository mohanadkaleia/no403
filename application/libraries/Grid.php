<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


/**
 * Class name : Grid
 * 
 * Description :
 * Grid library
 * 
 * Created date ; 28-2-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia 
 * contact : ms.kaleia@gmail.com
 */
 
class Grid 
{		
	//attribute
	var $option = array(
						"title"=>"" , 
						"id"=>"id" , 
						"sortable"=>true , 
						"search"=>true , 
						"page_size"=>10 , 
						"current_page" => 1 ,
						"row_number"=>true,
						"add_button" => true , 
						"add_title" => "Add new",
						"add_url" => "" , 
						"total_size"=>0);
	var $data = array();//data to displayed in the grid in total
	var $control = array();//control button array {edit, delete, ...}
	
	//private attribute
	var $offset = 0; //this variable is used to determin data array index to be shown
	var $limited_data = array(); //the data after limit its size to match page_size 
	var $current_page = 1;
	 
	/*
	 * option array 
	 * title : the title of the grid
	 * id    : table id (this field id relate to control function like edit or delete to be passed with the url)
	 * sortable : sortable (true by default)
	 * search : search the records (true by default)
	 * page_size : default page size is 10 row per page
	 * current_page : current page to be shown
	 * row_number : if true then show row number
	 * add_button : show add button below the grid to enable add records
	 * add_url : the url to add record page
	 * tatoal_size : this is a private variable so you don't have to change it 
	 * it is equal to data.length where the data is the total data
	 * 
	 * 
	 * control array example
	 * array(
			  array("title" => "Edit" , "icon"=>"icon-pencil" , "url"=>base_url()."user/editUser" , "message_type"=>null , "message"=>"") , 
			  array("title" => "Delete" , "icon"=>"icon-trash" ,"url"=>base_url()."user/deleteUser" , "message_type"=>"confirm" , "message"=>"Are you sure?")
			);
	 * each element of controll array is a function to with the grid, each element contain these fields
	 * title : the label that will appear in the grid
	 * icon  : the icon that will display like "icon-pencil" it can be chosen from bootstrap icons
	 * url	 : the url function
	 * message_type : javascript alert type (confirm , prompt)
	 * message : the message text 
	 */ 
	
	
	/**
	 * function name : gridRender
	 * 
	 * Description : 
	 * render the data and send the result
	 * 
	 * Created date ; 28-2-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
    public function gridRender()
    {
		//set the total size of the data
		$this->option['total_size'] = count($this->data);
		
			
		//sort the data
		
		
		
		
		//match limit size
    	$this->gridLimitData();
    	
    	
    	
		//return the array objects as encoded json to send it to JavasScipt
		$json_array = array(
							"data" => $this->limited_data , 
							"control"=>$this->control , 
							"option"=>$this->option 
							);							
    	return json_encode($json_array);
    }
	
	
	/**
	 * function name : gridLimitData
	 * 
	 * Description : 
	 * limit the data array to match page_count option
	 * 
	 * Created date ; 15-3-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
    public function gridLimitData()
    {
    	//calculate the offset that will be used in array slice to get limited data
    	$this->gridOffset()	;
			
    	$this->limited_data =  array_slice($this->data, $this->offset, $this->option['page_size']);
	}
	
	
	/**
	 * function name : gridOffset
	 * 
	 * Description : 
	 * calculate the offset that will be used in array slice to get limited data
	 * 
	 * Created date ; 15-3-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
    public function gridOffset()
    {
    	//the offset is equal to cuurent page - 1 multiple with page size
    	/**example
    	 *if page size to be shown is 2 and and current page is the first page then
		 * the offset is (1-1)*2 = 0
		 * if cuurent_page = 2
		 * offset (2-1)*2 = 2
    	*/
    	    	
    	$this->offset = ($this->current_page - 1)*$this->option['page_size'];					
	}
	
}





/* End of file Someclass.php */