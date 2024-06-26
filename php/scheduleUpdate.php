<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	print_r($_POST);
	$id=$_POST["id"];
	if (isset($_POST['lunes'])) {
		$lunes_e="'".date("H:i:s",strtotime($_POST['lunes_e']))."'";
		$lunes_s="'".date("H:i:s",strtotime($_POST['lunes_s']))."'";
	}
	else {
		$lunes_e="NULL";
		$lunes_s="NULL";
	}
	if (isset($_POST['martes'])) {
		$martes_e="'".date("H:i:s",strtotime($_POST['martes_e']))."'";
		$martes_s="'".date("H:i:s",strtotime($_POST['martes_s']))."'";
	}
	else {
		$martes_e="NULL";
		$martes_s="NULL";
	}
	if (isset($_POST['miercoles'])) {
		$miercoles_e="'".date("H:i:s",strtotime($_POST['miercoles_e']))."'";
		$miercoles_s="'".date("H:i:s",strtotime($_POST['miercoles_s']))."'";
	}
	else {
		$miercoles_e="NULL";
		$miercoles_s="NULL";
	}
	if (isset($_POST['jueves'])) {
		$jueves_e="'".date("H:i:s",strtotime($_POST['jueves_e']))."'";
		$jueves_s="'".date("H:i:s",strtotime($_POST['jueves_s']))."'";
	}
	else {
		$jueves_e="NULL";
		$jueves_s="NULL";
	}
	if (isset($_POST['viernes'])) {
		$viernes_e="'".date("H:i:s",strtotime($_POST['viernes_e']))."'";
		$viernes_s="'".date("H:i:s",strtotime($_POST['viernes_s']))."'";
	}
	else {
		$viernes_e="NULL";
		$viernes_s="NULL";
	}
	if (isset($_POST['sabado'])) {
		$sabado_e="'".date("H:i:s",strtotime($_POST['sabado_e']))."'";
		$sabado_s="'".date("H:i:s",strtotime($_POST['sabado_s']))."'";
	}
	else {
		$sabado_e="NULL";
		$sabado_s="NULL";
	}
	if (isset($_POST['domingo'])) {
		$domingo_e="'".date("H:i:s",strtotime($_POST['domingo_e']))."'";
		$domingo_s="'".date("H:i:s",strtotime($_POST['domingo_s']))."'";
	}
	else {
		$domingo_e="NULL";
		$domingo_s="NULL";
	}
	if (isset($_POST['update'])) {
		$query = "UPDATE horario SET e0=$domingo_e, e1=$lunes_e, e2=$martes_e, e3=$miercoles_e, e4=$jueves_e, e5=$viernes_e, e6=$sabado_e, s0=$domingo_s, s1=$lunes_s, s2=$martes_s, s3=$miercoles_s, s4=$jueves_s, s5=$viernes_s, s6=$sabado_s WHERE id_alumno=$id AND status='Activo'";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$fp = fopen("../log/".$id.".log", "a+");
		fputs($fp, "\n_________________________________________\nSe actualiza horario ".date("d-m-Y - H:i:s")."\n\nLunes: $lunes_e - $lunes_s\nMartes: $martes_e - $martes_s\nMiércoles: $miercoles_e - $miercoles_s\nJueves: $jueves_e - $jueves_s\nViernes: $viernes_e - $viernes_s\nSábado: $sabado_e - $sabado_s\nDomingo: $domingo_e - $domingo_s\nUsuario que actualiza el horario: $_SESSION[user]\n_________________________________________");
		fclose($fp);
		header("Location:../forms/scheduleUpdateForm.php?a=A0002&id=$id");
	}
	else {
		$query = "INSERT INTO horario VALUES( $id, $domingo_e, $lunes_e, $martes_e, $miercoles_e, $jueves_e, $viernes_e, $sabado_e, $domingo_s, $lunes_s, $martes_s, $miercoles_s, $jueves_s, $viernes_s, $sabado_s, 'Activo')";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$fp = fopen("../log/".$id.".log", "a+");
		fputs($fp, "\n_________________________________________\nSe actualiza horario ".date("d-m-Y - H:i:s")."\n\nLunes: $lunes_e - $lunes_s\nMartes: $martes_e - $martes_s\nMiércoles: $miercoles_e - $miercoles_s\nJueves: $jueves_e - $jueves_s\nViernes: $viernes_e - $viernes_s\nSábado: $sabado_e - $sabado_s\nDomingo: $domingo_e - $domingo_s\nUsuario que actualiza el horario: $_SESSION[user]\n_________________________________________");
		fclose($fp);
		header("Location:../forms/scheduleUpdateForm.php?a=A0001&id=$id");
	}
?>