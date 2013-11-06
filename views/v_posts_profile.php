<? foreach($users as $user): ?>  

    <h2><?=$user['first_name']?> <?=$user['last_name']?>'s Profile</h2> 

    <? if($user['profile_pic'] != ""): ?>
        <div class="profile-pic">
            <img src="<?=$user['profile_pic']?>" alt="<?=basename($user['profile_pic'])?>" class="profile-image"/>
        </div>
    <? endif; ?>

    <div class="profile-info">
        Name: <?=$user['first_name']?> <?=$user['last_name']?><br>
        E-mail: <?=$user['email']?><br>
        <? if($user['location'] != ""): ?> Location: <?=$user['location']?><br> <? endif; ?>
        <? if($user['website'] != ""): ?> Website: <?=$user['website']?><br> <? endif; ?>
        <!--
        <? if(isset($connections[$user['user_id']])): ?>
            <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
        <? else: ?>
            <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
        <? endif; ?> -->
    </div>
<br class="clearme">
<?endforeach;?>

<h2><?=$user['first_name']?> <?=$user['last_name']?>'s Posts</h2>

<? if(empty($posts)): ?>
    <?=$user['first_name']?> <?=$user['last_name']?> has not yet made any posts.
<? else: ?>

    <?php foreach($posts as $post): ?>

    <article class="post">

        <!--<h4><?=$post['first_name']?> <?=$post['last_name']?> posted:</h4>-->

        <p><?=$post['content']?></p>

        <? if(isset($numlikes[$post['post_id']])): ?>
            <? if($numlikes[$post['post_id']]['num_likes'] == 1): ?>
                <?=$numlikes[$post['post_id']]['num_likes']?> like
            <? else: ?>
                <?=$numlikes[$post['post_id']]['num_likes']?> likes
            <? endif; ?>
        <? else: ?>
            0 likes
        <? endif; ?>&#149

        <?=Time::display($post['created'],'m/d/Y')?> &#149
        <?=Time::display($post['created'],'g:i a')?>

    </article><br>

    <?php endforeach; ?>
<? endif; ?>