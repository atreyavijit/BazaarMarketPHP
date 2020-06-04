<?php
  require_once("vendor/autoload.php");
  require_once("includes/functions.php");

   //select the books from our DB

            // $qselect = DB::query("SELECT * FROM books");
            // $counter = DB::count();
  $error = [];
  $form_action = "products_form.php";
  $category = DB::query("SELECT * FROM `category` ORDER BY `name` ASC");

  $verified = false;

  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if((isset($_POST['product_name']) && strlen(trim($_POST['product_name'])) > 0) &&
       (isset($_POST['product_category']) && strlen(trim($_POST['product_category'])) > 0) &&
       (isset($_POST['product_price']) && strlen(trim($_POST['product_price'])) > 0 && is_numeric($_POST['product_price'])) &&
       (isset($_POST['product_details']) && strlen(trim($_POST['product_details'])) > 0) &&
       (is_logged_in())) {

         $category = DB::query("SELECT * FROM `category` ORDER BY `name` ASC");

         foreach($category as $key => $value) {
           if($_POST['product_category'] == $category[$key]["id"]) {
             //array_splice($category, $key, 1);
             //$message = "Category '" . $category[$key]["name"] . "' has been deleted.";
             //DB::delete('category', 'slug=%s', $_POST['category']);
             //Header("Location: ".$form_action);
             $insert = array("name"=>$_POST['product_name'], "category"=>$_POST['product_category'], "owner_id" => $_SESSION['id'], "price" => $_POST['product_price'], "details" => $_POST['product_details']);
             $verified = true;
             break;
           }
         }


         if($verified == true) {
           //print_r($_POST);
           //print_r($_FILES);

           upload_file($_FILES, $insert, 'product', 'product_image');
        }
    }
	else 
	{
		if(isset($_POST['product_name']) && $_POST['product_name'] == "") 
		{
			$error[] = "Product name has nothing";
		}
		if(isset($_POST['product_category']) && $_POST['product_category'] == "") 
		{
			$error[] = "You have to choose a category";
		}
		if(isset($_POST['product_price']) && ($_POST['product_price'] == "" || !is_numeric($_POST['product_price']))) 
		{
			$error[] = "You must specify a price for your product and it must be numeric";
		}
		if(isset($_POST['product_details']) && $_POST['product_details'] == "") 
		{
			$error[] = "Product details is required";
		}
	}
	
  }
  echo $twig->render("products_form.html", array("category" => $category, "form_action" => $form_action, "messages"=>$error));

?>
