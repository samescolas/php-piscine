#!/usr/bin/php
<?php

if ($argc > 1 && $argv[1] != "")
{	
	/*
	$filename = ltrim(rtrim(preg_replace('/\s+/', ' ', $argv[1])));
	$handle = fopen($filename, "rb");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	print $contents;
	 */

	$filename = ltrim(rtrim(preg_replace('/\s+/', ' ', $argv[1])));
	$byteArray = unpack("C*myint", file_get_contents($filename));
	foreach ($byteArray as $b)
		print $b;
}
?>
