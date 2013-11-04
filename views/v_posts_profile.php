<? foreach($users as $user): ?>  

    <h2><?=$user['first_name']?> <?=$user['last_name']?>'s Profile</h2>  

    Name: <?=$user['first_name']?> <?=$user['last_name']?><br>
    E-mail: <?=$user['email']?><br>
    <? if($user['location'] != ""): ?> Location: <?=$user['location']?><br> <? endif; ?>
    <? if($user['website'] != ""): ?> Website: <?=$user['website']?><br> <? endif; ?>

    <!-- If there exists a connection with this user, show a unfollow link -->
    <? if(isset($connections[$user['user_id']])): ?>
        <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

    <!-- Otherwise, show the follow link -->
    <? else: ?>
        <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
    <? endif; ?>

<?endforeach;?><br><br>

<h2><?=$user['first_name']?> <?=$user['last_name']?>'s Posts</h2>

<?php foreach($posts as $post): ?>

<article>

    <!--<h4><?=$post['first_name']?> <?=$post['last_name']?> posted:</h4>-->

    <p><?=$post['content']?></p>

    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    </time>

</article><br>

<?php endforeach; ?>