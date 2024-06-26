<?php
    
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>	
		<link rel="stylesheet" href="../css/styleTable.css" type="text/css" media="print, projection, screen" />
		<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
		<script type="text/javascript">
			$(function() {
				$("table")
					.tablesorter({widthFixed: true, widgets: ['zebra']})
					.tablesorterPager({container: $("#pager")});
			});
		</script>
    </head>
	<body>
		<center><div id="pager" class="pager">
			<form>
				<img src="../images/first.png" class="first"/>
				<img src="../images/prev.png" class="prev"/>
				<input type="text" class="pagedisplay"/ style="text-align:center;width:100px" readonly="readonly">
				<img src="../images/next.png" class="next"/>
				<img src="../images/last.png" class="last"/>
				<select class="pagesize">
					<option selected="selected" value="5">5</option>
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option  value="40">40</option>
				</select>
			</form>
		</div></center>
		<div style="overflow-x:auto;width:100%;">
			<table cellspacing="1" class="tablesorter" id="table">
				<thead>
					<tr>
						<th><span>Fecha&nbsp;&nbsp;&nbsp;<span>
						<th><span>Entrada&nbsp;&nbsp;&nbsp;<span>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td><span>Fecha</span></td>					
						<td><span>Entrada</span></td>					
					</tr>
				</tfoot>
				<tbody>
					<?php
						$query="SELECT fecha, MIN(hora_entrada) FROM asistencia WHERE id_alumno=$_GET[id] AND retardo='R' AND fecha BETWEEN '$_GET[fecha_i] 00:00:00.000000' AND '$_GET[fecha_t] 23:59:59.999999' GROUP BY fecha";
						//echo $query;
						$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
						$numero=mysqli_num_rows($res);
						while ($resultado = mysqli_fetch_array($res)){
							$resultado['hora_entrada']=date("g:i A",strtotime($resultado['hora_entrada']));
							echo "<tr><td style='text-align:center'>$resultado[fecha]</td><td style='text-align:center'>$resultado[hora_entrada]</td></tr>";
						}
					?>
				</tbody>
			</table>
			<center><?php echo "$numero registros"; ?></center>
		</div>
	</body>
</html>
