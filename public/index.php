<?php 
	require_once "../database.php";
?>
<!DOCTYPE html>
<html lang="en">
	<?php include_once "views/head.php"; ?>
	 
<body class="animsition">
		<!-- Header -->
  <?php include_once "views/header.php"; ?>

	<?php 
	$page = null;
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} ?>

	<?php 
	include_once "views/slider.php";
	include_once "views/featured_products.php";
	include_once "views/advertising.php";
	include_once "views/footer.php";
	require_once "views/scripts.php" ?>

</body>
</html>
