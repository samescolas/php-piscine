<?php

class Camera {
	static $verbose = False;
	protected $origin;
	protected $orientation;
	protected $width;
	protected $height;
	protected $ratio;
	protected $fov;
	protected $near;
	protected $far;

	public function __construct($args) {
		extract($args);
		if (isset($origin) && isset($orientation) && isset($width) &&
			isset($height) && isset($ratio) && isset($fov) && isset($near) && isset($far)) {
			$this->origin = $origin;
			$this->orientation = $orientation;
			$this->width = $width;
			$this->height = $height;
			$this->ratio = $ratio;
			$this->fov = $fov;
			$this->near = $near;
			$this->far = $far;
			$T = 
		}
			
		else
			die("Invalid arguments passed to constructor.\n");
		if (self::$verbose)
			echo "Camera instance constructed" . PHP_EOL;
	}

	public function watchVertex($worldVertex) {

	}

	public function __toString() {

	}

	public function __destruct() {
		if (self::$verbose)
			echo "Camera instance destructed" . PHP_EOL;
	}
}

?>
