<?php
     header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$colegio = mysqli_real_escape_string($conn, $_POST["colegio"]);
	$responsable = mysqli_real_escape_string($conn, $_POST["res"]);
	$cargo = mysqli_real_escape_string($conn, $_POST["cargoRes"]);
	$query="SELECT colegios FROM colegio WHERE colegios='$colegio'";
	$result = mysqli_query( $conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	if(mysqli_num_rows($result)>0) {
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		header("Location:../forms/newSchoolForm.php?e=E0001");
	}
	else {
		$query="INSERT INTO colegio VALUES(null, '$colegio', '$responsable', '$cargo')";
		$result = mysqli_query( $conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		header("Location:../forms/newSchoolForm.php?a=A0001");
	}
?>
