<?php
	$class=""; //this variable will contain the class name for alert area
	$message = ""; // this variable will contain the message that will appear in the alert
			
	if(isset($status_message)) 
	{
		$class="alert alert-success";
		$message = $status_message;
	}
	if(validation_errors()) 
	{
		$class="alert alert-error";
		$message = validation_errors();
	} 
?>


<div class="container">
	
	<div class="hero-unit">
		<h3 class="title">Edit category</h3>	 
	
		<form  method="post" action="<?php echo base_url();?>settings/editCategoryData">
			
			<div class="<?php echo $class;?>">
				<?php 
					echo $message;
				?>
			</div>
			
			<!--cat id-->			
			<input type="hidden" name="cat_id" value="<?php echo $cat_info[0]['id'];?>"/>
			
			<div class="user_form">	
				<table>
					<tr>
						<td>
							<label for="cat_name">Category name</lable>		
						</td>
						
						<td>
							<input  type="text" name="cat_name" id="cat_name" placeholder="category name" required value="<?php echo $cat_info[0]['name'];?>"/>			
						</td>
					</tr>
					
					<tr>
						<td>
							<label for="cat_type">Category type</label>		
						</td>
						
						<td>
							<select name="cat_type">
								<option value="os" selected="true">OS</option>
								<option value="license">License</option>
								<option value="lang">Lang</option>								
							</select>																
						</td>
					</tr>
					
					
					<tr>
						<td>
							<label for="cat_code">Category code</label>		
						</td>
						
						<td>
							<input  type="text" name="cat_code" id="cat_code" placeholder="like en for english language" <?php echo $cat_info[0]['code'];?> />			
						</td>
					</tr>
					
					<tr>
						<td>
							<label for="cat_url">Link with webpage</label>		
						</td>
						
						<td>
							<input  type="url" name="cat_url" id="cat_url" placeholder="web page for description" <?php echo $cat_info[0]['url'];?> />			
						</td>
					</tr>
					
					<tr>
						<td>							
							<label for="cat_desc">Descrition</label>		
						</td>
						
						<td>
							<textarea id="cat_desc" name="cat_desc" rows="5" ><?php echo $cat_info[0]['description'];?></textarea>			
						</td>
					</tr>					
				</table>
			</div>			
			
			<div class="control_button">
				<button type="submit" class="btn btn-primary">Save changes</button>
				<button type="button" class="btn" onclick="window.location='<?php echo base_url()."settings/manageCategories"?>'">Cancel</button>
			</div>				
					
			
			
		
		
		</form>
		
		
		
	</div> <!-- end hero uit -->	
	
	
</div> <!-- end container -->

