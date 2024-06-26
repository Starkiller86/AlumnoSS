<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$usuario = mysqli_real_escape_string($conn, $_POST['user']);
	$password = mysqli_real_escape_string($conn, $_POST['pass']);
	$query = "SELECT * FROM usuario WHERE nombre_usuario='$usuario' AND password='$password'";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_array($result);
		if($row['status'] != "Activo") {
			mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			header("Location:../index.php?e=E0003");
		}
		else {
			$_SESSION['user'] = $usuario;
			$_SESSION['pass'] = $password;
			$_SESSION['id'] = $row['id_usuario'];
			$_SESSION['nombre'] = $row['nombre'];
			$_SESSION['last_access'] = date("Y-n-j H:i:s");
			$_SESSION['privilegios'] = $row['privilegios'];
			mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			header("Location:../principal/default.php");
		}
	}
	else {
		$query = "SELECT * FROM usuario WHERE nombre_usuario='$usuario'";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		if(mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_array($result);
			if($row['status'] != "Activo") {
				mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
				header("Location:../index.php?e=E0003");
			}
			else {
				if($row['password']==""){
					mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
					header("Location:../index.php?e=E0005");
				}
				else{
					mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
					header("Location:../index.php?e=E0002");
				}
			}
		}
		else {
			mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			header("Location:../index.php?e=E0002");
		}
	}
?>