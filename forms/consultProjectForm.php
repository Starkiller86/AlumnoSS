<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Consulta de Proyectos</title>
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
			<div id="legend">Consulta de proyectos</div>
			<br><form id="formulario" name="formulario" method="post" action="">
				<label>Proyecto:</label>
				<input type="text" name="proyecto" class="inputs"  id="name" value="<?php if(isset($_POST['proyecto'])) echo $_POST['proyecto']; ?>">
				<label>&Aacute;rea:</label>
				<select name='area' class="inputs">
					<option value="0" <?php if(isset($_POST['area'])) { if($_POST['area']== 0) echo "selected='selected'"; }?>>Seleccione un area...</option>
					<option value="Biblioteca infantil" <?php if(isset($_POST['area'])) { if($_POST['area']== "Biblioteca infantil") echo "selected='selected'"; }?>>Biblioteca infantil</option>
					<option value="Biblioteca adultos" <?php if(isset($_POST['area'])) { if($_POST['area']== "Biblioteca adultos") echo "selected='selected'"; }?>>Biblioteca adultos</option>
					<option value="RCI adultos" <?php if(isset($_POST['area'])) { if($_POST['area']== "RCI adultos") echo "selected='selected'"; }?>>RCI adultos</option>
					<option value="RCI niños" <?php if(isset($_POST['area'])) { if($_POST['area']== "RCI niños") echo "selected='selected'"; }?>>RCI ni&ntilde;os</option>
					<option value="Planeacion y promocion" <?php if(isset($_POST['area'])) { if($_POST['area']== "Planeación y promoción") echo "selected='selected'"; }?>>Planeaci&oacute;n y promoci&oacute;n</option>
				</select>
				<label>Estado:</label>
				<select name="status" class="inputs">
					<option value="0">Seleccione estado...</option>
					<?php
						if(isset($_POST['status'])){
							if($_POST['status'] == "Disponible"){
								print ("<option value='Disponible' selected='selected'>Disponible</option>");
								print ("<option value='Ocupado'>Ocupado</option>");
								print ("<option value='Terminado'>Terminado</option>");
							}
							else {
								if($_POST['status'] == "Ocupado"){
									print ("<option value='Disponible'>Disponible</option>");
									print ("<option value='Ocupado' selected='selected'>Ocupado</option>");
									print ("<option value='Terminado'>Terminado</option>");
								}
								else {
									print ("<option value='Disponible'>Disponible</option>");
									print ("<option value='Ocupado'>Ocupado</option>");
									print ("<option value='Terminado'>Terminado</option>");
								}
							}
						}
						else {
							print ("<option value='Disponible'>Disponible</option>");
							print ("<option value='Ocupado'>Ocupado</option>");
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
				$query="SELECT * FROM proyecto";
				$opciones = 0;
				if($_POST['status'] != "0") {
					$status = " status='".$_POST['status']."'";
					$opciones = $opciones + 1;
				}
				if($_POST['proyecto'] != "") {
					$proyecto = " nombre_proyecto LIKE '".$_POST['proyecto']."%'";
					$opciones = $opciones + 1;
				}
				if($_POST['area'] != "0") {
					$area = " area='".$_POST['area']."'";
					$opciones = $opciones + 1;
				}
				if($opciones != 0) {
					$query = $query." WHERE ";
					if(isset($proyecto)){
						$query = $query.$proyecto;
						if(isset($area)) {
							$query = $query." AND".$area;
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
						if(isset($area)) {
							$query = $query.$area;
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
						<?php if(isset($_POST['buscar_x'])) echo "<input type='hidden' name='buscar_x' value='0'"; ?>
					</form>
				</div></center>
				<div style="overflow-x:auto;width:100%;">
				<br><table cellspacing="1" class="tablesorter" id="table">
					<thead>
						<tr>
							<th><span>Nombre del proyecto&nbsp;&nbsp;&nbsp;<span>
							<th><span>&Aacute;rea&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Descripci&oacute;n&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Alumnos requeridos&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Alumnos asignados&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Fecha de creaci&oacute;n&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Fecha de t&eacute;rmino&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Estado&nbsp;&nbsp;&nbsp;</span></th>
							<th><span>Acciones&nbsp;&nbsp;&nbsp;</span></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td><span>Nombre del proyecto</span></td>
							<td><span>&Aacute;rea</span></td>
							<td><span>Descripci&oacute;n</span></td>
							<td><span>Alumnos requeridos</span></td>
							<td><span>Alumnos asignados</span></td>
							<td><span>Fecha de creaci&oacute;n</span></td>
							<td><span>Fecha de t&eacute;rmino</span></td>
							<td><span>Estado</span></td>
							<td><span>Acciones</span></td>
						</tr>
					</tfoot>
					<tbody>
					<?php
						while ($row = mysqli_fetch_array($res)){
							echo (
								"<tr><td><span>$row[nombre_proyecto]</span></td>".
								"<td><span>$row[area]</span></td>".
								"<td><span>$row[descripcion]</span></td>".
								"<td><span>$row[lugares_requeridos]</span></td>".
								"<td><span>$row[lugares_asignados]</span></td>".
								"<td><span>$row[fecha]</span></td>".
								"<td><span>$row[fecha_termino]</span></td>".
								"<td><span>$row[status]</span></td><td style='text-align:center'>"
							);
							if($row['status']!="Terminado") {
								echo "<a href='updateProjectForm.php?proyecto=$row[id_proyecto]'><img src='../images/document_edit.png' title='Actualizar' style='border:0' height='20px' width='20px'></a>";
								echo "<a href='dropProjectForm.php?id=$row[id_proyecto]'><img src='../images/document_delete.png' title='Terminar' style='border:0' height='20px' width='20px'></a>";
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
