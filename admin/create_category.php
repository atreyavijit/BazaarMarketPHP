<?php
  require_once('../vendor/autoload.php');
  require_once('../includes/functions.php');
  if(!is_admin())
	 header("location:/logout.php");
  
  $form_action = "create_category.php";
  $error = [];
  $success = [];

  
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if((isset($_POST['category']) && strlen(trim($_POST['category'])) > 0) &&
       (isset($_POST['category_slug']) && strlen(trim($_POST['category_slug'])) > 0)) {
		 $categories = DB::query("SELECT * FROM `category` WHERE name=%s",$_POST['category']);
		 if(DB::count()>0)
		 {
			 $error[] = "Category '" . $_POST['category'] . "' already exists.";
		 }
		 else
		 {
			 $insert = array("name" => $_POST['category'], "slug" => $_POST['category_slug'], "description" => $_POST['category_desc']);
			 DB::insert('category', $insert);
			 $success[] = "Category '" . $_POST['category'] . "' has been created.";
			 //Header("Location: create_category.php");
		 }
			 
		 
    }
	else if($_POST['category'] == "")
	{
		$error[] = "'Category name' is required";
	}
	if($_POST['category_slug'] == "")
	{
		$error[] = "'Category slug' is required";
	}
  }
  $category = DB::query("SELECT * FROM `category` ORDER BY `name` ASC");

  echo $twig->render("create_category.html", array("category" => $category, "form_action" => $form_action,"messages"=>$error,"success"=>$success));
?>
