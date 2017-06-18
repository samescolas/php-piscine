<?php

function	auth($login, $passwd)
{
	if (($file = file_get_contents("./private/passwd")) === FALSE)
		return FALSE;
	foreach (unserialize($file) as $key => $val)
	{
		if ($val['login'] === $login)
			return $val['passwd'] === hash('sha256', $passwd);
	}
	return FALSE;
}

?>
