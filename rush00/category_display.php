<?php

function	get_categories($all)
{
	$fd = fopen('./products.txt', 'r');
	flock($fd, LOCK_SH);
	$products = unserialize(file_get_contents("products.txt"));
	flock($fd, LOCK_UN);
	fclose($fd);
	//if empty?

	$categories = array();

	foreach($products as $prod)
	{
		foreach($prod['categories'] as $cat)
			if ($all || $cat != $prod['name'])
				$categories[$cat] = 1;
	}
	ksort($categories);
	return $categories;
}

function	display_category_list()
{
	$categories = get_categories(FALSE);
	echo "<a href='./index.php?category=all' class='category'>";
		echo "<div>All</div>";
	echo "</a>";
	foreach ($categories as $key=>$val)
	{
		echo "<a href='./index.php?category=$key' class='category'>";
			echo "<div>".ucfirst($key)."</div>";
		echo "</a>";
	}
}

function	display_search_categories()
{
	$categories = get_categories(TRUE);
	echo "<div id='search-category-container'>";
	foreach($categories as $key=>$val)
		echo "<a class='search-category' href='./index.php?category=$key'><div>".ucfirst($key)."</div></a>";
	echo "</div>";
}

?>
