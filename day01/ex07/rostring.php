#!/usr/bin/php
<?php

if ($argc >= 2)
{
	$arr = preg_split('/\s+/', $argv[1]);
	if (count($arr) <= 1)
		print "$arr[0]\n";
	else
	{
		foreach(array_slice($arr, 1) as $param)
			print "$param ";
		print  $arr[0]."\n";
	}
}

?>
