<?php

require_once(__DIR__ . "/Vertex.class.php");

class Vector {
	private $_x;
	private $_y;
	private $_z;
	private $_w = 0;
	static $verbose = False;

	public function __construct($args) {
		if (isset($args['dest']))
			$v1 = $args['dest'];
		else
			die("Improper constructor format for Vector class.\n");
		if (isset($args['orig']))
			$v2 = $args['orig'];
		else
			$v2 = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
		$this->_x = $v1->_x - $v2->_x;
		$this->_y = $v1->_y - $v2->_y;
		$this->_z = $v1->_z - $v2->_z;
		if (self::$verbose)
			echo "$this constructed" . PHP_EOL;
	}

	public function magnitude() {
		return sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2));
	}

	public function normalize() {
		$ret = new Vector( array(
			'dest' => new Vertex( array(
				'x' => $this->_x / $this->magnitude(),
				'y' => $this->_y / $this->magnitude(),
				'z' => $this->_z / $this->magnitude()
			))
		));
		return $ret;
	}

	public function add($v2) {
		$ret = new Vector( array(
			'dest' => new Vertex( array(
				'x' => $this->_x + $v2->_x,
				'y' => $this->_y + $v2->_y,
				'z' => $this->_z + $v2->_z
			))
		));
		return $ret;
	}

	public function sub($v2) {
		$ret = new Vector( array(
			'dest' => new Vertex( array(
				'x' => $this->_x - $v2->_x,
				'y' => $this->_y - $v2->_y,
				'z' => $this->_z - $v2->_z
			))
		));
		return $ret;
	}

	public function opposite() {
		$ret = new Vector( array(
			'dest' => new Vertex( array(
				'x' => $this->_x * -1,
				'y' => $this->_y * -1,
				'z' => $this->_z * -1
			))
		));
		return $ret;
	}

	public function scalarProduct($k) {
		$ret = new Vector( array(
			'dest' => new Vertex( array(
				'x' => $this->_x * $k,
				'y' => $this->_y * $k,
				'z' => $this->_z * $k
			))
		));
		return $ret;
	}

	public function dotProduct($v2) {
		return ($this->_x * $v2->_x) + ($this->_y * $v2->_y) + ($this->_z * $v2->_z);
	}

	public function cos($v2) {
		return $this->dotProduct($v2) / ($this->magnitude() * $v2->magnitude());
	}

	public function crossProduct($v2) {
		$ret = new Vector( array(
			'dest' => new Vertex( array(
				'x' => ($this->_y * $v2->_z) - ($this->_z * $v2->_y),
				'y' => ($this->_z * $v2->_x) - ($this->_x * $v2->_z),
				'z' => ($this->_x * $v2->_y) - ($this->_y * $v2->_x)
			))
		));
		return $ret;
	}

	public function __toString() {
		return sprintf("Vector( x:%1.2f, y:%1.2f, z:%1.2f, w:%1.2f )",
			$this->_x,
			$this->_y,
			$this->_z,
			$this->_w
		);
	}
 
	public function __get($name) {
		if (isset($this->$name) || property_exists($this, $name))
			return $this->$name;
	}

	public function __destruct() {
		if (self::$verbose)
			echo "$this destructed" . PHP_EOL;
	}


	static function doc() {
		return file_get_contents(__DIR__ . "/Vector.doc.txt");
	}

}

//Vector::$verbose = True;
/*
$vt = new Vertex( array( 'x' => 1.4, 'y' => 0.0, 'z' => 0.0 ) );
$vtx = new Vertex( array( 'x' => 2.0, 'y' => 0.0, 'z' => 0.0 ) );
$vty = new Vertex( array( 'x' => 0.0, 'y' => 1.0, 'z' => 0.0 ) );
$vtz = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 1.0 ) );

$v1 = new Vector ( array( 'dest' => $vtx) );
$v2 = new Vector ( array( 'dest' => $vty) );

$sum = $v1->sub($v2);
$norm = $v1->normalize();
echo "normalized: " . $norm;
 */


?>
