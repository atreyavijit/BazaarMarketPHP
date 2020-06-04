<?php
  require_once('../vendor/autoload.php');
  require_once('../includes/functions.php');

  $form_action = "product_management.php";
  if ($_SERVER['REQUEST_METHOD'] == "GET"){
    if (isset($_GET['delete']) && isValidNumber($_GET['delete']) && is_admin()) {
      DB::delete('product', 'id=%i', (int)$_GET['delete']);
    }

  }
  $products = DB::query('SELECT P.id, P.name, C.name as "category", U.name as "owner", P.price, P.details, P.status FROM `product` as P INNER JOIN category as C ON P.category=C.id INNER JOIN user as U ON P.owner_id=U.id ORDER BY P.`name` ASC');

  echo $twig->render("product_management.html", array("products" => $products));
?>
