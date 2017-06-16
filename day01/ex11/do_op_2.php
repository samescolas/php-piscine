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

function	ft_fatal($msg)
{
	print $msg;
	exit();
}

if ($argc == 2)
{
	$expr = preg_replace('/\s+/', '', $argv[1]);

	if (preg_match("/(^-?\d+\.?\d*)/", $expr, $m) === FALSE)
		ft_fatal("Syntax Error\n");
	else
		$a = $m[1];

	if (preg_match("/^$a(.)-?\d+\.?\d*$/", $expr, $m) === FALSE)
		ft_fatal("Syntax Error\n");
	else
		$op = $m[1];

	if (preg_match("/^$a\\$op(-?\d+\.?\d*)$/", $expr, $m) === FALSE)
		ft_fatal("Syntax Error\n");
	else
		$b = $m[1];

	if (is_numeric($a) && is_numeric($b) && is_op($op))
		print do_op($a, $b, $op)."\n";
	else
		print "Syntax Error\n";
}
else
	print "Incorrect Parameters\n";

?>
