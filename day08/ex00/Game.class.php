<?php

class Game {
	static $verbose;
	public $board;
	private $players;

	public function __construct($args) {
		extract($args);
		if (isset($players) && isset($board)) {
			$this->players = $players;
			$this->board = $board;
		}
		else
			die ("Improper arguments passed to constructor." . PHP_EOL);
		foreach($players as $p)
			echo $p->name . " has joined the battle!<br />";
		if (self::$verbose)
			echo "$this constructed." . PHP_EOL;
	}

	public function __toString() {
		return "PLACEHOLDER.Game.class.php";
	}

	public function display() {
	}

	public function __destruct() {
		if (self::$verbose)
			echo "$this destructed." . PHP_EOL;
	}
}

?>
