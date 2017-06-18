<?php
session_start();

function	display($prod, $quantity, $is_admin)
{
echo '<div class="prod" href="add_prod.php?name='.$prod["name"].'">';
	if ($is_admin) 
	{
		echo "<a href='./mod_prod.php?name=".urlencode($prod["name"])."'>";
		echo "<img id='mod-icon' src='https://image.freepik.com/free-icon/settings-wheel_318-39936.jpg' />";
		echo "</a>";
		echo "<a href='./del_prod.php?name=".urlencode($prod["name"])."'>";
		echo "<img id='del-icon' src='https://image.freepik.com/free-icon/recycle-bin_318-55452.jpg' />";
		echo "</a>";
	}
		echo "<div class='prod-img'>";
			echo '<img src="'.$prod["image"].'" />';
		echo "</div>";
		echo "<hr />";
		echo "<div class='prod-info'>";
			echo "<p>".ucfirst($prod["name"])."</p>";
			echo "<p>".money_format("$%i", $prod["price"])."</p>";
			echo "<div class='quantity'>";
				echo "<input type='submit' name='".urlencode($prod['name'])."' value='-' />";
				echo "<span>".($quantity ? $quantity : '0')." in cart</span>";
				echo "<input type='submit' name='".urlencode($prod['name'])."' value='+' />";
			echo "</div>";
		echo "</div>";
	echo '</div>';
}

function	display_products($category)
{
	$is_admin = $_SESSION['admin'] != "";
	$fd = fopen('./products.txt', 'r');
	flock($fd, LOCK_SH);
	$products = unserialize(file_get_contents("products.txt"));
	flock($fd, LOCK_UN);
	fclose($fd);
	//if empty?
		echo "<form action='./add_prod.php?referer=index.php&category=".$_GET["category"]."' method='post'>";
		foreach($products as $prod)
		{
			if (in_array($category, $prod['categories']) || $category == "" || $category == "all")
			{
				$quantity = $_SESSION['basket'][$prod['name']];
				display($prod, $quantity, $is_admin);
			}
		}
		if ($is_admin)
		{
			echo '<div class="prod">';
			echo "<div class='add-img'>";
				echo "<a href='./create_prod.php'>";
					echo '<img src="https://image.freepik.com/free-icon/addition-thick-symbol_318-36715.jpg"/>';
				echo "</a>";
			echo "</div>";
			echo "<hr />";
			echo "<div class='prod-info'>";
				echo "<p>Add Product</p>";
			echo "</div>";
			echo '</div>';
		}


	echo "</form>";
}

?>
