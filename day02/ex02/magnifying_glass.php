#!/usr/bin/php
<?php

function	capitalize_titles($title, &$html)
{
		$html = preg_replace_callback (
			'/<[^>]*?(title\s*=\s*\"(.*?)\")[^>]*?>/is',
			function ($matches) {
				$regex = "/";
				$regex .= preg_quote(substr($matches[0], 0, strpos($matches[0], $matches[1])), '/');
				$regex .= preg_quote(substr($matches[1], 0, strpos($matches[1], $matches[2])), '/');
				$regex .= "(".preg_quote($matches[2], '/').")/is";
				return preg_replace_callback(
					$regex,
					function ($matches) {
						return preg_replace(
							"/".preg_quote($matches[1], '/')."/is",
							strtoupper($matches[1]),
							$matches[0]
						);
					},
					$matches[0]
				);
			},
			$html
		);
}

if ($argc > 1 && $argv[1] != "")
{
	$file = glob($argv[1]);
	if (count($file) > 0)
		$file = $file[0];
	else
		die("Err: file not found\n");

	if (is_readable($argv[1]) === FALSE)
		die("Err: permission denied\n");

	if (($file_contents = file_get_contents($argv[1])) === FALSE)
		die("Err: unable to read file\n");	

	preg_match_all('/<\s*a[^<]*?\s*>(.*?)<\s*\/\s*a\s*>/is', $file_contents, $a);
	$ct = count($a[1]);
	for($i=0; $i < $ct; $i++)
	{
		if ($a[1][$i][0] == "<")
		{
			if (preg_match_all('/>(.*?)</is', $a[1][$i], $matches) > 0)
			{
				for ($j=0; $j < count($matches[0]); $j++)
				{
					$regex = '/';
					$regex .= preg_quote(substr($a[0][$i], 0, strpos($a[0][$i], $matches[1][$j])), '/');
					$regex .= '([^<]*?)</is';
					$file_contents = preg_replace_callback(
						$regex,
						function ($matches_inner) {
							return preg_replace(
								"/".preg_quote($matches_inner[1], '/')."/is",
								strtoupper($matches_inner[1]),
								$matches_inner[0]
							);
						},
						$file_contents
					);
				}
			}

		}
		else
		{
			$file_contents = preg_replace_callback(
				"/".preg_quote($a[1][$i], '/')."/is",
				function ($matches) {
					return preg_replace_callback(
						'/^([^<]*)/is',
						function ($matches) {
							return preg_replace(
								"/".preg_quote($matches[1], '/')."/is",
								strtoupper($matches[1]),
								$matches[0]
							);
						},
						$matches[0]
					);
				},
				$file_contents
			);
		}

		capitalize_titles($a[0][$i], $file_contents);
	}
	print $file_contents."\n";
}

?>
