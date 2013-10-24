<?php foreach($posts as $post): ?>

<article class="rounded">

    <h4><?=$post['first_name']?> <?=$post['last_name']?> posted:</h4>

    <p><?=$post['content']?></p>

    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    </time>

</article><br>

<?php endforeach; ?>
