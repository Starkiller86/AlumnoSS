<?php
	if(!isset($_GET['emysql'])) {
		header("Location:../index.php");
	}
	require "../php/security.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Error MySQL</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
    </head>
	<body> 
				<br><center><span style='font-size:12pt;color:red'><?php echo $_GET['emysql']; ?></span></center>
    </body>
</html>
<?php
	$error =  str_replace("%20"," ",$_GET['emysql']);
	$error =  str_replace("'","\'",$error);
	echo "<script language='javascript' type='text/javascript'>jAlert('$error', 'MySQL Error')</script>";
?>