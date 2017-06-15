<?php

class Ship {
	static $verbose = False;
	public $name;
	use __DIR__ . "/name_generator.php";

	public function __construct($args) {
		extract($args);
		if (isset($name))
			$this->name = $name;
		else
			$this->name = getRandomName();

		if (self::$verbose)
			echo "$this constructed." . PHP_EOL;
	}

	public function __toString() {

	}

	public function __destruct() {
		if (self::$verbose)
			echo "$this destructed." . PHP_EOL;
	}

?>
