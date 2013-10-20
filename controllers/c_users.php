<?php

# Define a class called nameofclass_controller

class users_controller extends base_controller {

# Each of these functions is one of our methods.
    
    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {

        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";

        #  Set client files that need to load in the <head>
        $client_files_head = Array('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js','http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js','/js/validate-signup.js');
        $this->template->client_files_head = Utils::load_client_files($client_files_head);

        # Render template
        echo $this->template;
    }

    public function p_signup() {

        # More data we want stored with the user
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Encrypt the password  
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

        # Create an encrypted token via their email address and a random string
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

        # Insert this user into the database 
        $user_id = DB::instance(DB_NAME)->insert("users", $_POST);

        # After user signs up, send them to the login page.
        Router::redirect("/users/login");

    }

    public function login($error = NULL) {
        # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";
        $this->template->content->error = $error;

        #  Set client files that need to load in the <head>
        $client_files_head = Array('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js','http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js','/js/validate-login.js');
        $this->template->client_files_head = Utils::load_client_files($client_files_head);

        # Render template
        echo $this->template;
    }

    public function p_login() {
        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
        $q = "SELECT token 
        FROM users 
        WHERE email = '".$_POST['email']."' 
        AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

       # Login failed
        if(!$token) {
            # Note the addition of the parameter "error"
            Router::redirect("/users/login/error"); 
        }
        # Login passed
        else {
            setcookie("token", $token, strtotime('+2 weeks'), '/');
            Router::redirect("/");
        }
    }

    public function logout() {
        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
        Router::redirect("/");
    }

    public function profile($user_name = NULL) {

        # If user is blank, they're not logged in; redirect them to the login page
        if(!$this->user) {
            Router::redirect('/users/login');
        }

        # If they weren't redirected away, continue:

        /*
        If you look at _v_template you'll see it prints a $content variable in the <body>
        Knowing that, let's pass our v_users_profile.php view fragment to $content so 
        it's printed in the <body>
        */
        $this->template->content = View::instance('v_users_profile');

        # $title is another variable used in _v_template to set the <title> of the page
        $this->template->title = "Profile of".$this->user->first_name;

        #  Set client files that need to load in the <head>
        $client_files_head = Array('/css/sample-app.css');
        $this->template->client_files_head = Utils::load_client_files($client_files_head);

        # Set client files that need to load before the closing </body> tag
        $client_files_body = Array('/js/sample-app.js');
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Render View
        echo $this->template;
    }

    public function editprofile() {
        # Setup view
        $this->template->content = View::instance('v_users_editprofile');
        $this->template->title   = "Edit Profile";

        # Render template
        echo $this->template;
    }

    public function p_editprofile() {
        /*
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        */

        
        # More data we want stored with the user
        $_POST['modified'] = Time::now();


        # Insert this user into the database 
        DB::instance(DB_NAME)->update("users", $_POST, "WHERE user_id = '".$user_id."'");

        # For now, just confirm they've signed up - 
        # You should eventually make a proper View for this
        echo 'Profile updated';

    }

} # end of the class

?>