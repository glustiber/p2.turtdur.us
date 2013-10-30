<h2>posts of people you are following:</h2>

<?php foreach($posts as $post): ?>

<article class="post">

	<? if($post['profile_pic'] != ""): ?>
		<div class="post-avatar">	
			<img src="<?=$post['profile_pic']?>" alt="<?=basename($post['profile_pic'])?>">
		</div>

	<? endif; ?>

	<h4><a href='/posts/profile/<?=$post['post_user_id']?>'><?=$post['first_name']?> <?=$post['last_name']?></a>: </h4>

	<p><?=$post['content']?></p>

	<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	    <?=Time::display($post['created'])?><br>
	</time>

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
<br class="clearme">
</article><br>

<?php endforeach; ?>

