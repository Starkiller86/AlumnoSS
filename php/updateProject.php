<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id = $_POST['id'];
	$nombre = mysqli_real_escape_string($conn, $_POST["nombre_proyecto"]);
	$area = $_POST['area'];
	$lugares = $_POST['lugares'];
	$descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
	$query="SELECT id_proyecto FROM proyecto WHERE id_proyecto='$id' AND nombre_proyecto='$nombre' AND area='$area'";
	$result=mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	if (mysqli_num_rows($result)>0) {
		$query="SELECT lugares_asignados FROM proyecto WHERE id_proyecto=$_POST[id]";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		if($lugares<$row['lugares_asignados']) {
			mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			header("Location:../forms/updateProjectForm.php?e=E0002&proyecto=$_POST[id]");
		}
		else {
			if($lugares==$row['lugares_asignados']){
				$query="UPDATE proyecto SET nombre_proyecto='$nombre', descripcion='$descripcion', area='$area', lugares_requeridos=$lugares, status='Ocupado' WHERE id_proyecto=$_POST[id]";
				$result = mysqli_query($conn, $query);
				if(mysqli_error($conn)){
					header("Location:../forms/updateProjectForm.php?emysql=".mysqli_error($conn));
					exit();
				}
				mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
				header("Location:../forms/updateProjectForm.php?a=A0001&proyecto=$_POST[id]");
			}
			else {
				$query="UPDATE proyecto SET nombre_proyecto='$nombre', descripcion='$descripcion', area='$area', lugares_requeridos=$lugares, status='Disponible' WHERE id_proyecto=$_POST[id]";
				$result = mysqli_query($conn, $query);
				if(mysqli_error($conn)){
					header("Location:../forms/updateProjectForm.php?emysql=".mysqli_error($conn));
					exit();
				}
				mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
				header("Location:../forms/updateProjectForm.php?a=A0001&proyecto=$_POST[id]");
			}
		}
	}
	else {
		$query="SELECT id_proyecto FROM proyecto WHERE status!='Terminado' AND nombre_proyecto='$nombre' AND area='$area'";
		$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		if(mysqli_num_rows($result)>0){
			mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			header("Location:../forms/updateProjectForm.php?e=E0001&proyecto=$_POST[id]");
		}
		else {
			$query="SELECT lugares_asignados FROM proyecto WHERE id_proyecto=$_POST[id]";
			$result = mysqli_query($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
			$row = mysqli_fetch_array($result);
			if($lugares<$row['lugares_asignados']) {
				mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
				header("Location:../forms/updateProjectForm.php?e=E0002&proyecto=$_POST[id]");
			}
			else {
				if($lugares==$row['lugares_asignados']){
					$query="UPDATE proyecto SET nombre_proyecto='$nombre', descripcion='$descripcion', area='$area', lugares_requeridos=$lugares, status='Ocupado' WHERE id_proyecto=$_POST[id]";
					$result = mysqli_query($conn, $query);
					if(mysqli_error($conn)){
						header("Location:../forms/updateProjectForm.php?emysql=".mysqli_error($conn));
						exit();
					}
					mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
					header("Location:../forms/updateProjectForm.php?a=A0001&proyecto=$_POST[id]");
				}
				else {
					$query="UPDATE proyecto SET nombre_proyecto='$nombre', descripcion='$descripcion', area='$area', lugares_requeridos=$lugares, status='Disponible' WHERE id_proyecto=$_POST[id]";
					$result = mysqli_query($conn, $query);
					if(mysqli_error($conn)){
						header("Location:../forms/updateProjectForm.php?emysql=".mysqli_error($conn));
						exit();
					}
					mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
					header("Location:../forms/updateProjectForm.php?a=A0001&proyecto=$_POST[id]");
				}
			}
		}

	}
?>
