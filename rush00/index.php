<?php
	session_start();
	require("prod_display.php");
	require("category_display.php");
?>

<DOCTYPE! html>
<head>
	<title>STORE NAME</title>
	<link rel="stylesheet" href="index.css" />
	<script type="text/javascript" src="search.js"></script>
</head>
<body>
	<div id="header">
		<input id='search' type='text' placeholder='Search' />
		<?php
			display_search_categories();
		?>
        <?php
            if ($_SESSION["loggued_on_user"] == "")
            {
                echo '<a class=\'navbar\' href="login.php?referer=index.php">Login</a>';
                echo '<a class=\'navbar\' href="create.php?referer=index.php">Create Account</a>';
            }
            else 
            {
            	if ($_SESSION["admin"] != "")
            		echo '<a class=\'navbar\' href="admin.php">Admin</a>';
                echo '<a class=\'navbar\' href="logout.php">Logout</a>';
            }
        ?>
        <a class="navbar" href="modif.php">Change Password</a>
        <a class="navbar" href="basket.php">Basket</a>
    </div>
	<div id="main">
		<div class='categories'>
			<?php
				display_category_list();
			?>
		</div>
		<div id="products">
			<?php
				display_products($_GET['category']);
			?>
		</div>
	</div>


</body>
