<script>	
	$(document).ready(function() {		
	    gridRender('cat');
	}); 
</script>


<div class="container">
	
	<div class="hero-unit">
		<h3 class="title">Categories</h3>	 				
		<div class="grid">
			<table id="cat" action="<?php echo base_url();?>settings/ajaxGetCat" dir="ltr">				
				<tr>																					
					<th col="name" type="text">Name</th>
					<th col="type"  type="text">Type</th>		
					<th col="url"  type="text">URL</th>
					<th col="description"  type="text">Description</th>					
					<th col="id"  type="text">ID</th>
					<th col="created_date"  type="date">Created date</th>
				</tr>										
			</table>	
		</div>			
	</div> <!-- end hero uit -->	
	
	
</div> <!-- end container -->

