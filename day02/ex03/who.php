#!/usr/bin/php
<?php

$file = "/var/run/utmpx";
$format_str = "";

if (is_readable($file) === FALSE)
	die ("Unable to read utmpx\n");
$fd = fopen($file, "r");
fread($fd, filesize($file));
$contents = unpack($format_str, file_get_contents($file));
print_r($contents);


?>
