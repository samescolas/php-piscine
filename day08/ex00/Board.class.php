<?php

require_once(__DIR__ . "/Color.class.php");

class Board { 
	static $verbose = False;
	protected $width;
	protected $height;
	private $spaceships;
	private $obstacles;
	private $players;
	private $board;

	public function __construct($args) {
		extract($args);
		$this->width = isset($width) ? $width : mt_rand(100, 200);
		$this->hegiht = isset($height) ? $height : mt_rand(100, 200);
		if (isset($spaceships) && isset($players)) {
			$this->spaceships = $spaceships;
			$this->players = $players;
		}
		else
			die("Invalid arguments passed to constructor." . PHP_EOL);
		if (isset($obstacles))
			$this->obstacles = $obstacles;
		else
			$this->getRandomObstacles();
		$this->setupBoard();
		if (self::$verbose)
			echo "$this constructed." . PHP_EOL;
	}

	private function getRandomObstacles() {
		for($i = mt_rand(1, 10); $i > 0; $i--)
			$this->obstacles[] = [
				'width' => mt_rand(1, 5),
				'height' => mt_rand(1, 5),
				'color' => new Color([])
			];
	}

	private function setupBoard() {
		$this->board = [];
		for ($i=0; $i<$this->height; $i++)
			$this->board[$i] = array_fill(0, $this->width, 0);
		foreach($this->players as $p) {
			foreach($this->spaceships[$p->name] as $ship) {
				foreach($ship->coords as $c) {
					$this->board[$c->x][$c->y] = "S" . $ship->id . "P" . $ship->owner->id;
				}
			}
		}
		foreach($this->obstacles as $o) {
			$this->board[$o->x][$o->y] = "O" . $o->id;
		}
	}

	public function display() {
		for($row=0; $row<$this->height; $row++) {
			echo "<tr>";
			for($col=0; $col<$this->width; $col++) {
				$this->displayBlock($this->board[$row][$col]);
			}
			echo "</tr>";
		}
	}

	private function displayBlock($type) {
		switch($type[0]) {
			case "S":
				echo "<td class=\"spaceship\"></td>";
				break ;
			case "O":
				echo "<td class=\"obstacle\"></td>";
				break ;
			default:
				echo "<td class=\"empty\"></div>";
		}
	}

	public function __destruct() {
		if (self::$verbose)
			echo "$this destructed." . PHP_EOL;
	}
}

?>
