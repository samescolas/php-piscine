<?php

require_once(__DIR__ . "/Entity.class.php");

class Spaceship extends Entity {
	use RandomNameGenerator;
	static $verbose = False;

	public function __construct($args) {
		extract($args);
		parent::__construct(['x'=>$x, 'y'=>$y, 'width'=>$width, 'height'=>$hegiht]);
		$this->name = (isset($name) ? $name : $this->getRandomName());
		$this->size = $width * $height;
		$this->sprite = (isset($sprite) ? $sprite : "PLACEHOLDER");
		$this->hullPoints = (isset($hullPoints) ? $hullPoints : mt_rand(1, 10));
		$this->enginePower = (isset($enginePower) ? $enginePower : mt_rand(1, 10));
		$this->speed = (isset($speed) ? $speed : mt_rand(1, 10));
		$this->handling = (isset($handling) ? $handling : mt_rand(mt_rand(0,4), mt_rand(4, 7)));;
		$this->shield = (isset($shield) ? $shield : mt_rand(1, 4));
		$this->weapons = (isset($weapons) ? $weapons : "PLACEHOLDER");
		if (self::$verbose)
			echo "$this constructed." . PHP_EOL;
	}

	protected function isDestroyed() {
		return $this->hullPoints <= 0;
	}

	protected function getRandomSpaceship() {
		return new Spaceship( [
			'name' => $this->getRandomName(),
			'width' => mt_rand(0, 10000) % 4,
			'height' => mt_rand(0, 1000) % 5,
			'sprite' => 'PLACEHOLDER',
			'hullPoints' => mt_rand(0, 1742) % 10,
			'enginePower' => mt_rand(1, 1723) % 8,
			'speed' => mt_rand(1, 10),
			'handling' => mt_rand(0, 100) / 100,
			'shield' => mt_rand(0, 4),
			'weapons' => 'PLACEHOLDER',
		]);
	}

	public function __toString() {
		return $this->sprite;
	}

	public function __destruct() {
		if (self::$verbose)
			echo "$this destructed." . PHP_EOL;
	}
}

?>
