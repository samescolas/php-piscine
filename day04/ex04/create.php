<?php

$login = $_POST['login'];
$passwd = $_POST['passwd'];

function	add_user($login, $passwd)
{
	if (file_exists("./private/passwd"))
		$current_data = unserialize(file_get_contents("./private/passwd"));
	else
		$current_data = array();
	$current_data[] = array('login'=>$login, 'passwd'=>$passwd);
	file_put_contents("./private/passwd", serialize($current_data));
	header('Location: ./index.html');
	echo "OK\n";
}

if ($_POST['submit'] == "OK" && $login !== "" && $passwd !== "")
{
	if (!file_exists("./private"))
		mkdir("./private");
	else if (file_exists("./private/passwd"))
	{
		$secrets = unserialize(file_get_contents("./private/passwd"));
		foreach ($secrets as $secret)
			if ($secret['login'] === $login)
			{
				$user_found = TRUE;
				echo("ERROR\n");
			}
	}
	if ($user_found !== TRUE)
		add_user($login, hash('sha256', $passwd));
}
else
	echo "ERROR\n";

?>
