<?php
  include('vendor/autoload.php');
  include('includes/functions.php');
  
  $error = [];
  $success = [];
  $form_action = "contact.php";
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['c_name']) && $_POST['c_name']=="")
	{
		$error[] = "Name field has nothing";
	}
	if(isset($_POST['c_email']) && $_POST['c_email']=="") 
	{
		$error[] = "Email Field has nothing";
	}
	if(isset($_POST['c_subject']) && $_POST['c_subject']=="") 
	{
		$error[] = "Subject Field has nothing";
	}
	if(isset($_POST['c_message']) && $_POST['c_message']=="") 
	{
		$error[] = "Message Field has nothing";
	}
	if(sizeof($error) == 0)
	{		
		DB::insert('feedback', array('name' => $_POST['c_name'], 'email' => $_POST['c_email'], 'subject' => $_POST['c_subject'], 'message' => $_POST['c_message']));
		$success[] = "Your Feedback has been sent. Thank You.";
	}
  }
  

  echo $twig->render("contact_form.html",array("messages" => $error, "success"=>$success, "form_action" => $form_action,"post"=>$_POST));
?>