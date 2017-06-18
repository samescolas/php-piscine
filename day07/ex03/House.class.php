<?php

abstract class House {
	abstract protected function getHouseName();
	abstract protected function getHouseMotto();
	abstract protected function getHouseSeat();

	public function introduce() {
		echo "House " . $this->getHouseName() . " of " .
			$this->getHouseSeat() . " : \"" . 
			$this->getHouseMotto() . "\"" . PHP_EOL;
	}
}

?>
