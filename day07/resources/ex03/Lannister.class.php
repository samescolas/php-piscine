<?php

class Lannister {
	public $potential_mates;

	public function __construct() {
		$this->potential_mates = array("Jaime");
	}

	public function sleepWith($x) {
		if (property_exists($this, "potential_mates")) {
			if (in_array($x::class, $this->potential_mates))
				echo "With pleasure, but only in a tower in Winterfell, then." . PHP_EOL;
			else
				echo "Not even if I'm drunk!" . PHP_EOL;
		}
	}
}

?>
