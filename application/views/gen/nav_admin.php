<!-- This file contain navigation and it will contain :
  - menu
  - username 
  - logout button
 -->
 
<body>	
	<div id="wrap">	    	
		<div class="navbar navbar-inverse">
		    <div class="navbar-inner">
		    	<a class="brand" href="<?php echo base_url();?>">No403</a>
			    <ul class="nav">			    	
			    	<li class="<?php if(isset($dashboard)) echo $dashboard;?>"><a href="<?php echo base_url();?>dashboard">Dashboard</a></li>
			    	<li class="<?php if(isset($request)) echo $request;?>"><a href="<?php echo base_url();?>request/manageRequests">Requests</a></li>
			    	<li class="<?php if(isset($program)) echo $program;?>"><a href="<?php echo base_url();?>program/managePrograms">Programs</a></li>
			    	<li class="<?php if(isset($user)) echo $user;?>"><a href="<?php echo base_url();?>user/manageUser">Users</a></li>
			    	<li class="dropdown <?php if(isset($settings)) echo $settings;?>">		    		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">						
						Settings
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo base_url();?>settings/manageCategories">Categories</a></li>
							<li class="divider"></li>
							<li><a tabindex="-1" href="<?php echo base_url();?>settings/manageAttributes">Attributes</a></li>							
						</ul>
					</li>			    	
			    	<li class="<?php if(isset($log)) echo $log;?>"><a href="<?php echo base_url();?>log/showLog">Log</a></li>			    	
			    </ul>
			    <ul class="nav pull-right">			    				    
			    		    				    	
			    	<li class="dropdown">		    		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-user icon-white"></i>
						Hello <span style="color:#e1e1e1;font-weight: bold"><?php echo $this->session->userdata('username');?></span>
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo base_url();?>login/logout"><i class="icon-off"></i> Logout</a></li>																				
						</ul>
					</li>																						
			    </ul>
		    </div>
	    </div>					
