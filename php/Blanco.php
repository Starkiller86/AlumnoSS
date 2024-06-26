<?php 
header("Content-Type: text/html;charset=utf-8");
	require "../db/connectDB.php";



function limpia_espacios($cadena){
	$cadena = str_replace(' ', '', $cadena);
	return $cadena;
}
function cambiar($dato)
{
	$dato=str_replace('&oacute','&Oacute',$dato);
	$dato=str_replace('á',"&Aacute",$dato);
	$dato=str_replace('í',"Íacute",$dato);
	$dato=str_replace('é',"&Éacute",$dato);
	return $dato;
}

$cadena=limpia_espacios("Daniel Osornio Ruiz");
echo $cadena;



$query = "SELECT * FROM alumno, alumno_servicio, colegio WHERE alumno.id_alumno='693' AND alumno.id_alumno=alumno_servicio.id_alumno AND alumno.id_colegio=colegio.id_colegio";
		$result = mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		$row = mysqli_fetch_array($result);

		echo  $row['responsable'];
		$convercion=cambiar(strtoupper($row['responsable']));

$res = (empty($row['responsable'])== 1) ? "SIN RESPONSABLE" : cambiar(strtoupper($row['responsable']));
		echo  $convercion;
		echo empty($row['responsable']);

		echo "/n".$res;
		
		$str = str_replace("ll", "", "good golly miss molly!", $count);
echo $count;
echo $str;
echo str_replace('ó','&Oacute','ósornio');

echo "convertir a minúsculas: ".strtr(strtolower("CAMIÓN"),"ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ","à èìòùáéíóúçñäëïöü"); 
echo mb_strtolower("CAMIÓN",'UTF-8');
echo mb_strtoupper("camión",'UTF-8');
$nombre = "manual de php completo.chm"; 
$nombre = str_replace(" ", "", $nombre); 
echo str_replace(" ", "", mb_strtoupper($row['apellido_paterno']." ".$row['apellido_materno']." ".$row['nombre'],'UTF-8')).".docx";; 
							
		

?>