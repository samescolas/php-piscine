<?php

include_once('Lannister.class.php');

class Tyrion extends Lannister{
	public $potential_mates;

	public function __construct() {
		$this->potential_mates = array();
	}
}

?>
