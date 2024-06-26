<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
	<head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Comentarios del alumno</title>
		<script language="javascript" src="../js/validateCS.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'nombre' );
		</script>
	</head>
    <body>
		<br><fieldset class="frame">
			<div id="legend">Comentarios del alumno</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno ORDER BY apellido_paterno, apellido_materno, nombre";
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
			if(isset($_GET['id']) && $_GET['id']!=0){
				//$archivo = file_get_contents("../log/".$_GET['id'].".log");
				$comentarios="";
				$query="SELECT * FROM comentarios WHERE id_alumno=$_GET[id]";
				$result =  mysqli_query ($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				while($row=mysqli_fetch_array($result)) {
					$comentarios=$comentarios.$row['fecha']." ----- ".$row['comentario']."\n";
				}
				$SQL = "SELECT status FROM alumno WHERE id_alumno=$_GET[id]";
				$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
				$row=mysqli_fetch_array($QUERY);
		?>
			<br><fieldset class="frame" style='height:60%'>
				<form id="comentarios" name="comentarios" method="post" action="../php/commentsStudent.php" style="height:80%" onSubmit="return valida(this)">
					<textarea name="coments" style='height:100%;width:70%' readonly><?php echo $comentarios; ?></textarea>
					<?php
						if($row['status']!='Terminado') {
					?>
							<br><label>Comentario:</label>
							<input type="text" name="nuevo" id="nuevo" class="inputs" style="width:40%">
							<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
							<input type="image" name="submit" src="../images/player_fastforward.png" style="width:20px;height:20px" title="Agregar comentario">
					<?php
						}
					?>
				</form>
			</fieldset>
		<?php
			}
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
	</body>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha agregado correctamente el comentario.', 'Mensaje')</script>";
		}
	}
?>