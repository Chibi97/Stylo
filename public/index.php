<?php 
  session_start();
	require_once "../src/utilities.php";
	require_once "../database.php";
	require_once "../src/repository.php";

	$repo = new Repository($conn);
?>
<!DOCTYPE html>
<html lang="en">
	<?php view("head"); 

	$route = resolveRoute();
	$view = $route["view"];
	$args = $route["args"];
	$js_namespace = $route["namespace"];
	?>
<!-- <body class="animsition"> -->
<body class='animsition' data-namespace="<?= $js_namespace ?>">
	<?php 
	  view("navigation"); 
		view($view, compact("args"));
	 ?>

	<?php view("footer"); ?>
	<?php view("scripts"); ?>
</body>
</html>
<?php ?>