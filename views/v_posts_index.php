	<h2>poststream:</h2>

	<?php if(empty($posts)): ?>
		<h3><a href="/posts/users">Click here</a> to follow users and add them to your post stream.</h3>
	<?php else: ?>	

	<?php foreach($posts as $post): ?>

	<article class="post">

	<!--<div class="post-avatar"><img src="http://placekitten.com/300/300"></div>-->

		<? if($post['profile_pic'] != ""): ?>
			<div class="post-avatar">	
				<img src="<?=$post['profile_pic']?>" alt="<?=basename($post['profile_pic'])?>">
		</div>

		<? endif; ?>

		<h4><a href='/posts/profile/<?=$post['post_user_id']?>'><?=$post['first_name']?> <?=$post['last_name']?></a>: </h4>

		<p class="content"><?=$post['content']?></p>

		<div class="time-likes">

			<? if(isset($numlikes[$post['post_id']])): ?>
				<? if($numlikes[$post['post_id']]['num_likes'] == 1): ?>
					<?=$numlikes[$post['post_id']]['num_likes']?> like
				<? else: ?>
					<?=$numlikes[$post['post_id']]['num_likes']?> likes
		    	<? endif; ?>
		    <? else: ?>
		    	0 likes
		    <? endif; ?>&#149

			<!-- If user already likes a post, show the unlike link -->
			<? if(isset($likes[$post['post_id']])): ?>
		    	<a href='/posts/unlike/<?=$post['post_id']?>'>unlike</a>
		    <!-- Otherwise, show the like link -->
		    <? else: ?>
		        <a href='/posts/like/<?=$post['post_id']?>'>like</a>
		    <? endif; ?>&#149

			<!--<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
			    <?=Time::display($post['created'],'m/d/Y g:i a')?>
			</time>-->
			<?=Time::display($post['created'],'m/d/Y')?> &#149
			<?=Time::display($post['created'],'g:i a')?>
		</div>
	<br class="clearme">
	</article><br>

	<?php endforeach; ?>

	<?php endif; ?>
