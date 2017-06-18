<?php
session_start();

function	display_form($user, $pass)
{
	echo
	"<html>
	<head>
		<title>Sessions</title>
		<style>
			body {
				margin: 0;
				padding: 0;
			}
			h1 {
				padding-top: 10vw;
				margin: 0 auto;
				text-align: center;	
			}
			form {
				text-align: center;
				width: 80%;
				margin: 10% auto;
			}
			input {
				margin-bottom: 2vw;
			}
		</style>
	</head>
	<body>
		<h1>Login</h1>
		<form method=\"get\">
			Username: <input type=\"text\" name=\"login\" value=\"$user\" />
			<br />
			Password: <input type=\"password\" name=\"passwd\" value=\"$pass\"/>
			<br />
			<input type=\"submit\" name=\"submit\" value=\"OK\" />
		</form>
	</body>
	</html>";
}

if ($_GET['submit'] == "OK")
{
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}
display_form($_SESSION['login'], $_SESSION['passwd']);

?>
