<form method='POST' action='/users/p_editprofile'>
<!--
    First Name<br>
    <input type='text' name='first_name' value="<?=$user->first_name?>">
    <br><br>

    Last Name<br>
    <input type='text' name='last_name' value="<?=$user->last_name?>">
    <br><br>

    Email<br>
    <input type='text' name='email' value="<?=$user->email?>">
    <br><br>

    Password<br>
    <input type='password' name='password' value="<?=$user->password?>">
    <br><br>
-->
    Name:       <?=$user->first_name?> <?=$user->last_name?><br>
    E-mail:     <?=$user->email?><br>

    Location<br>
    <input type='text' name='location' value="<?=$user->location?>">
    <br><br>

    Website<br>
    <input type='url' name='website' value="<?=$user->website?>">
    <br><br>

    Bio<br>
    <input type='text' name='bio' value="<?=$user->bio?>">
    <br><br>

    <input type='submit' value='Edit Profile'>

</form>