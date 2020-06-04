<?php
  require_once("vendor/autoload.php");
  require_once("includes/functions.php");


  $form_action = "profile.php";
  $id = 0;
  $owner = false;
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(is_logged_in()) {
         $d = new DateTime('NOW');
        //  print_r($_POST);
        //  print_r($_FILES);

         $updateArray = array("photo_updated" => $d);

         upload_file_by_id_update($_FILES, $updateArray, 'user', 'profile_image', (int)$_POST['id']);
    }
  }

  if(isset($_GET['id']) && isValidNumber($_GET['id'])) {
    $profile = DB::queryFirstRow("SELECT * FROM `user` WHERE `id`=%i", (int)$_GET['id']);
    $id = $profile['id'];
  } else if(isset($_GET['id']) && isValidNumber($_GET['id']) && ($_SESSION['id'] == (int)$_GET['id'])) {
    $profile = DB::queryFirstRow("SELECT * FROM `user` WHERE `id`=%i", (int)$_GET['id']);
    $id = $profile['id'];
    $owner = true;
  } else if(isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
    $profile = DB::queryFirstRow("SELECT * FROM `user` WHERE `id`=%i", (int)$_SESSION['id']);
    $id = $_SESSION['id'];
    if($_SESSION['id'] == (int)$profile['id'])
      $owner = true;
  } else {
    $profile = array("username" => "Guest");
    //Reroute, invalid profile.....
  }
  echo $owner;
  //if(isset($_SESSION['id']) && $_SESSION['id'] == (int)$_GET['id'])
  echo $twig->render("profile.html", array("profile" => $profile, "form_action" => $form_action, "owner" => $owner));

?>
