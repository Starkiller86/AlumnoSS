<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id=$_POST["id_alumno"];
	$query="DELETE FROM comentarios WHERE id_alumno=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$query="DELETE FROM asistencia WHERE id_alumno=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$query="DELETE FROM horario WHERE id_alumno=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$query="DELETE FROM alumno_servicio WHERE id_alumno=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$query="DELETE FROM alumno_password WHERE id_alumno=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$query="DELETE FROM alumno WHERE id_alumno=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	if(isset($_POST['proyecto'])) {
		if($_POST['status']=="Ocupado"){
			$query="UPDATE proyecto SET lugares_asignados=".($_POST['lugares_asignados']-1).", status='Disponible' WHERE id_proyecto=$_POST[proyecto]";
			$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		}
		else{
			$query="UPDATE proyecto SET lugares_asignados=".($_POST['lugares_asignados']-1)." WHERE id_proyecto=$_POST[proyecto]";
			$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		}
	}
	mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$fp = fopen("../log/".$id.".log", "a+");
	fputs($fp, "\n_________________________________________\nSe elimina alumno ".date("d-m-Y - H:i:s")."\n\nUsuario que elimina al alumno: $_SESSION[user]\n_________________________________________");
	fclose($fp);
	header("Location:../forms/deleteStudentForm.php?a=A0001");
?>
