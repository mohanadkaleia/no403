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
		<h3 class="title">Edit attribute</h3>	 
	
		<form  method="post" action="<?php echo base_url();?>settings/editAttributeData">
			
			<div class="<?php echo $class;?>">
				<?php 
					echo $message;
				?>
			</div>
			
			<!--cat id-->			
			<input type="hidden" name="attr_id" value="<?php echo $attr_info[0]['id'];?>"/>
			
			<div class="user_form">	
				<table>
					<tr>
						<td>
							<label for="attr_name">Attribute name</lable>		
						</td>
						
						<td>
							<input  type="text" name="attr_name" id="attr_name" placeholder="attribute name" required value="<?php echo $attr_info[0]['name'];?>"/>			
						</td>
					</tr>
					
					
					<tr>
						<td>
							<label for="attr_val">Attribute value</label>		
						</td>
						
						<td>
							<input  type="text" name="attr_val" id="attr_val" placeholder="" value="<?php echo $attr_info[0]['value'];?>" />			
						</td>
					</tr>
					
					<tr>
						<td>							
							<label for="attr_desc">Descrition</label>		
						</td>
						
						<td>
							<textarea id="attr_desc" name="attr_desc" rows="5" ><?php echo $attr_info[0]['description'];?></textarea>			
						</td>
					</tr>					
				</table>
			</div>			
			
			<div class="control_button">
				<button type="submit" class="btn btn-primary">Save changes</button>
				<button type="button" class="btn" onclick="window.location='<?php echo base_url()."settings/manageAttributes"?>'">Cancel</button>
			</div>				
					
			
			
		
		
		</form>
		
		
		
	</div> <!-- end hero uit -->	
	
	
</div> <!-- end container -->

