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
			    	<li class="<?php if(isset($program)) echo $program;?>"><a href="<?php echo base_url();?>apps/managePrograms">Programs</a></li>
			    	<li class="<?php if(isset($user)) echo $user;?>"><a href="<?php echo base_url();?>user/manageUser">Users</a></li>
			    	<li class="<?php if(isset($setting)) echo $setting;?>"><a href="<?php echo base_url();?>setting/manageSetting">Settings</a></li>
			    	<li class="<?php if(isset($log)) echo $log;?>"><a href="<?php echo base_url();?>log/showLog">Log</a></li>			    	
			    </ul>
			    <ul class="nav pull-right">			    				    
			    		    				    	
			    	<li class="dropdown">		    		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-user icon-white"></i>
						Hello Mohanad
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="<?php echo base_url();?>login/logout"><i class="icon-off"></i> Logout</a></li>
							<li><a tabindex="-1" href="#"><i class="icon-pencil"></i> Change password</a></li>
						</ul>
					</li>																						
			    </ul>
		    </div>
	    </div>					
