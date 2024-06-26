<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id = $_POST['id_alumno'];
	$status = $_POST['status'];
	if($status == "Activo") {
		$query = "UPDATE alumno SET status='Inactivo' WHERE id_alumno=$id AND status='Activo'";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$query = "UPDATE alumno_servicio SET status='Inactivo' WHERE id_alumno=$id AND status='Activo'";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$query = "UPDATE horario SET status='Inactivo' WHERE id_alumno=$id AND status='Activo'";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$fp = fopen("../log/".$id.".log", "a+");
		fputs($fp, "\n_________________________________________\nSe inactiva el usuario ".date("d-m-Y - H:i:s")."\nUsuario que inactiva al alumno: $_SESSION[user]\n_________________________________________");
		fclose($fp);
		header("Location:../forms/dropStudentForm.php?a=A0001&id=$id");
	}
	else {
		if($status == "Inactivo") {
			$query = "UPDATE alumno SET status='Activo' WHERE id_alumno=$id AND status='Inactivo'";
			$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			$query = "UPDATE alumno_servicio SET status='Activo' WHERE id_alumno=$id AND status='Inactivo'";
			$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			$query = "UPDATE horario SET status='Activo' WHERE id_alumno=$id AND status='Inactivo'";
			$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			$fp = fopen("../log/".$id.".log", "a+");
			fputs($fp, "\n_________________________________________\nSe reactiva el usuario ".date("d-m-Y - H:i:s")."\nUsuario que reactiva al alumno: $_SESSION[user]\n_________________________________________");
			fclose($fp);
			header("Location:../forms/dropStudentForm.php?a=A0002&id=$id");
		}
	}
?>