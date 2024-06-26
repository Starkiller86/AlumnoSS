<?php
header("Content-Type: text/html;charset=utf-8");
require_once "../db/connectDB.php";
require_once "security.php";
require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
require_once '../php/PHPWord-master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();
use PhpOffice\PhpWord\TemplateProcessor;

$templateWord = new TemplateProcessor('plantilla.docx');
// $templateWord = new TemplateProcessor('../documents/plantilla.docx');
	
 
if(isset($_GET['id'])){


				 $query = "SELECT * FROM alumno, alumno_servicio, colegio WHERE alumno.id_alumno=".$_GET['id']." AND alumno.id_alumno=alumno_servicio.id_alumno AND alumno.id_colegio=colegio.id_colegio";
				$result = mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$row = mysqli_fetch_array($result);

				$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE asistencia.id_alumno=$_GET[id]";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$rows=mysqli_fetch_array($res);
				$horasx = $rows["hora"];
				$min = $rows["minutos"];
				$minutosx = $min%60;
				$h=(int)($min/60);
				$horasx+=$h;

		setlocale(LC_ALL,'es_MX'); 
		// #################################################################################################3
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
		// #################################################################################################3
		$dia = $hoy[2];
		$mes = $hoy[1];
		$ano = $hoy[0];
		$responsable = $resultado=(empty($row['responsable'])== 1) ? "SIN RESPONSABLE" : mb_strtoupper($row['responsable'],'UTF-8');
		$cargo = $resultado_cargo=(empty($row['cargo_responsable'])== 1) ? "SIN CARGO" : mb_strtoupper($row['cargo_responsable'],'UTF-8');
		$nombre = mb_strtoupper($row['apellido_paterno']." ".$row['apellido_materno']." ".$row['nombre'],'UTF-8');
		#################################################################################################
		if($row['semestre']==1||$row['semestre']==3) { $row['semestre']=$row['semestre']."er"; } else {
			if($row['semestre']==2) { $row['semestre']=$row['semestre']."do"; } else {
				if($row['semestre']==4||$row['semestre']==5||$row['semestre']==6) { $row['semestre']=$row['semestre']."to"; } else {
					if($row['semestre']==7||$row['semestre']==10) { $row['semestre']=$row['semestre']."mo"; } else {
						if($row['semestre']==8||$row['semestre']>10) { $row['semestre']=$row['semestre']."vo"; } else {
							if($row['semestre']==9) { $row['semestre']=$row['semestre']."no"; } } } } } }
		$semestre=$row['semestre'];
		$carrera = mb_strtoupper($row['carrera']);
		$matricula = mb_strtoupper($row['matricula']);
		$horas_acumuladas=$horasx.' hrs '.$minutosx.' min';
		$total_horas=$row['no_horas'].' hrs';
		$diainicio = $inicio[2] ;
		$mesinicio = $inicio[1] ;
		$anoinicio = $inicio[0] ;
		// $nombreArch=str_replace(" ", "", mb_strtoupper($row['apellido_paterno']." ".$row['apellido_materno']." ".$row['nombre'],'UTF-8')).".docx";
		$nombreArch=str_replace(" ", "", mb_strtoupper($row['apellido_paterno'],'UTF-8'))."_".str_replace(" ", "", mb_strtoupper($row['apellido_materno'],'UTF-8'))."_".str_replace(" ", "", mb_strtoupper($row['nombre'],'UTF-8')).".docx";

// --- Asignamos valores a la plantilla
		$templateWord->setValue('dia',$dia);
		$templateWord->setValue('mes',$mes);
		$templateWord->setValue('ano',$ano);
		$templateWord->setValue('Responsable',$responsable);
		$templateWord->setValue('Cargo',$cargo);
		$templateWord->setValue('nombrealu',$nombre);
		$templateWord->setValue('semestre',$semestre);
		$templateWord->setValue('carrera',$carrera);
		$templateWord->setValue('control',$matricula);
		$templateWord->setValue('horasacumuladas',$horas_acumuladas);
		$templateWord->setValue('horastotales',$total_horas);
		$templateWord->setValue('diainicio',$diainicio);
		$templateWord->setValue('mesinicio',$mesinicio);
		$templateWord->setValue('anoinicio',$anoinicio);
		$templateWord->setValue('area',$area);
        $templateWord->setValue('colegio',$colegio);

// --- Guardamos el documento
// $templateWord->saveAs('../documents/Documento02.docx');
$templateWord->saveAs('Documento02.docx');

header("Content-Disposition: attachment; filename=$nombreArch; charset=iso-8859-1");
echo file_get_contents('Documento02.docx');



	
}
?>
