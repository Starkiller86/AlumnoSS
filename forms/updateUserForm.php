<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Modificar usuarios</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateNU.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
    </head>
	<body onLoad="document.getElementById('name').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Modificar usuarios</div>
			<br><form id="formulario" name="formulario" method="get" action="">
				<label>Usuario:</label>
				<span class="select-box">
					<select name='usuario' class="inputs" onChange="document.getElementById('formulario').submit()">
						<option value="0">Selecciona el usuario...</option>
						<?php
							$SQL = "SELECT id_usuario, nombre_usuario FROM usuario WHERE id_usuario!=1 AND status='Activo'";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_GET['usuario'])){
									if($_GET['usuario'] == $resultado['id_usuario']){
										print ("<option value=$resultado[id_usuario] selected='selected'>$resultado[nombre_usuario]</option>");
									}
									else {
										print ("<option value=$resultado[id_usuario]>$resultado[nombre_usuario]</option>");
									}
								}
								else {
									print ("<option value=$resultado[id_usuario]>$resultado[nombre_usuario]</option>");
								}
							}
						?>
					</select>
				</span>
			</form>
		</fieldset>
		<?php
			if(isset($_GET['usuario'])&&$_GET['usuario']!=0){
				$SQL = "SELECT * FROM usuario WHERE id_usuario=$_GET[usuario]";
				$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
				$row = mysqli_fetch_array($QUERY);
		?>
		<br><fieldset class="frame">
			<form method="post" action="../php/updateUser.php" name="update" id="update" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset>
								<label>Nombre:</label><br>
								<input type="text" name="nombre" class="inputs" id="name" value="<?php echo $row['nombre']; ?>"><br>
								<label>Usuario:</label><br>
								<input type="text" name="user" class="inputs" value="<?php echo $row['nombre_usuario']; ?>"><br>
								<label>Contrase&ntilde;a:</label><br>
								<input type="password" name="pass" class="inputs" value="<?php echo $row['password']; ?>"><br>
								<label>Confirmar contrase&ntilde;a:</label><br>
								<input type="password" name="pass_Confirm" class="inputs" value="<?php echo $row['password']; ?>"><br>
								<input type="hidden" name="id" value="<?php echo $row['id_usuario']; ?>">
							</fieldset>
						</td>
					</tr>
				</table>
				<input type="image" class="submit" src="../images/user_update.png" title="Actualizar usuario"/>
			</form>
		</fieldset>
		<?php
			}
		?>
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
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha actualizado el usuario correctamente.', 'Atención')</script>";
		}
	}
?>
