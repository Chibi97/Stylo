<?php 
  session_start();
	require_once "../src/utilities.php";
	require_once "../database.php";
?>
<!DOCTYPE html>
<html lang="en">
	<?php view("head"); ?>
	 

<!-- <body class="animsition"> -->
<body>
  <?php view("navigation"); ?>

	<?php 
		$route = resolveRoute();
		$view = $route["view"];
		$args = $route["args"];
		view($view, compact("args"));
	 ?>

	<?php view("footer"); ?>
	<?php view("scripts"); ?>
</body>
</html>
