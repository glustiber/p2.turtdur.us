	<h2>My Profile</h2>

		<? if($user->profile_pic != ""): ?>
			<div class="profile-pic">
				<img src="<?=$user->profile_pic?>" alt="<?=basename($user->profile_pic)?>" class="profile-image"/>
			</div>
		<? endif; ?>

	<div class="profile-info">

		<br>
		<strong>Name:</strong> <?=$user->first_name?> <?=$user->last_name?><br>
		<strong>E-mail:</strong> <?=$user->email?><br>
		<? if($user->location != ""): ?>
			<strong>Location:</strong> <?=$user->location?><br>
		<? endif; ?>
		<? if($user->website != ""): ?>
			<strong>Website:</strong> <a href="<?=$user->website?>"><?=$user->website?></a><br>
		<? endif; ?><br>

		<a href='/users/editprofile'>Edit Profile</a>

	</div>
<br class="clearme">

<div class="profile-posts">

	<h2>My Posts</h2>

	<? if(empty($posts)): ?>
		You have not made any posts. <a href="/posts/add">Click here</a> to add a post now.
	<? else: ?>

		<a href="/posts/add">Click here</a> to add another post.<br><br>

		<?php foreach($posts as $post): ?>

		<article class="post">

		    <!--<h4><?=$post['first_name']?> <?=$post['last_name']?> posted:</h4>-->

		    <p><?=$post['content']?></p>

		    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
		        <?=Time::display($post['created'])?>
		    </time>

			<p>

				<? if(isset($numlikes[$post['post_id']])): ?>
					<? if($numlikes[$post['post_id']]['num_likes'] == 1): ?>
						<?=$numlikes[$post['post_id']]['num_likes']?> like
					<? else: ?>
						<?=$numlikes[$post['post_id']]['num_likes']?> likes
			    	<? endif; ?>
			    <? else: ?>
			    	0 likes
			    <? endif; ?>
			    
			    <a href="/posts/edit/<?=$post['post_id']?>">Edit</a>
			    <a href="/posts/delete/<?=$post['post_id']?>">Delete</a>

		    </p>

		</article><br>

		<?php endforeach; ?>
	<? endif; ?>

</div>