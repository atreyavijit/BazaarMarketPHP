<?php
	require_once("vendor/autoload.php");
	require_once("includes/functions.php");
	//TODO - only allow logged in users to view page

	if(!is_logged_in())
		Header("login.php");

	$sender = 0;
	$receiver = 0;
	echo $_SESSION['id'];
	if(is_numeric($_SESSION['id']) && $_SESSION['id'] > 0 && isset($_SESSION['id'])) {
		$inbox=DB::query('
		SELECT M.sender,M.receiver,M.subject,M.content,M.datetime,U.Username, U.Username as "From", UU.Username as "To" FROM messages as M LEFT OUTER JOIN `user` as U ON M.receiver=U.id LEFT OUTER JOIN `user` as UU ON M.sender=U.id  WHERE receiver=%i
		UNION
		SELECT M.sender,M.receiver,M.subject,M.content,M.datetime,U.Username, U.Username as "From", UU.Username as "To"  FROM messages as M LEFT OUTER JOIN `user` as U ON M.sender=U.id LEFT OUTER JOIN `user` as UU ON M.receiver=U.id WHERE sender=%i
		', $_SESSION['id'], $_SESSION['id']);
		/*SELECT M.sender,M.receiver,M.subject,M.content,M.datetime,U.Username FROM messages as M WHERE receiver=%i OR sender=%i INNER JOIN `users` as U ON `messages`.`receiver`=`users`.`id` INNER JOIN `users` ON `messages`.`sender`=`users`.`id`");
		*/
	} else {
		$inbox=DB::query('
		SELECT M.sender,M.receiver,M.subject,M.content,M.datetime,U.Username, U.Username as "From", UU.Username as "To" FROM messages as M LEFT OUTER JOIN `user` as U ON M.receiver=U.id LEFT OUTER JOIN `user` as UU ON M.sender=U.id  WHERE receiver=%i
		UNION
		SELECT M.sender,M.receiver,M.subject,M.content,M.datetime,U.Username, U.Username as "From", UU.Username as "To"  FROM messages as M LEFT OUTER JOIN `user` as U ON M.sender=U.id LEFT OUTER JOIN `user` as UU ON M.receiver=U.id WHERE sender=%i
		', $_SESSION['id'], $_SESSION['id']);
	}
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		if(is_numeric($_POST['sender']) && $_POST['sender'] > 0 && isset($_POST['sender']) && isset($_POST['receiver']) && is_numeric($_POST['receiver']) && $_POST['receiver'] > 0) {
			$inbox=DB::query("SELECT * FROM messages WHERE receiver=%i OR sender=%i", $_POST['receiver'], $_POST['sender']);

			if($_SERVER['REQUEST_METHOD'] == "POST"){
				$message = array("sender"=>$_POST['sender'], "receiver"=>$_POST['receiver'],"subject"=>$_POST['subject'],"content"=>$_POST['message'],"datetime"=>new datetime());
				$sender = $_POST['sender'];
				$receiver = $_POST['receiver'];
				DB::insert('messages',$message);
			}
		}
	}

	//get list of messages for this logged_in user
	//$sent_msg=DB::query("SELECT * FROM messages WHERE ", 1);


	echo $twig->render("messages.html", array("id" => $_SESSION['id'], "sender" => $sender, "receiver" => $receiver, "inbox" => $inbox));

?>
