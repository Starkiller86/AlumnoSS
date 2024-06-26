<?php
	require "../php/security.php";
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="../css/footer.css">
	</head>
	<body>
		<div>
			<div class="textFooter">
				<label>bienvenido(a): <?php echo strtoupper($_SESSION['nombre']); ?>&nbsp;&nbsp;&nbsp;</label>
			</div>
		</div>
	</body>
</html>