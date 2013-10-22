<form method='POST' action='/users/p_editprofile'>

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

    Profile picture<br>
    Age<br>
    Gender<br><br>

    <input type='submit' value='Update'>

</form>