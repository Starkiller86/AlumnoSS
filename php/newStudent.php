<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	require "password.php";
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
	$coments = mysqli_real_escape_string($conn, $_POST["coments"]);
	$escolaridad = $_POST["escolaridad"];
	$fecha = date("Y-n-j");

	$queryExistsUser = "SELECT * FROM alumno WHERE nombre = '$nombre' and apellido_paterno = '$apellidoP' and apellido_materno = '$apellidoM' and matricula = '$matricula'";
	$resultExists = mysqli_query($conn, $queryExistsUser) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	
	if(mysqli_num_rows($resultExists) == 1){
		echo "<script language='javascript' type='text/javascript'>jAlert('El nombre, apellido y matricula ya existen.', 'Error')</script>";
		header("Location:../forms/newStudentForm.php?e=DUPLICATED");

	}else{
		$query="INSERT INTO alumno VALUES (NULL, '$nombre', '$apellidoP', '$apellidoM', '$matricula', '$direccion', '$tel', '$mail', '$escolaridad', '$colegio', '$carrera', $semestre, '$documen', '$fecha' , 'Activo')";
		echo $query."<br>";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$query="SELECT MAX(id_alumno) as id_alumno FROM alumno";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$row=mysqli_fetch_array($result);
		$password = generarPassword();
		$query="INSERT INTO alumno_password VALUES ($row[id_alumno], '$password')";
		echo $query."<br>";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$query="SELECT colegios FROM colegio where id_colegio=$colegio";
		$result=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		$ncolegio = mysqli_fetch_array($result);
		$query="INSERT INTO comentarios VALUES($row[id_alumno], '$coments', '".date("Y-m-d H:i:s")."')";
		$result=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$fp = fopen("../log/".$row['id_alumno'].".log", "a+");
		fputs($fp, "Creado el ".date("d-m-Y - H:i:s"));
		fputs($fp, "\n\nId: $row[id_alumno]\nPassword: $password\nNombre: $nombre $apellidoP $apellidoM\nDirecci�n: $direccion\nTel�fono: $tel\nE-mail: $mail\nEscolaridad: $escolaridad\nInstituci�n: $ncolegio[0] ($colegio)\nCarrera: $carrera\nSemestre: $semestre\nDocumentaci�n: $documen\n\nUsuario que agrega el alumno: $_SESSION[user]\n_________________________________________");
		fputs($fp, "\n".date("d-m-Y - H:i:s ----- ").$coments);
		fclose($fp);
		header("Location:../forms/newStudentForm.php?a=A0001&pass=$password&id=$row[id_alumno]");
	}
?>