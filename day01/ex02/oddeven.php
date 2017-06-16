#!/usr/bin/php
<?php

function oddeven()
{
	print "Enter a number: ";

	$input = rtrim(fgets(STDIN), "\n");
	if (feof(STDIN))
		return FALSE;
	if (!preg_match('/^\d*?\.?\d*?$/', $input))
		print "'$input' is not a number\n";
	else if ($input % 2 == 0)
		print "The number $input is even\n";
	else
		print "The number $input is odd\n";
	return TRUE;
}

while (TRUE)
	if (oddeven() == FALSE)
	{
		print "^D\n";
		break ;
	}

?>
