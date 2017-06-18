<?php
session_start();

if ($_SESSION['admin'] === "")
	header("Location: index.php");

$fd = fopen("./products.txt", "r+");
flock($fd, LOCK_EX);
$products = unserialize(file_get_contents("./products.txt"));
unset($products[urldecode($_GET['name'])]);
file_put_contents("./products.txt", serialize($products));
flock($fd, LOCK_UN);
fclose($fd);
header("Location: index.php");

?>
