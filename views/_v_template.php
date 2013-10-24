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

	<nav>
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Tutorials</a>
				<ul>
					<li><a href="#">Photoshop</a></li>
					<li><a href="#">Illustrator</a></li>
					<li><a href="#">Web Design</a>
						<ul>
							<li><a href="#">HTML</a></li>
							<li><a href="#">CSS</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li><a href="#">Articles</a>
				<ul>
					<li><a href="#">Web Design</a></li>
					<li><a href="#">User Experience</a></li>
				</ul>
			</li>
			<li><a href="#">Inspiration</a></li>
		</ul>
	</nav>

	<div id="container">

		<div id="mainnavbar">

			<!-- Menu for users who are logged in -->
			<ul class="mainnavmenu">
		        <?php if($user): ?>

		        	<li><a href='/users/profile'>profile</a></li>
		        	<li><a href='/posts/users'>users</a></li>
		        	<li><a href='/posts'>posts</a></li>
		            <li><a href='/users/logout'>logout</a></li>

		        <!-- Menu options for users who are not logged in -->
		        <?php else: ?>

		            <li><a href='/users/signup'>sign up</a></li>
		            <li><a href='/users/login'>log in</a></li>

		        <?php endif; ?>
	        </ul>
			<a href='/' class="mainnavlogo">turtdur</a>

		</div>

		<div id="maincontent">

			<?php if(isset($content)) echo $content; ?>

			<?php if(isset($client_files_body)) echo $client_files_body; ?>

		</div>

		<div id="footerbar"></div>

	</div>
</body>
</html>