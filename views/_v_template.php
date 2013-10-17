<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<link rel="stylesheet" type="text/css" href="/css/master-styles.css">
	
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>

	<div id="wrapper">

		<div id="mainnavbar">
		
			<!-- Menu for users who are logged in -->
	        <?php if($user): ?>
	        	<ul class="mainnavmenu">
	        		<li><a href='/users/profile'>profile</a></li>
	            	<li><a href='/users/logout'>logout</a></li>
	            </ul>
	        <!-- Menu options for users who are not logged in -->
	        <?php else: ?>
	        	<ul class="mainnavmenu">
	            	<li><a href='/users/signup'>sign up</a></li>
	            	<li><a href='/users/login'>log in</a></li>
	            </ul>
	        <?php endif; ?>

			<a href='/' class="mainnavlogo">turtdur</a>

		</div>

		<div id="maincontent">

			<?php if(isset($content)) echo $content; ?>

			<?php if(isset($client_files_body)) echo $client_files_body; ?>

		</div>

		<div id="contentnav"></div>

		<div id="footer"></div>

	</div>

</body>
</html>