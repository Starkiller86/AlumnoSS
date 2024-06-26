<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Eliminar instituci&oacute;n</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'colegio' );
		</script>
		<script type='text/javascript'> 
			function confirma() {
				jConfirm('Al eliminar la institución, los alumnos dentro de la misma tendrán que ser reasignados a otra institución. ¿Está seguro de eliminar la institución?', 'Atención', function(r) { if( r ) { document.forms["eliminar"].submit(); }})
				return false
			}
		</script>
    </head>
	<body onLoad="document.getElementById('name').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Eliminar instituci&oacute;n</div>
			<br><form id="formulario" name="formulario" method="get" action="">
				<label>Instituci&oacute;n:</label>
				<span class="select-box">
					<select name='colegio' id="colegio" class="inputs" onChange="document.getElementById('formulario').submit()">
						<option value="0">Selecciona la instituci&oacute;n...</option>
						<?php
							$SQL = "SELECT * FROM colegio";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_GET['colegio'])){
									if($_GET['colegio'] == $resultado['id_colegio']){
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
				</span><br>
			</form>
			<?php
				if(isset($_GET['colegio'])&&$_GET['colegio']!=0){
					echo "<center><form id='eliminar' method='post' action='../php/dropSchool.php' onSubmit='return confirma()'>";
					echo "<input type='hidden' name='id' value='$_GET[colegio]'>";
					echo "<input type='image' class='submit' src='../images/folder_delete.png' title='Eliminar instituci&oacute;n'/>";
					echo "</form></center>";
				}
			?>
		</fieldset>
    </body>
	<?php
		if(isset($_GET['colegio'])){
			$query="SELECT id_alumno FROM alumno WHERE id_colegio=$_GET[colegio] AND status='Activo'";
			$result=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
			if(mysqli_num_rows($result)>0){
				echo "<script language='javascript' type='text/javascript'>jAlert('La instituci&oacute;n tiene alumnos activos asignados.', 'Atención')</script>";
			}
		}
	?>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha eliminado la instituci&oacute;n correctamente.', 'Atención')</script>";
		}
		mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
	}
?>
