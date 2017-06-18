#!/usr/bin/php
<?php

function frenglish($month)
{
	$months = array(
		"janvier"=>"jan",
		"fevrier"=>"feb",
		"mars"=>"mar",
		"avril"=>"apr",
		"mai"=>"may",
		"juin"=>"jun",
		"juillet"=>"jul",
		"aout"=>"aug",
		"septembre"=>"sep",
		"octobre"=>"oct",
		"novembre"=>"nov",
		"decembre"=>"dec"
	);

	return $months[$month];
}

function	is_dow($dow)
{
	$valid_dows = array(
		"lundi", "monday",
		"mardi", "tuesday",
		"mercredi", "wednesday",
		"jeudi", "thursday",
		"vendredi", "friday",
		"samedi", "saturday",
		"dimanche", "sunday"
	);

	return in_array(strtolower($dow), $valid_dows);
}

if ($argc > 1 && $argv[1] != "")
{
	//date_default_timezone_set('America/Los_Angeles');
	date_default_timezone_set('Europe/Paris');

	$date_arr = preg_split('/\s+/', $argv[1]);
	if (count($date_arr) != 5)
		die("Wrong Format\n");

	if (is_dow($date_arr[0]) === FALSE)
		die("Wrong Format\n");

	$month = frenglish(strtolower($date_arr[2]));
	if (strlen($month) != 3)
		die("Wrong Format\n");

	$day = $date_arr[1];
	if ($day <= 0 || $day > 31)
		die("Wrong Format\n");	

	$year = $date_arr[3];
	if (strlen($year) != 4)
		die("Wrong Format\n");

	$time = $date_arr[4];
	
	$format = "j M Y H:i:s";
	if (($date = date_create_from_format($format, "$day $month $year $time")) === FALSE)
		die("Wrong Format\n");

	print $date->getTimestamp()."\n";
}

?>
