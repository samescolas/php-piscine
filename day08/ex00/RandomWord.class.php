<?php

require_once(__DIR__ . "/Word.class.php");

class RandomWord extends Word {
	const NOUN = 1;
	const THING = 2;
	const VERB = 3;
	const ADVERB = 4;
	const ADJ = 5;
	const SAYING = 6;
	private $url = __DIR__ . "/data/";

	public function __construct($args) {
		extract($args);
		if (isset($type)) {
			switch($type) {
				case self::NOUN:
					$this->url .= "nouns";
					break ;
				case self::THING:
					$this->url .= "things";
					break ;
				case self::VERB:
					$this->url .= "verbs";
					break ;
				case self::ADVERB:
					$this->url .= "adverbs";
					break ;
				case self::ADJ:
					$this->url .= "adjectives";
					break ;
				case self::SAYING:
					$this->url .= "sayings";
					break ;
			}
			parent::__construct($this->getWord());
		}
		else
			die("Invalid argument parameters passed to constructor." . PHP_EOL);
	}

	public function getWord() {
		$list = explode(",", file_get_contents($this->url . ".txt"));
		return preg_replace('/\"/', '', $list[rand(1, count($list) - 3)]);
	}
}

?>
