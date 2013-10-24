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

	<div id="container">

		<div id="mainnavbar">

		<nav>
			<!-- Menu for users who are logged in -->
		        <?php if($user): ?>
			        <ul>
			        	<li><a href='#'>profile</a>
				        	<ul>
				        		<li><a href='/users/profile/'>view profile</a></li>
				        		<li><a href='/users/editprofile'>edit profile</a></li>
				        	</ul>
			        	</li>
			        	<li><a href='#'>users</a>
				        	<ul>
				        		<li><a href='/posts/users/'>all</a></li>
				        		<li><a href='#'>following</a></li>
				        		<li><a href='#'>followers</a></li>
				        	</ul>
			        	</li>
			        	<li><a href='/posts'>posts</a>
			        		<ul>
				        		<li><a href='/posts/'>post stream</a></li>
				        		<li><a href='#'>your posts</a></li>
				        		<li><a href='/posts/add/'>add post</a></li>
				        	</ul>
			        	</li>
			            <li><a href='/users/logout'>logout</a></li>
			        </ul>
		        <!-- Menu options for users who are not logged in -->
		        <?php else: ?>
			        <ul>
			            <li><a href='/users/signup'>sign up</a></li>
			            <li><a href='/users/login'>log in</a></li>
			        </ul>
		        <?php endif; ?>
		</nav>

			<a href='/' class="mainnavlogo">turtdur</a>

		</div>

		<div id="maincontent">

			<?php if(isset($content)) echo $content; ?>

			<?php if(isset($client_files_body)) echo $client_files_body; ?>

		</div>
<!--
		<div id="footerbar"></div>
-->
	</div>
</body>
</html>