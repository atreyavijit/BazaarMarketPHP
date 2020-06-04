<?php
  include("../vendor/autoload.php");
  include('../includes/functions.php');
  if(is_admin())
  {
	  $feedbacks = DB::query("select * from feedback");
  }
  else
  {
	  header("Location: ../logout.php");
  }

  echo $twig->render("view_feedback.html", array("feedbacks" => $feedbacks));
?>
