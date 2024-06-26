<?php
    require_once('../ezpdf-master/src/ezpdf/class.ezpdf.php');
	require '../db/connectDB.php';
        
	$pdf =  new Cezpdf('A4');
	$pdf->selectFont('../fonts/Helvetica.afm');
	$pdf->ezSetCmMargins(1,1,1.5,1.5);
        header("Content-Type: text/html;charset=utf-8"); 
	if($_GET['op']==1) {
		$queEmp = "SELECT fecha, hora_entrada, hora_salida, horas, horas_reales, retardo 
           FROM asistencia 
           WHERE id_alumno = {$_GET['id']} 
           AND fecha = '" . date("Y-n-j") . "'";
		$resEmp = mysqli_query($conn, $queEmp) or die(mysqli_error($conn));
		$query = "SELECT nombre, apellido_paterno, apellido_materno FROM alumno WHERE id_alumno=$_GET[id]";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$row = mysqli_fetch_assoc($result);
		$nombre = $row['nombre']." ".$row['apellido_paterno']." ".$row['apellido_materno'];
		$nombre = utf8_decode($nombre);
                
		$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia WHERE fecha='".date("Y-n-j")."' AND id_alumno=$_GET[id]";
		$res=mysqli_query($conn, $query) or die(mysqli_error($conn));
		$row=mysqli_fetch_array($res);
		$horasx = $row["hora"];
		$min = $row["minutos"];
		$minutosx = $min%60;
		$h=(int)($min/60);
		$horasx+=$h;
		$horas_hoy = utf8_decode("Horas realizadas en el día: <b>$horasx h $minutosx m</b>");

		$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id]";
		$res=mysqli_query($conn, $query) or die(mysqli_error($conn));
		$row=mysqli_fetch_array($res);
		$horasx = $row["hora"];
		$min = $row["minutos"];
		$minutosx = $min%60;
		$h=(int)($min/60);
		$horasx+=$h;
		$horas_acumuladas = "Total de horas acumuladas: <b>$horasx h $minutosx m</b>";
	}
	else {
		if($_GET['op']==2){
			if($_GET['fecha_t']==""&&$_GET['fecha_i']==""){
				$query="SELECT * FROM asistencia ";
			}
			else {
				if($_GET['fecha_i']!=""&&$_GET['fecha_t']==""){
					$query="SELECT * FROM asistencia WHERE fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '".date("Y-n-j")." 23:59:59.999999'";
				}
				else {
					if ($_GET['fecha_i']==""&&$_GET['fecha_t']!=""){
						$query="SELECT * FROM asistencia WHERE fecha BETWEEN '0000-00-00 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999'";
					}
					else {
						$query="SELECT * FROM asistencia WHERE fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999'";
					}
				}
			   
                        }
			if(isset($_GET['id'])&&$_GET['id']!=0) {
				if($_GET['fecha_i']!=""||$_GET['fecha_t']!=""){
					$query = $query." AND id_alumno=$_GET[id] ORDER BY fecha ASC";
				}
				else {
					$query = $query." WHERE id_alumno=$_GET[id] ORDER BY fecha ASC";
				
                                   }
                               // {$query= "SELECT * FROM asistencia WHERE id_alumno = $_GET[id] ORDER BY fecha ASC";} //MIA 
			}
			$resEmp = mysqli_query($conn, $query) or die(mysqli_error($conn));
			$query = "SELECT nombre, apellido_paterno, apellido_materno FROM alumno WHERE id_alumno=$_GET[id]";
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			$row = mysqli_fetch_assoc($result);
			$nombre = $row['nombre']." ".$row['apellido_paterno']." ".$row['apellido_materno'];
                        $nombre = utf8_decode($nombre); //Esta es la que se agregó
			
			if($_GET['fecha_t']==""&&$_GET['fecha_i']==""){
				if(isset($_GET['id'])&&$_GET['id']!=0) {
					$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id]";
				}
				else {
					$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia";
				}
			}
			else {
				if($_GET['fecha_i']!=""&&$_GET['fecha_t']==""){
					if(isset($_GET['id'])&&$_GET['id']!=0){
						$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia WHERE fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '".date("Y-n-j")." 23:59:59.999999'"  ;
					}
					else{
						$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id] AND fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '".date("Y-n-j")." 23:59:59.999999'";
					}
				}
				else {
					if ($_GET['fecha_i']==""&&$_GET['fecha_t']!=""){
						if(isset($_GET['id'])&&$_GET['id']!=0){
							$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id] AND fecha BETWEEN '0000-00-00 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999'";
						}
						else {
							$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia WHERE fecha BETWEEN '0000-00-00 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999'";
						}
					}
					else {
						if(isset($_GET['id'])&&$_GET['id']!=0){
							$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id] AND fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999'";
						}
						else {
							$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia WHERE fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999'";
						}
					}
				}
			}
			$res=mysqli_query( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
			$row=mysqli_fetch_array($res);
			$horasx = $row["hora"];
			$min = $row["minutos"];
			$minutosx = $min%60;
			$h=(int)($min/60);
			$horasx+=$h;
			$horas_hoy = "Horas realizadas en el intervalo: <b>$horasx h $minutosx m</b>";
			echo "<br><center><span style='font-size:11pt;font-weight:bold;'>Horas acumuladas en el intervalo: $horasx h $minutosx m</span></center>";
			if(isset($_GET['id'])&&$_GET['id']!=0){
				$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id]";
			}
			else {
				$query="SELECT SUM(HOUR(horas)) AS hora, SUM(MINUTE(horas)) AS minutos FROM asistencia";
			}
			$res=mysqli_query( $conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
			$row=mysqli_fetch_array($res);
			$horasx = $row["hora"];
			$min = $row["minutos"];
			$minutosx = $min%60;
			$h=(int)($min/60);
			$horasx+=$h;
			$horas_acumuladas = "Total de horas acumuladas: <b>$horasx h $minutosx m</b>";
		}
	}
	$ixx = 0;
	$numero = mysqli_num_rows($resEmp);
	if($numero==0){
		$data = utf8_decode( "El alumno no tiene registradas asistencias el día de hoy");
	}
	else {
		while($datatmp = mysqli_fetch_assoc($resEmp)) { 
			$ixx = $ixx+1;
			$data[] = array_merge($datatmp, array('num'=>$ixx));
		}
	}
	$titles = array(
					'fecha'=>'<b>Fecha</b>',
					'hora_entrada'=>'<b>Entrada</b>',
					'hora_salida'=>'<b>Salida</b>',
					'horas'=>'<b>Horas realizadas</b>',
					'horas_reales'=>'<b>Horas reales</b>',
					'retardo'=>'<b>Retardo</b>'
					
				);
	$options = array(
					'shadeCol'=>array(0.9,0.9,0.9),
					'xOrientation'=>'center',
					'width'=>500
				);
	$pdf->ezImage('../images/logo111.jpg',50 , 200, 'none', 'right');
	$pdf->ezText("<b>REPORTE DE ASISTENCIA</b>\n", 12);
	$pdf->ezText("$nombre\n\n", 12);

	$pdf->ezText($txttit, 12);
	if($numero==0){
		$pdf->ezText($data, 10);
	}
	else {
		$pdf->ezTable($data, $titles, '', $options);
	}
	$pdf->ezText("\n\n", 10);
	$pdf->ezText("$horas_hoy", 10,array('justification'=>'center'));
	$pdf->ezText("$horas_acumuladas", 10,array('justification'=>'center'));
	$pdf->ezText("\n\n\n", 10);
	$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10,array('justification'=>'right'));
	$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10,array('justification'=>'right'));
	ob_end_clean();
	$pdf->ezStream();
?>
