<?php
	require "../db/connectDB.php";
	include('../php/phplot.php');
// Verifica si la extensión GD está habilitada
//if (extension_loaded('gd') && function_exists('gd_info')) {
//    echo "GD está habilitado en tu servidor.";
//    echo "<pre>";
//    print_r(gd_info());
//    echo "</pre>";
//} else {
//    echo "GD no está habilitado en tu servidor. Debes habilitarlo para usar PHPlot con fuentes TrueType.";
//}


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
		for($i = 0; $i < $num_rows; $i++) {
			if($data[$i][0]==1) { $data[$i][0]="Enero"; } else {
				if($data[$i][0]==2) { $data[$i][0]="Febrero"; } else {
					if($data[$i][0]==3) { $data[$i][0]="Marzo"; } else {
						if($data[$i][0]==4) { $data[$i][0]="Abril"; } else {
							if($data[$i][0]==5) { $data[$i][0]="Mayo"; } else {
								if($data[$i][0]==6) { $data[$i][0]="Junio"; } else {
									if($data[$i][0]==7) { $data[$i][0]="Julio"; } else {
										if($data[$i][0]==8) { $data[$i][0]="Agosto"; } else {
											if($data[$i][0]==9) { $data[$i][0]="Septiembre"; } else {
												if($data[$i][0]==10) { $data[$i][0]="Octubre"; } else {
													if($data[$i][0]==11) { $data[$i][0]="Noviembre"; } else {
														if($data[$i][0]==12) { $data[$i][0]="Diciembre"; } } } } } } } } } } } } }
		$p = new PHPlot(800, 400);
		$p->SetDefaultTTFont('../fonts/arial.ttf');
		$p->SetXTitle('Fecha');
		$p->SetYTitle('Alumnos');
		$p->SetDataType('text-data');
		$p->SetDataValues($data);
		$p->SetPlotType('bars');
		$p->SetBackgroundColor('#ffffcc');
		$p->SetDrawPlotAreaBackground(True);
		$p->SetPlotBgColor('#ffffff');
		$p->SetPlotBorderType('full');
		$p->SetLegend(array('Alumnos'));
		$p->SetLegendWorld(0.1, 95);
		if($_GET['tipo']==1){
			$p->SetTitle('Alumnos inscritos en el periodo');
			$p->SetDataColors(array('#c1e4eb'));
		}
		else {
			$p->SetTitle('Alumnos que terminaron en el periodo');
			$p->SetDataColors(array('#318ce7'));
		}
		$p->SetFont('x_label', '../fonts/arial.ttf', 12, '');
		$p->SetFont('y_label', '../fonts/arial.ttf', 12, '');
		$p->SetFont('legend', '../fonts/arial.ttf', 10, '');
		$p->SetFont('x_title', '../fonts/arial.ttf', 14, '');
		$p->SetFont('y_title', '../fonts/arial.ttf', 14, '');
		$p->SetFont('title', '../fonts/arial.ttf', 18, '');
		$p->DrawGraph();
		mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
?>
