<?php
	require "../php/security.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Alta de instituciones</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateNC.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
    </head>
	<body onLoad="document.getElementById('name').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Alta de instituciones</div>
			<form method="post" action="../php/newSchool.php" name="formulario" id="formulario" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset>
								<label>Nombre:</label><br>
								<input type="text" name="colegio" class="inputs" id="name"><br>
								<label>Responsable de la instituci&oacute;n:</label><br>
								<input type="text" name="res" class="inputs"><br>
								<label>Cargo del responsable:</label><br>
								<input type="text" name="cargoRes" class="inputs"><br>
							</fieldset>
						</td>
					</tr>
				</table>
				<input type="image" class="submit" src="../images/folder_add.png" title="Agregar instituci&oacute;n"/>
			</form>
		</fieldset>
    </body>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha registrado correctamente la instituci&oacute;n.', 'Atención')</script>";
		}
	}
	if(isset($_GET['e'])) {
		if($_GET['e']=="E0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('La instituci&oacute;n ya esta dada de alta.', 'Atención')</script>";
		}
	}
?>
