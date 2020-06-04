<?php
  require_once('../vendor/autoload.php');
  require_once('../includes/functions.php');
  if(!is_admin())
	 header("location:/logout.php");
 
  $form_action = "remove_category.php";
  $category = DB::query("SELECT * FROM `category` ORDER BY `name` ASC");
  $error = [];
  $success = [];
 
  if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['category']) && strlen(trim($_POST['category'])) > 0) {
      $deleted = false;
      
        foreach($category as $key => $value) {
          //echo $_POST['category'] . " vs " . $category[$key]["slug"];
          if($_POST['category'] == $category[$key]["slug"]) {
            $success[] = "Category '" . $category[$key]["name"] . "' has been deleted.";
			array_splice($category, $key, 1);
            
            DB::delete('category', 'slug=%s', $_POST['category']);
            //Header("Location: ".$form_action);
            $deleted = true;
            break;
          }
        }
		if($deleted == false) {
			$error[] = " The category you specified doesn't exist.";
		}
	  
    }
  }
  
	  

  echo $twig->render("remove_category.html", array("category" => $category, "form_action" => $form_action, "messages" => $error, "success" => $success));
?>
