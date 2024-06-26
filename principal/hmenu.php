<?php
	require "../php/security.php";
	$privs = $_SESSION['privilegios'];
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/hmenu.css">
	</head>
	<body>
		<div class="menu">
			<?php if($privs[23]==1) { ?><a href="../forms/changePasswordForm.php" target="content"><img src="../images/account.png" style="border:0"></a><?php } ?>
			<a href="../php/logout.php"><img src="../images/logout.png" style="border:0"></a>
		</div>
	</body>
</html>