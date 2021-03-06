<?php

class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();

        # Make sure user is logged in if they want to use anything in this controller
        if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
    }

    public function index() {

    # Set up the View
    $this->template->content = View::instance('v_posts_index');
    $this->template->title   = "poststream";

    $q = "SELECT 
            posts.content,
            posts.created,
            posts.post_id AS post_id,
            posts.user_id AS post_user_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name,
            users.profile_pic
        FROM posts
        INNER JOIN users_users 
            ON posts.user_id = users_users.user_id_followed
        INNER JOIN users 
            ON posts.user_id = users.user_id
        WHERE users_users.user_id = '".$this->user->user_id."'
        ORDER BY posts.created DESC";  

    # Run the query, store the results in the variable $posts
    $posts = DB::instance(DB_NAME)->select_rows($q);

    # Pass data to the View
    $this->template->content->posts = $posts;

    # figure out which posts this user already likes
    $q = "SELECT *
        FROM posts_users
        WHERE user_id = ".$this->user->user_id;

    $likes = DB::instance(DB_NAME)->select_array($q, 'post_id_liked');
/*
    echo '<pre>';
    print_r($likes);
    echo '</pre>';
*/
    $this->template->content->likes = $likes;

    # figure out how many likes each post has
    $q = "SELECT post_id_liked, 
            COUNT(*) AS num_likes
        FROM posts_users GROUP BY post_id_liked";

    # $numlikes = DB::instance(DB_NAME)->select_rows($q);
    $numlikes = DB::instance(DB_NAME)->select_array($q, 'post_id_liked');

    $this->template->content->numlikes = $numlikes;
/*
    echo '<pre>';
    print_r($numlikes);
    echo '</pre>';
*/
    # Render the View
    echo $this->template;

    }

    public function add() {

        # Setup view
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "New Post";

        # Render template
        echo $this->template;

    }

    public function p_add() {

        # Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Insert
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
        DB::instance(DB_NAME)->insert('posts', $_POST);

        # Redirect to profile.
        Router::redirect("/users/profile");

    }

    public function edit($post_id) {

        # Setup view
        $this->template->content = View::instance('v_posts_edit');
        $this->template->title   = "Edit Post";

        $q = "SELECT content, user_id, post_id
            FROM posts
            WHERE post_id = ".$post_id;

        $post_data = DB::instance(DB_NAME)->select_row($q);

        # make sure users are only editing their own posts & aren't trying to edit other peoples' posts
        if($post_data['user_id'] == $this->user->user_id) {

            # pass the post data to the view
            $this->template->content->post_data = $post_data;

            # Render template
            echo $this->template;

        }
        else {
            Router::redirect("/");
        }

    }

    public function p_edit($user_id, $post_id) {

        # Unix timestamp of when this post was created / modified
        $_POST['modified'] = Time::now();

        # make sure users are only editing their own posts & aren't trying to edit other peoples' posts
        # this might be unnecessary in p_edit???
        if($user_id == $this->user->user_id) {
            # Update
            DB::instance(DB_NAME)->update("posts", $_POST, "WHERE post_id = '".$post_id."'");
        }

        # Redirect to profile.
        Router::redirect("/users/profile");

    }

    public function users() {

    # Set up the View
    $this->template->content = View::instance("v_posts_users");
    $this->template->title   = "Users";

    # Build the query to get all the users
    $q = "SELECT *
        FROM users
        WHERE user_id != ".$this->user->user_id;

    # Execute the query to get all the users. 
    # Store the result array in the variable $users
    $users = DB::instance(DB_NAME)->select_rows($q);

    # Build the query to figure out what connections does this user already have? 
    # I.e. who are they following
    $q = "SELECT * 
        FROM users_users
        WHERE user_id = ".$this->user->user_id;

    # Execute this query with the select_array method
    # select_array will return our results in an array and use the "users_id_followed" field as the index.
    # This will come in handy when we get to the view
    # Store our results (an array) in the variable $connections
    $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

    # Pass data (users and connections) to the view
    $this->template->content->users       = $users;
    $this->template->content->connections = $connections;

    # Render the view
    echo $this->template;
    }

    public function follow($user_id_followed) {

    # Prepare the data array to be inserted
    $data = Array(
        "created" => Time::now(),
        "user_id" => $this->user->user_id,
        "user_id_followed" => $user_id_followed
        );

    # Do the insert
    DB::instance(DB_NAME)->insert('users_users', $data);

    # Send them back
    Router::redirect("/posts/users");

    }

    public function unfollow($user_id_followed) {

        # Delete this connection
        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
        DB::instance(DB_NAME)->delete('users_users', $where_condition);

        # Send them back
        Router::redirect("/posts/users");

    }

    public function like($post_id_liked) {
        $data = Array(
            "created" => Time::now(),
            "user_id" => $this->user->user_id,
            "post_id_liked" => $post_id_liked
            );
        DB::instance(DB_NAME)->insert('posts_users', $data);
        Router::redirect("/posts");
    }

    public function unlike($post_id_liked) {
        $where = 'WHERE user_id = '.$this->user->user_id.' AND post_id_liked = '.$post_id_liked;
        DB::instance(DB_NAME)->delete('posts_users', $where);
        Router::redirect("/posts");
    }

    public function profile($user_id) {

        $this->template->content = View::instance("v_posts_profile");
        $this->template->title   = "Profile";
/*
        $user_details = DB::instance(DB_NAME)->select_row("SELECT * FROM users WHERE user_id = '".$user_id"'");

        print_r($user_details);
        */

        $q = "SELECT *
            FROM users
            WHERE user_id = ".$user_id;

        $user_details = DB::instance(DB_NAME)->select_rows($q);
/*
        print_r($user_details);
*/
        $this->template->content->users = $user_details;

        $q = "SELECT * 
            FROM users_users
            WHERE user_id = ".$this->user->user_id;

        $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

        $this->template->content->connections = $connections;

        $q = "SELECT *
            FROM posts
            WHERE user_id = '".$user_id."'
            ORDER BY created DESC";

        # Run the query, store the results in the variable $posts
        $posts = DB::instance(DB_NAME)->select_rows($q);

        # Pass data to the View
        $this->template->content->posts = $posts;

        echo $this->template;

    }

    public function delete($post_id) {

        # Delete this connection
        $where_condition = 'WHERE post_id = '.$post_id;
        DB::instance(DB_NAME)->delete('posts', $where_condition);

        # Send them back
        Router::redirect("/users/profile");

    }

} # end of class

?>