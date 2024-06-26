<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id = $_POST['id_usuario'];
	$status = $_POST['status'];
	if($status == "Activo") {
		$query = "UPDATE usuario SET status='Inactivo' WHERE id_usuario=$id";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		header("Location:../forms/dropUserForm.php?a=A0001&usuario=$id");
	}
	else {
		$query = "UPDATE usuario SET status='Activo' WHERE id_usuario=$id";
		$result = mysqli_query($conn,$query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		header("Location:../forms/dropUserForm.php?a=A0002&usuario=$id");
	}
?>