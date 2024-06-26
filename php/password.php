<?php
     header("Content-Type: text/html;charset=utf-8");
	function generarPassword() { 
		$permitidos = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$i = 0;
		$password = "";
		while ($i <= 4) {
			$password .= $permitidos[mt_rand(0,62)];
			$i++;
		}
		return $password;
	}
?>
