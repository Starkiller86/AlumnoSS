<?php
	require "../php/security.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Alta de proyectos</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateNP.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
    </head>
	<body onLoad="document.getElementById('name').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Alta de proyectos</div>
			<form method="post" action="../php/newProject.php" name="formulario" id="formulario" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset>
								<label>Nombre:</label><br>
								<input type="text" name="nombre_proyecto" class="inputs" id="name" style="width:100%"><br>
								<label>&Aacute;rea:</label><br>
								<select name='area' class="inputs" style="width:100%">
									<option value="0">Seleccione una área...</option>
                                    <option value="Biblioteca infantil">Biblioteca infantil</option>
									<option value="Biblioteca adultos" >Biblioteca adultos</option>
									<option value="RCI adultos">RCI adultos</option>
									<option value="RCI niños">RCI niños</option>
									<option value="Planeacion y promocion">Planeación y promoción</option>
								</select><br>
								<label>Alumnos requeridos:</label>
								<input type="text" name="lugares" class="inputs"><br><br>
								<label>Descripci&oacute;n:</label><br>
								<textarea name="descripcion" cols="10" rows="2" class="comment" style="height:150px;width:335px"></textarea>
							</fieldset>
						</td>
					</tr>
				</table>
				<input type="image" class="submit" src="../images/document_add.png" title="Agregar proyecto"/>
			</form>
		</fieldset>
    </body>
</html>
<?php
	if(isset($_GET['emysql'])) {
		$error =  str_replace("%20"," ",$_GET['emysql']);
		$error =  str_replace("'","\'",$error);
		echo "<script language='javascript' type='text/javascript'>jAlert('$error', 'MySQL Error')</script>";
	}
	if(isset($_GET['e'])) {
		if($_GET['e']=="E0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Ya se encuentra un proyecto activo dado de alta con el mismo nombre y en la misma área.', 'Error')</script>";
		}
	}
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha creado el proyecto correctamente.', 'Atención')</script>";
		}
	}
?>
