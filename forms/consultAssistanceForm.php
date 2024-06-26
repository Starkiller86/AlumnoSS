<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Consulta de asistencias</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>	
		<link rel="stylesheet" href="../css/styleTable.css" type="text/css" media="print, projection, screen" />
		<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
		<script type="text/javascript">
			$(function() {
				$("table")
					.tablesorter({widthFixed: true, widgets: ['zebra']})
					.tablesorterPager({container: $("#pager")});
			});
		</script>
		<script src="../js/jscal2.js"></script>
		<script src="../js/es.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="../css/reduce-spacing.css" />
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'nombre' );
		</script>
		<script language="JavaScript">
			function abrirVentana(texto) {
				window.open('../php/absencePopup.php?text='+texto, '_blank', 'height=300, width=300, menubar=no, resizable=no, status=no, scrollbars=yes, titlebar=no, toolbar=no');
			}
			function abrirPopup(texto, fecha_i, fecha_t) {
				window.open('../php/retardmentPopup.php?id='+texto+'&fecha_i='+fecha_i+'&fecha_t='+fecha_t, '_blank', 'height=290, width=400, menubar=no, resizable=no, status=no, scrollbars=yes, titlebar=no, toolbar=no');
			}
		</script>
    </head>
	<body>
		<br><fieldset class="frame">
			<div id="legend">Asistencia de alumnos</div>
			<form id="formulario" name="formulario" method="GET" action="" style="padding-top:5px;">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT DISTINCT id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno WHERE status = 'Activo'  ORDER BY apellido_paterno, apellido_materno, nombre";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ($resultado = mysqli_fetch_array($QUERY)){
								if(isset($_GET['id'])){
									if($_GET['id'] == $resultado['id_alumno']){
										print ("<option value=$resultado[id_alumno] selected='selected'>$resultado[apellido_paterno] $resultado[apellido_materno] $resultado[nombre]</option>");
									}
									else {
										print ("<option value=$resultado[id_alumno]>$resultado[apellido_paterno] $resultado[apellido_materno] $resultado[nombre]</option>");
									}
								}
								else {
									if(isset($_GET['id_consulta'])){
										if($_GET['id_consulta'] == $resultado['id_alumno']){
											print ("<option value=$resultado[id_alumno] selected='selected'>$resultado[apellido_paterno] $resultado[apellido_materno] $resultado[nombre]</option>");
										}
										else {
											print ("<option value=$resultado[id_alumno]>$resultado[apellido_paterno] $resultado[apellido_materno] $resultado[nombre]</option>");
										}
									}
									else {
										print ("<option value=$resultado[id_alumno]>$resultado[apellido_paterno] $resultado[apellido_materno] $resultado[nombre]</option>");
									}
								}
							}
						?>
					</select>
				</span>
				<label>Fecha de inicio:</label>
				<input type="text" name="fecha_i" class="inputs" id="f_date1" style="width:100px;text-align:center" readonly="readonly" value="<?php if(isset($_GET['fecha_i'])) { echo $_GET['fecha_i']; } ?>">
				<label>Fecha de t&eacute;rmino:</label>
				<input type="text" name="fecha_t" class="inputs" id="f_date2" style="width:100px;text-align:center" readonly="readonly" value="<?php if(isset($_GET['fecha_t'])) { echo $_GET['fecha_t']; } ?>">
				<script type="text/javascript">
					var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() },
						showTime: false
					});
					cal.manageFields("f_date1", "f_date1", "%Y-%m-%d");
					cal.manageFields("f_date2", "f_date2", "%Y-%m-%d");
				</script>
				&nbsp;&nbsp;&nbsp;<input type="image" name="buscar" class="submit" src="../images/search.png"/ width="30px" height="30px" align="middle" title="Buscar">
			</form>
		</fieldset>
		<?php
			if(isset($_GET['buscar_x'])){
		?>
		<br><div>
			<?php
				if($_GET['fecha_t']==""&&$_GET['fecha_i']==""){
					$query="SELECT * FROM asistencia";
				}
				else {
					if($_GET['fecha_i']!=""&&$_GET['fecha_t']==""){
						$query="SELECT * FROM asistencia WHERE fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '".date("Y-m-j")." 23:59:59.999999'";
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
						$query = $query." AND id_alumno=$_GET[id]";
					}
					else {
						$query = $query." WHERE id_alumno=$_GET[id]";
					}
				}
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$registros=mysqli_num_rows($res);
				if($registros==0) {
					echo "<center><span style='font-size:12pt;color:red'>No se encontraron coincidencias!!!</span></center>";
				}
			?>
				<center><div id="pager" class="pager">
					<form>
						<img src="../images/first.png" class="first"/>
						<img src="../images/prev.png" class="prev"/>
						<input type="text" class="pagedisplay"/ style="text-align:center;" readonly="readonly">
						<img src="../images/next.png" class="next"/>
						<img src="../images/last.png" class="last"/>
						<select class="pagesize">
							<option selected="selected" value="5">5</option>
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option  value="40">40</option>
						</select>
					</form>
					<?php echo "<a href='../php/report.php?id=$_GET[id]&op=2&fecha_i=$_GET[fecha_i]&fecha_t=$_GET[fecha_t]' target='_blank'><img src='../images/pdf.png' title='Reporte de asistencia' style='border:0' height='30px' width='30px'></a>"; ?>
				</div></center>
				<div style="overflow-x:auto;width:100%;">
				<table cellspacing="1" class="tablesorter" id="table">
					<thead>
						<tr>
							<th><span>Fecha&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Hora de entrada&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Hora de salida&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Registro de salida&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Horas realizadas&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Horas reales&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Retardo&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Acciones&nbsp;&nbsp;&nbsp;</span></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td><span>Fecha</span></td>
							<td><span>Hora de entrada</span></td>
							<td><span>Hora de salida</span></td>
							<td><span>Registro de salida</span></td>
							<td><span>Horas realizadas</span></td>
							<td><span>Horas reales</span></td>
							<td><span>Retardo</span></td>
							<td><span>Acciones</span></td>
						</tr>
					</tfoot>
					<tbody>
					<?php
						while ($row = mysqli_fetch_array($res)){
							echo (
								"<tr><td><span>$row[fecha]</span></td>".
								"<td><span>$row[hora_entrada]</span></td>".
								"<td><span>$row[hora_salida]</span></td>".
								"<td><span>$row[status]</span></td>".
								"<td><span>$row[horas]</span></td>".
								"<td><span>$row[horas_reales]</span></td>".
								"<td><span>$row[retardo]</span></td>"
							);
							echo "<td style='text-align:center;'><a href='updateAssistanceForm.php?id=$row[id_alumno]&fecha=$row[fecha]&hora_e=$row[hora_entrada]&hora_s=$row[hora_salida]&retardo=$row[retardo]'><img src='../images/user_assistance.png' title='Modificar asistencia' style='border:0' height='20px' width='20px'></a>";
							echo "<a href='../php/dropAssistance.php?id=$row[id_alumno]&fecha=$row[fecha]&hora_e=$row[hora_entrada]&hora_s=$row[hora_salida]&alumno=$_GET[id]&fecha_i=$_GET[fecha_i]&fecha_t=$_GET[fecha_t]&retardo=$row[retardo]'><img src='../images/user_delAssistance.png' title='Eliminar asistencia' style='border:0' height='20px' width='20px'></a></td></tr>";
						}
					?>
					</tbody>
				</table>
				</div>
				<?php  if($registros>0) { echo "<br><center><span style='font-size:10pt;'>Se encontraron $registros coincidencias</span></center>"; } ?>
		</div>
		<?php
				$query="SELECT fecha_inicio FROM alumno_servicio WHERE id_alumno=$_GET[id]";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$inicio=mysqli_fetch_array($res);
				if($_GET['fecha_t']=="") {
					$fechaFin=strtotime(date("Y-m-j"));
				}
				else {
					$fechaFin=strtotime($_GET['fecha_t']);
				}
				if($_GET['fecha_i']=="") {
					$fechaInicio=strtotime($inicio['fecha_inicio']);
				}
				else {
					$fechaInicio=strtotime($_GET['fecha_i']);
				}
				$inicio=strtotime($inicio['fecha_inicio']);
				$fin=strtotime(date("Y-m-j"));
				if(isset($_GET['id'])&&$_GET['id']!=0){
					$faltast=0;
					$faltas=0;
					$sfaltast="";
					$sfaltas="";
					for($i=$inicio; $i<=$fin; $i+=86400){
						$dia = date("w", $i);
						$query="SELECT e$dia, s$dia FROM horario WHERE id_alumno=$_GET[id] AND e$dia IS NOT NULL AND s$dia IS NOT NULL";
						$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
						if(mysqli_num_rows($res)>0) {
							$query="SELECT id_alumno FROM asistencia WHERE id_alumno=$_GET[id] AND fecha='".date("Y-m-j", $i)."'";
							$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
							if(mysqli_num_rows($res)==0) {
								$faltast=$faltast+1;
								$sfaltast=$sfaltast.date("Y-m-j", $i)."/";
								if ($i>=$fechaInicio&&$i<=$fechaFin) {
									$faltas=$faltas+1;
									$sfaltas=$sfaltas.date("Y-m-j", $i)."/";
								}
							}
						}
					}
					echo "<br><center><a href='javascript:void(0)' onClick='javascript:abrirVentana(&quot;$sfaltas&quot;)'><span style='font-size:10pt;font-weight:bold;'>Faltas en el intervalo: $faltas</span></a> ---------- ";
					echo "<a href='javascript:void(0)' onClick='javascript:abrirVentana(&quot;$sfaltast&quot;)'><span style='font-size:10pt;font-weight:bold;'>Faltas acumuladas: $faltast</span></center></a>";
					if($_GET['fecha_t']==""&&$_GET['fecha_i']==""){
						$query="SELECT count(*) FROM (SELECT fecha FROM asistencia WHERE id_alumno=$_GET[id] AND retardo='R' GROUP BY fecha) temp";
					}
					else {
						if($_GET['fecha_i']!=""&&$_GET['fecha_t']==""){
							$query="SELECT count(*) FROM (SELECT fecha FROM asistencia WHERE id_alumno=$_GET[id] AND retardo='R' AND fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '".date("Y-m-j")." 23:59:59.999999' GROUP BY fecha) temp";
						}
						else {
							if ($_GET['fecha_i']==""&&$_GET['fecha_t']!=""){
								$query="SELECT count(*) FROM (SELECT fecha FROM asistencia WHERE id_alumno=$_GET[id] AND retardo='R' AND fecha BETWEEN '0000-00-00 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999' GROUP BY fecha) temp";
							}
							else {
								$query="SELECT count(*) FROM (SELECT fecha FROM asistencia WHERE id_alumno=$_GET[id] AND retardo='R' AND fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999' GROUP BY fecha) temp";
							}
						}
					}
					$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
					$row=mysqli_fetch_array($res);
					echo "<br><center><a href='javascript:void(0)' onClick='javascript:abrirPopup(&quot;$_GET[id]&quot;, &quot;".date("Y-m-j",$fechaInicio)."&quot;, &quot;".date("Y-m-j",$fechaFin)."&quot;)'><span style='font-size:10pt;font-weight:bold;'>Retardos en el intervalo: $row[0]</span></a> ---------- ";
					$query="SELECT count(*) FROM (SELECT fecha FROM asistencia WHERE id_alumno=$_GET[id] AND retardo='R' GROUP BY fecha) temp";
					$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
					$row=mysqli_fetch_array($res);
					echo "<a href='javascript:void(0)' onClick='javascript:abrirPopup(&quot;$_GET[id]&quot;, &quot;".date("Y-m-j",$inicio)."&quot;, &quot;".date("Y-m-j",$fin)."&quot;)'><span  style='font-size:10pt;font-weight:bold;'>Retardos acumulados: $row[0]</span></a></center>";
				}
				if($_GET['fecha_t']==""&&$_GET['fecha_i']==""){
					if(isset($_GET['id'])&&$_GET['id']!=0) {
						$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id]";
					}
					else {
						$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia";
					}
				}
				else {
					if($_GET['fecha_i']!=""&&$_GET['fecha_t']==""){
						if(isset($_GET['id'])&&$_GET['id']!=0){
							$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '".date("Y-m-j")." 23:59:59.999999'";
						}
						else{
							$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id] AND fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '".date("Y-m-j")." 23:59:59.999999'";
						}
					}
					else {
						if ($_GET['fecha_i']==""&&$_GET['fecha_t']!=""){
							if(isset($_GET['id'])&&$_GET['id']!=0){
								$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id] AND fecha BETWEEN '0000-00-00 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999'";
							}
							else {
								$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE fecha BETWEEN '0000-00-00 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999'";
							}
						}
						else {
							if(isset($_GET['id'])&&$_GET['id']!=0){
								$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id] AND fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999'";
							}
							else {
								$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999'";
							}
						}
					}
				}
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$row=mysqli_fetch_array($res);
				$horasx = $row["hora"];
				$min = $row["minutos"];
				$minutosx = $min%60;
				$h=(int)($min/60);
				$horasx+=$h;
				echo "<br><center><span style='font-size:11pt;font-weight:bold;'>Horas acumuladas en el intervalo: $horasx h $minutosx m ---------- ";
				if(isset($_GET['id'])&&$_GET['id']!=0){
					$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE id_alumno=$_GET[id]";
				}
				else {
					$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia";
				}
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$row=mysqli_fetch_array($res);
				$horasx = $row["hora"];
				$min = $row["minutos"];
				$minutosx = $min%60;
				$h=(int)($min/60);
				$horasx+=$h;
				echo "Total de horas acumuladas: $horasx h $minutosx m</span></center>";
			}
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
	</body>
</html>