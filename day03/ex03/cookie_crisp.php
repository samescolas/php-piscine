<?php

switch ($_GET['action'])
{
	case "set":
		if ($_GET['name'] != "" && $_GET['value'] != "")
			setcookie($_GET['name'], $_GET['value'], time()+(3600*7));
		break ;
	case "get":
		echo $_COOKIE[$_GET['name']]."\n";
		break ;
	case "del":
		setcookie($_GET['name'], $_GET['value'], time() - 1);
		break;
}

?>
