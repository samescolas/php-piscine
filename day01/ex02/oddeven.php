#!/usr/bin/php
<?php

function oddeven($fd)
{
	print "Enter a number: ";

	$input = rtrim(fgets($fd), "\n");
	if (feof($fd))
		return FALSE;
	if (!preg_match('/^\d+$/', $input))
		print "'$input' is not a number\n";
	else if ($input % 2 == 0)
		print "The number $input is even\n";
	else
		print "The number $input is odd\n";
	return TRUE;
}

$fd = fopen("php://stdin", "r");

while (TRUE)
	if (oddeven($fd) == FALSE)
	{
		print "^D\n";
		break ;
	}

?>
