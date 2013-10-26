<h1>My Profile</h1>

<img src="<?=$user->profile_pic?>" alt="<?=basename($user->profile_pic)?>"/><br>

Name: <?=$user->first_name?> <?=$user->last_name?><br>
E-mail: <?=$user->email?><br>
<? if($user->location != ""): ?>
	Location: <?=$user->location?><br>
<? endif; ?>
<? if($user->website != ""): ?>
	Website: <?=$user->website?><br>
<? endif; ?><br>

<a href='/users/editprofile'>Edit Profile</a>