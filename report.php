<?php
require_once("vendor/autoload.php");
require_once("includes/functions.php");

if(!is_logged_in())
  header("Location:logout.php");
if(isset($_GET['id']) && $_GET['id']=="")
	header("location:index.php");
$error = [];
$form_action = "report.php";
$verified = false;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['reporter']) && $_POST['reporter'] == "") 
		{
			$error[] = "The reporter is unbdefined";
		}
	if(isset($_POST['reported']) && $_POST['reported'] == "") 
		{
			$error[] = "No user to be reported";
		}
	if(isset($_POST['report']) && $_POST['report'] == "") 
		{
			$error[] = "You have to write a detail for reporting the user";
		}
	if(sizeof($error)==0)
	{
		DB::insert('reports', array('reporter' => $_POST['reporter'],'reported' => $_POST['reported'],'report'=>$_POST['report'],'datetime'=>new DateTime("now")));
	}
}



echo $twig->render("report_form.html", array("form_action" => $form_action, "messages"=>$error,"session"=>$_SESSION,"get"=>$_GET));

?>
