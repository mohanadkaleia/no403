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
						"total_size"=>0,
						"offset" => 0);
	var $columns = array(); //columns array 
	var $data = array();//data to displayed in the grid in total	
	var $control = array();//control button array {edit, delete, ...}
	
	//private attribute	
	var $limited_data = array(); //the data after limit its size to match page_size 	
	 
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
	 * offset :this variable is used to determin data array index to be shown 
	 * for example if the offset is 10 then the first data record will be shown from index 10
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
		//get page number from post array
		if(isset($_POST["page_number"]))
		{
			$this->option["current_page"] = $_POST["page_number"];	
		}
												
		
		//seach the data
		if(isset($_POST["search"]) && $_POST["search"]!="" && $_POST["search"]!="null")
		{
			$keyword = $_POST["search"];
			$this->gridSearch($keyword);
		}
		
		
					
		//sort the data
		if(isset($_POST["sort_column"]) && $_POST["sort_column"]!="" && $_POST["sort_column"]!="null")
		{
			//get sorting column and dir	
			$sort_column = $_POST["sort_column"];
			$sort_dir = $_POST["sort_dir"];
			
			//sort the data array
			$this->gridSort($sort_column , $sort_dir);	
		}
		
		
		
		//match limit size
		//set the total size of the data
		$this->option['total_size'] = count($this->data);
		
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
			
    	$this->limited_data =  array_slice($this->data, $this->option['offset'], $this->option['page_size']);
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
    	    	
    	$this->option["offset"] = ($this->option["current_page"] - 1)*$this->option['page_size'];    	
    	//$this->offset = ($this->option["current_page"] - 1)*$this->option['page_size'];					
	}
	
	
	
	/**
	 * function name : gridSort
	 * 
	 * Description : 
	 * sorting data array depending on column and dir
	 * 
	 * Created date ; 15-3-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
    public function gridSort($sort_column , $sort_dir)
    {    	    	    
		//sorting the data array depending on the 
		$this->data = $this->msort($this->data, $sort_column, $sort_dir);
	}
	
	
	
	
	/**
	 * function name :msort
	 * 
	 * Description : 
	 * sort 2d array by columns
	 * parms:
	 * 		$array : the array to be sorted
	 * 		$sort_columns : array of columns that the array will sort by
	 * 		$dir : array of direction
	 * example: 
	 * 
	 * 		$data[] = array('volume' => 67, 'edition' => 2);
			$data[] = array('volume' => 86, 'edition' => 1);
			$data[] = array('volume' => 85, 'edition' => 6);
			$data[] = array('volume' => 98, 'edition' => 2);
			$data[] = array('volume' => 86, 'edition' => 6);
			$data[] = array('volume' => 67, 'edition' => 7);	
			$data = msort($data, 'volume' , 'DESC');
	 * Created date ; 3-5-2013
	 * Modification date : 
	 * Modfication reason : 
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	function msort($array, $sort_columns , $direction) 
	{
		$command_line = 'array_multisort(';
		$to_sort_array = array();
		$counter = 0;
		
		
		//conver the input parameters from string to arrays
		$column[] = $sort_columns;
		$dir[] = $direction;
		
						
		
		foreach ($column as $column_key => $column_value)		
		{
			// Obtain a list of columns
			foreach ($array as $key => $row) 			
			{
			    $to_sort_array[$counter][$key]  = $row[$column_value];			 
			}			
			
			
			$command_line .= '$to_sort_array['.$counter.'] , ';
			
			if($dir[$column_key] == 'asc')
				$command_line.='SORT_ASC , ';
			else if($dir[$column_key] == 'desc')
			{
				$command_line.='SORT_DESC ,';
			} 
			else
			{
				return $array;
			}
			
			$counter++;						
		}	
		
		$command_line.='$array);';
		
		eval($command_line);
		
		return $array;	 
	}
	
	
	/**
	 * function name : gridSearch
	 * 
	 * Description : 
	 * search the data array with matched keyword
	 * 
	 * Created date ; 14-5-2013
	 * Modification date : ---
	 * Modfication reason : ---
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
    public function gridSearch($keyword)
    {
		//data array of matched rows wit keyword	
		$data_found = array(); 	
			
		foreach ($this->columns as $column_name) 
		{
			$data_found = $data_found +  $this->search_like($this->data, $column_name, $keyword);
		}	
				
		//return the matched data					
		$this->data = $data_found;
	}


	
	
	
	
	/**
	 * function name :search_like
	 * 
	 * Description : 
	 * search an array by key and value , return like value rows
	 * parms:
	 * 		
	 * example:
	 * ----------------------------------------------
	 * $arr = array(0 => array('id'=>1,'name'=>"cat 1"),
             		1 => array('id'=>2,'name'=>"cat 2"),
             		2 => array('id'=>3,'name'=>"cat 1"));
	   print_r(search_like($arr, 'name', 'cat 1'));
	 * -----------------------------------------------		
	 * Created date ; 8-11-2012
	 * Modification date : 
	 * Modfication reason : 
	 * Author : Mohanad Shab Kaleia
	 * contact : ms.kaleia@gmail.com
	 */
	function search_like($array, $column, $keyword)
	{
	    $results = array();
		
		foreach ($array as $row) 
		{
			if(stripos($row[$column], $keyword) !== false)
				$results[] = $row;	
		}				
	    return $results;
	}
			
}


	

/* End of file Someclass.php */