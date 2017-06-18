<?php
	session_start();
	$prod_name = urldecode(array_keys($_POST)[0]);
	$incr = $_POST[urlencode($prod_name)];
	if ($incr == "X")
	{
		unset($_SESSION["basket"][$prod_name]);
		header('Location: '.$_GET["referer"]);
		exit;
	}
	if (!isset($_SESSION["basket"]))
		$_SESSION["basket"] = array();
	if (!isset($_SESSION['basket'][$prod_name]))
		$_SESSION["basket"][$prod_name] = 0;
	$_SESSION["basket"][$prod_name] += ($incr == "+" ? 1 : -1);
	if ($_SESSION["basket"][$prod_name] <= 0 && $_GET["referer"] != "basket.php")
		unset($_SESSION["basket"][$prod_name]);
	else if ($_SESSION["basket"][$prod_name] <= 0)
		$_SESSION["basket"][$prod_name] = 0;
	header('Location: '.$_GET["referer"]."?category=".$_GET["category"]);
?>