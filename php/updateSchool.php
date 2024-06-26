<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id=$_POST['id'];
	$colegio = mysqli_real_escape_string($conn, $_POST["nombre_colegio"]);
	$responsable = mysqli_real_escape_string($conn, $_POST["res"]);
	$cargo_responsable = mysqli_real_escape_string($conn, $_POST["cargoRes"]);
	$query="SELECT colegios FROM colegio WHERE id_colegio='$id' AND colegios='$colegio'";
	$result=mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	if (mysqli_num_rows($result)>0) {
		$query="UPDATE colegio SET responsable='$responsable', cargo_responsable='$cargo_responsable' WHERE id_colegio=$id";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		header("Location:../forms/updateSchoolForm.php?a=A0001&colegio=$id");
	}
	else {
		$query="SELECT colegios FROM colegio WHERE colegios='$colegio'";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		if(mysqli_num_rows($result)>0){
			mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			header("Location:../forms/updateSchoolForm.php?e=E0001&colegio=$id");
		}
		else{
			$query="UPDATE colegio SET colegios='$colegio', responsable='$responsable', cargo_responsable='$cargo_responsable' WHERE id_colegio=$id";
			$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			header("Location:../forms/updateSchoolForm.php?a=A0001&colegio=$id");
		}
	}	
?>
