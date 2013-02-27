<div class="container">
	
	<div class="hero-unit">
		<h3 class="title">Users</h3>	 
		
		<div class="grid">
			<table action="<?php echo base_url();?>user/ajaxGetUsers">
				<tr>										
					<th col="id" type="text">ID</th>
					<th col="name" type="text">User name</th>
					<th col="email"  type="text">Email</th>		
					<th col="func_edit">edit</th>
					<th col="func_edit">delete</th>
				</tr>
				
				<tr>
					<td class="middle">
						1
					</td>
					
					<td>
						Mohanad
					</td>
					<td>
						ms.kaleia@gmail.com
					</td>
					
					<td class="middle func">
						<a class="btn btn-mini" href="#"><i class=" icon-pencil"></i></a>
					</td>
					
					<td class="middle func">
						<a class="btn btn-mini" href="#"><i class=" icon-trash"></i></a>
					</td>
				</tr>
				
				<tr>
					<td class="middle">
						2
					</td>
					
					<td>
						Rami
					</td>
					<td>
						ramiaqqad@gmail.com
					</td>
					
					<td class="middle">
						<a class="btn btn-mini" href="#"><i class=" icon-pencil"></i></a>
					</td>
					
					<td class="middle">
						<a class="btn btn-mini" href="#"><i class=" icon-trash"></i></a>
					</td>
				</tr>
			</table>	
		
		
			<div class="row-fluid">				
				
				
			  	<div class="span8">
					<div class="pagination">
						<ul>					
							<li class="disabled"><a href="#">&laquo;</a></li>
							<li class="active"><a href="#">1</a></li>
							<li class=""><a href="#">2</a></li>
							<li class=""><a href="#">3</a></li>
							<li class=""><a href="#">4</a></li>
							<li class=""><a href="#">5</a></li>
							<li class="active"><a href="#">...</a></li>
							<li class="disabled"><span>&raquo;</span></li>				    
						</ul>
					</div>  			
				</div>
				
			  	<div class="span4">
			  		<div class="grid-search">			  						  								  
						<div class="input-append">
							<input class="span8" id="appendedInput" type="text">
						  	<span class="add-on"><i class="icon-search"></i></span>
						</div>						
			  		</div>			  				
				</div>
			</div>
		
			
			
			
			
			
		</div>
		
	</div> <!-- end hero uit -->	
	
	
</div> <!-- end container -->

