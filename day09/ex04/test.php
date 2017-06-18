<?php

$toAdd = ["first item", "second item", "another thing"];

if (file_exists(__DIR__ . "/test.csv")) {
	$fd = fopen(__DIR__ . "/test.csv", 'r+');
	flock($fd, LOCK_EX);
	$data = [];
	while (($val = fgetcsv($fd)))
		$data[] = $val[0];
	flock($fd, LOCK_UN);
	fclose($fd);
	echo implode(",", $data);
}
else {
	$fd = fopen(__DIR__ . "/test.csv", 'w');
	flock($fd, LOCK_EX);
	foreach($toAdd as $line)
		fputcsv($fd, [$line]);
	flock($fd, LOCK_UN);
	fclose($fd);
}

?>
