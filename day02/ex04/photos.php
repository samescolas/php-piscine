#!/usr/bin/php
<?php

function get_content($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36");
	//curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$page = curl_exec($ch);
	if (curl_errno($ch))
		$r_val = curl_error($ch);
	else
		$r_val = $page;
	curl_close($ch);
	return $r_val;
}

function	save_image($img_url, $filepath)
{
	if (file_exists($filepath) !== TRUE)
		mkdir($filepath);
	$content = get_content($img_url);
	if ($content == "<url> malformed")
		print "img_url: $img_url\tfilepath: $filepath\n";
	$title = substr($img_url, strrpos($img_url, '/') + 1);
	$file = fopen("$filepath/$title", "w") or die ("Unable to open file!\n");
	fwrite($file, $content);
	fclose($file);
}

if ($argc > 1 && $argv[1] != "")
{
	$filepath = preg_replace('/ /', '_', preg_replace('/https?:\/\//i', '', $argv[1]));
	$page = get_content(ltrim(rtrim(preg_replace('/ /', '%20', $argv[1]))));
	if ($page == "")
		die("Unable to get page contents\n");
	$images = array();
	preg_match_all('/\<\s*img\s+?src\s*=\s*\"(.*?)\".*\>/i', $page, $img_urls);
	if ($img_urls[1] === array())
		print $page;
		//die("No images found\n");
	foreach ($img_urls[1] as $img)
		save_image($img, $filepath);
}

?>
