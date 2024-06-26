<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	require "password.php";
	$id=$_POST["id"];
	$password = generarPassword();
	$query="UPDATE alumno_password SET password='$password' WHERE id_alumno=$id";
	$res=mysqli_query($conn,$query) or header("Location:error.php?emysql=".mysqli_error($conn));
	mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$fp = fopen("../log/".$id.".log", "a+");
	fputs($fp, "\n_________________________________________\nSe cambia contraseña ".date("d-m-Y - H:i:s")."\n\nNueva contraseña: $password\nUsuario que cambia el password: $_SESSION[user]\n_________________________________________");
	fclose($fp);
	header("Location:../forms/allocatePasswordForm.php?a=A0001&pass=$password");
?>