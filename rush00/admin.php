<?php
session_start();

function remove_user($login)
{
	if (!file_exists("./private/passwd"))
		return (false);
	else
	{
		$fd = fopen('./private/passwd', 'r');
		flock($fd, LOCK_SH);
		$accounts = unserialize(file_get_contents("./private/passwd"));
		flock($fd, LOCK_UN);
		fclose($fd);
		for ($i = 0; $i < count($accounts); $i++)
		{
			if ($accounts[$i]['login'] === $login)
			{
				unset($accounts[$i]);
				$fd = fopen('./private/passwd', 'w');
				flock($fd, LOCK_EX);
				file_put_contents("./private/passwd", serialize($accounts));
				flock($fd, LOCK_UN);
				fclose($fd);
				return (true);
			}
		}
	}
	return (false);
}

function grant_admin($login)
{
	if (!file_exists("./private/passwd"))
		return (false);
	else
	{
		$fd = fopen('./private/passwd', 'r');
		flock($fd, LOCK_SH);
		$accounts = unserialize(file_get_contents("./private/passwd"));
		flock($fd, LOCK_UN);
		fclose($fd);
		for ($i = 0; $i < count($accounts); $i++)
		{
			if ($accounts[$i]['login'] === $login)
			{
				$accounts[$i]['admin'] = true;
				$fd = fopen('./private/passwd', 'w');
				flock($fd, LOCK_EX);
				file_put_contents("./private/passwd", serialize($accounts));
				flock($fd, LOCK_UN);
				fclose($fd);
				return (true);
			}
		}
	}
	return (false);
}
/*
if ($_SESSION['admin'] == "")
{
	header("Location: ./index.php");
	exit();
}
 */

if ($_POST['del_login'] != "")
{
	$removed = remove_user($_POST['del_login']);
}

if ($_POST['adm_login'] != "")
{
	$granted = grant_admin($_POST['adm_login']);
	if ($granted && $_SESSION["loggued_on_user"] == $_POST['adm_login'])
		$_SESSION["admin"] = "admin";
}

?>

<html>
	<head>
		<title>Admin</title>
		<link rel="stylesheet" href="admin.css" />
	</head>
	<body>
		<a id="back" href="index.php"><span>&#8619</span> Back to StoreName</a>
		<form method='post' action="admin.php">
			<h1>Delete Account</h1>
			<input class="ifield" type='text' name='del_login' placeholder="Enter Username"/>
			<input id="submit" type='submit' name='submit' value='OK' />
			<?php
				if ($_POST['del_login'] != "" && $removed)
					echo "<p id='error-message'>User Sucessfully Removed!</p><br />"; 
				else if ($_POST['del_login'] != "")
					echo "<p id='error-message'>Username Does Not Exist</p><br />"; 
			?>
		</form>
		<br />
		<form method='post' action="admin.php">
			<h1>Add Admin Rights</h1>
			<input class="ifield" type='text' name='adm_login' placeholder="Enter Username"/>
			<input id="submit" type='submit' name='submit' value='OK' />
			<?php
				if ($_POST['adm_login'] != "" && $granted)
					echo "<p id='error-message'>User Granted Admin Rights!</p><br />"; 
				else if ($_POST['adm_login'] != "")
					echo "<p id='error-message'>Username Does Not Exist</p><br />"; 
			?>
		</form>
	</body>
</html>
