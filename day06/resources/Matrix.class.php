<?php

require_once(__DIR__ . '/Vector.class.php');

class Matrix {
	private $matrix;
	static $verbose = False;
	const IDENTITY = 0;
	const SCALE = 1;
	const RX = 2;
	const RY = 3;
	const RZ = 4;
	const TRANSLATION = 5;
	const PROJECTION = 6;

	public function __construct($args) {
		if (isset($args['preset'])) {
			switch ($args['preset']) {
				case self::IDENTITY:
					$this->matrix = [
						[1, 0, 0, 0],
						[0, 1, 0, 0],
						[0, 0, 1, 0],
						[0, 0, 0, 1]
					];
					$this->type = "IDENTITY";
					break ;
				case self::SCALE:
					if (isset($args['scale']))
						$s = $args['scale'];
					else
						die("Improper arguments passed to constructor.\n");
					$this->matrix = [
						[$s, 0, 0, 0],
						[0, $s, 0, 0],
						[0, 0, $s, 0],
						[0, 0, 0, 1]
					];
					$this->type = "SCALE";
					break ;
				case self::RX:
					if (isset($args['angle']))
						$a = $args['angle'];
					else
						die("Improper arguments passed to constructor.\n");
					$this->matrix = [
						[1, 0, 0, 0],
						[0, cos($a), -1 * sin($a), 0],
						[0, sin($a), cos($a), 0],
						[0, 0, 0, 1]
					];
					$this->type = "Ox ROTATION";
					break ;
				case self::RY:
					if (isset($args['angle']))
						$a = $args['angle'];
					else
						die("Improper arguments passed to constructor.\n");
					$this->matrix = [
						[cos($a), 0, sin($a), 0],
						[0, 1, 0, 0],
						[-1 * sin($a), 0, cos($a), 0],
						[0, 0, 0, 1]
					];
					$this->type = "Oy ROTATION";
					break ;
				case self::RZ:
					if (isset($args['angle']))
						$a = $args['angle'];
					else
						die("Improper arguments passed to constructor.\n");
					$this->matrix = [
						[cos($a), -1 * sin($a), 0, 0],
						[sin($a), cos($a), 0, 0],
						[0, 0, 1, 0],
						[0, 0, 0, 1]
					];
					$this->type = "Oz ROTATION";
					break ;
				case self::TRANSLATION:
					if (isset($args['vtc']))
						$v = $args['vtc'];
					else
						die("Improper arguments passed to constructor.\n");
					$this->matrix = [
						[1, 0, 0, $v->_x],
						[0, 1, 0, $v->_y],
						[0, 0, 1, $v->_z],
						[0, 0, 0, 1]
					];
					$this->type = "TRANSLATION";
					break ;
				case self::PROJECTION:
					if (isset($args['fov']) && isset($args['ratio']) && isset($args['near']) && isset($args['far'])) {
						$n = $args['near'];
						$f = $args['far'];
						$ratio = $args['ratio'];
						$fov = $args['fov'];
						$scale = tan($fov * 0.5 * pi() / 180) * $n;
						$r = $ratio * $scale;
						$l = -1 * $r;
					}
					$this->matrix = [
						[(2 * $n) / (2 * $r), 0, 0, 0],
						[0, 2 * $n / (2 * $scale), 0, 0],
						[0, 0, -1 * ($f + $n) / ($f - $n), -2 * $f * $n / ($f - $n)],
						[0, 0, -1, 0]
					];
					$this->type = "PROJECTION";
					break ;
				default:
					if (isset($args['m']))
						$this->matrix = $args['m'];
					else
						die("Invalid argument passed to preset constructor.\n");
			}
		}
		else
			die("Invalid argument passed to constructor.\n");
		/* VERBOSE OUTPUT NEEDED */
		if (self::$verbose) {
			if ($this->type == "IDENTITY")
				echo "Matrix " . $this->type . " instance constructed" . PHP_EOL;
			else if (!isset($args['m']))
				echo "Matrix " . $this->type . " preset instance constructed" . PHP_EOL;
		}
	}

	public function mult($m2) {
		$a = array([1, 1, 1, 1], [1, 1, 1, 1], [1, 1, 1, 1], [1, 1, 1, 1]);
		for ($row=0; $row<4; $row++) {
			for ($col=0; $col<4; $col++) {
				$sum = 0;
				for ($k=0; $k<4; $k++) {
					$sum += ($this->matrix[$row][$k] * $m2->matrix[$k][$col]);
				}
				$a[$row][$col] = $sum;
			}
		}
		$ret = new Matrix( array( 'preset' => '42', 'm' => $a ) );
		//echo "returning..." . PHP_EOL . $ret;
		return $ret;
	}

	public function transformVertex($v) {
		$coords = [$v->_x, $v->_y, $v->_z, $v->_w];
		$a= array();
		for ($row=0; $row<4; $row++) {
			$sum = 0;
			for ($k=0; $k<4; $k++) {
				$sum += ($this->matrix[$row][$k] * $coords[$k]);
			}
			$a[] = $sum;
		}
		$ret = new Vertex ( array(
			'x' => $a[0], 
			'y' => $a[1], 
			'z' => $a[2], 
			'w' => 1
		));
		return $ret;
	}

	public function __toString() {
		$ret = "M | vtcX | vtcY | vtcZ | vtxO" . PHP_EOL;
		$ret .= "-----------------------------" . PHP_EOL;
		foreach(array('x', 'y', 'z', 'w') as $key => $val) {
			$ret .= "$val";
			for ($i=0; $i<4; $i++)
				$ret .= sprintf(" | %0.2f", $this->matrix[$key][$i]);
			if ($key != 3)
				$ret .= PHP_EOL;
		}
		return $ret;
	}
	public function __destruct() {
		if (self::$verbose)
			echo "Matrix instance destructed" . PHP_EOL;
	}

	static function doc() {
		return file_get_contents(__DIR__ . "/Matrix.doc.txt");
	}

}



?>
