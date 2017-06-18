<?php
session_start();

if ($_SESSION['admin'] == "")
{
	header("Location: ./index.php");
	exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
	if ($_POST['price'] === "" || !is_numeric($_POST['price']))
	{
		header("Location: ./create_prod.php");
		exit();
	}

	$fd = fopen("./products.txt", "r+");
	flock($fd, LOCK_EX);
	$products = unserialize(file_get_contents("./products.txt"));
	$products[$_POST['name']] = array(
		"name" => $_POST['name'],
		"price" => $_POST['price'],
		"categories" => explode(",", $_POST['categories']),
		"image" => $_POST['image']
	);
	array_unshift($products[$_POST['name']]['categories'], $_POST['name']);
	file_put_contents("./products.txt", serialize($products));
	flock($fd, LOCK_UN);
	fclose($fd);
	header("Location: ./index.php");
}
else
{
	echo "<html>
		<head>
		<title>Create Item</title>
			<link rel='stylesheet' href='./mod_prod.css' />
		</head>
		<body>
			<a id='back' href='index.php'><span>&#8619</span> Back to StoreName</a>
			<h1>Create Item</h1>
			<form action='./create_prod.php' method='post'>
				Name: <input name='name' type='text' /><br />
				Price: <input name='price' type='text' placeholder='0.00' /><br />
				Categories: <input name='categories' type='text' placeholder='Eg. vegetables,root,...'/><br />
				Image URL: <input name='image' type='text' value=''/><br />
				<input type='submit' value='Save Changes' />
			</form>
		</body>
		</html>";
}
