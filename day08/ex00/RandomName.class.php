<?php

require_once( __DIR__ . "/RandomWord.class.php" );

trait RandomNameGenerator {
	public function getRandomName() {
		$name = "";
		$noun = new RandomWord( array ('type' => RandomWord::NOUN) );
		$adj= new RandomWord( array ('type' => RandomWord::ADJ) );
		$thing = new RandomWord( array ('type' => RandomWord::THING) );
		$verb = new RandomWord( array ('type' => RandomWord::VERB) );
		$adverb = new RandomWord( array ('type' => RandomWord::ADVERB) );
		if (rand(1, 2) % 2 == 0) {
			$name = "The " . ucfirst($noun);
			if (rand(1, 5) == 3) {
				do {
					$verb->value = $verb->getWord() . "er";
				} while ($verb->isWord() === False);
				$name .= " " . ucfirst($verb);
			}
			else if (rand(1, 10) % 5 <= 3) {
				if (rand(1, 3) == 3)
					$name .= (rand(1,2) == 1 ? " Daughter" : " Son");
				$name .= " of ";
				$name .= $this->getRandomName();
			}
		}
		else {
			$name = ucfirst($noun->value);
			if (rand(1, 75542) % 3 == 1) {
				$name .= " the ";
				$name .= (rand(1, 7) == 2 ? " Extra " . ucfirst($adj->value) : ucfirst($adj->value));
			}
			else if (rand(1, 2) == 2) {
				do {
					$verb->value = $verb->getWord() . "er";
				} while ($verb->isWord() === False);
				$name .= " the ";
				$name .= ucfirst($verb->value);
			}
			else if (rand(1, 100000) == 42)
				$name .= ", Ruler of the " . (rand(1, 2) == 1 ? "West" : "East");
			else
				$name .= ", Father of " . $this->getRandomName();
		}
		return $name;
	}
}

?>
