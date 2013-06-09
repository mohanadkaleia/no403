<?php
	//by defalut there is no error and only greeting message
	$class="alert alert-info";
	$message = "How are you today?";
	
	//error message
	
	 
	
	
	if(validation_errors()) 
		{
			$class="alert alert-error";
			$message = validation_errors();
		}

?>
<div id="wrap">   		
	<div class="container">
	
		<div class="login_slogan">			
			<div class="clear"></div>		
			<p>
				NO403 Control Panel
			</p>
		</div>
		
		
				
		<!--<form action="<?php echo base_url();?>adminpanel/login/validateLogin" method="post" class="form-signin">-->
		<form action="<?php echo base_url();?>login/validateLogin" method="post" class="form-signin">	
			<h2 class="form-signin-heading">Please sign in</h2>
			
			<!-- error message -->
	
			<div class="<?php echo $class;?>">
				<button class="close" data-dismiss="alert" type="button">×</button>
				<?php echo $message;?>
			</div>
			
			<!-- email address -->
			<input name="email" type="text" class="input-block-level" placeholder="Email address" autofocus="true" required value="<?php echo $this->input->post('email');?>"> 
			
			<!-- passowrd -->
			<input name="password" type="password" class="input-block-level" placeholder="Password" required>
			
			<!-- remmember me -->
			<label class="checkbox">
			  <input type="checkbox" value="remember-me" id="rememberme"> Remember me
			</label>
			
			
			<button class="btn btn-large btn-primary" type="submit">Sign in</button>
							
		</form>

    </div> <!-- /container -->
    <div id="push"></div>
    
</div>



		


	<div id="footer">
	  <div class="container">
	    <p class="muted credit">Powered by <a href="http://www.computech-sy.com" target="_blank">CompuTech Group</a>.</p>
	  </div>
	</div>		

	<!-- load js -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="<?php echo base_url();?>js/jquery-1.8.0.min.js"></script>
	<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>			
					
</body>

</html>