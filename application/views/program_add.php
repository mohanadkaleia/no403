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
		<h3 class="title">Add program</h3>	 
	
		<form  method="post" action="<?php echo base_url();?>program/addProgramData" enctype="multipart/form-data">
			
			<div class="<?php echo $class;?>">
				<?php 
					echo $message;
				?>
			</div>
			

			
			<div class="user_form">	
				<table class="form_table">
					<tr class="title">
						<td colspan="2">							
							Program information:
						</td>
					</tr>
					
					<tr class="odd">
						<td>
							<label for="prog_name">Program name</lable>		
						</td>
						
						<td>
							<input  class="input-xlarge" type="text" name="prog_name" id="prog_name" placeholder="Program name" required value="<?php echo $this->input->post('prog_name');?>" required/>			
						</td>
					</tr>
					
					<tr class="even">
						<td>
							<label for="prog_version">version</label>		
						</td>
						
						<td>
							<input class="input-xlarge" type="text" name="prog_version" id="prog_version" placeholder="program version ex. 1.02"  value="<?php echo $this->input->post('prog_version');?>" required/>
						</td>
					</tr>
					
					
					<tr class="odd">
						<td>
							<label for="prog_pname">Physical name</label>		
						</td>
						
						<td>
							<input  class="input-xlarge" type="text" name="prog_pname" id="prog_pname" placeholder="ex. adobe_flash.exe"  value="<?php echo $this->input->post('prog_pname');?>" required/>
						</td>
					</tr>
					
					<tr class="even">
						<td>
							<label for="prog_picture">Picture</label>		
						</td>
						
						<td>
							<input type="file" name="prog_picture" id="prog_picture"/>
						</td>
					</tr>
					
					
					<tr>
						<td>
							<label for="prog_url">Download URL</label>		
						</td>
						
						<td>
							<input class="input-xlarge" type="url" name="prog_url" id="prog_url" placeholder="the url to download from..." value="<?php echo $this->input->post('prog_url');?>" required/>
						</td>
					</tr>
					
					
					<tr class="even">
						<td>
							<label for="prog_website">website</label>		
						</td>
						
						<td>
							<input class="input-xlarge" type="url" name="prog_website" id="prog_website" placeholder="source website like adobe.com" value="<?php echo $this->input->post('prog_website');?>" required/>
						</td>
					</tr>
					
					
					<tr>
						<td>
							<label for="prog_produced">Produced by</label>		
						</td>
						
						<td>
							<input class="input-xlarge" type="text" name="prog_produced" id="prog_produced" placeholder="the creator of program ex. google" value="<?php echo $this->input->post('prog_produced');?>" required/>
						</td>
					</tr>
					
					
					<tr class="even">
						<td>
							<label for="">Select program category:</label>		
						</td>
						
						<td>
										
						</td>
					</tr>
					
					<?php
						for($i=0 ; $i<count($cat_types) ; $i++)
						{
					?>
						
						<tr class="even">
							<td>
								<?php echo $cat_types[$i]['type'];?>
							</td>
							
							<td>
								<?php
									for ($j=0;$j<count($cat_all);$j++)
									{
										if($cat_all[$j]['type']==$cat_types[$i]['type'])
										{
											?>
												<input type="checkbox" name="prog_cat[]" id="prog_cat[]" value="<?php echo $cat_all[$j]['id'];?>"/>   <?php echo $cat_all[$j]['name'];?>
												<br>
											
											
											<?php
										}
									}
								?>
								
							</td>
						</tr>	
					
					<?php
						}
					?>
					
					<tr>
						<td>							
							<label for="prog_desc">Descrition</label>		
						</td>
						
						<td>
							<textarea id="prog_desc" name="prog_desc" rows="5" ><?php echo $this->input->post('prog_desc');?></textarea>			
						</td>
					</tr>
			
										
				</table>
			</div>			
			
			<div class="control_button">
				<button type="submit" class="btn btn-primary">Save changes</button>
				<button type="button" class="btn" onclick="window.location='<?php echo base_url()."program/managePrograms"?>'">Cancel</button>
			</div>				
					
			
			
		
		
		</form>
		
		
		
	</div> <!-- end hero uit -->	
	
	
</div> <!-- end container -->

