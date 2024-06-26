<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id=$_GET['id'];
	$fecha=$_GET["fecha"];
	$hora_entrada=$_GET["hora_e"];
	$hora_salida=$_GET["hora_s"];
	$retardo=$_GET['retardo'];
	$query = "DELETE FROM asistencia WHERE id_alumno=$id AND fecha='$fecha' AND hora_entrada='$hora_entrada' AND hora_salida='$hora_salida' AND retardo='$retardo'";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$fp = fopen("../log/".$id_alumno.".log", "a+");
	fputs($fp, "\n_________________________________________\nSe elimina la asistencia ".date("d-m-Y - H:i:s")."\nFecha: $fecha\nUsuario que elimina la asistencia: $_SESSION[user]\n_________________________________________");
	fclose($fp);
	header("Location:../forms/consultAssistanceForm.php?a=A0001&id=$_GET[alumno]&fecha_i=$_GET[fecha_i]&fecha_t=$_GET[fecha_t]&buscar_x=1");
?>