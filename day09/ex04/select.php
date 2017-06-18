<?php

if (!file_exists(__DIR__ . "/list.csv"))
	exit();
$fd = fopen(__DIR__ . "/list.csv");
flock($fd, LOCK_SH);
$list = fgetcsv($fd);
flock($fd, LOCK_UN);
echo join(",", $list);

?>
