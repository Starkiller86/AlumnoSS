<?php
	require "../php/security.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Gr&aacute;fica de alumnos</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>	
		<script src="../js/jscal2.js"></script>
		<script src="../js/es.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="../css/reduce-spacing.css" />
    </head>
	<body>
		<br><fieldset class="frame">
			<div id="legend">Gr&aacute;fica de alumnos</div>
			<form id="formulario" name="formulario" method="GET" action="../php/graphic.php" style="padding-top:5px;">
				<br><select name="tipo" class="inputs">
					<option value="1" <?php if(isset($_GET['tipo'])) { if($_GET['tipo']== 1) echo "selected='selected'"; }?>> Ingreso</option>
					<option value="2" <?php if(isset($_GET['tipo'])) { if($_GET['tipo']== 2) echo "selected='selected'"; }?>> Termino</option>
				</select>
				<label>Fecha de inicio:</label>
				<input type="text" name="fecha_i" class="inputs" id="f_date1" style="width:100px;text-align:center" readonly="readonly" value="<?php if(isset($_GET['fecha_i'])) { echo $_GET['fecha_i']; } ?>">
				<label>Fecha de t&eacute;rmino:</label>
				<input type="text" name="fecha_t" class="inputs" id="f_date2" style="width:100px;text-align:center" readonly="readonly" value="<?php if(isset($_GET['fecha_t'])) { echo $_GET['fecha_t']; } ?>">
				<script type="text/javascript">
					var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() },
						showTime: false
					});
					cal.manageFields("f_date1", "f_date1", "%Y-%m-%d");
					cal.manageFields("f_date2", "f_date2", "%Y-%m-%d");
				</script>
				&nbsp;&nbsp;&nbsp;<input type="image" name="buscar" class="submit" src="../images/search.png"/ width="30px" height="30px" align="middle" title="Buscar">
			</form>
		</fieldset>
		<?php
			if(isset($_GET['buscar_x'])){
		?>
		<br><div>
			<?php
				echo "<center><img src='../php/graphic.php?tipo=$_GET[tipo]&fecha_i=$_GET[fecha_i]&fecha_t=$_GET[fecha_t]'></center>";
			}
		?>
		</div>
	</body>
</html>