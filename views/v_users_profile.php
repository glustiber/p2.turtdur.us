<h1>This is the profile of <?=$user->first_name?></h1>

<p>Name: 	 <?=$user->first_name?> <?=$user->last_name?></p>
<p>E-mail:   <?=$user->email?></p>
<p>Location: <?=$user->location?></p>
<p>Website:  <?=$user->website?></p>
<p>Bio:      <?=$user->bio?></p>

<a href='/users/editprofile'>Edit profile</a>