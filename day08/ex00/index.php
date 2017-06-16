<?php 

session_start(); 

require_once(__DIR__ . "/Game.class.php");
require_once(__DIR__ . "/HumanPlayer.class.php");
require_once(__DIR__ . "/Board.class.php");


if (!isset($_SESSION['game'])) {
	$players = [new HumanPlayer([]), new HumanPlayer([])];
	$spaceships = [];
	foreach($players as $p)
		$spaceships[$p->name] = $p->spaceships;
	$g = new Game([
		'players' => $players,
		'board' => new Board([
			'height'=>80,
			'width'=>80,
			'spaceships' => $spaceships,
			'players' => $players
		])
	]);

	$_SESSION['game'] = $g;

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Something</title>
</head>
<body>
	<h1 id="turn">Your turn!</h1>
	<table>
		<?php $_SESSION['game']->board->display(); ?>
	</table>
</body>
</html>
