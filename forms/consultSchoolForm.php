<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Consulta de instituciones</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>	
		<link rel="stylesheet" href="../css/styleTable.css" type="text/css" media="print, projection, screen" />
		<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
    </head>
	<body>
		<br><fieldset class="frame">
			<div id="legend">Consulta de instituciones</div>
			<?php
				$query="SELECT * FROM colegio";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$registros=mysqli_num_rows($res);
				if($registros==0) {
					echo "<center><span style='font-size:12pt;color:red'>No se encontraron instituciones!!!</span></center>";
				}
			?>
				<br><center><div id="pager" class="pager">
					<form>
						<img src="../images/first.png" class="first"/>
						<img src="../images/prev.png" class="prev"/>
						<input type="text" class="pagedisplay"/ style="text-align:center;" readonly="readonly">
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
				<div style="overflow-x:auto;width:80%;">
				<table cellspacing="1" class="tablesorter" id="table">
					<thead>
						<tr>
							<th><span>Nombre&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Responsable&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Cargo del responsable&nbsp;&nbsp;&nbsp;<span></th>
							<th><span>Acciones&nbsp;&nbsp;&nbsp;<span></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td><span>Nombre</span></td>
							<td><span>Responsable</span></td>
							<td><span>Cargo del responsable</span></td>
							<td><span>Acciones</span></td>
						</tr>
					</tfoot>
					<tbody>
					<?php
						while ($row = mysqli_fetch_array($res)){
							echo (
								"<tr><td><span>$row[colegios]</span></td>".
								"<td><span>$row[responsable]</span></td>".
								"<td><span>$row[cargo_responsable]</span></td><td style='width:50px;text-align:center'>"
							);
							echo "<a href='updateSchoolForm.php?colegio=$row[id_colegio]'><img src='../images/folder_edit.png' title='Modificar' style='border:0' height='20px' width='20px'></a>";
							echo "<a href='dropSchoolForm.php?colegio=$row[id_colegio]'><img src='../images/folder_delete.png' title='Eliminar' style='border:0' height='20px' width='20px'></a>";
							echo "</td></tr>";
						}
						mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
					?>
					</tbody>
				</table>
				<?php  if($registros>0) { echo "<br><center><span style='font-size:10pt;'>Se encontraron $registros instituciones</span></center><br>"; } ?>
		</div>
		</fieldset>
	</body>
</html>