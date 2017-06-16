#!/usr/bin/php
<?php

function	is_op($str)
{
	return $str == "+" || $str == "-" || $str == "/" || $str == "*" || $str == "%";
}

function	do_op($a, $b, $op)
{
	if ($op == "+")
		return ($a + $b);
	else if ($op == "-")
		return ($a - $b);
	else if ($op == "*")
		return ($a * $b);
	else if ($b == 0)
	{
		print "Err: divide by zero\n";
		exit();
	}
	else if ($op == "/")
		return ($a / $b);
	else
		return ($a % $b);
}

if ($argc == 4)
{
	$a = preg_replace('/\s+/', '', $argv[1]);
	$b = preg_replace('/\s+/', '', $argv[3]);
	$op = preg_replace('/\s+/', '', $argv[2]);
	if (is_numeric($a) && is_numeric($b) && is_op($op))
		print do_op($a, $b, $op)."\n";
	else
		print "Incorrect Parameters\n";
}
else
	print "Incorrect Parameters\n";

?>
