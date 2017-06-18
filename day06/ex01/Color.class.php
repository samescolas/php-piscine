<?php

class Color {
	static $verbose = False;
	public $red;
	public $green;
	public $blue;

	public function __construct($colorKey) {
		switch (count($colorKey)) {
			case 1:
				$c = $colorKey['rgb'];
				$this->assign_colors(['red'=>$c >> 16 & 255, 'green'=>$c >> 8 & 255, 'blue'=>$c & 255]);
				break ;

			case 3:
				$this->assign_colors($colorKey);
				break ;

			default:
				echo "Improper argument format passed to color constructor.";
		}
		if (self::$verbose)
			echo "$this constructed." . PHP_EOL;
	}
	
	public function __get($name) {
		if (isset($this->$name) || property_exists($this, $name))
			return $this->$name;
	}

	public function __set($name, $value) {
		if (isset($this->$name) || property_exists($this, $name))
			$this->$property = $value;
	}

	public function __destruct() {
		if (self::$verbose)
			echo "$this destructed." . PHP_EOL;
	}

	public function __toString() {
		$ret = sprintf("Color( red: %3d, green: %3d, blue: %3d )",
			$this->red,
			$this->green,
			$this->blue
		);
		return $ret;
	}

	public function add($color) {
		$ret = clone $this;
		$ret->red = $this->red + $color->red;
		$ret->green = $this->green+ $color->green;
		$ret->blue = $this->blue+ $color->blue;
		if (self::$verbose)
			echo "$ret constructed." . PHP_EOL;
		return $ret;
	}

	public function sub($color) {
		$ret = clone $this;
		$ret->red = $this->red - $color->red;
		$ret->green = $this->green - $color->green;
		$ret->blue = $this->blue - $color->blue;
		if (self::$verbose)
			echo "$ret constructed." . PHP_EOL;
		return $ret;
	}

	public function mult($val) {
		$ret = clone $this;
		$ret->red *= $val;
		$ret->green *= $val;
		$ret->blue *= $val;
		if (self::$verbose)
			echo "$ret constructed." . PHP_EOL;
		return $ret;
	}

	private function assign_colors($rgb) {
		$this->red = intval($rgb['red']);
		$this->green= intval($rgb['green']);
		$this->blue = intval($rgb['blue']);
	}

	static function doc() {
		return file_get_contents(__DIR__ . "/Color.doc.txt");
	}
}

?>
