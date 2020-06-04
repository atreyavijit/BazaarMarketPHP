<?php
  include("../vendor/autoload.php");
  include('../includes/functions.php');
  if(is_admin())
  {
	  $reports = DB::query("select * from reports");
  }
  else
  {
	  header("Location: ../logout.php");
  }

  echo $twig->render("view_reports.html", array("reports" => $reports));
?>
