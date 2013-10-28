<form method='POST' action='/posts/p_edit/<?=$post_data['user_id']?>/<?=$post_data['post_id']?>'>

    <label for='content'>Edit Post:</label><br>
    <textarea name='content' id='content'><?=$post_data['content']?></textarea>

    <br><br>
    <input type='submit' value='Edit post'>

</form> 