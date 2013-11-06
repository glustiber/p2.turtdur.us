<h2>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h2>

<? if($user): ?>
	<p>Use the menu above to view and edit your profile, post status updates, follow and unfollow other users, and view posts and profiles of users you're following.</p>
<? else: ?>
    <p>turtdur is a simple microblog where you can create a profile and post periodic status updates, follow other
    users, and view their profiles and status updates. At turtdur, you can also upload a profile picture, edit your profile,
    edit your posts, delete your posts, and "like" posts of other users.</p>
    <br>
    <p>Click <a href="/users/signup">sign up</a> to create an account, or click <a href="/users/login">log in</a> if you already have one.</p>
<? endif; ?>