<?php

function	get_user_info($login, $passwd)
{
	if (!file_exists("./private/passwd"))
		return FALSE;
	$fd = fopen('./private/passwd', 'r');
	flock($fd, LOCK_SH);
	$contents = unserialize(file_get_contents("./private/passwd"));
	flock($fd, LOCK_UN);
	fclose($fd);
	foreach ($contents as $acct)
		if ($acct['login'] == $login)
			break ;
	if ($acct['passwd'] === hash('sha256', $passwd))
		return $acct;
	return FALSE;
}

function	update_password($account, $password)
{
	$contents = unserialize(file_get_contents("./private/passwd"));
	foreach ($contents as  $key => $val)
		if ($val['login'] == $account['login'])
			break ;
	$contents[$key]['passwd'] = hash('sha256', $password);
	file_put_contents("./private/passwd", serialize($contents));
	header("Location: ./index.php");
	echo "OK\n";
}

$login = $_POST['login'];
$oldpw = $_POST['oldpw'];
$newpw = $_POST['newpw'];

if ($_POST['submit'] === "OK" && $login !== "" && $oldpw !== "" && $newpw !== "")
{
	if (!file_exists("./private"))
		mkdir("./private");
	if (($user = get_user_info($login, $oldpw)) !== FALSE)
		update_password($user, $newpw);
}
?>

<html>
<head>
	<title>Update Password</title>
	<link rel="stylesheet" href="modif.css" />
</head>
<body>
	<a id="back" href="index.php"><span>&#8619</span> Back to StoreName</a>
	<h1>Update Password</h1>
	<form action="./modif.php" method="post">
		<input class="ifield" type="text" name="login" placeholder="Enter Username" />
		<br />
		<input class="ifield" name="oldpw" type="password" placeholder="Enter Password" />
		<br />
		<input class="ifield" name="newpw" type="password" placeholder="Enter New Password" />
		<br />
		<input id="submit" type="submit" name="submit" value="OK" />
		<?php
			if (isset($_POST['login']) || isset($_POST['oldpw']) || isset($_POST['newpw']))
				echo "<p id='error-message'>Invalid username or password.</p>";
		?>
	</form>
</body>
</html>
