<?php
  require_once("vendor/autoload.php");
  require_once("includes/functions.php");


  // $category = DB::query("SELECT * FROM `category` ORDER BY `name` DESC");


  if (isset($_GET['p_id']) && is_numeric($_GET['p_id'])){
		$category =  DB::query("SELECT * FROM category WHERE id=%i", $_GET['p_id']);
		
			//no book was found in database
			header("Location: shop.php");
    }
    

  echo $twig->render("products_list.html", array("category" => $category));

?>
