<?php
	require "../php/security.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Exportar base de datos</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateCP.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
    </head>
	<body onLoad="document.getElementById('password').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Exportar base de datos</div>
			<form method="post" action="../php/backup.php" name="formulario" id="formulario" onSubmit="return valida(this)">
				<br><input type="image" class="submit" src="../images/database-export.png" title="Generar respaldo"/>
			</form>
		</fieldset>
    </body>
</html>
<?php
	if(isset($_GET['a'])) {
		echo "<script language='javascript' type='text/javascript'>jAlert('', 'Atención')</script>";
		echo "<script type='text/javascript'> jConfirm('Se ha generado el archivo de respaldo <b>$_GET[a].sql</b> correctamente. ¿Desea descargar el archivo?', 'Atención', function(r) { if( r ) window.open('../php/download.php?id=$_GET[a].sql', '_blank', 'height=10, width=10, menubar=no, resizable=no, status=no, scrollbars=no, titlebar=no, toolbar=no') }); </script>";
	}
	if(isset($_GET['ebk'])) {
		echo "<script type='text/javascript'> jConfirm('Se ha producido algun error o advertencia al generar el respaldo. Para m&aacute;s informaci&oacute;n vea el archivo <b>$_GET[ebk].log</b>.. ¿Desea descargar el archivo ahora?', 'Atención', function(r) { if( r ) window.open('../php/download.php?id=$_GET[a].log', '_blank', 'height=10, width=10, menubar=no, resizable=no, status=no, scrollbars=no, titlebar=no, toolbar=no') }); </script>";
	}
?>
