<?php
  require_once ("vendor/autoload.php");
  require_once ("includes/functions.php");

  $id = -1;

  if(isValidNumber($_GET['id'])) {
    $id = (int)$_GET['id'];

    $listing = DB::queryFirstRow("SELECT U.email, U.id as 'uid', P.id, P.name, P.category, P.photo, C.name as 'category_name', U.name as 'owner', P.price, P.details, P.status FROM `product` as P INNER JOIN `category` as C ON P.category=C.id INNER JOIN `user` as U ON P.owner_id=U.id WHERE P.id=%i", (int)$_GET['id']);
  } else {

  }

  echo $twig->render("listing.html", array("id" => $id, "listing" => $listing));
?>
