<?php

class NightsWatch {
	public $fighters;
	public $others;

	public function __construct() {
		$this->fighters = array();
		$this->others = array();
	}

	public function recruit($human) {
		if (method_exists($human, "fight"))
			$this->fighters[] = $human;
		else
			$this->others[] = $human;
	}

	public function fight() {
		foreach($this->fighters as $fighter) {
			$fighter->fight();
		}
	}
}

?>
