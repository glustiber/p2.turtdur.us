<h2>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h2>

<? if($user): ?>
	<p>Use the menu above to view and edit your profile, post status updates, follow and unfollow other users, and view posts and profiles of users you're following.</p>
<? else: ?>
    <p>turtdur is a simple microblog where you can post status updates and view status updates and view status updates of all other users you choose to follow.</p>
    <p>Click sign up to create an account, or click log in if you already have one.</p>
<? endif; ?>