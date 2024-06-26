<?php
    header("Content-Type: text/html;charset=utf-8");
	require "../db/connectDB.php";
	require "security.php";
	function leef($fichero) {
		$texto = file($fichero);
		$tamleef = sizeof($texto);
		$todo = "";
		for($n=0;$n<$tamleef;$n++) {
			$todo = $todo.$texto[$n];
		}
		return $todo;
	}
	
	function rtf($plantilla, $fsalida, $matequivalencias) {
		$pre = time();
		$fsalida = $fsalida.$pre.".rtf";
		$txtplantilla = leef($plantilla);
		$punt = fopen($fsalida, "w");
		foreach($matequivalencias as $dato) {
			$datosql = $dato[1];
			$datosql = stripslashes($datosql);
			$datortf = $dato[0];
			$datosql = str_replace("á","\\u193\\'c1",$datosql);
			$datosql = str_replace("é","\\u201\\'c9",$datosql);
			$datosql = str_replace("í","\\u205\\'cd",$datosql);
			$datosql = str_replace("ó","\\u211\\'d3",$datosql);
			$datosql = str_replace("ú","\\u218\\'da",$datosql);
			$datosql = str_replace("ñ","\\u209\\'d1",$datosql);
			$datosql = str_replace("Á","\\u193\\'c1",$datosql);
			$datosql = str_replace("É","\\u201\\'c9",$datosql);
			$datosql = str_replace("Í","\\u205\\'cd",$datosql);
			$datosql = str_replace("Ó","\\u211\\'d3",$datosql);
			$datosql = str_replace("Ú","\\u218\\'da",$datosql);
			$datosql = str_replace("Ñ","\\u209\\'d1",$datosql);
			$txtplantilla = str_replace($datortf, $datosql, $txtplantilla);
		}
		fputs($punt, $txtplantilla);
		fclose($punt);
		return $fsalida;
	}
	
	if(isset($_GET['id'])&&isset($_GET['doc'])) {
	
		$query = "SELECT * FROM alumno, alumno_servicio, colegio WHERE alumno.id_alumno=$_GET[id] AND alumno.id_alumno=alumno_servicio.id_alumno AND alumno.id_colegio=colegio.id_colegio";
		$result = mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		
		$query = "SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id]";
		$result = mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		$row_horas = mysqli_fetch_array($result);
		
		$query= "select area from proyecto where id_proyecto = $row[id_proyecto]";
		$result = mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		$row_area = mysqli_fetch_array($result);
	
		
		$fecha = date("Y-n-j");
		$hoy = explode("-", $fecha);
		$inicio = explode("-", $row['fecha_inicio']);
		$termino = explode("-", $row['fecha_termino']);
		if($hoy[1]==1) { $hoy[1]="Enero"; } else { 
			if($hoy[1]==2) { $hoy[1]="Febrero"; } else { 
				if($hoy[1]==3) { $hoy[1]="Marzo"; } else { 
					if($hoy[1]==4) { $hoy[1]="Abril"; } else { 
						if($hoy[1]==5) { $hoy[1]="Mayo"; } else { 
							if($hoy[1]==6) { $hoy[1]="Junio"; } else { 
								if($hoy[1]==7) { $hoy[1]="Julio"; } else { 
									if($hoy[1]==8) { $hoy[1]="Agosto"; } else { 
										if($hoy[1]==9) { $hoy[1]="Septiembre"; } else { 
											if($hoy[1]==10) { $hoy[1]="Octubre"; } else { 
												if($hoy[1]==11) { $hoy[1]="Noviembre"; } else { 
													if($hoy[1]==12) { $hoy[1]="Diciembre"; } } } } } } } } } } } }
		if($inicio[1]=="01") { $inicio[1]="Enero"; } else { 
			if($inicio[1]=="02") { $inicio[1]="Febrero"; } else { 
				if($inicio[1]=="03") { $inicio[1]="Marzo"; } else { 
					if($inicio[1]=="04") { $inicio[1]="Abril"; } else { 
						if($inicio[1]=="05") { $inicio[1]="Mayo"; } else { 
							if($inicio[1]=="06") { $inicio[1]="Junio"; } else { 
								if($inicio[1]=="07") { $inicio[1]="Julio"; } else { 
									if($inicio[1]=="08") { $inicio[1]="Agosto"; } else { 
										if($inicio[1]=="09") { $inicio[1]="Septiembre"; } else { 
											if($inicio[1]=="10") { $inicio[1]="Octubre"; } else { 
												if($inicio[1]=="11") { $inicio[1]="Noviembre"; } else { 
													if($inicio[1]=="12") { $inicio[1]="Diciembre"; } } } } } } } } } } } }
		if($termino[1]=="01") { $termino[1]="Enero"; } else { 
			if($termino[1]=="02") { $termino[1]="Febrero"; } else { 
				if($termino[1]=="03") { $termino[1]="Marzo"; } else { 
					if($termino[1]=="04") { $termino[1]="Abril"; } else { 
						if($termino[1]=="05") { $termino[1]="Mayo"; } else { 
							if($termino[1]=="06") { $termino[1]="Junio"; } else { 
								if($termino[1]=="07") { $termino[1]="Julio"; } else { 
									if($termino[1]=="08") { $termino[1]="Agosto"; } else { 
										if($termino[1]=="09") { $termino[1]="Septiembre"; } else { 
											if($termino[1]=="10") { $termino[1]="Octubre"; } else { 
												if($termino[1]=="11") { $termino[1]="Noviembre"; } else { 
													if($termino[1]=="12") { $termino[1]="Diciembre"; } } } } } } } } } } } }
		if($row['semestre']==1||$row['semestre']==3) { $row['semestre']=$row['semestre']."er"; } else {
			if($row['semestre']==2) { $row['semestre']=$row['semestre']."do"; } else {
				if($row['semestre']==4||$row['semestre']==5||$row['semestre']==6) { $row['semestre']=$row['semestre']."to"; } else {
					if($row['semestre']==7||$row['semestre']==10) { $row['semestre']=$row['semestre']."mo"; } else {
						if($row['semestre']==8||$row['semestre']>10) { $row['semestre']=$row['semestre']."vo"; } else {
							if($row['semestre']==9) { $row['semestre']=$row['semestre']."no"; } } } } } }
		if($row['escolaridad']=="Bachillerato") { $escolaridad="bachillerato"; } else { 
			if($row['escolaridad']=="Universidad") { $escolaridad="$row[semestre] semestre de la carrera"; } else { 
				if($row['escolaridad']=="Especialidad") { $escolaridad="$row[semestre] semestre de la especialidad"; } } }
		$plantilla = "../documents/$_GET[doc].rtf";
		$equivalencias[0][0] = "#*DIA*#";
		$equivalencias[0][1] = "$hoy[2]";
		$equivalencias[1][0] = "#*MES*#";
		$equivalencias[1][1] = "$hoy[1]";
		$equivalencias[2][0] = "#*ANO*#";
		$equivalencias[2][1] = "$hoy[0]";
		$equivalencias[3][0] = "#*NOMBRE*#";
		$equivalencias[3][1] = strtoupper($row['apellido_paterno'])." ".strtoupper($row['apellido_materno'])." ".strtoupper($row['nombre']);
		$equivalencias[4][0] = "#*CARRERA*#";
		$equivalencias[4][1] = strtoupper($row['carrera']);
		$equivalencias[5][0] = "#*CONTROL*#";
		$equivalencias[5][1] = strtoupper($row['matricula']);
		$equivalencias[6][0] = "#*TIPO*#";
		$equivalencias[6][1] = strtoupper($row['tipo_servicio']);
		$equivalencias[7][0] = "#*HORAS*#";
	    $equivalencias[7][1] = strtoupper($row['no_horas']);
		$equivalencias[8][0] = "#*DIAINC*#";
		$equivalencias[8][1] = "$inicio[2]";
		$equivalencias[9][0] = "#*MESINC*#";
		$equivalencias[9][1] = "$inicio[1]";
		$equivalencias[10][0] = "#*ANOINC*#";
		$equivalencias[10][1] = "$inicio[0]";
		$equivalencias[11][0] = "#*DIAFN*#";
		$equivalencias[11][1] = "$termino[2]";
		$equivalencias[12][0] = "#*MESFN*#";
		$equivalencias[12][1] = "$termino[1]";
		$equivalencias[13][0] = "#*ANOFN*#";
		$equivalencias[13][1] = "$termino[0]";
		$equivalencias[14][0] = "#*ESCOLARIDAD*#";
		$equivalencias[14][1] = "$escolaridad";
		$equivalencias[15][0] = "#*RESPONSABLE*#";
		$equivalencias[15][1] = strtoupper($row['responsable']);
		$equivalencias[16][0] = "#*CARGO*#";
		$equivalencias[16][1] = strtoupper($row['cargo_responsable']);
                $equivalencias[17][0] = "#*AREA*#";
                $equivalencias[17][1] = "$row_area[area]";
                $equivalencias[18][0] = "#*COLEGIO*#";
                $equivalencias[18][1] = "$row[colegios]";
		$equivalencias[19][0] = "#*TOTHORAS*#";
		$equivalencias[19][1] = strtoupper($row['no_horas']);
                $salida = rtf($plantilla, "doc", $equivalencias);
		
		$downloadfilename = basename($salida);
		$archivo = $salida;
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . $downloadfilename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($archivo));
		ob_clean();
		flush();
		readfile($archivo);
		unlink($archivo);
		exit;
	}
	else {
		header("Location:../principal/start.php");
	}
?>
