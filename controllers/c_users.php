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
        $client_files_head = Array('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js','http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js','/js/validate-signup.js','/js/jstz.min.js');
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
        $this->template->title = "Profile of ".$this->user->first_name;
        /*
        #  Set client files that need to load in the <head>
        $client_files_head = Array('/js/edit-profile.js');
        $this->template->client_files_head = Utils::load_client_files($client_files_head);
        
        # Set client files that need to load before the closing </body> tag
        $client_files_body = Array('/js/edit-profile.js');
        $this->template->client_files_body = Utils::load_client_files($client_files_body);
        */
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

        # Sanitize the user entered data
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Filter post, create new array with only submitted fields
        $data = array_filter($_POST);

        # If password was updated, encrypt it
        if(isset($data['password'])) {
            $data['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        }

        # Set time modified to now
        $data['modified'] = Time::now();

        # Update
        DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");

        # Redirect to profile.
        Router::redirect("/users/profile");

    }
    /*
    public function viewall() {
        
        $users = DB::instance(DB_NAME) -> select_rows('SELECT first_name,last_name,email,location,website FROM users');

        # Setup view
        $this->template->content = View::instance('v_users_viewall');
        $this->template->title   = "All users";

        # Render template
        echo $this->template;
    }

    public function viewprofile() {
        # Setup view
        $this->template->content = View::instance('v_users_viewprofile');
        $this->template->title   = "View Profile";

        # Query
        $q = "SELECT 
                posts.content AS content,
                posts.user_id AS post_user_id,
                posts.created AS created,
                users_users.user_id AS follower_id,
                users.first_name,
                users.last_name
            FROM posts
            INNER JOIN users_users
            INNER JOIN users ON posts.user_id = users.user_id
            WHERE users_users.user_id != 1
            AND posts.user_id = users_users.user_id_followed
            ORDER BY posts.created DESC";

        # Run the query, store the results in the variable $posts
        $posts = DB::instance(DB_NAME)->select_rows($q);

        # Pass data to the View
        $this->template->content->posts = $posts;

        # Render template
        echo $this->template;
    }
    */
} # end of the class

?>