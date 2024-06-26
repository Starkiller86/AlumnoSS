<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$nombre=$_POST["nombre"];
	$apellidoP = mysqli_real_escape_string($conn, $_POST["apellidoP"]);
	$apellidoM = mysqli_real_escape_string($conn, $_POST["apellidoM"]);
	$matricula = mysqli_real_escape_string($conn, $_POST["matricula"]);
	$direccion = mysqli_real_escape_string($conn, $_POST["direccion"]);
	$tel = mysqli_real_escape_string($conn, $_POST["tel"]);
	$mail = mysqli_real_escape_string($conn, $_POST["mail"]);
	$colegio = mysqli_real_escape_string($conn, $_POST["colegio"]);
	$carrera = mysqli_real_escape_string($conn, $_POST["carrera"]);
	$documen = mysqli_real_escape_string($conn, $_POST["documen"]);
	$semestre = mysqli_real_escape_string($conn, $_POST["sem"]);
	$escolaridad = $_POST["escolaridad"];
	$query="UPDATE alumno SET semestre=$semestre, escolaridad='$escolaridad', nombre='$nombre', apellido_paterno='$apellidoP', apellido_materno='$apellidoM', matricula='$matricula', direccion='$direccion', telefono='$tel', e_mail='$mail', id_colegio=$colegio, carrera='$carrera', documentos='$documen' WHERE id_alumno=$_POST[id_alumno]";
	$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$query="SELECT colegios FROM colegio where id_colegio=$colegio";
	$result=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
	$ncolegio = mysqli_fetch_array($result);
	mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$fp = fopen("../log/".$_POST['id_alumno'].".log", "a+");
	fputs($fp, "\n_________________________________________\nSe actualiza perfil ".date("d-m-Y - H:i:s")."\n\nNombre: $nombre $apellidoP $apellidoM\nDirección: $direccion\nTeléfono: $tel\nE-mail: $mail\nEscolaridad: $escolaridad\nInstitución: $ncolegio[0] ($colegio)\nCarrera: $carrera\nSemestre: $semestre\nDocumentación: $documen\n_________________________________________");
	fclose($fp);
	header("Location:../forms/updateStudentForm.php?a=A0001&id=$_POST[id_alumno]");
?>
