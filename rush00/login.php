<?php
session_start();

require("./auth.php");

if ($_POST['login'] !== "" && $_POST['passwd'] !== "")
{
	$auth = auth($_POST['login'], $_POST['passwd']);
	if ($auth == true)
	{
		$_SESSION['loggued_on_user'] = $_POST['login'];
		if ($auth === "admin")
			$_SESSION['admin'] = "admin";
		header('Location: '.$_GET["referer"]);
	}
}
?>

<html>
	<head>
		<title>Member Login</title>
		<link rel="stylesheet" href="login.css" />
	</head>
	<body>
		<a id="back" href="index.php"><span>&#8619</span> Back to StoreName</a>
		<h1>Member Login</h1>
		<form method='post' action=<?php echo "login.php?referer=".$_GET["referer"]?>>
			<input class="ifield" type='text' name='login' placeholder="Enter Username"/>
			<br />
			<input class="ifield" type='password' name='passwd' placeholder="Enter Password"/>
			<br />
			<input id="submit" type='submit' name='submit' value='OK' />
			<?php
				if (isset($_POST['login']) || isset($_POST['passwd']))
					echo "<p id='error-message'>Incorrect username or password.</p><br />"; 
			?>
		</form>
	</body>
</html>
