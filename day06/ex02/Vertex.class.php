<?php

require_once(__DIR__ . "/Color.class.php");


class Vertex {
	private $_x;
	private $_y;
	private $_z;
	private $_w;
	private $_color;
	static $verbose = False;

	public function __construct($args) {
		$this->_x = $args['x'];
		$this->_y = $args['y'];
		$this->_z = $args['z'];
		if (isset($args['w']))
			$this->_w = $args['w'];
		else
			$this->_w = 1.0;
		if (isset($args['color']))
			$this->_color = $args['color'];
		else
			$this->_color = new Color(array('rgb'=>0xffffff));
		if (self::$verbose)
			echo "$this constructed" . PHP_EOL;
	}

	public function __get($name) {
		if (isset($this->$name) || property_exists($this, $name))
			return $this->$name;
	}

	public function __set($name, $value) {
		if (isset($this->$name) || property_exists($this, $name))
		{
			switch($name) {
				case "_x":
				case "_y":
				case "_z":
				case "_w":
					if (is_float($value))
						$this->$name = $value;
					break ;
				case "_color":
					if (strtolower(get_class($value)) == "color")
						$this->$name = $value;
					break ;
			}
		}
	}

	public function __toString() {
		$base = sprintf("Vertex( x: %1.2f, y: %1.2f, z:%1.2f, w:%1.2f",
				$this->_x,
				$this->_y,
				$this->_z,
				$this->_w
		);
		if (self::$verbose)
			return $base . ", " . $this->_color . " )";
		else
			return $base . " )";
}


	public function __destruct() {
		if (self::$verbose)
			echo "$this destructed" . PHP_EOL;
	}

	static function doc() {
		return file_get_contents(__DIR__ . "/Vertex.doc.txt");
	}

}

?>
