<?php foreach($posts as $post): ?>

<article class="rounded">

	<h4><a href='/posts/profile/<?=$post['post_user_id']?>'><?=$post['first_name']?> <?=$post['last_name']?></a> posted:</h4>

	<p><?=$post['content']?></p>

	<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	    <?=Time::display($post['created'])?><br><br>
	</time>
<!--
	<p><?=$post['post_id']?></p>
	<p><?=$liked?></p>
-->

	<? if(isset($numlikes[$post['post_id']])): ?>
		<? if($numlikes[$post['post_id']]['num_likes'] == 1): ?>
			<?=$numlikes[$post['post_id']]['num_likes']?> like
		<? else: ?>
			<?=$numlikes[$post['post_id']]['num_likes']?> likes
    	<? endif; ?>
    <? else: ?>
    	0 likes
    <? endif; ?>

	<!-- If user already likes a post, show the unlike link -->
	<? if(isset($likes[$post['post_id']])): ?>
    	<a href='/posts/unlike/<?=$post['post_id']?>'>unlike</a>
    <!-- Otherwise, show the like link -->
    <? else: ?>
        <a href='/posts/like/<?=$post['post_id']?>'>like</a>
    <? endif; ?>

</article><br>

<?php endforeach; ?>

