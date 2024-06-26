<?php
	require "../php/security.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Cambiar contrase&ntilde;a</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateCP.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
    </head>
	<body onLoad="document.getElementById('password').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Cambiar contrase&ntilde;a</div>
			<form method="post" action="../php/changePassword.php" name="formulario" id="formulario" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset>
								<label>Contrase&ntilde;a actual:</label><br>
								<input type="password" name="password" class="inputs" id="password"><br>
								<label>Nueva contrase&ntilde;a:</label><br>
								<input type="password" name="new_password" class="inputs"><br>
								<label>Confirme nueva contrase&ntilde;a:</label><br>
								<input type="password" name="new_password_confirm" class="inputs"><br>
							</fieldset>
						</td>
					</tr>
				</table>
				<input type="image" class="submit" src="../images/user_update.png" title="Cambiar contrase&ntilde;a"/>
			</form>
		</fieldset>
    </body>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha actualizado la contrase&ntilde;a.', 'Atención')</script>";
		}
	}
?>
