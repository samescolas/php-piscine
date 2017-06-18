<?php

require_once( __DIR__ . "/RandomName.class.php");
require_once( __DIR__ . "/Spaceship.class.php");

class HumanPlayer {
	use RandomNameGenerator;
	static $verbose = False;
	public $spaceships;
	public $name;

	public function __construct($args) {
		extract($args);
		$this->name = (isset($name) ? $name : $this->getRandomName());
		if (isset($spaceships))
			$this->spaceships = $spaceships;
		else
			$this->generateFleet(mt_rand(3,6));
		if (self::$verbose)
			echo "$this constructed." . PHP_EOL;
	}

	private function generateFleet($num_ships) {
		$this->spaceships = [];
		for($i=0; $i<$num_ships; $i++) {
			$this->spaceships[] = new Spaceship( [
				'x' => $i * 3,
				'y' => $i * mt_rand(2, 4) % 150,
				'width' => mt_rand(2, 5),
				'height' => mt_rand(3, 3)
			]);
		}
	}

	public function __toString() {
		return $this->name;
	}

	protected function take_turn() {
	}

	public function __destruct() {
		if (self::$verbose)
			echo "$this destructed." . PHP_EOL;
	}
}

?>
