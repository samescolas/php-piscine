<?php

function	get_user_info($login, $passwd)
{
	if (!file_exists("./private/passwd"))
		return FALSE;
	$contents = unserialize(file_get_contents("./private/passwd"));
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
	echo "OK\n";
}

$login = $_POST['login'];
$oldpw = $_POST['oldpw'];
$newpw = $_POST['newpw'];

if ($_POST['submit'] === "OK" && $login !== "" && $oldpw !== "" && $newpw !== "")
{
	if (!file_exists("./private"))
		mkdir("./private");
	if (($user = get_user_info($login, $oldpw)) === FALSE)
		echo "ERROR\n";
	else
		update_password($user, $newpw);
}
else
	echo "ERROR\n";

?>
