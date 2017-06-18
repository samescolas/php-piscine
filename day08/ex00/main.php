<?

require_once(__DIR__ . "/HumanPlayer.class.php");
require_once(__DIR__ . "/Game.class.php");
require_once(__DIR__ . "/RandomName.class.php");
require_once(__DIR__ . "/Spaceship.class.php");

class randomName {
	use RandomNameGenerator;
	public $name;

	public function __construct() {
		$this->getNewName();
	}

	public function __toString() {
		return $this->name;
	}

	public function getNewName() {
		$this->name = $this->getRandomName();
	}
}

$players = [
	new HumanPlayer([]), new HumanPlayer([])
];

$g = new Game(['players' => $players]);

$n = new randomName();

$spacesShips = [];
foreach($players as $p) {
	$spacesShips[$p->name] = [];
	for($i=0;$i<mt_rand(2,5); $i++) {
		$spaceShips[$p->name][] = new Spaceship( [
			'name' => $n,
			'width' => mt_rand(0, 10000) % 4,
			'height' => mt_rand(0, 1000) % 5,
			'sprite' => 'PLACEHOLDER',
			'hullPoints' => mt_rand(0, 1742) % 10,
			'enginePower' => mt_rand(1, 1723) % 8,
			'speed' => mt_rand(1, 10),
			'handling' => mt_rand(0, 100) / 100,
			'shield' => mt_rand(0, 4),
			'weapons' => 'PLACEHOLDER',
		]);
		$n->getNewName();
	}
}

foreach($spaceShips as $s)
{
	print_r($s);
}

?>
