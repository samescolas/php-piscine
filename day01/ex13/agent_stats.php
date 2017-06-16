#!/usr/bin/php
<?php

function	get_line()
{
	if (feof(STDIN))
		return "";
	else
		return fgets(STDIN);
}

function	calculate_avg()
{
	$avg = 0;
	$num_items = 0;
	$num_scores = 0;

	$arr = array();
	fgets(STDIN);
	while (($line = get_line()) != "")
	{
		$num_items += 1;
		$arr[] = explode(';', $line);
		if ($arr[$num_items - 1] != "")
		{
			$avg += $arr[$num_items - 1][1];
			$num_scores += 1;
		}
	}
	print ($avg / $num_scores) . "\n";
}

function	calculate_per_user_avg()
{
	$arr = array();
	fgets(STDIN);
	while (($line = get_line()) != "")
		$arr[] = explode(';', $line);
}

function	calculate_variance()
{
	$arr = array();
	fgets(STDIN);
	while (($line = get_line()) != "")
		$arr[] = explode(';', $line);
}

if ($argc > 1)
{
	$argv[1] = preg_replace('/\s+/', '', $argv[1]);
	if ($argv[1] == "moyenne" || $argv[1] == "average")
		calculate_avg();
	else if ($argv[1] == "moyenne_user" || $argv[1] == "average_user")
		calculate_per_user_avg();
	else if ($argv[1] == "ecart_moulinette" || $argv[1] == "moulinette_variance")
		calculate_variance();
	else
		print "Err: Invalid Option\n";
}

?>
