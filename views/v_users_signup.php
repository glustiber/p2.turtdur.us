<h2>Sign Up</h2>

<p>Please fill out the information below to sign up.</p><br>

<?php if(isset($error)): ?>
    <div class='error'>
        There is already an account associated with that email address. Please try again.
    </div>
    <br>
<?php endif; ?>

<form method='POST' action='/users/p_signup' id='signUp'>

    First Name:<br>
    <input type='text' name='first_name' class='required'>
    <br><br>

    Last Name:<br>
    <input type='text' name='last_name' class='required'>
    <br><br>

    E-mail:<br>
    <input type='text' name='email' class='required email'>
    <br><br>

    Password:<br>
    <input type='password' name='password' class='required'>
    <br><br>

    <input type='hidden' name='timezone'>

    <script>
        $('input[name=timezone]').val(jstz.determine().name());
    </script>   

    <input type='submit' value='Sign up'>

</form>