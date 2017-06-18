#!/usr/bin/php
<?php

$arg_arr = array();
foreach (array_slice($argv, 1) as $param)
	$arg_arr = array_merge($arg_arr, explode(' ', preg_replace('/\s+/', ' ', $param)));
sort($arg_arr);
foreach ($arg_arr as $arg)
	print "$arg\n";

?>
