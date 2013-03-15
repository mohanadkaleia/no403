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
	
	alert(action);
		
	$.ajax({
			  type: "POST",
			  url: action,  
			  cache: false,
			  success: function(json)
						{
			  		    try
			  		    {			  		    				  		   
			  		 		var obj = jQuery.parseJSON(json);
			  		 		
			  		 		/*Read grid parameters*/
			  		 		
			  		 		//data oject	
			  		 		var data_obj = obj["data"];
			  		 		
			  		 		//control object
			  		 		var control_obj = obj["control"];	
			  		 		
			  		 		//Option
			  		 		var option = obj["option"];			  		 					  		 					  		 				  		 				  		 					  		 
							
							//add data and functions to the table			  		 					  		 					  		 					  							  			
			  				gridAddRow(grid_id , data_obj , control_obj , option);
			  				
			  				//add pagination - search - add button - range of show
			  				gridAddControlBar(grid_id , option);			  			
			  				
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
		//get the number of rows from data 
		var numberOfRows = Object.keys(data).length;
		
		//get first row (the row that contain database column name by "col" attribute)
		var $thead =  $('#'+grid_id).find("tr:first");
		
		//add function titles to thead
		gridAddControlTitle(grid_id , control);
					
		//get the number of td inside tr
		var numberOfTd = $thead.children('td').length;
		
		//if the row number option is set to true then add th in the first
		if(option['row_number'])
			$thead.find("th:first").before("<th col='row_num'>#</th>");
				
		//add row and data cell
		for(i=0;i<numberOfRows;i++)
		{											
			//add new row to the table
			$('#'+grid_id).append('<tr></tr>');					
			
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
 * Add functions title to the thead of grid table
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
	//number of contorls 
	var numberOfControls = Object.keys(control).length;		
	
	//label field name
	var title_counter ;
			
	for(title_counter = 0; title_counter < numberOfControls;title_counter++)
	{
		$('#'+grid_id).find("tr:first").append("<th>"+ control[title_counter]['title']  +"</th>")
	}
	
	
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
		var title = option['title'];   // grid title
		var sortable = option['sorable'];   // is columns sortable
		var search = option['search'];   // grid search
		
		
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
function gridAddControlBar(grid_id , option)
{		
		//reach grid table
		var $grid =  $('#'+grid_id);
		
		//control bar
		var bar = "";
		
		bar+= '<div class="well well-small">';
		bar+= '<div class="row-fluid">';
		
		//if add button is true then show add button with given url
		if(option['add_button'] == true)
		{
			bar+='<div class="span2">';
			bar+='<a class="btn btn-info" href="'+option["add_url"]+'"><i class="icon-plus-sign icon-white"></i> '+option["add_title"]+'</a>';
			bar+='</div>';
		}
		
		//show row count
		bar+='<div class="span1">';
		bar+='<span class="grid-pagination">1-10</span>';
		bar+='</div>';
		
		//pagination
		bar+='<div class="span5">';
		bar+='<div class="pagination pagination-centered">';
		bar+='<ul>';
		bar+='<li class="disabled" ><a href="#">&laquo;</a></li>';
		bar+='<li class="active"><a href="#1">1</a></li>';
		bar+='<li class=""><a href="#2">2</a></li>';																			
		bar+='<li class="" title="next"><a href="#2">&raquo;</a></li>	';															
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


