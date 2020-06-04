<?php

error_reporting(E_ALL); //FOR TESTING PUROSES

ini_set('display_errors', 'on'); //SHOWS ALL 500+ ERRORS
include('vendor/autoload.php');
include('includes/functions.php');
$error = [];
$form_action = "register.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  DB::queryFirstRow("SELECT `username` FROM `user` WHERE `username`=%s", $_POST['username']);
	if(DB::count()==1)
	{
		$error[] = "The username you specified is already taken.";
	}

	DB::queryFirstRow("SELECT `email` FROM `user` WHERE `email`=%s", $_POST['email']);
	if(DB::count()==1)
	{
		$error[] = "The email you specified already exists in database.";
	}

	$hashedPassword = "";
    $log->info("[REGISTER.php] Email '".$_POST['email']."' has not been taken yet!");

	if(isset($_POST['full_name']) && $_POST['full_name'] == "")
	{
		$error[] = "Full Name has nothing";
	}
	if(isset($_POST['username']) && $_POST['username'] == "")
	{
		$error[] = "Username has nothing";
	}
	if(isset($_POST['email']) && $_POST['email'] == "")
	{
		$error[] = "Email has nothing";
	}
	if(isset($_POST['email_confirm']) && $_POST['email_confirm'] == "")
	{
		$error[] = "You didn't confirm email";
	}
	if(isset($_POST['password']) && $_POST['password'] == "")
	{
		$error[] = "Password has nothing";
	}
	if(isset($_POST['password_confirm']) && $_POST['password_confirm'] == "")
	{
		$error[] = "You didn't confirm password";
	}
	if(isset($_POST['email']) && isset($_POST['email_confirm']) && $_POST['email'] != "" && $_POST['email_confirm'] != "" && $_POST['email'] != $_POST['email_confirm'])
	{
		$error[] = "Emails don't match";
	}
	if(isset($_POST['password']) && isset($_POST['password_confirm']) && $_POST['password'] != "" && $_POST['password_confirm'] != "" && $_POST['password'] != $_POST['password_confirm'])
	{
		$error[] = "Passwords don't match";
	}
	if(sizeof($error) == 0)
	{
        //Process our registration since we have no errors
        $options = [
            'cost' => 12,
        ];
        $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT, $options); //Hashed password using BCRYPT with a length of 60 characters
        DB::query("INSERT INTO `user`(`name`,`email`,`username`,`password`)".
                  "VALUES('".$_POST['full_name']."','".$_POST['email']."','".$_POST['username']."','".$hashedPassword."')");
        $log->info("[REGISTER.php] Email '".$_POST['email']."' has been registered and inserted into the database!");
		$results = DB::queryFirstRow("SELECT `id`, `name`, `type`, `password` FROM `user` WHERE `email` = %s LIMIT 1", $_POST['email']);
		if(DB::count()==1)
		{
			DB::update('user', array('last_login'=>new DateTime("now")), 'id=%i', (int)$results['id']); //update last login for this user
			$_SESSION['id'] = $results['id'];
			$_SESSION['username'] = $results['username'];
			$_SESSION['name'] = $results['name'];
			$_SESSION['type'] = $results['type'];
			Header("Location:index.php");
		}
		else
		{
			$error[] = "Can't login";
		}
	}

}
echo $twig->render("register_form.html", array("messages"=>$error, "post"=>$_POST,"form_action"=>$form_action));
?>
