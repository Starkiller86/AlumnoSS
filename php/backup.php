<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	require "../db/connectDB.php"; 
	mysqli_close($conn);
	$nombre = date("Y_m_d_H_i_s");
	$C_RUTA_ARCHIVO = dirname(__file__)."/../backups/".$nombre.".sql";
	$log = dirname(__file__)."/../backups/".$nombre.".log";
	$command = "mysqldump --opt --log-error=".$log." -h ".$urldb." ".$db." -u ".$userdb." --password='".$passuserdb."' > ".$C_RUTA_ARCHIVO;
	system($command);
	if(filesize($log) == 0){
		header("Location:../forms/backupForm.php?a=".$nombre);
	}
	else {
		header("Location:../forms/backupForm.php?ebk=".$nombre);
	}
?>
