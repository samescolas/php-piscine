<?php

include_once('Fighter.class.php');

class UnholyFactory {
	public $fighter_types;

	public function __construct() {
		$this->fighter_types = array();
	}

	public function absorb($obj) {
		if (is_subclass_of($obj, "Fighter")) {
			if (isset($this->fighter_types[$obj->type]))
				echo "(Factory already absorbed a fighter of type " . $obj->type . ")" . PHP_EOL;
			else {
				echo "(Factory absorbed a fighter of type " . $obj->type . ")" . PHP_EOL;
				$this->fighter_types[$obj->type] = $obj;
			}
		}
		else
			echo "(Factory can't absorb this, it's not a fighter)" . PHP_EOL;
	}

	public function fabricate($name) {
		if (array_key_exists($name, $this->fighter_types)) {
			echo "(Factory fabricates a fighter of type " . $name . ")" . PHP_EOL;
			return $this->fighter_types[$name];
		}
		else {
			echo "(Factory hasn't absorbed any fighter of type " . $name . ")" . PHP_EOL;
		}
	}
}

?>
