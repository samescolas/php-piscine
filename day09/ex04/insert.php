<?php

if (!file_exists(__DIR__ . "/list.csv"))
	exit();
$fd = fopen(__DIR__ . "/list.csv");
flock($fd, LOCK_EX);
fputcsv($fd, $_POST['toDo']);
flock($fd, LOCK_UN);
fclose($fd);

echo 1;

?>
