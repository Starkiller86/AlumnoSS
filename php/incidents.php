<?php
    header("Content-Type: text/html;charset=utf-8");
	require "../php/security.php";
	require "../db/connectDB.php";
	$id=$_POST['id'];
	$inicio=strtotime($_POST['fecha_i']);
	$fin=strtotime($_POST['fecha_t']);
	if(isset($_POST['agregar_x'])||isset($_POST['agregar_y'])) {
		for($i=$inicio; $i<=$fin; $i+=86400){
			$fecha=date("Y-m-j", $i);
			$dia = date("w", $i);
			$query="SELECT 1 FROM asistencia WHERE id_alumno=$id AND fecha=$fecha";
			$res=mysqli_query( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
			if(mysqli_num_rows($res)>0) {
				$query="DELETE FROM asistencia WHERE id_alumno=$id AND fecha=$fecha";
				$res=mysqli_query( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
			}
			$query="SELECT e$dia, s$dia FROM horario WHERE id_alumno=$id AND e$dia IS NOT NULL AND s$dia IS NOT NULL";
			$res=mysqli_query( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
			if(mysqli_num_rows($res)>0) {
				$row=mysqli_fetch_array($res);
				$query="SELECT tipo_horas FROM alumno_servicio WHERE id_alumno=$id";
				$result=mysqli_query( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$tipo=mysqli_fetch_array($result);
				$query="SELECT TIMEDIFF('$row[1]', '$row[0]')";
				$result = mysqli_query( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$horas_real = mysqli_fetch_array($result);
				$query="SELECT SEC_TO_TIME( TIME_TO_SEC( '$horas_real[0]' ) * $tipo[0] ) FROM dual";
				$result = mysqli_query( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$horas_totales=mysqli_fetch_array($result);
				$query="INSERT INTO asistencia VALUES ('$id','$fecha','$row[0]','$row[1]','Salida registrada', '$horas_real[0]', '$horas_totales[0]', '')";
				$result = mysqli_query( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
			}
		}
		mysqli_close($conn);
		$fp = fopen("../log/".$id.".log", "a+");
		fputs($fp, "\n_________________________________________\nSe agregan incidencias de asistencia ".date("d-m-Y - H:i:s")."\n\nFecha de inicio: $_POST[fecha_i]\nFecha de termino: $_POST[fecha_t]\nUsuario que agrega incidencias: $_SESSION[user]\n_________________________________________");
		fclose($fp);
		header("Location:../forms/incidentsForm.php?a=A0001");
	}
	else {
		if(isset($_POST['eliminar_x'])||isset($_POST['eliminar_y'])) {
			$query="DELETE FROM asistencia WHERE id_alumno=$id AND fecha BETWEEN '$_POST[fecha_i] 00:00:00.000000' AND '$_POST[fecha_t] 23:59:59.999999'";
			$result = mysqli_query( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		}
		mysqli_close($conn);
		$fp = fopen("../log/".$id.".log", "a+");
		fputs($fp, "\n_________________________________________\nSe eliminan asistencias ".date("d-m-Y - H:i:s")."\n\nFecha de inicio: $_POST[fecha_i]\nFecha de termino: $_POST[fecha_t]\nUsuario que elimina las asistencias: $_SESSION[user]\n_________________________________________");
		fclose($fp);
		header("Location:../forms/incidentsForm.php?a=A0002");
	}
?>