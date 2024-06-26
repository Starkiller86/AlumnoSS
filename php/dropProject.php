<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id = $_POST["id"];
	$query="UPDATE proyecto SET status='Terminado', fecha_termino='".date("Y-n-j")."' WHERE id_proyecto=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$query="UPDATE alumno_servicio SET status='Terminado', fecha_termino='".date("Y-n-j")."' WHERE id_proyecto=$id AND status='Activo'";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$query="SELECT id_alumno FROM alumno_servicio WHERE id_proyecto=$id";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	while($row=mysqli_fetch_array($result)) {
		$fp = fopen("../log/".$row['id_alumno'].".log", "a+");
		fputs($fp, "\n_________________________________________\nSe termina proyecto asignado ".date("d-m-Y - H:i:s")."\n_________________________________________");
		fclose($fp);
	}
	mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	header("Location:../forms/dropProjectForm.php?a=A0001");
?>