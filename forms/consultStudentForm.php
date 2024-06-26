<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
                <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Consultar Alumnos</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'colegio' );
			new YAHOO.Hack.FixIESelectWidth( 'proyecto' );
			new YAHOO.Hack.FixIESelectWidth( 'servicio' );
		</script>
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
    </head>
    <body onLoad="document.getElementById('name').focus()">
		<br><fieldset class="frame">
			<div id="legend">Consultar alumnos</div>
			<br><form id="formulario" name="formulario" method="post" action="">
				<label>Fecha:</label>
				<input type="text" name="fecha" class="inputs" id="f_date1" style="width:100px;text-align:center" readonly="readonly" value="<?php if(isset($_POST['fecha'])) echo $_POST['fecha']; ?>">
				<script type="text/javascript">
					var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() },
						showTime: false
					});
					cal.manageFields("f_date1", "f_date1", "%Y-%m-%d");
				</script>
				<label>Nombre:</label>
				<input type="text" name="nombre" class="inputs"  id="name" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']; ?>">
				<label>Apellido Paterno:</label>
				<input type="text" name="apellidoP" class="inputs"  style="width:150px;" value="<?php if(isset($_POST['apellidoP'])) echo $_POST['apellidoP']; ?>">
				<label>Apellido Materno:</label>
				<input type="text" name="apellidoM" class="inputs"  style="width:150px;" value="<?php if(isset($_POST['apellidoM'])) echo $_POST['apellidoM']; ?>"><br>
				<label>Proyecto:</label>
				<span class="select-box">
					<select name='proyecto' id="proyecto" class="inputs" id="proyecto">
						<option value="0">Selecciona el proyecto...</option>
						<?php
							header('Content-Type: text/html; charset=utf-8');
							$SQL = "SELECT DISTINCT nombre_proyecto, id_proyecto, area FROM proyecto;";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_POST['proyecto'])){
									if($_POST['proyecto'] == $resultado['id_proyecto']){
										print ("<option value=$resultado[id_proyecto] selected='selected'>$resultado[area] - $resultado[nombre_proyecto]</option>");
									}
									else {
										print ("<option value=$resultado[id_proyecto]>$resultado[area] - $resultado[nombre_proyecto]</option>");
									}
								}
								else {
									print ("<option value=$resultado[id_proyecto]>$resultado[area] - $resultado[nombre_proyecto]</option>");
								}
							}
						?>
					</select>
				</span>
				<label>&Aacute;rea:</label>
				<select name='area' class="inputs">
					<option value="0" <?php if(isset($_POST['area'])) { if($_POST['area']== 0) echo "selected='selected'"; }?>>Seleccione un &aacute;rea...</option>
					<option value="Biblioteca infantil" <?php if(isset($_POST['area'])) { if($_POST['area']== "Biblioteca infantil") echo "selected='selected'"; }?>>Biblioteca infantil</option>
					<option value="Biblioteca adultos" <?php if(isset($_POST['area'])) { if($_POST['area']== "Biblioteca adultos") echo "selected='selected'"; }?>>Biblioteca adultos</option>
					<option value="RCI adultos" <?php if(isset($_POST['area'])) { if($_POST['area']== "RCI adultos") echo "selected='selected'"; }?>>RCI adultos</option>
					<option value="RCI ni�os" <?php if(isset($_POST['area'])) { if($_POST['area']== "RCI ni�os") echo "selected='selected'"; }?>>RCI ni&ntilde;os</option>
					<option value="Planeacion y promocion" <?php if(isset($_POST['area'])) { if($_POST['area']== "Planeacion y promocion") echo "selected='selected'"; }?>>Planeaci&oacute;n y promoci&oacute;n</option>
				</select>
				<label>Tipo de servicio:</label>
				<span class="select-box">
					<select name="tipo_servicio" id="servicio" class="inputs">
						<option value="0" <?php if(isset($_POST['tipo_servicio'])) { if($_POST['tipo_servicio']== 0) echo "selected='selected'"; }?>> Selecciona el tipo de servicio...</option>
						<option value="Servicio social" <?php if(isset($_POST['tipo_servicio'])) { if($_POST['tipo_servicio']== "Servicio social") echo "selected='selected'"; }?>> Servicio social</option>
						<option value="Practicas profesionales" <?php if(isset($_POST['tipo_servicio'])) { if($_POST['tipo_servicio']== "Practicas profesionales") echo "selected='selected'"; }?>> Practicas profesionales</option>
						<option value="Estancia" <?php if(isset($_POST['tipo_servicio'])) { if($_POST['tipo_servicio']== "Estancia") echo "selected='selected'"; }?>> Estancia</option>
						<option value="Estancia I" <?php if(isset($_POST['tipo_servicio'])) { if($_POST['tipo_servicio']== "Estancia I") echo "selected='selected'"; }?>> Estancia I</option>
						<option value="Estancia II" <?php if(isset($_POST['tipo_servicio'])) { if($_POST['tipo_servicio']== "Estancia II") echo "selected='selected'"; }?>> Estancia II</option>
						<option value="Estadia" <?php if(isset($_POST['tipo_servicio'])) { if($_POST['tipo_servicio']== "Estadia") echo "selected='selected'"; }?>> Estadia</option><br>
					</select>
				</span><br>
				<label>Instituci&oacute;n:</label>
				<span class="select-box">
					<select name='colegios' class="inputs" id="colegio">
						<option value="0">Seleccione la instituci&oacute;n...</option>
						<?php
							$SQL = "SELECT DISTINCT * FROM colegio";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_POST['colegios'])){
									if($_POST['colegios'] == $resultado['id_colegio']){
										print ("<option value=$resultado[id_colegio] selected='selected'>$resultado[colegios]</option>");
									}
									else {
										print ("<option value=$resultado[id_colegio]>$resultado[colegios]</option>");
									}
								}
								else {
									print ("<option value=$resultado[id_colegio]>$resultado[colegios]</option>");
								}
							}
						?>
					</select>
				</span>
				<label>Documentaci&oacute;n:</label>
				<select name="documentos" class="inputs">
					<option value="0">Seleccione documentaci&oacute;n...</option>
					<?php
						if(isset($_POST['documentos'])){
							if($_POST['documentos'] == "Completa"){
								print ("<option value='Completa' selected='selected'>Completa</option>");
								print ("<option value='Incompleta'>Incompleta</option>");
							}
							else {
								if($_POST['documentos'] == "Incompleta"){
									print ("<option value='Completa'>Completa</option>");
									print ("<option value='Incompleta' selected='selected'>Incompleta</option>");
								}
								else {
									print ("<option value='Completa'>Completa</option>");
									print ("<option value='Incompleta'>Incompleta</option>");
								}
							}
						}
						else {
							print ("<option value='Completa'>Completa</option>");
							print ("<option value='Incompleta'>Incompleta</option>");
						}
					?>
				</select>
				<label>Estado:</label>
				<select name="status" class="inputs">
					<option value="0">Seleccione estado...</option>
					<?php
						if(isset($_POST['status'])){
							if($_POST['status'] == "Activo"){
								print ("<option value='Activo' selected='selected'>Activo</option>");
								print ("<option value='Inactivo'>Inactivo</option>");
								print ("<option value='Terminado'>Terminado</option>");
							}
							else {
								if($_POST['status'] == "Inactivo"){
									print ("<option value='Activo'>Activo</option>");
									print ("<option value='Inactivo' selected='selected'>Inactivo</option>");
									print ("<option value='Terminado'>Terminado</option>");
								}
								else {
									if($_POST['status'] == "Terminado"){
										print ("<option value='Activo'>Activo</option>");
										print ("<option value='Inactivo'>Inactivo</option>");
										print ("<option value='Terminado' selected='selected'>Terminado</option>");
									}
									else {
										print ("<option value='Activo'>Activo</option>");
										print ("<option value='Inactivo'>Inactivo</option>");
										print ("<option value='Terminado'>Terminado</option>");
									}
								}
							}
						}
						else {
							print ("<option value='Activo'>Activo</option>");
							print ("<option value='Inactivo'>Inactivo</option>");
							print ("<option value='Terminado'>Terminado</option>");
						}
					?>
				</select>
				&nbsp;&nbsp;&nbsp;<input type="image" name="buscar" class="submit" src="../images/search.png"/ width="30px" height="30px" align="middle" title="buscar">
			</form>
		</fieldset>
		<?php
			if(isset($_POST['buscar_x'])){
		?>
		<br><div>
		<?php
				$query0="SELECT alumno.* FROM alumno, alumno_servicio, proyecto";
				$query1="SELECT * FROM alumno";
				$query="";
				$opciones = 0;
				if($_POST['nombre'] != "") {
					$nombre = " LOWER(alumno.nombre) LIKE LOWER ('".$_POST['nombre']."%')";
					$opciones = $opciones + 1;
				}
				if($_POST['apellidoP'] != "") {
					$apellido_paterno = " LOWER(alumno.apellido_paterno) LIKE LOWER('".$_POST['apellidoP']."%')";
					$opciones = $opciones + 1;
				}
				if($_POST['apellidoM'] != "") {
					$apellido_materno = " LOWER(alumno.apellido_materno) LIKE LOWER('".$_POST['apellidoM']."%')";
					$opciones = $opciones + 1;
				}
				if($_POST['colegios'] != "0") {
					$colegio = " alumno.id_colegio='".$_POST['colegios']."'";
					$opciones = $opciones + 1;
				}
				if($_POST['documentos'] != "0") {
					$documentos = " alumno.documentos='".$_POST['documentos']."'";
					$opciones = $opciones + 1;
				}
				if($_POST['status'] != "0") {
					$status = " alumno.status='".$_POST['status']."'";
					$opciones = $opciones + 1;
				}
				if($_POST['proyecto'] != "0") {
					$proyecto = " alumno.id_proyecto=".$_POST['proyecto'];
					$opciones = $opciones + 1;
				}
				if($_POST['area'] != "0") {
					$area = " alumno.area='".$_POST['area']."'";
					$opciones = $opciones + 1;
				}
				if($_POST['tipo_servicio'] != "0") {
					$servicio = " alumno.tipo_servicio='".$_POST['tipo_servicio']."'";
					$opciones = $opciones + 1;
				}
				if($opciones != 0) {
					$query = $query." WHERE ";
					if(isset($nombre)) {
						$query = $query.$nombre;
						if(isset($apellido_paterno)) {
							$query = $query." AND".$apellido_paterno;
							if(isset($apellido_materno)) {
								$query = $query." AND".$apellido_materno;
								if(isset($colegio)) {
									$query = $query." AND".$colegio;
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
								else {
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
							}
							else {
								if(isset($colegio)) {
									$query = $query." AND".$colegio;
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
								else {
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
							}
						}
						else {
							if(isset($apellido_materno)) {
								$query = $query." AND".$apellido_materno;
								if(isset($colegio)) {
									$query = $query." AND".$colegio;
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
								else {
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
							}
							else {
								if(isset($colegio)) {
									$query = $query." AND".$colegio;
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
								else {
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
							}
						}
					}
					else {
						if(isset($apellido_paterno)) {
							$query = $query.$apellido_paterno;
							if(isset($apellido_materno)) {
								$query = $query." AND".$apellido_materno;
								if(isset($colegio)) {
									$query = $query." AND".$colegio;
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
								else {
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
							}
							else {
								if(isset($colegio)) {
									$query = $query." AND".$colegio;
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
								else {
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
							}
						}
						else {
							if(isset($apellido_materno)) {
								$query = $query.$apellido_materno;
								if(isset($colegio)) {
									$query = $query." AND".$colegio;
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
								else {
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
							}
							else {
								if(isset($colegio)) {
									$query = $query.$colegio;
									if(isset($documentos)) {
										$query = $query." AND".$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
								}
								else {
									if(isset($documentos)) {
										$query = $query.$documentos;
										if(isset($status)) {
											$query = $query." AND".$status;
										}
									}
									else {
										if(isset($status)) {
											$query = $query.$status;
										}
									}
								}
							}
						}
					}
				}
				if($_POST['proyecto']!=0||$_POST['area']!="0"||$_POST['tipo_servicio']!="0") {
					if($_POST['proyecto']==0&&$_POST['area']=="0"&&$_POST['tipo_servicio']=="0"&&$opciones>0){
						$query = $query." AND";
					}
					else {
						if($_POST['proyecto']!=0&&$_POST['area']=="0"&&$_POST['tipo_servicio']=="0"&&$opciones>1) {
							$query = $query." AND";
						}
						else {
							if($_POST['proyecto']==0&&$_POST['area']!="0"&&$_POST['tipo_servicio']=="0"&&$opciones>1) {
								$query = $query." AND";
							}
							else {
								if($_POST['proyecto']==0&&$_POST['area']=="0"&&$_POST['tipo_servicio']!="0"&&$opciones>1) {
									$query = $query." AND";
								}
								else {
									if($_POST['proyecto']!=0&&$_POST['area']!="0"&&$_POST['tipo_servicio']=="0"&&$opciones>2) {
										$query = $query." AND";
									}
									else{
										if($_POST['proyecto']!=0&&$_POST['area']=="0"&&$_POST['tipo_servicio']!="0"&&$opciones>2) {
											$query = $query." AND";
										}
										else {
											if($_POST['proyecto']==0&&$_POST['area']!="0"&&$_POST['tipo_servicio']!="0"&&$opciones>2) {
												$query = $query." AND";
											}
											else {
												if($_POST['proyecto']!=0&&$_POST['area']!="0"&&$_POST['tipo_servicio']!="0"&&$opciones>3) {
													$query = $query." AND";
												}
											}
										}
									}
								}
							}
						}
					}
					if(isset($proyecto)){
						$query = $query." alumno_servicio.id_proyecto=$_POST[proyecto] AND";
					}
					if(isset($area)){
						$query = $query." proyecto.area='$_POST[area]' AND";
					}
					if(isset($servicio)){
						$query = $query." alumno_servicio.tipo_servicio='$_POST[tipo_servicio]' AND";
					}
					$join = " alumno.id_alumno=alumno_servicio.id_alumno AND alumno_servicio.id_proyecto=proyecto.id_proyecto";
					$consulta = $query0.$query.$join;
				}
				else {
					$consulta = $query1.$query;
				}
				if($_POST['fecha']!="") {
					if($opciones>0) {
						$fecha = " AND alumno.fecha='$_POST[fecha]'";
					}
					else {
						$fecha = " WHERE alumno.fecha='$_POST[fecha]'";
					}
				}
				else {
					$fecha = "";
				}
				$consulta = $consulta.$fecha;
				$res=mysqli_query($conn, $consulta) or header("Location:error.php?emysql=".mysqli_error($conn));
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
						<?php if(isset($_POST['buscar_x'])) echo "<input type='hidden' name='buscar_x' value='0'"; ?>
					</form>
				</div></center>
				<div style="overflow-x:auto;width:100%;">
				<br><table cellspacing="1" class="tablesorter" id="table">
					<thead>
						<tr>
							<th><span>Nombre&nbsp;&nbsp;&nbsp;<span>
							<th><span>Apellido paterno&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Apellido materno&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Id&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Contrase&ntilde;a&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Matricula  o n&uacute;mero de control&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Direcci&oacute;n&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Tel&eacute;fono&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>e-mail&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Escolaridad&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Instituci&oacute;n&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Carrera&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Semestre&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Documentaci&oacute;n&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Proyecto&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>&Aacute;rea&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Jefe directo&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Tipo de servicio&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Fecha de inicio&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Fecha de t&eacute;rmino&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Horas a realizar&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Tipo de horas&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Horario&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Lunes&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Martes&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Mi&eacute;rcoles&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Jueves&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Viernes&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>S&aacute;bado&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Domingo&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Estado&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Fecha de creaci&oacute;n&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Acciones&nbsp;&nbsp;&nbsp;<span></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td><span>Nombre</span></td>
							<td><span>Apellido paterno</span></td>
							<td><span>Apellido materno</span></td>
							<td><span>Id</span></td>
							<td><span>Contrase&ntilde;a</span></td>
							<td><span>Matricula  o n&uacute;mero de control</span></td>
							<td><span>Direcci&oacute;n</span></td>
							<td><span>Tel&eacute;fono</span></td>
							<td><span>e-mail</span></td>
							<td><span>Escolaridad</span></td>
							<td><span>Instituci&oacute;n</span></td>
							<td><span>Carrera</span></td>
							<td><span>Semestre</span></td>
							<td><span>Documentaci&oacute;n</span></td>
							<td><span>Proyecto</span></td>
							<td><span>&Aacute;rea</span></td>
							<td><span>Jefe directo</span></td>
							<td><span>Tipo de servicio</span></td>
							<td><span>Fecha de inicio</span></td>
							<td><span>Fecha de t&eacute;rmino</span></td>
							<td><span>Horas a realizar</span></td>
							<td><span>Tipo de horas</span></td>
							<td><span>Horario</span></td>
							<td><span>Lunes</span></td>
							<td><span>Martes</span></td>
							<td><span>Mi&eacute;rcoles</span></td>
							<td><span>Jueves</span></td>
							<td><span>Viernes</span></td>
							<td><span>S&aacute;bado</span></td>
							<td><span>Domingo</span></td>
							<td><span>Estado</span></td>
							<td><span>Fecha de creaci&oacute;n</span></td>
							<td><span>Acciones</span></td>
						</tr>
					</tfoot>
					<tbody>
					<?php
						while ($row = mysqli_fetch_array($res)){
							$query="SELECT colegios FROM colegio where id_colegio=$row[id_colegio];";
							$result=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
							$colegio = mysqli_fetch_array($result);
							$query="SELECT password FROM alumno_password where id_alumno=$row[id_alumno];";
							$result=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
							$password = mysqli_fetch_array($result);
							$query="SELECT * FROM alumno_servicio where id_alumno=$row[id_alumno] ORDER BY status;";
							$result=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
							echo (
								"<tr><td><span>$row[nombre]</span></td>".
								"<td><span>$row[apellido_paterno]</span></td>".
								"<td><span>$row[apellido_materno]</span></td>".
								"<td><span>$row[id_alumno]</span></td>".
								"<td><span>$password[password]</span></td>".
								"<td><span>$row[matricula]</span></td>".
								"<td><span>$row[direccion]</span></td>".
								"<td><span>$row[telefono]</span></td>".
								"<td><span>$row[e_mail]</span></td>".
								"<td><span>$row[escolaridad]</span></td>".
								"<td><span>$colegio[colegios]</span></td>".
								"<td><span>$row[carrera]</span></td>".
								"<td><span>$row[semestre]</span></td>".
								"<td><span>$row[documentos]</span></td>"
							);
							if(mysqli_num_rows($result)>0){
								$servicio = mysqli_fetch_array($result);
								$query="SELECT nombre_proyecto, area FROM proyecto WHERE id_proyecto=$servicio[id_proyecto];";
								$result=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
								$proyecto = mysqli_fetch_array($result);
								echo (
									"<td><span>$proyecto[nombre_proyecto]</span></td>".
									"<td><span>$proyecto[area]</span></td>".
									"<td><span>$servicio[jefe_directo]</span></td>".
									"<td><span>$servicio[tipo_servicio]</span></td>".
									"<td><span>$servicio[fecha_inicio]</span></td>".
									"<td><span>$servicio[fecha_termino]</span></td>".
									"<td><span>$servicio[no_horas]</span></td>"
								);
								if($servicio['tipo_horas']==1){
									echo "<td><span>Normales</span></td>";
								}
								else{
									if($servicio['tipo_horas']==2){
										echo "<td><span>Dobles</span></td>";
									}
									else{
										echo "<td><span>&nbsp;</span></td>";
									}
								}
								$query="SELECT * FROM horario WHERE id_alumno=$row[id_alumno];";
								$result=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
								if(mysqli_num_rows($result)>0) {
									$horario = mysqli_fetch_array($result);
									$dias = "";
									if($horario['e1']!=""&&$horario['s1']!="") {
										$dias=$dias."/Lunes";
									}
									if($horario['e2']!=""&&$horario['s2']!="") {
										$dias=$dias."/Martes";
									}
									if($horario['e3']!=""&&$horario['s3']!="") {
										$dias=$dias."/Miercoles";
									}
									if($horario['e4']!=""&&$horario['s4']!="") {
										$dias=$dias."/Jueves";
									}
									if($horario['e5']!=""&&$horario['s5']!="") {
										$dias=$dias."/Viernes";
									}
									if($horario['e6']!=""&&$horario['s6']!="") {
										$dias=$dias."/Sabado";
									}
									if($horario['e0']!=""&&$horario['s0']!="") {
										$dias=$dias."/Domingo";
									}
									echo (
										"<td><span>$dias</span></td>".
										"<td><span>$horario[e1] - $horario[s1]</span></td>".
										"<td><span>$horario[e2] - $horario[s2]</span></td>".
										"<td><span>$horario[e3] - $horario[s3]</span></td>".
										"<td><span>$horario[e4] - $horario[s4]</span></td>".
										"<td><span>$horario[e5] - $horario[s5]</span></td>".
										"<td><span>$horario[e6] - $horario[s6]</span></td>".
										"<td><span>$horario[e0] - $horario[s0]</span></td>"
									);
								}
								else {
									echo (
										"<td><span>&nbsp;</span></td>".
										"<td><span>&nbsp;</span></td>".
										"<td><span>&nbsp;</span></td>".
										"<td><span>&nbsp;</span></td>".
										"<td><span>&nbsp;</span></td>".
										"<td><span>&nbsp;</span></td>".
										"<td><span>&nbsp;</span></td>".
										"<td><span>&nbsp;</span></td>"
									);
								}
							}
							else {
								unset($proyecto);
								unset($servicio);
								echo (
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>".
									"<td><span>&nbsp;</span></td>"
								);
							}
							echo (
								"<td><span>$row[status]</span></td>".
								"<td><span>$row[fecha]</span></td><td style='text-align:center;'>"
							);
							if ($row['status']=="Activo") { echo "<a href='updateStudentForm.php?id=$row[id_alumno]'><img src='../images/user_update.png' title='Modificar' style='border:0' height='20px' width='20px'></a>"; }
							if ($row['status']=="Activo") { echo "<a href='dropStudentForm.php?id=$row[id_alumno]'><img src='../images/user_lock.png' title='Inactivar' style='border:0' height='20px' width='20px'></a>"; }
							else { if($row['status']=="Inactivo") { echo "<a href='dropStudentForm.php?id=$row[id_alumno]'><img src='../images/user_unlock.png' title='Activar' style='border:0' height='20px' width='20px'></a>";  } }
							if (isset($proyecto)&&$row['status']=="Activo") { echo "<a href='../php/documents.php?id=$row[id_alumno]&doc=aceptacion'><img src='../images/documents.png' title='Carta de aceptaci&oacute;n' style='border:0' height='20px' width='20px'></a>"; }
							if ($row['status']=="Activo") {
								if (isset($proyecto)) { echo "<a href='allocateProjectForm.php?id=$row[id_alumno]'><img src='../images/user_document_edit.png' title='Cambiar informaci&oacute;n de proyecto' style='border:0' height='20px' width='20px'></a><a href='deallocateProjectForm.php?id=$row[id_alumno]'><img src='../images/user_deallocate.png' title='Desasignar proyecto' style='border:0' height='20px' width='20px'></a>"; 
								echo "<a href='scheduleUpdateForm.php?id=$row[id_alumno]'><img src='../images/user_schedule.png' title='Cambiar horario' style='border:0' height='20px' width='20px'></a>"; }
								else { echo "<a href='allocateProjectForm.php?id=$row[id_alumno]'><img src='../images/user_document.png' title='Asignar proyecto' style='border:0' height='20px' width='20px'></a>"; }
							}
							if ($row['status']=="Activo") {
								if ($password['password']=="") { echo "<a href='allocatePasswordForm.php?id=$row[id_alumno]'><img src='../images/security_key.png' title='Asignar contrase&ntilde;a' style='border:0' height='20px' width='20px'></a>"; }
								else { echo "<a href='allocatePasswordForm.php?id=$row[id_alumno]'><img src='../images/security_key.png' title='Cambiar contrase&ntilde;a' style='border:0' height='20px' width='20px'></a>"; }
							}
							if (isset($proyecto)&&$row['status']=="Activo") { echo "<a href='../php/report.php?id=$row[id_alumno]&op=1' target='_blank'><img src='../images/pdf.png' title='Reporte de asistencia' style='border:0' height='20px' width='20px'></a>"; }
							if (isset($proyecto)&&$row['status']=="Activo") { echo "<a href='../forms/terminationDocForm.php?id=$row[id_alumno]'><img src='../images/notification_done.png' title='Terminar servicio y generar carta de terminaci&oacute;n' style='border:0' height='20px' width='20px'></a>"; } else { if ($row['status']=="Terminado") { echo "<a href='../php/documents.php?id=$row[id_alumno]&doc=terminacion'><img src='../images/documents.png' title='Generar carta de terminaci&oacute;n' style='border:0' height='20px' width='20px'></a>"; } }
							if ($row['status']=="Activo"&&isset($proyecto)) { echo "<a href='consultAssistanceForm.php?id=$row[id_alumno]&fecha_i=&fecha_t=&buscar_x='><img src='../images/search.png' title='Consultar asistencia' style='border:0' height='20px' width='20px'></a>"; }
							echo "<a href='commentsStudentForm.php?id=$row[id_alumno]'><img src='../images/message.png' title='Comentarios' style='border:0' height='20px' width='20px'></a>";
							echo "<a href='deleteStudentForm.php?id=$row[id_alumno]'><img src='../images/user_delete.png' title='Eliminar' style='border:0' height='20px' width='20px'></a>";
							echo "</td></tr>";
						}
					?>
					</tbody>
				</table>
				</div>
				<?php if($registros>0) { echo "<br><center><span style='font-size:10pt;'>Se encontraron $registros coincidencias</span></center>"; } ?>
		</div>
		<?php
			}
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
	</body>
</html>
