<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id = $_POST['id_usuario'];
	$query = "DELETE FROM usuario WHERE id_usuario=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	header("Location:../forms/deleteUserForm.php?a=A0001");
?>