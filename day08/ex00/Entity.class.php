<?php

class Entity {
	protected $x;
	protected $y;
	protected $width;
	protected $height;
	public $coords;

	public function __construct($args) {
		extract($args);
		$this->x = $x;
		$this->y = $y;
		$this->width = $width;
		$this->height = $height;
		$this->setCoords();
	}

	private function setCoords() {
		$this->coords = [];
		for ($i=0; $i<$this->height; $i++) {
			for ($j=0; $j<$this->width; $j++) {
				$this->coords[] = [
					'x' => $j + $x, 
					'y' => $i + $y
				];
			}
		}
	}
}

?>
