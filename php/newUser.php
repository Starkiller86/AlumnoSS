<?php
     header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
	$usuario = mysqli_real_escape_string($conn, $_POST['user']);
	$password = mysqli_real_escape_string($conn, $_POST['pass']);
	$query = "SELECT id_usuario FROM usuario WHERE nombre_usuario='$usuario'";
	$result =  mysqli_query ( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
	if(mysqli_num_rows($result)>0) {
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		header("Location:../forms/newUserForm.php?e=E0001");
	}
	else {
		$query="INSERT INTO usuario VALUES(NULL, '$usuario', '$nombre', '$password', '00000000000000000000000000000000', 'Activo')";
		$result =  mysqli_query ( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		header("Location:../forms/newUserForm.php?a=A0001");
	}
?>
