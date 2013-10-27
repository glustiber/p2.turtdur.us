<?php foreach($posts as $post): ?>

<article class="rounded">

	<h4><a href='/posts/profile/<?=$post['post_user_id']?>'><?=$post['first_name']?> <?=$post['last_name']?></a> posted:</h4>

	<p><?=$post['content']?></p>

	<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	    <?=Time::display($post['created'])?>
	</time>

	<!-- If user already likes a post, show the unlike link 
	<? if(isset($liked[$user->user_id])): ?>
    <a href='/posts/unlike/<?=$user->user_id?>'>unlike</a>
    <!-- Otherwise, show the like link 
    <? else: ?>
        <a href='/posts/like/<?=$user->user_id?>'>like</a>
    <? endif; ?>
-->
</article><br>

<?php endforeach; ?>

