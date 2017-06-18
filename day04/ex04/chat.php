<?php

session_start();

function	display_message($msg)
{
	if ($_SESSION['loggued_on_user'] == $msg['login'])
		$class = "self";
	else
		$class = "other";
	echo 
		"<div class='$class'>
			<p>".$msg['login']."</p>
			<p>".$msg['time']."</p>
			<p>".$msg['msg']."</p>
		</div>";
}

if (file_exists("./private/chat"))
{
	$fd = fopen('./private/chat', 'r');
	flock($fd, LOCK_SH);
	$raw_text = "";
	while (TRUE)
	{
		$text = fread($fd, 100);
		if ($text === FALSE)
			break ;
		$raw_text.=$text;
	}
	$contents = unserialize($raw_text);
	flock($fd, LOCK_UN);
	fclose($fd);
	foreach($contents as $msg)
		display_message($msg);
}

?>
