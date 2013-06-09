<script>	
	$(document).ready(function() {		
	    gridRender('cat');
	}); 
</script>


<div class="container">
	
	<div class="hero-unit">
		<h3 class="title">Attributes</h3>	 				
		<div class="grid">
			<table id="cat" action="<?php echo base_url();?>settings/ajaxGetAttr" dir="ltr">				
				<tr>																					
					<th col="name" type="text">Name</th>
					<th col="value"  type="text">Value</th>
					<th col="description"  type="text">Description</th>								
				</tr>										
			</table>	
		</div>			
	</div> <!-- end hero uit -->	
	
	
</div> <!-- end container -->

