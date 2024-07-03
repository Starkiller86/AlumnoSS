<?php
    header("Content-Type: text/html;charset=utf-8");
	require "../db/connectDB.php";
	include "phplot.php";

		if($_GET['tipo']==1){
			if($_GET['fecha_t']==""&&$_GET['fecha_i']==""){
				$query="SELECT CONCAT(YEAR(fecha_inicio), '-', MONTH(fecha_inicio)) fecha, count(*) FROM alumno_servicio group by YEAR(fecha_inicio), MONTH(fecha_inicio) ORDER BY fecha_inicio";
			}
			else {
				if($_GET['fecha_i']!=""&&$_GET['fecha_t']==""){
					$query="SELECT CONCAT(YEAR(fecha_inicio), '-', MONTH(fecha_inicio)) fecha, count(*) FROM alumno_servicio WHERE fecha_inicio BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '".date("Y-n-j")." 23:59:59.999999' group by YEAR(fecha_inicio), MONTH(fecha_inicio) ORDER BY fecha_inicio";
				}
				else {
					if ($_GET['fecha_i']==""&&$_GET['fecha_t']!=""){
						$query="SELECT CONCAT(YEAR(fecha_inicio), '-', MONTH(fecha_inicio)) fecha, count(*) FROM alumno_servicio WHERE fecha_inicio BETWEEN '0000-00-00 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999' group by YEAR(fecha_inicio), MONTH(fecha_inicio) ORDER BY fecha_inicio";
					}
					else {
						$query="SELECT CONCAT(YEAR(fecha_inicio), '-', MONTH(fecha_inicio)) fecha, count(*) FROM alumno_servicio WHERE fecha_inicio BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999' group by YEAR(fecha_inicio), MONTH(fecha_inicio) ORDER BY fecha_inicio";
					}
				}
			}
		}
		else {
			if($_GET['tipo']==2){
				if($_GET['fecha_t']==""&&$_GET['fecha_i']==""){
					$query="SELECT CONCAT(YEAR(fecha_termino), '-', MONTH(fecha_termino)) fecha, count(*) FROM alumno_servicio where status='Terminado' group by YEAR(fecha_termino), MONTH(fecha_termino) ORDER BY fecha_termino";
				}
				else {
					if($_GET['fecha_i']!=""&&$_GET['fecha_t']==""){
						$query="SELECT CONCAT(YEAR(fecha_termino), '-', MONTH(fecha_termino)) fecha, count(*) FROM alumno_servicio WHERE status='Terminado' AND fecha_termino BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '".date("Y-n-j")." 23:59:59.999999' group by YEAR(fecha_termino), MONTH(fecha_termino) ORDER BY fecha_termino";
					}     
					else {
						if ($_GET['fecha_i']==""&&$_GET['fecha_t']!=""){
							$query="SELECT CONCAT(YEAR(fecha_termino), '-', MONTH(fecha_termino)) fecha, count(*) FROM alumno_servicio WHERE status='Terminado' AND fecha_termino BETWEEN '0000-00-00 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999' group by YEAR(fecha_termino), MONTH(fecha_termino) ORDER BY fecha_termino";
						}
						else {
							$query="SELECT CONCAT(YEAR(fecha_termino), '-', MONTH(fecha_termino)) fecha, count(*) FROM alumno_servicio WHERE status='Terminado' AND fecha_termino BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999' group by YEAR(fecha_termino), MONTH(fecha_termino) ORDER BY fecha_termino";
						}
					}
				}
			}
		}
		$file_path = __DIR__ . '/testfile.txt';
		$myfile = fopen($file_path, "w");
		if ($myfile === false) {
			die('Error: No se pudo abrir el archivo para escritura.');
		}
		
		fwrite($myfile, "Query".$query);
		fclose($myfile);
		$res=mysqli_query( $conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
		$num_rows = mysqli_num_rows($res);
		if($_GET['fecha_i']==""){
			$_GET['fecha_i'] = "0000-00-00";
		}
		if($_GET['fecha_t']==""){
			$_GET['fecha_t'] = date("Y-n-j");
		}
		if($num_rows==0) {
			$data=array(array("No se encontraron coincidencias",0));
		}
		else {
			for($i = 0; $i < $num_rows; $i++) {
				$data[]= mysqli_fetch_row($res);
			}
		}
		for ($i = 0; $i < $num_rows; $i++) {
			switch ($data[$i][0]) {
				case "1": $data[$i][0] = "Enero"; break;
				case "2": $data[$i][0] = "Febrero"; break;
				case "3": $data[$i][0] = "Marzo"; break;
				case "4": $data[$i][0] = "Abril"; break;
				case "5": $data[$i][0] = "Mayo"; break;
				case "6": $data[$i][0] = "Junio"; break;
				case "7": $data[$i][0] = "Julio"; break;
				case "8": $data[$i][0] = "Agosto"; break;
				case "9": $data[$i][0] = "Septiembre"; break;
				case "10": $data[$i][0] = "Octubre"; break;
				case "11": $data[$i][0] = "Noviembre"; break;
				case "12": $data[$i][0] = "Diciembre"; break;
			}
		}
		
		
		$p = new Phplot\Phplot\phplot(800, 600);
		$p->SetDefaultTTFont(__DIR__ . '/../fonts/arial.ttf');
$p->SetXTitle('Mes');
$p->SetYTitle('Cantidad');
$p->SetDataType('text-data');
$p->SetDataValues($data);
$p->SetPlotType('bars');
$p->SetBackgroundColor('#ffffcc');
$p->SetDrawPlotAreaBackground(True);
$p->SetPlotBgColor('#ffffff');
$p->SetPlotBorderType('full');
$p->SetLegend(array('Alumnos'));
$p->SetLegendWorld(0.1, 95);
$p->SetTitle('Alumnos inscritos en el periodo');
$p->SetDataColors(array('#008000', '#008000', '#0000FF')); // green, green, blue

	$p->DrawGraph();

		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
