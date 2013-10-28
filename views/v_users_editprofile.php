<form method='POST' action='/users/p_editprofile' enctype="multipart/form-data">

<div class="left">
    First Name<br>
    <input type='text' name='first_name' placeholder="<?=$user->first_name?>">
    <br><br>

    Last Name<br>
    <input type='text' name='last_name' placeholder="<?=$user->last_name?>">
    <br><br>

    Email<br>
    <input type='text' name='email' placeholder="<?=$user->email?>">
    <br><br>

    Password<br>
    <input type='password' name='password'>
    <br><br>

    Location<br>
    <input type='text' name='location' placeholder="<?=$user->location?>">
    <br><br>

    Website<br>
    <input type='url' name='website' placeholder="<?=$user->website?>">
    <br><br>

    Gender<br><br>
</div>

    Profile picture<br>
    <? if($user->profile_pic != ""): ?>
        <img src="<?=$user->profile_pic?>" alt="<?=basename($user->profile_pic)?>" /><br>
    <? endif; ?>
    <input type="file" name="profile_pic" />
    <br><br>

    <input type='submit' value='Update Profile'>

</form>