<?php
    header("Content-Type: text/html;charset=utf-8");
	require "../php/security.php";
?>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td><span>Fecha</span></td>					</tr>
				</tfoot>
				<tbody>
					<?php
						$_GET['text'] = substr ( $_GET['text'] , 0, -1 );
						$fechas = explode("/", $_GET['text']);
						for($i = 0; $i < count($fechas); $i++) {
							echo "<tr><td style='text-align:center'><span>$fechas[$i]</span></td></tr>";
						}
					?>
				</tbody>
			</table>
			<center><?php echo count($fechas)." registros"; ?></center>
		</div>
	</body>
</html>