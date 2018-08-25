<?php
class C_hello extends CI_Controller {
	function index() {
		?>
		<!doctype html>
		<html>
			<head>
				<title>Hello World!</title>
			</head>
			<body>
				<?php echo $random = random_int(0,100); ?>
			</body>
		</html>
		<?php
	}
}

?>