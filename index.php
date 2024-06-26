<?php
	session_start();
?>
<html>
     <!-- Favicon and touch icons -->
         <link rel="shortcut icon" href="images/favicon2.ico">

	<head>
		<meta http-equiv="Content-Type" content="text/html; UTF-8" />
		<title>Sistema de Control del Servicio Social</title>
		<link href="css/login-box.css" rel="stylesheet" type="text/css" />
		<link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="js/validateLogin.js"></script>
		<script language="javascript" src="js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="js/jquery.alerts.js"></script>
	</head>
	<body onLoad="document.getElementById('usuario').focus()">
		<div id='login'>
			<img src='images/g1.png' height="130px" width="200px">
			<div id="login-box">
				<H2>Login</H2><br><br>
				<form method="POST" action="php/validate.php" onsubmit="return validar(this)" name="loginform" id="loginform">
					<br><br><table>
						<tr>
							<td>
								<label style="font: bold 20px Arial;color:white;">Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>
							</td>
							<td>
								<input name="user" class="form-login" title="Usuario" value="" size="30" maxlength="20" id="usuario"/>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>
								<label style="font: bold 20px Arial;color:white;">Contrase&ntilde;a: </label>
							</td>
							<td>
								<input name="pass" type="password" class="form-login" title="Password" value="" size="30" maxlength="20"/>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td></td>
							<td>
								<input type="image" src="images/login-btn2.png" style="float:right">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
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
			echo "<script language='javascript' type='text/javascript'>jAlert('Debe llenar los campos para poder entrar.', 'Error')</script>";
		}
		else if($_GET['e']=="E0002") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Usuario y/o contraseña incorrectos.', 'Error')</script>";
		}
		else if($_GET['e']=="E0003") {
			echo "<script language='javascript' type='text/javascript'>jAlert('El usuario no se encuentra activo, comuniquese con el administrador.', 'Error')</script>";
		}
		else if($_GET['e']=="E0004") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha cerrado su sesi&oacute;n ya que ha estado inactiva durante m&aacute;s de 10 minutos.', 'Error')</script>";
		}
		else if($_GET['e']=="E0005") {
			echo "<script language='javascript' type='text/javascript'>jAlert('El usuario no tiene asignada ninguna contrase&ntilde;a, comuniquese con el administrador.', 'Error')</script>";
		}
	}
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Ha cerrado sesión correctamente.', 'Atención')</script>";
		}
	}
?>
