<?php
session_start();
require("auth.php");
if (auth($_POST["login"], $_POST["passwd"]))
	$_SESSION["loggued_on_user"] = $_POST["login"];
?>

<html>
<head>
	<link rel="stylesheet" href="basket.css" />
</head>
<body>
	<a id="back" href="index.php"><span>&#8619</span> Back to StoreName</a>
	<div id="checkout">
		<div class="summary check_sec">
			Order Summary
		</div>
		<div class="check_sec">
			Subtotal
			<span>
				<?php
					$products = unserialize(file_get_contents("products.txt"));
					$subtotal = 0;
					if (isset($_SESSION["basket"]))
					{
						foreach ($_SESSION["basket"] as $item => $qnt)
							$subtotal += (float)($products[$item]["price"]) * $qnt;
					}
					echo money_format("$%i", $subtotal);
				?>
			</span>
		</div>
		<div class="check_sec">
			Delivery Fee
			<span>$5.99</span>
		</div>
		<div class="check_sec">
			Tax
			<span>
				<?php
					$tax = .725 * $subtotal;
					echo money_format("$%i", $tax);
				?>
			</span>
		</div>
		<hr />
		<div class="check_sec">
			Payment Due
			<span>
				<?php
					echo money_format("$%i", $tax + $subtotal + 5.99);
				?>
			</span>
		</div>
		<?php
			if ($_SESSION["loggued_on_user"] != "")
				echo '<input id="checkout_submit" type="submit" name="checkout" value="Checkout" />';
			else
			{
				echo "<h1>Member Login</h1>";
				echo "<form method='post' action='./basket.php'>";
					echo "<input class='ifield' type='text' name='login' placeholder='Enter Username'/>";
					echo "<br />";
					echo "<input class='ifield' type='password' name='passwd' placeholder='Enter Password'/>";
					echo "<br />";
					echo "<input id='submit' type='submit' name='submit' value='OK' />";
					if (isset($_POST['login']) || isset($_POST['passwd']))
						echo "<p id='error-message'>Incorrect username or password.</p><br />"; 
				echo "</form>";
				echo '<a id="create" href="create.php?referer=basket.php">Create Account<a>';
			}
		?>
	</div>




	<form action='./add_prod.php?referer=basket.php' method='post'>
		<div id="items">
		<?php
		  if (!isset($_SESSION["basket"]) || count($_SESSION["basket"]) == 0)
		  {
				echo '<div class="item">';
						echo "<p id='empty'>Your Basket is Empty</p>";
				echo '</div>';
		  }
		  else
		  {
			foreach ($_SESSION["basket"] as $item => $qnt)
			{
				echo '<div class="item">';
					echo '<div class="img_cont">';
						echo '<img src="'.$products[$item]["image"].'"/ >';
					echo '</div>';
					echo '<div class="info_cont">';
						echo '<input id="delete" type="submit" name="'.urlencode($item).'" value="X" />';
						echo '<p>'.ucfirst($item).'</p>';
						echo '<p>'.money_format("$%i", $products[$item]["price"]).'</p>';
						echo "<div class='quantity'>";
							echo "<input type='submit' name='".urlencode($item)."' value='-' />";
							echo "<span>".$qnt." in cart</span>";
							echo "<input type='submit' name='".urlencode($item)."' value='+' />";
						echo "</div>";
					echo '</div>';
				echo '</div>';
			}
		  } 
		?>
		</div>
	</form>
