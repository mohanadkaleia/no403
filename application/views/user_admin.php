<script>	
	$(document).ready(function() {		
	    gridRender('user');
	}); 
</script>


<div class="container">
	
	<div class="hero-unit">
		<h3 class="title">Users</h3>	 
		
		<div class="grid">
			<table id="user" class="grid" action="<?php echo base_url();?>user/ajaxGetUsers" dir="ltr">				
				<tr>																
					<th col="id" type="text">ID</th>
					<th col="name" type="text">User name</th>
					<th col="email"  type="text">Email</th>		
					<th col="created_date" type="date">Created date</th>
				</tr>										
			</table>	
		
			<div class="well well-small">			  	
				<div class="row-fluid">												
				  	
				  	<div class="span2">
				  		<a class="btn btn-info" href="<?php echo base_url()."user/addUser"?>"><i class="icon-plus-sign icon-white"></i> Add new</a>
				  	</div>
				  
				  	
				  	<div class="span1">
				  		<span class="grid-pagination">1-10</span>
				  	</div>
				  					  	
				  	<div class="span5">
						<div class="pagination pagination-centered">
							<ul>												
								<li class="disabled" ><a href="#">&laquo;</a></li>							
								<li class="active"><a href="#">1</a></li>
								<li class=""><a href="#">2</a></li>
								<li class=""><a href="#">3</a></li>																						
								<li class=""><a href="#">&raquo;</a></li>				    
							</ul>
						</div>
					</div>
					
				  	<div class="span4">				  					  						  								  
						<div class="input-append grid-search">
							<input class="span8" id="search" type="text">
						  	<span class="add-on"><i class="icon-search"></i></span>
						</div>										  					  				
					</div>
				</div>			 
			</div>
			
			
		
			
			
			
			
			
		</div>
		
	</div> <!-- end hero uit -->	
	
	
</div> <!-- end container -->

