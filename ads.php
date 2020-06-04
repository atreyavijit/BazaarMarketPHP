<?php
  require_once ("vendor/autoload.php");
  require_once ("includes/functions.php");

  $id = -1;

  if(isValidNumber($_GET['id'])) {
    $products = DB::query('SELECT P.id, P.name, P.category, P.photo, C.name as "category_name", U.name as "owner", P.price, P.details, P.status FROM `product` as P INNER JOIN category as C ON P.category=C.id LEFT OUTER JOIN user as U ON P.owner_id=U.id WHERE P.category=%i ORDER BY P.`id` DESC', $_GET['id']);
    $id = $_GET['id'];
  }

  echo $twig->render("ads.html", array("id" => $id, "products" => $products));
?>
