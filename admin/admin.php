<?php
  //$funcDir = dirname($_SERVER["DOCUMENT_ROOT"])."/BazaarMarket/includes/functions.php";
  include("../vendor/autoload.php");
  include('../includes/functions.php');

  if(!is_admin())
    Header("Location: /login.php");

  //include('../pages/admin_nav.php');
  if ($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET['delete']) && isValidNumber($_GET['delete']) && is_admin()) {
      DB::delete('user', 'id=%i', (int)$_GET['delete']);
    }
  }

  //DB::debugMode(); // echo out each SQL command being run, and the runtime

  $users = DB::query("SELECT * FROM `user`");


  echo $twig->render("admin_home.html", array("users" => $users));
?>
