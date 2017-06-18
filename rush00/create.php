<?php

session_start();
$login = $_POST['login'];
$passwd = $_POST['passwd'];

function	add_user($login, $passwd)
{
	if (file_exists("./private/passwd"))
	{
		$fd = fopen('./private/passwd', 'r+');
		flock($fd, LOCK_EX);
		$current_data = unserialize(file_get_contents("./private/passwd"));
		$current_data[] = array('login'=>$login, 'passwd'=>$passwd);
		file_put_contents('./private/passwd', serialize($current_data));
		flock($fd, LOCK_UN);
		fclose($fd);
	}
	else
	{
		$current_data = array();
		$current_data[] = array('login'=>$login, 'passwd'=>$passwd);
		$fd = fopen('./private/passwd', 'w');
		flock($fd, LOCK_EX);
		file_put_contents("./private/passwd", serialize($current_data));
		flock($fd, LOCK_UN);
		fclose($fd);
	}
	$_SESSION["loggued_on_user"] = $login;
	header('Location: '.$_GET["referer"]);
	echo "OK\n";
	exit();
}

if ($_POST['submit'] == "OK" && $login !== "" && $passwd !== "")
{
	if (!file_exists("./private"))
		mkdir("./private");
	if (file_exists("./private/passwd"))
	{
		$fd = fopen('./private/passwd', 'r');
		flock($fd, LOCK_SH);
		$accounts = unserialize(file_get_contents("./private/passwd"));
		flock($fd, LOCK_UN);
		fclose($fd);
		foreach ($accounts as $account)
		{
			if ($account['login'] === $login)
			{
				$user_found = TRUE;
				break ;
			}
		}
	}
	if ($user_found !== TRUE)
		add_user($login, hash('sha256', $passwd));
}
?>

<html>
	<head>
		<title>Create Account</title>
		<link rel="stylesheet" href="create.css" />
	</head>
	<body>
		<a id="back" href="index.php"><span>&#8619</span> Back to StoreName</a>
		<h1>Create Account</h1>
		<form action=<?php echo "create.php?referer=".$_GET["referer"]?> method='post'>
			<input class="ifield" type='text' name='login' placeholder="Enter Username" />
			<br />
			<input class="ifield" type='password' name='passwd' placeholder="Password" />
			<br />
			<input id="submit" type='submit' name='submit' value='OK'/>
			<?php 
				if (isset($_POST['login']) || isset($_POST['passwd']))
					echo "<p id='error-message'>Username already exists.</p>";
			?>
		<form>
	</body>
</html>

