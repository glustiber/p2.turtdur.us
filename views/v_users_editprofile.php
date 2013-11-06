<h2>Edit Profile</h2>

<form method='POST' action='/users/p_editprofile' enctype="multipart/form-data" id="editProfile">

<div class="left">
    First Name:<br>
    <input type='text' name='first_name' placeholder="<?=$user->first_name?>">
    <br><br>

    Last Name:<br>
    <input type='text' name='last_name' placeholder="<?=$user->last_name?>">
    <br><br>

    E-mail:<br>
    <input type='text' name='email' placeholder="<?=$user->email?>" class="email">
    <br><br>

    Password:<br>
    <input type='password' name='password'>
    <br><br>
</div>
<div class="right">
    Location:<br>
    <input type='text' name='location' placeholder="<?=$user->location?>">
    <br><br>

    Website:<br>
    <input type='url' name='website' placeholder="<?=$user->website?>">
    <br><br>

    Profile picture:<br>
<!--    <? if($user->profile_pic != ""): ?>
        <div class="profile-pic"><img src="<?=$user->profile_pic?>" alt="<?=basename($user->profile_pic)?>" /><br></div>
    <? endif; ?>-->
    <input type="file" name="profile_pic" />
    <br><br>
</div>
<br class="clearme">
    <input type='submit' value='Update Profile'>
<br class="clearme">
</form>
