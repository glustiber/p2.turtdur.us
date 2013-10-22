<h2>All users of <?=APP_NAME?></h2>
<!-- THIS IS DONE IN c_users. Separate display and logic.
<?php
       $users = DB::instance(DB_NAME) -> select_rows('SELECT first_name,last_name,email,location,website FROM users');
?>
-->
<?php foreach($users as $key => $value): ?>
	
	Name: <?=$users[$key]['first_name']?> <?=$users[$key]['last_name']?><br>
	Email: <?=$users[$key]['email']?><br>
	Location: <?=$users[$key]['location']?><br><br>

<?php endforeach; ?>