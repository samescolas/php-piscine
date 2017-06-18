<?php

class Dice {
	private $num_sides;
	private $value;
	static $verbose = False;

	public function __construct($args) {
		if (isset($args['num_sides']))
			$this->num_sides = $args['num_sides'];
		else
			$this->num_sides = 6;
		if (self::$verbose)
			echo "Spun up a " . $this->num_sides . " sided die." . PHP_EOL;
	}

	protected function rollDie() {
		$this->value = rand(1, $this->num_sides);
		return $this->value;
	}

	public function __toString() {
		return "D" . $this->num_sides;
	}

	public function __destruct() {
		if (self::$verbose)
			echo "$this destructed." . PHP_EOL;
	}
}

?>
