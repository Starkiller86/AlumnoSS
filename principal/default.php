<?php
	require "../php/security.php";
?>
<html>
	<head>
		<title>Centro Educativo y Cultural del Estado de Querétaro</title>
	</head>
	<frameset rows="15%,5%,75%,5%" border='0'>
		<frame scrolling='no' name="head" src="header.php">
		<frame scrolling='no' name="head" src="hmenu.php">
		<frameset cols="16%,84%" border='0'>
			<frame scrolling='yes' name="side" src="menu.php"> 
			<frame scrolling='auto' name="content" src="start.php"> 
		</frameset>
		<frame scrolling='no' name="foot" src="footer.php">
	</frameset>
</html>
