<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id = $_POST["id"];
	$query="UPDATE alumno SET id_colegio=0 WHERE id_colegio=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$query="DELETE FROM colegio WHERE id_colegio=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	header("Location:../forms/dropSchoolForm.php?a=A0001");
?>