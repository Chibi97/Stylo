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
	<?php 
	  view("navigation"); 
	
		$route = resolveRoute();
		if(isset($route["view"])) {
			$view = $route["view"];
			$args = $route["args"];
			view($view, compact("args"));
		} else view("404");
	 ?>

	<?php view("footer"); ?>
	<?php view("scripts"); ?>
</body>
</html>
