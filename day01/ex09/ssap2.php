#!/usr/bin/php
<?php

function	ft_sort($a, $b)
{
	$a = strtolower($a);
	$b = strtolower($b);
	$len = strlen($a);
	if (strlen($b) > $len)
		$len = strlen($b);
	for ($i=0; $i <= $len; $i++)
	{
		if ($a[$i] == "")
			return 1;
		else if ($b[$i] == "")
			return -1;
		if ($a[$i] != $b[$i])
		{
			if (preg_match('/[a-z]/', $a[$i]))
			{
				if (preg_match('/[a-z]/', $b[$i]))
					return strcmp("$a[$i]", "$b[$i]");
				else
					return -1;
			}
			else if (preg_match('/\d/', "$a[$i]"))
			{
				if (preg_match('/\d/', "$b[$i]"))
				{
					if ($a[$i] == $b[$i])
						return 0;
					else
						return ($a[$i] > $b[$i]) ? 1 : -1;
				}
				else if (preg_match('/[a-z]/', $b[$i]))
					return 1;
				else
					return -1;
			}
			else
			{
				if (preg_match('/[a-z]/', $b[$i]) || preg_match('/\d/', $b[$i]))
					return 1;
				else
					return strcmp("$a[$i]", "$b[$i]");
			}
		}
	}
	print_r($a);
}

$arg_arr = array();
foreach (array_slice($argv, 1) as $param)
	$arg_arr = array_merge($arg_arr, preg_split('/\s+/', $param));

usort($arg_arr, "ft_sort");

foreach ($arg_arr as $arg)
	print "$arg\n";

?>
