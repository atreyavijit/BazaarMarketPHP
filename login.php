<?php
  //SEND ALL $_POST REQUESTS HERE FROM LOGIN
  require_once ("vendor/autoload.php");
  require_once ("includes/functions.php");


  if(is_logged_in()) {
	  
    Header("Location: products_list.php");
  }
  $error = "";
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $log->info('Login Attempt');
    //pr($_POST);
    //form submitted
    if(isset($_POST['email']) && $_POST['email']== ""){
        //uname has nothing
        $error = "Please supply a username.";
    } else if(isset($_POST['password']) && $_POST['password']== ""){
        //psw has nothing
        $error = "Please supply a password.";
    }
    $results = DB::queryFirstRow("SELECT `id`, `name`, `type`, `password` FROM `user` WHERE `email` = %s LIMIT 1", $_POST['email']);
    $count = DB::count();
    if($count == 0) {
      $log->info('No user has been found');
      $error =  "Username does not exist.";
    //} else if($query->num_rows>1){
    } else if($count > 1) {
      //echo "Multiple users<br>";
    } else {
      $log->info("User with email '".$_POST['email']."' as attempting to login.");
      if(password_verify($_POST['password'], $results['password'])) {
        DB::update('user', array('last_login'=>new DateTime("now")), 'id=%i', (int)$results['id']);
        if(DB::affectedRows() !=1){//number of rows altered by query // $query_update->affected_rows
          //echo "Didn't work";
        }
        $_SESSION['id'] = $results['id'];
        $_SESSION['username'] = $results['username'];
        $_SESSION['name'] = $results['name'];
        $_SESSION['type'] = $results['type'];
        //redirect users on successful login
        header("location: index.php");
      } else {
        $error = "Password is invalid";
      }
    }
  }

echo $twig->render("login_form.html",
            array(
              "form_action" => $_SERVER['PHP_SELF'],
              "error" => $error) );

?>
