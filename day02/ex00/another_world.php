#!/usr/bin/php
<?php

if ($argc > 1 && $argv[1] != "")
{
	print ltrim(rtrim(preg_replace('/\s+/', ' ', $argv[1])))."\n";
}

?>
