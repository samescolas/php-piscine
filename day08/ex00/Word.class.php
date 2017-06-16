<?php

class Word {
	public $value;

	public function __construct($value) {
		$this->value = $value;
	}

	public function __toString() {
		return $this->value;
	}

	public function isWord() {
		$res = @file_get_contents("http://www.dictionary.com/browse/" . urlencode($this->value));
		if ($res == "")
			return False;
		else
			return True;
	}
}

?>
