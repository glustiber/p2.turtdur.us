<h2>list of all users:</h2>

<? foreach($users as $user): ?>

    <!-- Print this user's name -->
    <?=$user['first_name']?> <?=$user['last_name']?><br>

<!--    <? if($user['location'] != ""): ?>

        <?=$user['location']?><br>

    <? endif; ?>
-->
    <!-- If there exists a connection with this user, show a unfollow link -->
    <? if(isset($connections[$user['user_id']])): ?>
        <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

    <!-- Otherwise, show the follow link -->
    <? else: ?>
        <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
    <? endif; ?>&#149

    <a href='/posts/profile/<?=$user['user_id']?>'>View Profile</a>

    <br><br>

<? endforeach; ?>
