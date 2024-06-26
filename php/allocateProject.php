<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	if(isset($_POST['id'])){
		$id=$_POST["id"];
	}
	if(isset($_POST['update'])){
		$proyecto_anterior = $_POST["update"];
	}
	
	$proyecto = $_POST["proyecto"];
	$fecha_inicio = $_POST["fecha_i"];
	$fecha_termino = $_POST["fecha_t"];
	$tipo_servicio = $_POST["tipo_servicio"];
	$tipo_horas = $_POST["tipo_horas"];
	$jefe = mysqli_real_escape_string($conn, $_POST["jefe"]);
	$horas = mysqli_real_escape_string($conn, $_POST["horas"]);
	$fecha = date("Y-m-d");
	$query = "SELECT nombre_proyecto, lugares_requeridos, lugares_asignados, status FROM proyecto WHERE id_proyecto=$proyecto";
	$result = mysqli_query($conn,$query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	$lugares = mysqli_fetch_array($result);
	if($lugares['status']=="Terminado"){
		header("Location:../forms/allocateProjectForm.php?e=E0002&id=$id");
	}
	else {
		if($lugares['status']=="Ocupado"){
			if(isset($_POST['update'])){
				if($proyecto!=$proyecto_anterior) {
					header("Location:../forms/allocateProjectForm.php?e=E0001&id=$id");
				}
				else {
					$query = "UPDATE alumno_servicio SET fecha_inicio='$fecha_inicio', fecha_termino='$fecha_termino', no_horas=$horas, tipo_horas=$tipo_horas, tipo_servicio='$tipo_servicio' WHERE id_alumno=$id";
					$result = mysqli_query($conn,$query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
					$fp = fopen("../log/".$id.".log", "a+");
					fputs($fp, "\n_________________________________________\nid:".$id."\nSe actualiza proyecto (ocupado) ".date("Y-m-d - H:i:s")."\n\nProyecto: $lugares[0] ($proyecto)\nFecha de inicio: $fecha_inicio\nFecha termino: $fecha_termino\nTipo de servicio: $tipo_servicio\nTipo de horas: $tipo_horas\nJefe directo: $jefe\nHoras a realizar: $horas\nUsuario que asigna el proyecto: $_SESSION[user]\n_________________________________________");
					fclose($fp);
					header("Location:../forms/allocateProjectForm.php?a=A0002&id=$id");
				}
				
			}
			else {
				header("Location:../forms/allocateProjectForm.php?e=E0001&id=$id");
			}
		}
		else {
			if(isset($_POST['update'])){
				if($proyecto!=$proyecto_anterior) {
					$query = "SELECT lugares_requeridos, lugares_asignados, status FROM proyecto WHERE id_proyecto=$proyecto_anterior";
					$result = mysqli_query($conn,$query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
					$lugar = mysqli_fetch_array($result);
					if($lugar['status']=="Ocupado") {
						$query = "UPDATE proyecto SET lugares_asignados=".($lugar['lugares_asignados']-1).", status='Disponible' WHERE id_proyecto=$proyecto_anterior";
					}
					else {
						$query = "UPDATE proyecto SET lugares_asignados=".($lugar['lugares_asignados']-1)." WHERE id_proyecto=$proyecto_anterior";
					}
					$result = mysqli_query($conn,$query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
					if(($lugares['lugares_asignados']+1)==$lugares['lugares_requeridos']) {
						$query = "UPDATE proyecto SET lugares_asignados=".($lugares['lugares_asignados']+1).", status='Ocupado' WHERE id_proyecto=$proyecto";
					}
					else {
						$query = "UPDATE proyecto SET lugares_asignados=".($lugares['lugares_asignados']+1)." WHERE id_proyecto=$proyecto";
					}
					$result = mysqli_query($conn,$query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
					$query = "UPDATE alumno_servicio SET jefe_directo='$jefe', id_proyecto=$proyecto, fecha_inicio='$fecha_inicio', fecha_termino='$fecha_termino', no_horas=$horas, tipo_horas=$tipo_horas, tipo_servicio='$tipo_servicio' WHERE id_alumno=$id";
					$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
					$fp = fopen("../log/".$id.".log", "a+");
					fputs($fp, "\n_________________________________________\nSe actualiza proyecto (update)\n".date("Y-m-d - H:i:s")."\n\nProyecto: $lugares[0] ($proyecto)\nFecha de inicio: $fecha_inicio\nFecha termino: $fecha_termino\nTipo de servicio: $tipo_servicio\nTipo de horas: $tipo_horas\nJefe directo: $jefe\nHoras a realizar: $horas\nUsuario que asigna el proyecto: $_SESSION[user]\n_________________________________________");
					fclose($fp);
					header("Location:../forms/allocateProjectForm.php?a=A0002&id=$id");
				}
				else {
					$query = "UPDATE alumno_servicio SET jefe_directo='$jefe',fecha_inicio='$fecha_inicio', fecha_termino='$fecha_termino', no_horas=$horas, tipo_horas=$tipo_horas, tipo_servicio='$tipo_servicio' WHERE id_alumno=$id";
					$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
					$fp = fopen("../log/".$id.".log", "a+");
					fputs($fp, "\n_________________________________________\nSe actualiza proyecto (update else) ".date("Y-m-d - H:i:s")."\n\nProyecto: $lugares[0] ($proyecto)\nFecha de inicio: $fecha_inicio\nFecha termino: $fecha_termino\nTipo de servicio: $tipo_servicio\nTipo de horas: $tipo_horas\nJefe directo: $jefe\nHoras a realizar: $horas\nUsuario que asigna el proyecto: $_SESSION[user]\n_________________________________________");
					fclose($fp);
					header("Location:../forms/allocateProjectForm.php?a=A0002&id=$id");
				}
			}
			else {
				$query="INSERT INTO alumno_servicio VALUES($proyecto, $id, '$jefe', '$fecha_inicio', '$fecha_termino', $horas, $tipo_horas, '$tipo_servicio', 'Activo')";
				$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
				if(($lugares['lugares_asignados']+1)==$lugares['lugares_requeridos']){
					$query="UPDATE proyecto SET lugares_asignados=".($lugares['lugares_asignados']+1).", status='Ocupado' WHERE id_proyecto=$proyecto";
				}
				else {
					$query="UPDATE proyecto SET lugares_asignados=".($lugares['lugares_asignados']+1)." WHERE id_proyecto=$proyecto";
				}
				$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
				mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
				$fp = fopen("../log/".$id.".log", "a+");
				fputs($fp, "\n_________________________________________\nSe actualiza proyecto (else) ".date("%Y-%m-%d - H:i:s")."\n\nProyecto: $lugares[0] ($proyecto)\nFecha de inicio: $fecha_inicio\nFecha termino: $fecha_termino\nTipo de servicio: $tipo_servicio\nTipo de horas: $tipo_horas\nJefe directo: $jefe\nHoras a realizar: $horas\nUsuario que asigna el proyecto: $_SESSION[user]\n_________________________________________");
				fclose($fp);
				header("Location:../forms/allocateProjectForm.php?a=A0001&id=$id");
			}
		}
	}
	
?>
