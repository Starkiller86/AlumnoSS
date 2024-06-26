<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id=$_POST['id'];
	$entrada_anterior=$_POST['entrada_anterior'];
	$salida_anterior=$_POST['salida_anterior'];
	$fecha=$_POST["fecha"];
	$hora_entrada=$_POST["hora_e"];
	$hora_salida=$_POST["hora_s"];
	$hora_entrada=date("H:i:s",strtotime($hora_entrada));
	$hora_salida=date("H:i:s",strtotime($hora_salida));
	if(isset($_POST['retardo'])) {
		$retardo="R";
	}
	else {
		$retardo=" ";
	}
	$query = "UPDATE asistencia SET retardo='$retardo', hora_entrada='$hora_entrada', hora_salida='$hora_salida' WHERE id_alumno=$id AND fecha='$fecha' AND hora_entrada='$entrada_anterior' AND hora_salida='$salida_anterior' ORDER BY fecha ASC";              
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	if ($hora_salida=="00:00:00"){
		$query="UPDATE asistencia SET status='Salida no registrada', horas='00:00:00', horas_reales='00:00:00' WHERE id_alumno=$id AND fecha='$fecha' AND hora_entrada='$hora_entrada' AND hora_salida='$hora_salida'";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	}
	else {
		$query="SELECT tipo_horas FROM alumno_servicio WHERE id_alumno=$id";
		$result=mysqli_query($conn, $query) or header("Location:../index.php?emysql=".mysqli_error($conn));
		$tipo=mysqli_fetch_array($result);
		$query="SELECT TIMEDIFF('$hora_salida', '$hora_entrada') FROM dual";
		$result = mysqli_query($conn, $query) or header("Location:../index.php?emysql=".mysqli_error($conn));
		$horas_real = mysqli_fetch_array($result);
		$query="SELECT SEC_TO_TIME( TIME_TO_SEC( '$horas_real[0]' ) * $tipo[0] ) FROM dual";
		$result = mysqli_query($conn, $query) or header("Location:../index.php?emysql=".mysqli_error($conn));
		$horas_totales=mysqli_fetch_array($result);
		$query="UPDATE asistencia SET status='Salida registrada', horas='$horas_real[0]', horas_reales='$horas_totales[0]' WHERE id_alumno=$id AND fecha='$fecha' AND hora_entrada='$hora_entrada' AND hora_salida='$hora_salida'";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	}
	$fp = fopen("../log/".$id_alumno.".log", "a+");
	fputs($fp, "\n_________________________________________\nSe modifica asistencia ".date("d-m-Y - H:i:s")."\nFecha: $fecha\nUsuario que modifica la asistencia: $_SESSION[user]\n_________________________________________");
	fclose($fp);
	header("Location:../forms/updateAssistanceForm.php?a=A0001&id=$id&fecha=$fecha&hora_e=$hora_entrada&hora_s=$hora_salida&retardo=$retardo");
?>
