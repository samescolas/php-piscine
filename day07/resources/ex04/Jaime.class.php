<?php

include_once('Lannister.class.php');

class Jaime extends Lannister{
	public $potential_mates;

	public function __construct() {
		$this->potential_mates = array("Cersei");
	}
}

?>
