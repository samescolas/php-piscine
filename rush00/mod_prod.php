<?php
session_start();

function display_mod_form($product)
{
	echo "<html>
		<head>
		<title>Modify ".ucfirst(urldecode($product['name']))."</title>
			<link rel='stylesheet' href='./mod_prod.css' />
		</head>
		<body>
			<a id='back' href='index.php'><span>&#8619</span> Back to StoreName</a>
			<h1>Update ".ucfirst(urldecode($product['name']))."</h1>
			<img src='".$product['image']."' />
			<form action='./mod_prod.php' method='post'>
				Name: <input name='name' type='text' value='".$product['name']."' /><br />
				Price: <input name='price' type='text' value='".$product['price']."' /><br />
				Categories: <input name='categories' type='text' value='".implode(",",array_slice($product['categories'], 1))."'/><br />
				Image URL: <input name='image' type='text' value='".$product['image']."'/><br />
				<input type='submit' name='".urlencode($product['name'])."' value='Save Changes' />
			</form>
		</body>
		</html>";

}

if ($_SESSION['admin'] == "")
{
	header("Location: index.php");
	exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
	$product = urldecode(array_search("Save Changes", $_POST));
	$fd = fopen("./products.txt", "r+");
	flock($fd, LOCK_EX);
	$products = unserialize(file_get_contents("./products.txt"));
	if (urldecode($_POST['name']) != $product)
		$products[$product]['categories'][0] = urldecode($_POST['name']);
	else
		$products[$product]['categories'][0] = urldecode($_POST['name']);
	$categories = explode(",", $_POST['categories']);
	for ($i=0; $i < count($categories); $i++)
		if (!in_array(urldecode($categories[$i]), $products[$product]['categories']))
			$products[$product]['categories'][$i + 1] = urldecode($categories[$i]);
	$products[$product]['name'] = urldecode($_POST['name']);
	$products[$product]['image'] = $_POST['image'];
	$products[$product]['price'] = $_POST['price'];
	if (urldecode($_POST['name']) != $product)
	{
		$products[urldecode($_POST['name'])] = $products[$product];
		unset($products[$product]);
	}
	file_put_contents("./products.txt", serialize($products));
	flock($fd, LOCK_UN);
	fclose($fd);
	header('Location: ./index.php');
}
else
{
	$fd = fopen("./products.txt", "r");
	flock($fd, LOCK_SH);
	$products = unserialize(file_get_contents("./products.txt"));
	flock($fd, LOCK_UN);
	fclose($fd);
	$product  = $products[urldecode($_GET['name'])];
	display_mod_form($product);
}
