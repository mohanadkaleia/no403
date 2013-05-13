// grid.js
//required jquery.js


/**
 * function name : gridRender
 * 
 * Description : 
 * read the data and then build the grid table
 * 
 * parameter:
 * grid_id : grid table id
 * Created date ; 28-2-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
function gridRender(grid_id)
{				
	//get the data, option and control from ajax page with the url from action attribute in our grid table
	var action = $("#"+grid_id).attr("action");
					
	//get the hash from the url
	var grid_option = gridHashReader(grid_id);	
	
	//set option values that we will pass to ajaxGridRender
	var option = new Array();	
	//if there is no hash option is passed then use the default	
	if(grid_option == null)
	{
		//page number by default is 1
		//page_number = 1;
		option['page_number'] = 1;
		//search keyword
		option['search'] = "";			
		
		//sort
	}
	else
	{				
		//set page number
		option['page_number'] = grid_option[0];
		
		//set search criteria
		option['search'] = grid_option[1];			
		
		//sort column
		option['sort_column'] = grid_option[2];
				
		//sort dir
		option['sort_dir']  = grid_option[3];	
	}						
		
	//get the data using ajax function
	gridAjaxRender(grid_id , action , option);					  				
} 



/**
 * function name : gridRenderWithOption
 * 
 * Description : 
 * read the data and then build the grid table
 * 
 * parameter:
 * grid_id : grid table id
 * option : array of options {page number , search , sort} the option is passed from javascript 
 * and it is different from options that passes from php file
 * Created date ; 28-2-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
function gridRenderWithOption(grid_id , option)
{	
	//get the data, option and control from ajax page with the url from action attribute in our grid table
	var action = $("#"+grid_id).attr("action");
				
	//page number	
	var page_number = option['page_number'];
	
	//search criteia
	var search_keyword = option['search'];
	
	//sorting
	var sort_column = option['sort_column'];
	var sort_type = option['sort_dir']; //it will be {desc, acs or none}	

		
	//get the data using ajax function
	gridAjaxRender(grid_id , action , option);					  				
} 




/**
 * 
 * function name : gridAjaxRender
 * 
 * Description : 
 * execute ajax function with a given ajax url
 * 
 * parameter:
 * grid_id : the grid which we want to render
 * ajax_url : the url where the php ajax functions is stored
 * option : array of the option {page_number , search , sort}
 * Created date ; 28-2-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
function gridAjaxRender(grid_id , ajax_url , option)
{				
	$.ajax({
			  type: "POST",
			  url: ajax_url,			   
			  cache: false,
			  data:{			  	
		  		page_number:option['page_number'] ,
		  		sort_column:option['sort_column'] , 		  		
		  		sort_dir:option['sort_dir']
		  		},
		  		
		  		data: { name: "John", location: "Boston" },
			  success: function(json)
						{
			  		    try
			  		    {				  		    				  		    	
			  		    			  		    				  		   
			  		 		var obj = jQuery.parseJSON(json);
			  		 		
			  		 		//Read grid parameters
			  		 		
			  		 		//data oject	
			  		 		var data_obj = obj["data"];
			  		 		
			  		 		//control object
			  		 		var control_obj = obj["control"];	
			  		 		
			  		 		//Option
			  		 		var option_obj = obj["option"];			  		 					  		 					  		 				  		 				  		 					  		 
							
							//add sorting funcion to column
							gridAddSorting(grid_id);
							
							//add sorting direction symbol to the column
							if(option['sort_column']!=null)
								gridAddSortDir(grid_id , option['sort_column'] , option['sort_dir']);
							
							//add function titles to thead
							gridAddControlTitle(grid_id , control_obj);
							
							//add data and functions to the table			  		 					  		 					  		 					  							  			
			  				gridAddRow(grid_id , data_obj , control_obj , option_obj);
			  				
			  				//add pagination - search - add button - range of show
			  				gridAddControlBar(grid_id , option_obj , data_obj);			  			
			  				
			  			}
			  			catch(e) {
			  				alert('Exception while request..');
			  			}
			  	},
			  	error: function(){
			  		alert('Error while request..');
			  	}
			  });
}

/**
 * function name : gridAddRow
 * 
 * Description : 
 * Add data row to the table , in this function we will add data and functions(add - edit)
 * 
 * Parameters :
 * Json data array
 * Created date ; 28-2-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
function gridAddRow(grid_id , data , control , option)
{
		
		//remove all row from the last page to append new ones
		var $grid = $("#"+grid_id).find("tr.grid-row").remove();
		
		//get the number of rows from data 
		var numberOfRows = Object.keys(data).length;
		
		//get first row (the row that contain database column name by "col" attribute)
		var $thead =  $('#'+grid_id).find("tr:first");
								
		//get the number of td inside tr
		var numberOfTd = $thead.children('td').length;
		
		//if the row number option is set to true then add th in the first
		if(option['row_number'])
			$thead.find("th:first").before("<th class='grid-th' col='row_num'>#</th>");
				
		//add row and data cell
		for(i=0;i<numberOfRows;i++)
		{											
			//add new row to the table
			$('#'+grid_id).append('<tr class="grid-row"></tr>');					
			
			//adding td
			$thead.find("th").each(function(){
				//get columm name
				var col_name = $(this).attr("col");				
				//alert($(this).attr("col"));
				
				//print row number if the row num option is true
				if(col_name=="row_num")
					$('#'+grid_id).find("tr:last").append("<td class='middle'>"+(i+1)+"</td>")
				//if this th is data cell then add data to the cell , if it is control then don't'
				else if(col_name != null)
				{
					$('#'+grid_id).find("tr:last").append("<td>"+data[i][col_name]+"</td>")	
				}
				
				
				 
			});
			
			//add control to the row								
			gridAddControlRow(grid_id , control , data , option , i);			
		}
}



/**
 * function name : gridAddControlTitle
 * 
 * Description : 
 * Add functions title to the "thead" of grid table
 * 
 * Parameters :
 * Json data array
 * Created date ; 2-3-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
function gridAddControlTitle(grid_id , control)
{
	
	//remove all th that added by grid to ot duplicate it when loading new data
	var $grid = $("#"+grid_id).find("th.grid-th").remove();
	
	//number of contorls 
	var numberOfControls = Object.keys(control).length;		
	
	//label field name
	var title_counter ;
			
	for(title_counter = 0; title_counter < numberOfControls;title_counter++)
	{
		$('#'+grid_id).find("tr:first").append("<th class='grid-th'>"+ control[title_counter]['title']  +"</th>")
	}		
}


/**
 * function name : gridAddSorting
 * 
 * Description : 
 * Add sorting function to the column onclick
 * 
 * Parameters :
 * Json data array
 * Created date ; 30-4-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
function gridAddSorting(grid_id)
{
	
	//remove all th that added by grid to ot duplicate it when loading new data
	var $grid = $("#"+grid_id).find("tr:first th");
	
	$grid.each(function(){
		//get column name
		col_name = $(this).attr('col');				
				
		//if there is sorting before then don't set a sort function
		if($(this).attr('onclick')==null)		
		{
			//assign sort onclick function
			$(this).attr('onclick', 'gridSortColumn("'+grid_id+'", "'+col_name+'" , "asc")'); //the default sort dir is asc						
		}									
	});
}



/**
 * function name : gridAddControlRow
 * 
 * Description : 
 * Add controls to the tr of grid table for example add delete button
 * 
 * Parameters :
 * grid_id : grid id in the html
 * control : control function array (delete , edit)
 * data : data array
 * row_id : pointer to the dara row index .. this is help to add id to function url 
 * Created date ; 2-3-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
function gridAddControlRow(grid_id , control , data , option , row_id)
{
	
	//number of contorls 
	var numberOfControls = Object.keys(control).length;			
	
	//counter variable
	var control_counter;
	
	//row text to be added
	var append_text="";
	
	//JQuery funcion
	var jq_func="";	
		
	for(control_counter=0;control_counter<numberOfControls;control_counter++)
	{
		var database_id = option['id']; //database table primary key				
		
		var append_text="";
		
		append_text += "<td class='middle'>";
		append_text += "<a";
		append_text += " title='"+control[control_counter]['title']+"'";
		append_text += " class='btn btn-mini'";
		
		message = control[control_counter]['message'];
		url = control[control_counter]['url'];				
		/* dialog box not completed yet :(
		if(control[control_counter]['message_type'] == "confirm")
		{		
			//append_text += " onclick='alert(\" Hello \");'";																	
			append_text += " onclick='"+ gridConfirm(message , url)  +"'";			
			//alert(append_text);
		}
		if(control[control_counter]['message_type'] == "prompt")
		{
			append_text += " onclick='alert(\" Are you sure man?\")'";
		}
		*/		
		append_text += " href='"+control[control_counter]['url']+"/"+data[row_id][database_id]+"'";
		//append_text += " onclick='alert(\" Hello \");'";
		append_text += " >";					
		append_text += " <i";
		append_text += " class='"+control[control_counter]['icon']+"'";
		append_text += " ></i></a></td>";
							
		$('#'+grid_id).find("tr:last").append(append_text);							
	}		
}



/**
 * function name : gridConfirm
 * 
 * Description : 
 * show confirm message when clicking on control
 * 
 * Parameters :
 * message : the message to be shown
 * Created date ; 8-3-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
function gridConfirm(message , url)
{	
		
		//var confirm_box = 'var ';
		return 'var truthBeTold = window.confirm("'+message+'");\
				 if(truthBeTold)\
				 {\
				 	window.location("'+url+'");\
				 }\
				 else\
				 {\
				 	window.alert("Bye for now!");\
				 }\
		';				
}



/**
 * function name: gridAddControlBar
 * 
 * Description: 
 * Add conrol bar below the table that contain (add button - showing range - pagination - search)
 * 
 * Parameters:
 * grid_id: grid id
 * Created date ; 13-3-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
function gridAddControlBar(grid_id , option , data)
{		
		//remove the control bar to change it and insert new one
		var $grid = $("#grid_bar").remove();
		
		//reach grid table
		var $grid =  $('#'+grid_id);
		
		//control bar
		var bar = "";
		
		bar+= '<div id="grid_bar"   class="well well-small">';
		bar+= '<div class="row-fluid">';
		
		//if add button is true then show add button with given url
		if(option['add_button'] == true)
		{
			bar+='<div class="span2">';
			bar+='<a class="btn btn-info" href="'+option["add_url"]+'"><i class="icon-plus-sign icon-white"></i> '+option["add_title"]+'</a>';
			bar+='</div>';
		}
		
		//show row count
		var current_page = option['current_page'];
		var page_size = option['page_size'];
		var total_size = option['total_size'];
		var number_of_pages = Math.ceil(total_size/page_size);

		//compute the start index and the end index for showing data
		var start_index = (current_page - 1)*page_size + 1;
		var end_index = (start_index -1) + page_size;
		if(end_index > total_size)	end_index = total_size;
		
		
		bar+='<div class="span1">';
		bar+='<span class="grid-pagination">'+start_index+'-'+end_index+'</span>';
		bar+='</div>';
		
		//pagination
		//compute the prev and next
		var prev_index = current_page*1 - 1;
		//class of prev button
		var prev_class="";
		
		var next_index = current_page*1 + 1;			
		var next_class="";
		
		if(prev_index < 1) {prev_index = 1 ; prev_class = "active";}
		if(next_index > number_of_pages) {next_index = number_of_pages ; next_class = "active";}
		
		bar+='<div class="span5">';
		bar+='<div class="pagination pagination-centered grid-pagination">';
		bar+='<ul>';		
		bar+='<li class="'+prev_class+'" title="Prev" onclick="gridGotoPage(\'' + grid_id + '\'  , ' + prev_index + ' );" ><a>&laquo; Prev</a></li>';				
		bar+='<li class="'+next_class+'" title="Next" onclick="gridGotoPage(\'' + grid_id + '\'  , ' + next_index + ' );"><a>Next &raquo;</a></li>';		
		bar+='<li class=""><input id="page_number" type="text" value="'+current_page+'" onkeypress="gridPageInput(event , \'' + grid_id + '\')"></li>';																	
		bar+='</ul>';								
		bar+='</div>';										
		bar+='</div>';		  		
				  	
		//search
		if(option['search'] == true)
		{
			bar+='<div class="span4">';
			bar+='<div class="input-append grid-search">'
			bar+='<input class="span8" id="search" type="text">';
			bar+='<span class="add-on"><i class="icon-search"></i></span>';
			bar+='</div>';
			bar+='</div>';
		}
						
		bar+='</div>'; //end of row fluid div
		bar+='</div>'; //end of well div
		
		$grid.after(bar);				
}


/**
 * function name: gridHashReader
 * 
 * Description: 
 * This function will read the hash from the url and split it to get grid option like page number and search criteria
 * 
 * note:
 * As we are using the hash in the url to pass grid option we have to  make sure about its form and it will be like this:
 * 
 * user=1-mohanad-xxxx-xxxx&user2=3-kaleia-xxxx
 * 
 * where user is grid name , user2 is another grid 
 * xx-xx-xx-xx
 * first option will be page number
 * second is the search keyword
 * 
 * Parameters:
 * grid_id: grid id
 * Created date ; 16-3-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
 */
function gridHashReader(grid_id)
{		
	//return the hash code as "#user=1-search-"
	var hash_options = window.location.hash;
	
	//if there is no hash options in the url then exit the function
	if(hash_options == "")
		return;
	
	try
	{					
		//remove the hash character
		hash_options = hash_options.slice(1 , hash_options.length);		
		/*split the hash option array to an arrays for each grid
		 * example: if the hash option is user1=2-mohanad&user2=4-55
		 * then it will be returned as an array 
		 * hash_option_array[0] = user1=2-mohanad
		 * hash_option_array[1] = user2=4-55
		 * 
		 * the split character is '&'
		 */
		var hash_options_array = hash_options.split("&");
		
		//current grid option
		var grid_option;
		
		//current grid counter will used in the for loop
		var current_grid = 0;
		
		//scan all options to determine which one is for me
		for(current_grid = 0 ; current_grid < hash_options_array.length ; current_grid++)
		{
			grid_option = hash_options_array[current_grid];
			
			//split the option by '=' chracter
			grid_option = grid_option.split("=");
			
			//if the current grid is our working grid then return 
			if(grid_option[0] == grid_id)
			{			
				break;
			}								
		}
		
		//after we have finished the loop we have the index of our grid option stored in cuurent_grid. 
		grid_option = hash_options_array[current_grid];
		
		//first we have to slice the options to remove grid name  
		grid_option = grid_option.slice(grid_id.length + 1 , grid_option.length);
		
		//now we want to split the options by '-' charachter
		grid_option_array = grid_option.split('-');
		
		return grid_option_array;
	
	}
	
	catch(e)
	{
		//the hash code is not work, but don't panic nothing will happen :)		
	}
}





/**
 * function name: gridGotoPage
 * 
 * Description: 
 * this function will get the next page data
 * 
 * Parameters:
 * grid_id: grid id
 * page_number : as we want to go to another page then we have to pass page number value
 * Created date ; 16-3-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
*/
function gridGotoPage(grid_id , page_number)
{
	
	//set option values
	var option = new Array();	
	
	//set page number
	option['page_number'] = page_number;
	
	//get the other options
	hash_option = gridHashReader(grid_id);
	
	if(hash_option!= null)
	{				
		//search keyword
		option['search'] = hash_option[1];
		
		//sort optoions
		option['sort_column'] = hash_option[2];
		option['sort_dir'] = hash_option[3];
	}
	
	//update hash history
	gridUpdateHistory(grid_id , option , 'page_number');
	
	
	//get data with the option
	gridRenderWithOption(grid_id , option);
	
}


/**
 * function name: gridSortColumn
 * 
 * Description: 
 * this function send column name and sorting direction to be rendered
 * 
 * Parameters:
 * grid_id: grid id
 * column_name : column name
 * dir: {desc , asc}
 * Created date ; 30-4-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
*/
function gridSortColumn(grid_id , column_name , dir)
{				
	//update the sort direction of the column so if it is desc then make it asc, if asc make it none		
	var $thead =  $('#'+grid_id).find("tr:first");		
	
	$thead.find("th").each(function(){
	//get columm name
	var col_name = $(this).attr("col");	
			
	if(col_name == column_name)
	{		
		if(dir=="asc")
		{																													
			$(this).attr('onclick', 'gridSortColumn("'+grid_id+'", "'+column_name+'" , "desc")');																
		}						
		else if(dir=="desc")
		{						
			$(this).attr('onclick', 'gridSortColumn("'+grid_id+'", "'+column_name+'", "none")');		
		}						
		else
		{						
			$(this).attr('onclick', 'gridSortColumn("'+grid_id+'", "'+column_name+'" , "asc")');
		}										
	}
	else
	{
		//remove the dir icon from every column except the sorted one						
		$(this).find("span").remove();
	}
																								
	});
	
	//add sorting direction symbol to the column
	gridAddSortDir(grid_id , column_name , dir);
	
	
	
	
	//set option values
	var option = new Array();
		
	//get the other options
	hash_option = gridHashReader(grid_id);
	
	if(hash_option!= null)
	{
		//set page number
		option['page_number'] = hash_option[0];		
		
		//search keyword
		option['search'] = hash_option[1];	
	}
	
	
	//set column name
	option['sort_column'] = column_name;
	
	//set sort direction
	option['sort_dir'] = dir;
	
	//update hash history
	gridUpdateHistory(grid_id , option , 'sort');
	
	
	//get data with the option
	gridRenderWithOption(grid_id , option);
	
}


/**
 * function name: gridAddSortDir
 * 
 * Description: 
 * this function will add sorting direction to column
 * 
 * Parameters:
 * grid_id: grid id
 * column_name : column name
 * dir: {desc , asc}
 * Created date ; 30-4-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
*/
function gridAddSortDir(grid_id , column_name , dir)
{
		//update the sort direction of the column so if it is desc then make it asc, if asc make it none		
		var $thead =  $('#'+grid_id).find("tr:first");		
		
		$thead.find("th").each(function(){
		//get columm name
		var col_name = $(this).attr("col");	
				
		if(col_name == column_name)
		{		
			if(dir=="asc")
			{																																																																					
				//remove the dir icon						
				$(this).find("span").remove();
				
				//add new dir icon
				$(this).append("  <span><i class='icon-chevron-up'></i></span>");						
			}						
			else if(dir=="desc")
			{														
				//remove the dir icon						
				$(this).find("span").remove();
				
				//add new dir icon
				$(this).append("  <span><i class='icon-chevron-down'></i></span>");
			}						
			else
			{							
				//remove the dir icon						
				$(this).find("span").remove();
			}													
		}
		else
		{
			//remove the dir icon from every column except the sorted one						
			$(this).find("span").remove();
		}
																									
	});
}

/**
 * function name: gridPageInput
 * 
 * Description: 
 * this function will listen to input and
 * 
 * Parameters:
 * grid_id: grid id
 * page_number : as we want to go to another page then we have to pass page number value
 * Created date ; 16-3-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
*/
function gridPageInput(key_event , grid_id)
{		
		var key=key_event.keyCode || key_event.which;		
		if (key==13) //13 for enter key ascii code
		{	
			var page_number = $("#page_number").val();					
			gridGotoPage(grid_id , page_number);
		}
} 


/**
 * function name: gridUpdateHistory
 * 
 * Description: 
 * this function read the hash code url and then update it with a given option value
 * 
 * Parameters:
 * grid_id: grid id
 * option : an option that we want to update in the URL
 * option['page_number'] = 1
 * option_type: option type that we want to replace with for example: page_number
 * Created date ; 26-3-2013
 * Modification date : ---
 * Modfication reason : ---
 * Author : Mohanad Shab Kaleia
 * contact : ms.kaleia@gmail.com
*/
function gridUpdateHistory(grid_id , option , option_type)
{	
	var hash_original;
	var hash_updated;
	var hash_original_string;
	var hash_updated_string;
	
			
	//return the hash code as "#user=1-search-" this is the original one (before updated)
	var hash_original_string = window.location.hash;
	
	//if the hash code is empty then create a new one
	if(hash_original_string == "")
	{
		if(option_type == "page_number")
		{
			hash_updated_string = "#"+grid_id+"="+option[option_type];
			hash_updated_string += "-null-null-null";
		}			
		else if(option_type == "search")
		{	
			//here I suppos that the default page is the first page		
			hash_updated_string = "#"+grid_id+"=1-"+option[option_type];
		}
		else if(option_type == "sort")
		{
			//here I suppos that the default page is the first page	and no search keyword is passed	
			hash_updated_string = "#"+grid_id+"=1-null-"+option['sort_column']+"-"+option['sort_dir'];
		}							
	}	
	else
	{				
		
		//read the hash history that is related to our grid
		hash_original =  gridHashReader(grid_id);
		
		//we assign the old hash with the new empty one to update it and to make a copy of the original
		hash_updated =  gridHashReader(grid_id);
		 
		//modify the hash history with the given option value and type
		switch(option_type)
		{
			case "page_number":
			hash_updated[0] = option[option_type];
			break;
			
			case "search":
			hash_updated[1] = option[option_type];
			break;
			
			case "sort":			
			hash_updated[2] = option["sort_column"];
			hash_updated[3] = option["sort_dir"];			
			break;
		}
					
		
		//replace the new value with the prev one
		//but before that we need to change the form of the hash history from array to string
		 
	
		 		
		hash_updated_string = grid_id + "="; 
		hash_original_string = grid_id + "=";
		for(i=0 ; i< hash_updated.length ; i++)
		{
			hash_updated_string+=hash_updated[i];			
			hash_original_string +=hash_original[i];
			
			if(i < (hash_updated.length-1))
			{				
				hash_updated_string+="-";				
				hash_original_string += "-";				
			}							
		}				
		
		var hash = window.location.hash;
		
		hash_updated_string = hash.replace(hash_original_string , hash_updated_string);
		
	}
		
	window.location.hash = hash_updated_string;										
}