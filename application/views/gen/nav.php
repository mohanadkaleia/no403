<!-- This file contain navigation and it will contain :
  - menu
  - username 
  - logout button
 -->

<body>
	
<!-- the header will contain the menu, social and search --> 
<div id="header">
	
	<!-- slogan -->
	<div id="slogan">
		<img src="<?php echo base_url();?>images/slogan.png" height="250px">
	</div>
	
	<!-- social buttons -->
	<div id="social">			
		<a href="#"><img src="<?php echo base_url();?>images/Facebook-icon.png"></a>
		<a href="#"><img src="<?php echo base_url();?>images/Twitter-icon.png"></a>			
		<a href="#"><img src="<?php echo base_url();?>images/RSS-icon.png"></a>			
	</div>
	
	<!-- search -->
	<div id="searchContainer">			
		<form id="searchForm">
			<input type="text" name="search" id="search" class="input-medium search-query" placeholder="">
			<input type="submit" name="searchSubmit" id="searchSubmit" value="">
		</form> 
	</div>
	
	
	<div class="clear"></div>
	
	<!-- menu -->
	<div id="menu">
		<ul>	
							
			<li class="<?php if(isset($home)) echo $home;?>"><a href="<?php echo base_url();?>">Home</a></li>
			<li class="<?php if(isset($apps)) echo $apps;?>"><a href="<?php echo base_url();?>apps">App center</a></li>
			<li class="<?php if(isset($request)) echo $request;?>"><a href="<?php echo base_url();?>request">Request</a></li>
			<li class="<?php if(isset($contact)) echo $contact;?>"><a href="<?php echo base_url();?>contact">Contact</a></li>
			<li class="<?php if(isset($about)) echo $about;?>"><a href="<?php echo base_url();?>about">About</a></li>
			<!--<li class="login"><a href="#">Login</a></li>-->				
		</ul>
	</div>
</div>
