<?php
session_start();

include "./auth.php";

if ($_POST['login'] !== "" && $_POST['passwd'] !== "")
{
	if (auth($_POST['login'], $_POST['passwd']))
	{
		$_SESSION['loggued_on_user'] = $_POST['login'];
		echo "<iframe name='chat' src='chat.php' width='100%' height='550px'></iframe>";
		echo "<iframe name='speak' src='speak.php' width='100%' height='50px'></iframe>";
	}
	else
	{
		$_SESSION['loggued_on_user'] = "";
		echo "ERROR\n";
	}
}
else
	echo "ERROR\n";

?>
