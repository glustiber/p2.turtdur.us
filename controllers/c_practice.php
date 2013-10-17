<?php
class practice_controller extends base_controller {

	public function test1() {
		require(APP_PATH."/libraries/Image.php");
		/*
		Instantiate an Image object using the "new" keyword
		Whatever params we use when instantiating are passed to __construct 
		*/
		$imageObj = new Image('http://placekitten.com/500/500');

		/*
		Call the resize method on this object using the object operator (single arrow ->) 
		which is used to access methods and properties of an object
		*/
		$imageObj->resize(200,200);

		# Display the resized image
		$imageObj->display();

	}

	public function test2() {
		echo Time::now();
	}

	# Add row to users
	public function test3() {
		# Our SQL command
		$q = "INSERT INTO users SET 
    	first_name = 'Sam', 
    	last_name = 'Seaborn',
    	email = 'seaborn@whitehouse.gov'";

		# Run the command
		echo DB::instance(p2_turtdur_us)->query($q);
	}

	# Update row
	public function test4() {
		# Our SQL command
		$q = "UPDATE users
    	SET email = 'samseaborn@whitehouse.gov'
    	WHERE email = 'seaborn@whitehouse.gov'";

		# Run the command
		echo DB::instance(p2_turtdur_us)->query($q);
	}

	# Delete row
	public function test5() {
		# Our SQL command
		$q = "DELETE FROM users
    	WHERE email = 'seaborn@whitehouse.gov'";

		# Run the command
		echo DB::instance(p2_turtdur_us)->query($q);
	}

	public function test6() {
		$data = Array(
    	'first_name' => 'Dirk', 
    	'last_name' = 'Cutter', 
    	'email' => 'dirkcutter@whitehouse.gov');

		/*
		Insert requires 2 params
		1) The table to insert to
		2) An array of data to enter where key = field name and value = field data
		The insert method returns the id of the row that was created
		*/
		$user_id = DB::instance(p2_turtdur_us)->insert('users', $data);

		echo 'Inserted a new row; resulting id:'.$user_id;
	}

}
?>