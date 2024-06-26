<?php
    header("Content-Type: text/html;charset=utf-8");
	session_start();
	session_unset();
	session_destroy();
	echo "<script>parent.location.href='../index.php?a=A0001';</script>";
?>