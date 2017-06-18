<?php
session_start();

function	format_message($msg)
{
	return array(
		'login' => $_SESSION['loggued_on_user'],
		'time' => time(),
		'msg' => $msg
	);
}

function	add_message($msg)
{
	if (!file_exists('./private'))
		mkdir('./private');
	if (file_exists('./private/chat'))
	{
		if (($fd = fopen('./private/chat', 'r+')) !== FALSE)
			flock($fd, LOCK_EX);
		else
			echo "fix this?";
		$raw_text = "";
		while (TRUE)
		{
			$raw_text = fread($fd, 100);
			if ($raw_text === FALSE)
				break ;
			$raw_text.=$text;
		}
		$messages = unserialize($raw_text);
		$messages[] = format_message($msg);
		fwrite($fd, serialize($messages));
		flock($fd, LOCK_UN);
		fclose($fd);
	}
	else
	{
		$messages = array();
		$messages[] = format_message($msg);
		$fd = fopen('./private/chat', 'w');
		flock($fd, LOCK_EX);
		fwrite($fd, serialize($messages));
		flock($fd, LOCK_UN);
		fclose($fd);
	}
}


if ($_SESSION['loggued_on_user'] != "")
{
	if ($_POST['msg'] != '')
		add_message($_POST['msg']);
	echo "
		<form width='100% height='100%' action='./speak.php' method='post'>
			<input type='text' name='msg' value='' style='font-size:1.5vw; vertical-align:center; width:100%; height:100%;'/>
		</form>";
}
else
	echo "nope";
?>
