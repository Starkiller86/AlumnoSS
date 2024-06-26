<?php
	require "../php/security.php";
	$privs = $_SESSION['privilegios'];
?>
<html>
	<head>
		<script src='../js/jquery-1.7.2.min.js' type='text/javascript'></script>
		<script type='text/javascript' src='../js/acordeon.js'></script>
		<link href="../css/acordeon.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="lateralPanel">
		<table cellpadding="0px" cellspacing="0px" class="tabla"><tr><td>
			<div class='menu_list' id='pane'>
				<?php if($privs[0]==1||$privs[1]==1||$privs[2]==1||$privs[3]==1||$privs[4]==1||$privs[5]==1||$privs[6]==1||$privs[7]==1||$privs[28]==1||$privs[29]==1||$privs[31]==1) { ?><p class='menu_head'>&nbsp;&nbsp;&nbsp;Alumnos</p> <?php } ?>
				<div class='menu_body'>
					<?php if($privs[0]==1) { ?><a href='../forms/newStudentForm.php' target="content">Registrar nuevo alumno</a><?php } ?>
					<?php if($privs[1]==1) { ?><a href='../forms/dropStudentForm.php' target="content" >Activar/Inactivar alumno</a><?php } ?>
					<?php if($privs[2]==1) { ?><a href='../forms/updateStudentForm.php' target="content" >Modificar datos del alumno</a><?php } ?>
					<?php if($privs[3]==1) { ?><a href='../forms/allocateProjectForm.php' target="content">Asignar/Cambiar proyecto al alumno</a><?php } ?>
					<?php if($privs[4]==1) { ?><a href='../forms/deallocateProjectForm.php' target="content">Desasignar proyecto al alumno</a><?php } ?>
					<?php if($privs[5]==1) { ?><a href='../forms/allocatePasswordForm.php' target="content">Cambiar contrase&ntilde;a al alumno</a><?php } ?>
					<?php if($privs[29]==1) { ?><a href='../forms/scheduleUpdateForm.php' target="content">Asignar/Cambiar horario al alumno</a><?php } ?>
					<?php if($privs[29]==1) { ?><a href='../forms/horarios.php' target="content">Horario Alumno</a><?php } ?>
					<?php if($privs[28]==1) { ?><a href='../forms/commentsStudentForm.php' target="content">Hist&oacute;rico de comentarios del alumno</a><?php } ?>
					<?php if($privs[31]==1) { ?><a href='../forms/logStudentForm.php' target="content">Log del alumno</a><?php } ?>
					<?php if($privs[6]==1) { ?><a href='../forms/deleteStudentForm.php' target="content">Eliminar alumno</a><?php } ?>
					<?php if($privs[7]==1) { ?><a href='../forms/consultStudentForm.php' target="content">Consulta de alumnos</a><?php } ?>
				</div>
				<?php if($privs[8]==1||$privs[9]==1||$privs[10]==1||$privs[11]==1) { ?><p class='menu_head'>&nbsp;&nbsp;&nbsp;Instituciones</p><?php } ?>
				<div class='menu_body'>
					<?php if($privs[8]==1) { ?><a href='../forms/newSchoolForm.php' target="content">Registrar nueva instituci&oacute;n</a><?php } ?>
					<?php if($privs[9]==1) { ?><a href='../forms/updateSchoolForm.php' target="content">Modificar instituci&oacute;n</a><?php } ?>
					<?php if($privs[10]==1) { ?><a href='../forms/dropSchoolForm.php' target="content">Eliminar instituci&oacute;n</a><?php } ?>
					<?php if($privs[11]==1) { ?><a href='../forms/consultSchoolForm.php' target="content">Consultar instituciones</a><?php } ?>
				</div>
				<?php if($privs[12]==1||$privs[13]==1||$privs[14]==1||$privs[15]==1) { ?><p class='menu_head'>&nbsp;&nbsp;&nbsp;Proyectos</p><?php } ?>
				<div class='menu_body'>
					<?php if($privs[12]==1) { ?><a href='../forms/newProjectForm.php' target="content">Registrar nuevo proyecto</a><?php } ?>
					<?php if($privs[13]==1) { ?><a href='../forms/updateProjectForm.php' target="content">Modificar datos del proyecto</a><?php } ?>
					<?php if($privs[14]==1) { ?><a href='../forms/dropProjectForm.php' target="content">Terminar proyecto</a><?php } ?>
					<?php if($privs[15]==1) { ?><a href='../forms/consultProjectForm.php' target="content">Consulta de proyectos</a><?php } ?>
				</div>
				<?php if($privs[16]==1||$privs[30]==1) { ?><p class='menu_head'>&nbsp;&nbsp;&nbsp;Asistencia</p><?php } ?>
				<div class='menu_body'>
					<?php if($privs[16]==1) { ?><a href='../forms/consultAssistanceForm.php' target="content">Consultar asistencia del alumno</a><?php } ?>
					<?php if($privs[30]==1) { ?><a href='../forms/incidentsForm.php' target="content">Incidencias</a><?php } ?>
				</div>
				<?php if($privs[17]==1||$privs[18]==1||$privs[19]==1||$privs[20]==1||$privs[21]==1||$privs[22]==1) { ?><p class='menu_head'>&nbsp;&nbsp;&nbsp;Administraci&oacute;n</p><?php } ?>
				<div class='menu_body'>
					<?php if($privs[17]==1) { ?><a href='../forms/newUserForm.php' target="content">Registrar usuarios</a><?php } ?>
					<?php if($privs[18]==1) { ?><a href='../forms/updateUserForm.php' target="content">Actualizar usuarios</a><?php } ?>
					<?php if($privs[19]==1) { ?><a href='../forms/dropUserForm.php' target="content">Activar/Inactivar usuarios</a><?php } ?>
					<?php if($privs[20]==1) { ?><a href='../forms/deleteUserForm.php' target="content">Eliminar usuarios</a><?php } ?>
					<?php if($privs[21]==1) { ?><a href='../forms/updatePrivsForm.php' target="content">Cambiar privilegios</a><?php } ?>
					<?php if($privs[22]==1) { ?><a href='../forms/consultUserForm.php' target="content">Consultar usuarios</a><?php } ?>
				</div>
				<?php if($privs[25]==1) { ?><p class='menu_head'>&nbsp;&nbsp;&nbsp;Gr&aacute;ficas</p><?php } ?>
				<div class='menu_body'>
					<?php if($privs[25]==1) { ?><a href='../forms/graphicStudentForm.php' target="content">Gr&aacute;fica de alumnos</a><?php } ?>
				</div>
				<?php if($privs[26]==1||$privs[27]==1) { ?><p class='menu_head'>&nbsp;&nbsp;&nbsp;Documentos</p><?php } ?>
				<div class='menu_body'>
					<?php if($privs[26]==1) { ?><a href='../forms/acceptanceDocForm.php' target="content">Carta de aceptaci&oacute;n</a><?php } ?>
					<?php if($privs[27]==1) { ?><a href='../forms/terminationDocForm.php' target="content">Carta de terminaci&oacute;n</a><?php } ?>
					<?php if($privs[26]==1||$privs[27]==1) { ?><a href='../forms/ConstancyDocForm.php' target="content">Constancia de horas</a><?php } ?>
				</div>
				<?php if($privs[24]==1) { ?><p class='menu_head'>&nbsp;&nbsp;&nbsp;Base de datos</p><?php } ?>
				<div class='menu_body'>
					<?php if($privs[24]==1) { ?><a href='../forms/backupForm.php' target="content">Generar respaldo</a><?php } ?>
				</div>
				<p class='menu_head'>&nbsp;&nbsp;&nbsp;Perfil</p>
				<div class='menu_body'>
					<?php if($privs[23]==1) { ?><a href='../forms/changePasswordForm.php' target="content">Cambiar contrase&ntilde;a</a><?php } ?>
					<a href='../php/logout.php' target="content">Cerrar sesi&oacute;n</a>
				</div>
			</div>
		</td></tr></table>
	</body>
</html>