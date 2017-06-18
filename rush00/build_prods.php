#!/usr/bin/php
<?php

$a = array(

	"banana"=> 
	[	
	"name"=>"banana",
	"categories"=>array("banana", "fruit"),
	"price"=>"0.15",
	"image"=>"http://www.halfyourplate.ca/wp-content/uploads/2015/01/banana_small.gif"
],

"black currant" =>
[
	"name"=>"black currant",
	"categories"=>array("black currant", "fruit"),
	"price"=>"2.50",
	"image"=>"http://www.halfyourplate.ca/wp-content/uploads/2015/01/blackcurrant_small.gif"
],

"cherries"=>
[
	"name"=>"cherries",
	"categories"=>array("cherries", "fruit"),
	"price"=>"3.00",
	"image"=>"http://www.halfyourplate.ca/wp-content/uploads/2015/01/cherries_small.jpg"
],

"cranberries"=>
[
	"name"=>"cranberries",
	"categories"=>array("cranberries", "fruit"),
	"price"=>"1",
	"image"=>"http://www.halfyourplate.ca/wp-content/uploads/2017/03/Cranberriesforwebsite1.jpg"
],

"asparagus"=>
[
	"name"=>"asparagus",
	"categories"=>array("asparagus", "vegetables"),
	"price"=>"2",
	"image"=>"http://images.groceryserver.com/groceryserver/haxor/log/clientId/ee3975a3dd472846611e50cbdf1e2679/zipCode/94043/recipeId/475756/upcValue/3338304080/entityType/promotion/entityId/36263086/retailerLocationId/70313/usage/getRecipeInformationByExternalId/promotion/200x188/34/3338304080.jpg.d.jpg"
],

"carrot"=>
[
	"name"=>"carrot",
	"categories"=>array("carrot", "vegetables"),
	"price"=>"1.25",
	"image"=>"http://www.eatsxm.com/uploads/1/3/8/6/13862036/1353573_orig.jpg"
],

"lettuce"=>
[
	"name"=>"lettuce", 
	"categories"=>array("lettuce", "vegetables"),
	"price"=>"2.25",
	"image"=>"http://ghk.h-cdn.co/assets/cm/15/11/480x552/54ff047238f22-green-leaf-lettuce-0707-xl.jpg"
],

"beet"=>
[
	"name"=>"beet",
	"categories"=>array("beet", "vegetables"),
	"price"=>"2.00",
	"image"=>"https://www.organicfacts.net/wp-content/uploads/2013/07/beetroot.jpg"
],

"eggplant"=>
[
	"name"=>"eggplant",
	"categories"=>array("eggplant", "vegetables"),
	"price"=>"1.75",
	"image"=>"http://www.rareseeds.com/assets/1/14/DimLarge/Eggplant-Florida-Market-IMG_4228-(3).jpg"
],

"potato"=>
[
	"name"=>"potato",
	"categories"=>array("potato", "vegetables"),
	"price"=>"3.50",
	"image"=>"https://cdn.shopify.com/s/files/1/1017/2183/t/2/assets/live-preview-potato.png?7512524907405341692"
	]

"peanuts"=>
[
	"name"=>"peanuts",
	"categories"=>array("peanuts", "vegetables"),
	"price"=>"2.00",
	"image"=>"https://www.organicfacts.net/wp-content/uploads/2013/07/beetroot.jpg"
],

"eggplant"=>
[
	"name"=>"eggplant",
	"categories"=>array("eggplant", "vegetables"),
	"price"=>"1.75",
	"image"=>"http://www.rareseeds.com/assets/1/14/DimLarge/Eggplant-Florida-Market-IMG_4228-(3).jpg"

);

	file_put_contents("products.txt", serialize($a));

$root = array("login"=>"root", "passwd"=>hash('sha256', "toor"), "admin"=>"true");
file_put_contents("./private/passwd", serialize($root));

?>
