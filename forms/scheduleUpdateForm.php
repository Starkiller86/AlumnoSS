<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Asignar horario</title>
		<script type="text/javascript" src="../js/validateSU.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/jquery.ptTimeSelect.css" />
		<link rel="stylesheet" type="text/css" href="../css/ui.theme.css" />
		<link rel="stylesheet" type="text/css" href="../css/ui.core.css" />
		<script type="text/javascript" src="../js/jquery.ptTimeSelect.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'nombre' );
		</script>
    </head>
	<body onLoad="document.getElementById('name').focus()">
		<br><fieldset class="frame">
			<div id="legend">Asignar horario</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT DISTINCT alumno.id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno, alumno_servicio WHERE alumno.status='Activo' AND alumno_servicio.status='Activo' ORDER BY apellido_paterno, apellido_materno, nombre";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_GET['id'])){
									if($_GET['id'] == $resultado['id_alumno']){
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
						?>
					</select>
				</span>
			</form>
		</fieldset>
		<?php
			if(isset($_GET['id'])&&$_GET['id']!=0){
				$query="SELECT * FROM horario where id_alumno=$_GET[id] and status='Activo'";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				if(mysqli_num_rows($res)>0){
					$row=mysqli_fetch_array($res);
					if($row['e0']!="") { $row['e0'] = date("g:i A",strtotime($row['e0'])); }
					if($row['e1']!="") { $row['e1'] = date("g:i A",strtotime($row['e1'])); }
					if($row['e2']!="") { $row['e2'] = date("g:i A",strtotime($row['e2'])); }
					if($row['e3']!="") { $row['e3'] = date("g:i A",strtotime($row['e3'])); }
					if($row['e4']!="") { $row['e4'] = date("g:i A",strtotime($row['e4'])); }
					if($row['e5']!="") { $row['e5'] = date("g:i A",strtotime($row['e5'])); }
					if($row['e6']!="") { $row['e6'] = date("g:i A",strtotime($row['e6'])); }
					if($row['s0']!="") { $row['s0'] = date("g:i A",strtotime($row['s0'])); }
					if($row['s1']!="") { $row['s1'] = date("g:i A",strtotime($row['s1'])); }
					if($row['s2']!="") { $row['s2'] = date("g:i A",strtotime($row['s2'])); }
					if($row['s3']!="") { $row['s3'] = date("g:i A",strtotime($row['s3'])); }
					if($row['s4']!="") { $row['s4'] = date("g:i A",strtotime($row['s4'])); }
					if($row['s5']!="") { $row['s5'] = date("g:i A",strtotime($row['s5'])); }
					if($row['s6']!="") { $row['s6'] = date("g:i A",strtotime($row['s6'])); }
					if(!(isset($_GET['a']))||!(isset($_GET['e']))) {
						echo "<script language='javascript' type='text/javascript'>jAlert('El alumno ya tiene asignado un horario.', 'Atención')</script>";
					}
				}
		?>
		<br><fieldset class="frame">
			<form method="post" action="../php/scheduleUpdate.php" name="updateForm" id="updateForm" onSubmit="return valida(this)">
					<br><table border='0' align="center">
						<tr>
							<td></td>
							<td></td>
							<td style="text-align:center">Entrada</td>
							<td style="text-align:center">Salida</td>
						</tr>
						<tr>
							<td>Lunes</td>
							<td><input type='checkbox' name='lunes' id="lunes" <?php if (isset($row)) { if ($row['e1']!=""||$row['s1']!="") { echo "checked"; } } else { echo "checked"; } ?> onclick = "lunes_e.disabled = !this.checked; lunes_s.disabled = !this.checked; lunes_e.value=''; lunes_s.value=''"></td>
							<td><input type='text' name='lunes_e' id="lunes_e" readonly <?php if(isset($row)) { if($row['e1']!="") { echo "value='$row[e1]'"; } else { echo "disabled"; } } ?> ></td>
							<td><input type='text' name='lunes_s' id="lunes_s" readonly <?php if(isset($row)) { if($row['s1']!="") { echo "value='$row[s1]'"; } else { echo "disabled"; } } ?> ></td>
						</tr>
						<tr>
							<td>Martes</td>
							<td><input type='checkbox' name='martes' id="martes" <?php if (isset($row)) { if ($row['e2']!=""||$row['s2']!="") { echo "checked"; } } else { echo "checked"; } ?> onclick = "martes_e.disabled = !this.checked; martes_s.disabled = !this.checked; martes_e.value=''; martes_s.value=''"></td>
							<td><input type='text' name='martes_e' id="martes_e" readonly <?php if(isset($row)) { if($row['e2']!="") { echo "value='$row[e2]'"; } else { echo "disabled"; } } ?> ></td>
							<td><input type='text' name='martes_s' id="martes_s" readonly <?php if(isset($row)) { if($row['s2']!="") { echo "value='$row[s2]'"; } else { echo "disabled"; } } ?> ></td>
						</tr>
						<tr>
							<td>Miércoles</td>
							<td><input type='checkbox' name='miercoles' id="miercoles" <?php if (isset($row)) { if ($row['e3']!=""||$row['s3']!="") { echo "checked"; } } else { echo "checked"; } ?> onclick = "miercoles_e.disabled = !this.checked; miercoles_s.disabled = !this.checked; miercoles_e.value=''; miercoles_s.value=''"></td>
							<td><input type='text' name='miercoles_e' id="miercoles_e" readonly <?php if(isset($row)) { if($row['e3']!="") { echo "value='$row[e3]'"; } else { echo "disabled"; } } ?> ></td>
							<td><input type='text' name='miercoles_s' id="miercoles_s" readonly <?php if(isset($row)) { if($row['s3']!="") { echo "value='$row[s3]'"; } else { echo "disabled"; } } ?> ></td>
						</tr>
						<tr>
							<td>Jueves</td>
							<td><input type='checkbox' name='jueves' id="jueves" <?php if (isset($row)) { if ($row['e4']!=""||$row['s4']!="") { echo "checked"; } } else { echo "checked"; } ?> onclick = "jueves_e.disabled = !this.checked; jueves_s.disabled = !this.checked; jueves_e.value=''; jueves_s.value=''"></td>
							<td><input type='text' name='jueves_e' id="jueves_e" readonly <?php if(isset($row)) { if($row['e4']!="") { echo "value='$row[e4]'"; } else { echo "disabled"; } } ?> ></td>
							<td><input type='text' name='jueves_s' id="jueves_s" readonly <?php if(isset($row)) { if($row['s4']!="") { echo "value='$row[s4]'"; } else { echo "disabled"; } } ?> ></td>
						</tr>
						<tr>
							<td>Viernes</td>
							<td><input type='checkbox' name='viernes' id="viernes" <?php if (isset($row)) { if ($row['e5']!=""||$row['s5']!="") { echo "checked"; } } else { echo "checked"; } ?> onclick = "viernes_e.disabled = !this.checked; viernes_s.disabled = !this.checked; viernes_e.value=''; viernes_s.value=''"></td>
							<td><input type='text' name='viernes_e' id="viernes_e" readonly <?php if(isset($row)) { if($row['e5']!="") { echo "value='$row[e5]'"; } else { echo "disabled"; } } ?> ></td>
							<td><input type='text' name='viernes_s' id="viernes_s" readonly <?php if(isset($row)) { if($row['s5']!="") { echo "value='$row[s5]'"; } else { echo "disabled"; } } ?> ></td>
						</tr>
						<tr>
							<td>Sábado</td>
							<td><input type='checkbox' name='sabado' id="sabado" <?php if (isset($row)) { if ($row['e6']!=""||$row['s6']!="") { echo "checked"; } } else { echo "checked"; } ?> onclick = "sabado_e.disabled = !this.checked; sabado_s.disabled = !this.checked; sabado_e.value=''; sabado_s.value=''"></td>
							<td><input type='text' name='sabado_e' id="sabado_e" readonly <?php if(isset($row)) { if($row['e6']!="") { echo "value='$row[e6]'"; } else { echo "disabled"; } } ?> ></td>
							<td><input type='text' name='sabado_s' id="sabado_s" readonly <?php if(isset($row)) { if($row['s6']!="") { echo "value='$row[s6]'"; } else { echo "disabled"; } } ?> ></td>
						</tr>
						<tr>
							<td>Domingo</td>
							<td><input type='checkbox' name='domingo' id="domingo" <?php if (isset($row)) { if ($row['e0']!=""||$row['s0']!="") { echo "checked"; } } else { echo "checked"; } ?> onclick = "domingo_e.disabled = !this.checked; domingo_s.disabled = !this.checked; domingo_e.value=''; domingo_s.value=''"></td>
							<td><input type='text' name='domingo_e' id="domingo_e" readonly <?php if(isset($row)) { if($row['e0']!="") { echo "value='$row[e0]'"; } else { echo "disabled"; } } ?> ></td>
							<td><input type='text' name='domingo_s' id="domingo_s" readonly <?php if(isset($row)) { if($row['s0']!="") { echo "value='$row[s0]'"; } else { echo "disabled"; } } ?> ></td>
						</tr>
						<script type="text/javascript">
							$('#lunes_e, #lunes_s, #martes_e, #martes_s, #miercoles_e, #miercoles_s, #jueves_e, #jueves_s, #viernes_e, #viernes_s, #sabado_e, #sabado_s, #domingo_e, #domingo_s').ptTimeSelect({
								hoursLabel: "Horas",
								minutesLabel: "Minutos",
								setButtonLabel: "Seleccionar",
								containerWidth: "300px"
							});
						</script>
					</table>
				<?php if(isset($row)) echo "<input type='hidden' name='update' value='yes'>"; ?>
				<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
				<input type="image" class="submit" src="../images/user_schedule.png" title="Modificar horario"/>
			</form>
		</fieldset>
		<?php
			}
		?>
    </body>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha asignado el horario correctamente.', 'Mensaje')</script>";
		}
		if($_GET['a']=="A0002") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha actualizado el horario correctamente.', 'Mensaje')</script>";
		}
	}
?>
