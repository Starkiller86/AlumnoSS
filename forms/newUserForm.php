<?php
	require "../php/security.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Alta de usuarios</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateNU.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
    </head>
	<body onLoad="document.getElementById('name').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Alta de usuarios</div>
			<form method="post" action="../php/newUser.php" name="formulario" id="formulario" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset>
								<label>Nombre:</label><br>
								<input type="text" name="nombre" class="inputs" id="name"><br>
								<label>Usuario:</label><br>
								<input type="text" name="user" class="inputs"><br>
								<label>Contrase&ntilde;a:</label><br>
								<input type="password" name="pass" class="inputs"><br>
								<label>Confirmar contrase&ntilde;a:</label><br>
								<input type="password" name="pass_Confirm" class="inputs"><br>
							</fieldset>
						</td>
					</tr>
				</table>
				<input type="image" class="submit" src="../images/user_add.png" title="Agregar usuario"/>
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
			echo "<script language='javascript' type='text/javascript'>jAlert('Ya se encuentra registrado el nombre de usuario.', 'Error')</script>";
		}
	}
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha registrado el usuario correctamente.', 'Atención')</script>";
		}
	}
?>
