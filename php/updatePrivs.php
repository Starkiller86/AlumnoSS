<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$id = $_POST['id'];
	$privilegios = "";
	if(isset($_POST['p0'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p1'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p2'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p3'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p4'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p5'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p6'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p7'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p8'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p9'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p10'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p11'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p12'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p13'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p14'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p15'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p16'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p17'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p18'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p19'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p20'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p21'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p22'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p23'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p24'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p25'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p26'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p27'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p28'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p29'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p30'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	if(isset($_POST['p31'])) { $privilegios = $privilegios."1"; } else { $privilegios = $privilegios."0"; }
	$SQL = "UPDATE usuario SET privilegios='$privilegios' WHERE id_usuario=$id";
	$QUERY =  mysqli_query ($conn,$SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
	mysqli_close($conn) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	header("Location:../forms/updatePrivsForm.php?a=A0001&usuario=$id");
?>