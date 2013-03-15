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
		<h3 class="title">Add user</h3>	 
	
		<form  method="post" action="<?php echo base_url();?>user/addUserData">
			
			<div class="<?php echo $class;?>">
				<?php 
					echo $message;
				?>
			</div>
			
			<div class="user_form">	
				<table>
					<tr>
						<td>
							<label for="username">Username</lable>		
						</td>
						
						<td>
							<input class="input-xlarge" type="text" name="username"  placeholder="Your username" required value="<?php echo $this->input->post('username');?>"/>			
						</td>
					</tr>
					
					<tr>
						<td>
							<label for="email">Email</label>		
						</td>
						
						<td>
							<input class="input-xlarge" type="email" name="email" placeholder="you@domain.com" required value="<?php echo $this->input->post('email');?>"/>			
						</td>
					</tr>
					
					<tr>
						<td>
							<label for="password">Password</label>		
						</td>
						
						<td>
							<input class="input-xlarge" type="password" name="password" placeholder="must be more than 6" required />			
						</td>
					</tr>
					
					<tr>
						<td>
							<label for="password_confirm">Password confirmation</label>		
						</td>
						
						<td>
							<input class="input-xlarge" type="password" name="password_confirm" placeholder="repeat your password" required/>			
						</td> 
					</tr>
				</table>
			</div>			
			
			<div class="control_button">
				<button type="submit" class="btn btn-primary">Save changes</button>
				<button type="button" class="btn" onclick="window.location='<?php echo base_url()."user/manageUser"?>'">Cancel</button>
			</div>				
					
			
			
		
		
		</form>
		
		
		
	</div> <!-- end hero uit -->	
	
	
</div> <!-- end container -->

