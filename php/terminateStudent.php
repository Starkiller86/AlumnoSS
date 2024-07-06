<?php
     header("Content-Type: text/html;charset=utf-8");
	require "../db/connectDB.php";
	require "security.php";
	if(isset($_GET['id'])) {
		$query = "SELECT id_proyecto FROM alumno_servicio WHERE id_alumno=$_GET[id] AND status='Activo'";
		$result = mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		$servicio=mysqli_fetch_array($result);
		if(isset($servicio['id_proyecto'])) {
			$query = "SELECT status, lugares_asignados FROM proyecto WHERE id_proyecto='$servicio[id_proyecto]'";
			$result = mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
			$proyecto=mysqli_fetch_array($result);
			if($proyecto['status']=="Ocupado"){
				$query="UPDATE proyecto SET lugares_asignados=".($proyecto['lugares_asignados']-1).", status='Disponible' WHERE id_proyecto=$servicio[id_proyecto]";
				$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			}
			else{
				$query="UPDATE proyecto SET lugares_asignados=".($proyecto['lugares_asignados']-1)." WHERE id_proyecto=$servicio[id_proyecto]";
				$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			}
		}
		$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id]";
		$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		$row=mysqli_fetch_array($res);
		$horasx = $row["hora"];
		$min = $row["minutos"];
		$minutosx = $min%60;
		$h=(int)($min/60);
		$horasx+=$h;
		$query = "UPDATE alumno SET status='Terminado' WHERE id_alumno=$_GET[id]";
		$result = mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		$query = "UPDATE alumno_servicio SET status='Terminado' WHERE id_alumno=$_GET[id]";
		$result = mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		$query = "UPDATE horario SET status='Terminado' WHERE id_alumno=$_GET[id]";
		$result = mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		$fp = fopen("../log/".$_GET['id'].".log", "a+");
		fputs($fp, "\n_________________________________________\nSe termina la sesión ".date("d-m-Y - H:i:s")."\nTotal de horas realizadas: $horasx hrs $minutosx mins\nUsuario que termina la sesión del alumno: $_SESSION[user]\n_________________________________________");
		fclose($fp);
		header("Location:../forms/terminationDocForm.php?id=$_GET[id]&a=A0001");
	}
	else {
		header("Location:../principal/start.php");
	}
?>
