<?php

require_once( __DIR__ . "/RandomWord.class.php" );

class RandomName {
	public $name;

	public function __construct() {
		$noun = new RandomWord( array ('type' => RandomWord::NOUN) );
		$adj= new RandomWord( array ('type' => RandomWord::ADJ) );
		$thing = new RandomWord( array ('type' => RandomWord::THING) );
		$verb = new RandomWord( array ('type' => RandomWord::VERB) );
		$adverb = new RandomWord( array ('type' => RandomWord::ADVERB) );
		if (rand(1, 2) % 2 == 0) {
			$this->name = "The " . ucfirst($noun);
			if (rand(1, 5) == 3) {
				do {
					$verb->value = $verb->getWord() . "er";
				} while ($verb->isWord() === False);
				$this->name .= " " . ucfirst($verb);
			}
			else if (rand(1, 10) % 5 <= 3) {
				if (rand(1, 3) == 3)
					$this->name .= (rand(1,2) == 1 ? " Daughter" : " Son");
				$this->name .= " of ";
				$n = new RandomName();
				$this->name .= $n->name;
			}

		}
		else {
			$this->name = ucfirst($noun->value);
			if (rand(1, 75542) % 3 == 1) {
				$this->name .= " the ";
				$this->name .= (rand(1, 7) == 2 ? " Extra " . ucfirst($adj->value) : ucfirst($adj->value));
			}
			else if (rand(1, 2) == 2) {
				do {
					$verb->value = $verb->getWord() . "er";
				} while ($verb->isWord() === False);
				$this->name .= " the ";
				$this->name .= ucfirst($verb->value);
			}
			else if (rand(1, 100000) == 42) {
				$this->name .= ", Ruler of the " . (rand(1, 2) == 1 ? "West" : "East");
			}
			else {
				$n = new RandomName();
				$this->name .= ", Father of " . $n->name;
			}
		}
	}

	public function __toString() {
		return $this->name;
	}
}

$n = new RandomName();

echo $n.PHP_EOL;

?>
