<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Consulta de Usuarios</title>
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
    </head>
	<body onLoad="document.getElementById('name').focus()">
	<br><fieldset class="frame">
			<div id="legend">Consulta de usuarios</div>
			<br><form id="formulario" name="formulario" method="GET" action="">
				<label>Nombre:</label>
				<input type="text" name="nombre" class="inputs"  id="name" value="<?php if(isset($_GET['nombre'])) echo $_GET['nombre']; ?>">
				<label>Usuario:</label>
				<input type="text" name="usuario" class="inputs"  value="<?php if(isset($_GET['usuario'])) echo $_GET['usuario']; ?>">
				<label>Estado:</label>
				<select name="status" class="inputs">
					<option value="0">Seleccione estado...</option>
					<?php
						if(isset($_GET['status'])){
							if($_GET['status'] == "Activo"){
								print ("<option value='Activo' selected='selected'>Activo</option>");
								print ("<option value='Inactivo'>Inactivo</option>");
							}
							else {
								if($_GET['status'] == "Inactivo"){
									print ("<option value='Activo'>Activo</option>");
									print ("<option value='Inactivo' selected='selected'>Inactivo</option>");
								}
								else {
									print ("<option value='Activo'>Activo</option>");
									print ("<option value='Inactivo'>Inactivo</option>");
								}
							}
						}
						else {
							print ("<option value='Activo'>Activo</option>");
							print ("<option value='Inactivo'>Inactivo</option>");
						}
					?>
				</select>
				&nbsp;&nbsp;&nbsp;<input type="image" name="buscar" class="submit" src="../images/search.png"/ width="30px" height="30px" align="middle" title="buscar">
			</form>
		</fieldset>
		<?php
			if(isset($_GET['buscar_x'])){
		?>
		<br><div>
			<?php
				$query="SELECT * FROM usuario";
				$opciones = 0;
				if($_GET['status'] != "0") {
					$status = " status='".$_GET['status']."'";
					$opciones = $opciones + 1;
				}
				if($_GET['nombre'] != "") {
					$nombre = " nombre LIKE '".$_GET['nombre']."%'";
					$opciones = $opciones + 1;
				}
				if($_GET['usuario'] != "") {
					$usuario = " nombre_usuario='".$_GET['usuario']."'";
					$opciones = $opciones + 1;
				}
				if($opciones != 0) {
					$query = $query." WHERE ";
					if(isset($nombre)){
						$query = $query.$nombre;
						if(isset($usuario)) {
							$query = $query." AND".$usuario;
							if(isset($status)){
								$query = $query." AND".$status;
							}
						}
						else {
							if(isset($status)){
								$query = $query." AND".$status;
							}
						}
					}
					else {
						if(isset($usuario)) {
							$query = $query.$usuario;
							if(isset($status)){
								$query = $query." AND".$status;
							}
						}
						else {
							if(isset($status)){
								$query = $query.$status;
							}
						}
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
						<?php if(isset($_GET['buscar_x'])) echo "<input type='hidden' name='buscar_x' value='0'"; ?>
					</form>
				</div></center>
				<div style="overflow-x:auto;width:100%;">
				<table cellspacing="1" class="tablesorter" id="table">
					<thead>
						<tr>
							<th><span>Nombre&nbsp;&nbsp;&nbsp;<span>
							<th><span>Usuario&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Password&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Privilegios&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Estado&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Acciones&nbsp;&nbsp;&nbsp;</span></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td><span>Nombre</span></td>
							<td><span>Usuario</span></td>
							<td><span>Password</span></td>
							<td><span>Privilegios</span></td>
							<td><span>Estado</span></td>
							<td><span>Acciones</span></td>
						</tr>
					</tfoot>
					<tbody>
					<?php
						while ($row = mysqli_fetch_array($res)){
							echo (
								"<tr><td><span>$row[nombre]</span></td>".
								"<td><span>$row[nombre_usuario]</span></td>".
								"<td><span>$row[password]</span></td><td>"
							);
							$privs = $row['privilegios'];
							if ($privs[0]==1) { echo "Alta de alumnos, "; }
							if ($privs[1]==1) { echo "Cambiar estado de alumno, "; }
							if ($privs[2]==1) { echo "Modificar alumnos, "; }
							if ($privs[3]==1) { echo "Asignar y cambiar proyectos, "; }
							if ($privs[4]==1) { echo "Desasignar proyectos, "; }
							if ($privs[5]==1) { echo "Cambiar contrse&ntilde;as de alumnos, "; }
							if ($privs[6]==1) { echo "Eliminar alumnos, "; }
							if ($privs[7]==1) { echo "Consultar alumnos, "; }
							if ($privs[8]==1) { echo "Alta de instituciones, "; }
							if ($privs[9]==1) { echo "Modificar instituciones, "; }
							if ($privs[10]==1) { echo "Eliminar instituciones, "; }
							if ($privs[11]==1) { echo "Consultar instituciones, "; }
							if ($privs[12]==1) { echo "Alta de proyectos, "; }
							if ($privs[13]==1) { echo "Modificar proyectos, "; }
							if ($privs[14]==1) { echo "Terminar proyectos, "; }
							if ($privs[15]==1) { echo "Consultar proyectos, "; }
							if ($privs[16]==1) { echo "Consultar asistencias, "; }
							if ($privs[17]==1) { echo "Alta de usuarios, "; }
							if ($privs[18]==1) { echo "Modificar usuarios, "; }
							if ($privs[19]==1) { echo "Cambiar estado de usuarios, "; }
							if ($privs[20]==1) { echo "Eliminar usuarios, "; }
							if ($privs[21]==1) { echo "Cambiar privilegios de usuarios, "; }
							if ($privs[22]==1) { echo "Consultar usuarios, "; }
							if ($privs[23]==1) { echo "Cambiar contrase&ntilde;a de perfil, "; }
							if ($privs[24]==1) { echo "Respaldar la base de datos, "; }
							if ($privs[25]==1) { echo "Generar graficas de alumnos, "; }
							if ($privs[26]==1) { echo "Generar carta de aceptaci&oacute;n, "; }
							if ($privs[27]==1) { echo "Generar carta de terminaci&oacute;n, "; }
							if ($privs[28]==1) { echo "Historial de comentarios del alumno, "; }
							if ($privs[29]==1) { echo "Asignar y cambiar horario al alumno, "; }
							if ($privs[30]==1) { echo "Generar incidencias, "; }
							if ($privs[31]==1) { echo "Ver log de alumno, "; }
							echo ("</td><td><span>$row[status]</span></td>".
								"<td style='text-align:center'>"
							);
							if($row['id_usuario']!=1) {
								if($row['status']=="activo") {
									echo "<a href='updateUserForm.php?usuario=$row[id_usuario]'><img src='../images/user_update.png' title='Modificar usuario' style='border:0' height='20px' width='20px'></a>";
									echo "<a href='updatePrivsForm.php?usuario=$row[id_usuario]'><img src='../images/security_keyandlock.png' title='Modificar privilegios' style='border:0' height='20px' width='20px'></a>";
									echo "<a href='dropUserForm.php?usuario=$row[id_usuario]'><img src='../images/user_lock.png' title='Inactivar usuario' style='border:0' height='20px' width='20px'></a>";
								}
								else {
									echo "<a href='dropUserForm.php?usuario=$row[id_usuario]'><img src='../images/user_unlock.png' title='Activar usuario' style='border:0' height='20px' width='20px'></a>";
								}
								echo "<a href='deleteUserForm.php?usuario=$row[id_usuario]'><img src='../images/user_delete.png' title='Eliminar usuario' style='border:0' height='20px' width='20px'></a>";
							}
							echo "</td></tr>";
						}
					?>
					</tbody>
				</table>
				</div>
				<?php  if($registros>0) { echo "<br><center><span style='font-size:10pt;'>Se encontraron $registros coincidencias</span></center>"; } ?>
		</div>
		<?php
			}
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
	</body>
</html>