#!/usr/bin/php
<?php

$r_val = "";
$key = $argv[1];

foreach(array_slice($argv, 2) as $param)
{
	if (explode(':', $param, 2)[0] == $key)
		$r_val = explode(':', $param, 2)[1];
}

if ($r_val != "")
	print "$r_val\n";

?>
