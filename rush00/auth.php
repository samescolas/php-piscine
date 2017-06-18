<?php

function	auth($login, $passwd)
{
	if (!file_exists("./private/passwd"))
		return FALSE;
	if (($file = file_get_contents("./private/passwd")) === FALSE)
		return FALSE;
	foreach (unserialize($file) as $key => $val)
	{
		if ($val['login'] === $login && $val['passwd'] === hash('sha256', $passwd))
		{
			return ($val['admin'] ? "admin" : TRUE);
		}
	}
	return FALSE;
}

?>
