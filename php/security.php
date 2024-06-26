<?php
    header("Content-Type: text/html;charset=utf-8");
	session_start();
	if(isset($_SESSION['user'])){
		$dateOld= $_SESSION["last_access"];
		$dateNow = date("Y-n-j H:i:s");
		$time = (strtotime($dateNow)-strtotime($dateOld));
		if($time>= 600) {
			session_unset();
			session_destroy();
			echo "<script>parent.location.href='../index.php?e=E0004';</script>";
		}
		else{
			$_SESSION["last_access"] = $dateNow;
		}
	}
	else {
		echo "<script>parent.location.href='../index.php';</script>";
	}
?>
