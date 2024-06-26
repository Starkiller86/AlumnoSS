<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php";
	$fp = fopen("../log/".$_POST['id'].".log", "a+");
	fputs($fp, "\n".date("d-m-Y - H:i:s $_SESSION[user] ----- ").$_POST['nuevo']);
	fclose($fp);
	$query="INSERT INTO comentarios VALUES($_POST[id], '$_POST[nuevo]', '".date("Y-m-d H:i:s")."')";
	$result =  mysqli_query ($conn, $query) or header("Location:../forms/error.php?emysql=".mysqli_error($conn));
	header("Location:../forms/commentsStudentForm.php?id=$_POST[id]&a=A0001");
?>