<?php
    header("Content-Type: text/html;charset=utf-8");
	require "security.php";
	$downloadfilename = basename($_GET['id']);
	$archivo = "../backups/".$_GET['id'];
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=' . $downloadfilename);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($archivo));
	ob_clean();
	flush();
	readfile($archivo);
	exit;
?>