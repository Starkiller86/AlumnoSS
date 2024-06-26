<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$password = mysqli_real_escape_string($_POST["new_password"]);
	$query="UPDATE usuario SET password='$password' WHERE id_usuario=$_SESSION[id]";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$_SESSION['pass']=$password;
	mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	header("Location:../forms/changePasswordForm.php?a=A0001");
?>