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
		<h3 class="title">Add category</h3>	 
	
		<form  method="post" action="<?php echo base_url();?>settings/addCategoryData">
			
			<div class="<?php echo $class;?>">
				<?php 
					echo $message;
				?>
			</div>
			
			<div class="user_form">	
				<table>
					<tr>
						<td>
							<label for="cat_name">Category name</lable>		
						</td>
						
						<td>
							<input  type="text" name="cat_name" id="cat_name" placeholder="category name" required value="<?php echo $this->input->post('cat_name');?>"/>			
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
							<input  type="text" name="cat_code" id="cat_code" placeholder="like en for english language" value="<?php echo $this->input->post('cat_code');?>"/>			
						</td>
					</tr>
					
					<tr>
						<td>
							<label for="cat_url">Link with webpage</label>		
						</td>
						
						<td>
							<input  type="url" name="cat_url" id="cat_url" placeholder="web page for description"   value="<?php echo $this->input->post('cat_url');?>"/>			
						</td>
					</tr>
					
					<tr>
						<td>							
							<label for="cat_desc">Descrition</label>		
						</td>
						
						<td>
							<textarea id="cat_desc" name="cat_desc" rows="5" ><?php echo $this->input->post('cat_desc');?></textarea>			
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

