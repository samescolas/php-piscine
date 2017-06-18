<?php

if (!file_exists(__DIR__ . "/list.csv"))
	exit();

$fd = fopen(__DIR__ . "/list.csv", 'r+');
flock($fd, LOCK_EX);
$data = [];
while (($val = fgetcsv($fd)))
	if ($_GET['toDo'] != $val[0])
		$data[] = $val[0];
flock($fd, LOCK_UN);
fclose($fd);

$fd = fopen(__DIR__ . "/list.csv", 'w');
flock($fd, LOCK_EX);
foreach($data as $row)
	fputcsv($fd, $row);
flock($fd, LOCK_UN);

foreach($data as $item) {
	if ($item == $_POST['toDo'])
}

?>
