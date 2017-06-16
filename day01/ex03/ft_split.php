#!/usr/bin/php
<?php

function ft_split($str)
{
	$trimmed_str = trim(preg_replace('/ +/', ' ', $str));
	$vals = explode(' ', $trimmed_str);
	sort($vals);
	return $vals;
}

?>
