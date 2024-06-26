<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$nombre = mysqli_real_escape_string($conn, $_POST["nombre_proyecto"]);
	$area = mysqli_real_escape_string($conn, $_POST['area']);
	$lugares = mysqli_real_escape_string($conn, $_POST['lugares']);
	$descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
	$query="SELECT id_proyecto FROM proyecto WHERE status!='Terminado' AND nombre_proyecto='$nombre' AND area='$area'";
	$result = mysqli_query( $conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	if(mysqli_num_rows($result)>0){
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		header("Location:../forms/newProjectForm.php?e=E0001");
	}
	else {
		$query="INSERT INTO proyecto VALUES(null, '$nombre', '$descripcion', '$area', $lugares, 0, '".date("Y-m-d")."', '0000-01-01', 'Disponible')";
		$result = mysqli_query( $conn, $query);
		if(mysqli_error($conn)){
			header("Location:../forms/newProjectForm.php?emysql=".mysqli_error($conn));
			exit();
		}
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		header("Location:../forms/newProjectForm.php?a=A0001");
	}
?>
