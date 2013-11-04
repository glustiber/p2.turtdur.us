<h2>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h2>

<? if($user): ?>
	<p>Use the menu above to view and edit your profile, post status updates, follow and unfollow other users, and view posts and profiles of users you're following.</p>
<? else: ?>
    <p>turtdur is a simple microblog where you can post updates and keep track of what all your friends are doing.</p><br>
    <p>Click sign up to create an account, or click log in if you already have one.</p>
<? endif; ?>