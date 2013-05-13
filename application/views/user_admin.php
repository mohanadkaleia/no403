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
		</div>
		
	</div> <!-- end hero uit -->	
	
	
</div> <!-- end container -->

