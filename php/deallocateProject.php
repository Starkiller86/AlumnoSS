<?php
     header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id_alumno=$_POST["id_alumno"];
	$id_proyecto=$_POST["id_proyecto"];
	$query = "SELECT lugares_requeridos, lugares_asignados, status FROM proyecto WHERE id_proyecto=$id_proyecto";
	$result = mysqli_query($conn,$query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$lugares = mysqli_fetch_array($result);
	if($lugares['status']=="Terminado"){
		header("Location:../forms/deallocateProjectForm.php?e=E0001");
	}
	else {
		$query = "DELETE FROM alumno_servicio WHERE id_alumno=$id_alumno";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$fp = fopen("../log/".$id_alumno.".log", "a+");
		fputs($fp, "\n_________________________________________\nSe desasigna el proyecto ".date("d-m-Y - H:i:s")."\nUsuario que desasigna el proyecto: $_SESSION[user]\n_________________________________________");
		fclose($fp);
		if($lugares['status']=="Ocupado"){
			$staff = $lugares["lugares_asignados"] - 1;
			$query = "UPDATE proyecto SET lugares_asignados=$staff, status='Disponible' WHERE id_proyecto=$id_proyecto";
			$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			header("Location:../forms/deallocateProjectForm.php?a=A0001");
		}
		else {
			$staff = $lugares["lugares_asignados"] - 1;
			$query = "UPDATE proyecto SET lugares_asignados=$staff WHERE id_proyecto=$id_proyecto";
			$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			header("Location:../forms/deallocateProjectForm.php?a=A0001");
		}
	}
?>