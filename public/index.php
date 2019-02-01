<?php 
	require_once "../database.php";
?>
<!DOCTYPE html>
<html lang="en">
	<?php include_once "views/head.php"; ?>
	 
<body class="animsition">
  <?php include_once "views/navigation.php"; ?>

	<?php 
	$page = null;
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} 
	
	switch($page) {
		case 'shop':
			include_once "views/all-products.php";
			break;
		case 'popular':
			include_once "views/featured-products.php";
			break;
	  case 'about':
			include_once "views/about.php";
			break;
		case 'contact':
			include_once "views/contact.php";
			break;
		case 'cart':
			include_once "views/cart.php";
			break;
		case 'product':
			include_once "views/product-details.php";
			break;
		default:
			include_once "views/slider.php";
			include_once "views/featured-products.php";
			include_once "views/advertising.php";
		  break;
	}
	
	include_once "views/footer.php";
	require_once "views/scripts.php"; ?>

</body>
</html>
