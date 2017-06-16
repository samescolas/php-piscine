#!/usr/bin/php
<?php

if ($argc == 2 && $argv[1] != "")
{
	$str = preg_replace('/\s+/', ' ', $argv[1])."\n";
	print (rtrim(ltrim($str)))."\n";
}

?>
