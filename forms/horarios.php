<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta content="610" http-equiv="REFRESH">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Asignar horario</title>
		<script type="text/javascript" src="../js/validateSU.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/jquery.ptTimeSelect.css" />
		<link rel="stylesheet" type="text/css" href="../css/ui.theme.css" />
		<link rel="stylesheet" type="text/css" href="../css/ui.core.css" />
    <link rel="stylesheet" type="text/css" href="../css/tippy.css" />
		<script type="text/javascript" src="../js/jquery.ptTimeSelect.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>        
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'nombre' );
		</script>
    </head>
	<body onLoad="document.getElementById('name').focus()" style="background-color: #c1e4eb;">
		<br><fieldset class="frame">
			<div id="legend">Horarios</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Proyecto</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione Un Proyecto...</option>
						<?php
							$SQL = "SELECT  * from proyecto  where status='Disponible'";     
                            $QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_GET['id'])){
									if($_GET['id'] == $resultado['id_proyecto']){
										print ("<option value=$resultado[id_proyecto] selected='selected'>
                                            $resultado[nombre_proyecto]</option>");
									}
									else {
										print ("<option value=$resultado[id_proyecto]>$resultado[nombre_proyecto]</option>");
									}
								}
								else {
									print ("<option value=$resultado[id_proyecto]>$resultado[nombre_proyecto]</option>");
								}
							}
						?>
					</select>
					
				</span>
			</form>
		</fieldset>
	
		<br><fieldset class="frame">
			<form method="post" action="../php/scheduleUpdate.php" name="updateForm" id="updateForm" onSubmit="return valida(this)">
					<br><table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>ALUMNO</th>
                                    <th>Domingo</th>
                                    <th>Lunes</th>
                                    <th>Martes</th>
                                    <th>Miércoles</th>
                                    <th>Jueves</th>
                                    <th>Viernes</th>
                                    <th>Sábado</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                       
                                   <tr>
                                      
                                       <?php
                                        if(isset($_GET['id'])){ 
                                            $SQL = "SELECT DISTINCT alumno.id_alumno as id_alu, nombre, apellido_paterno, apellido_materno FROM alumno, alumno_servicio WHERE alumno_servicio.id_proyecto = '$_GET[id]' and alumno_servicio.status = 'Activo' AND alumno_servicio.id_alumno = alumno.id_alumno";
                                            $QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
                                                while ( $resultado = mysqli_fetch_array($QUERY)) {
                                    
                                       echo" <td id='' style='text-align:justify;'>
                                                <button id='nombre_".$resultado['id_alu']."' type='button' class='btn btn-light'> <a  style='text-decoration: none; color:black; text-transform: uppercase;'>".$resultado['apellido_paterno'] ." ". $resultado['apellido_materno'] . " ".$resultado['nombre']."<br></a></button> 
                                               
                                       ";
                                            
                                               
                                            ?>
                                        </td>   
                                        <?php      
                                            $horario="SELECT * FROM horario where id_alumno='$resultado[id_alu]' ";
                                            echo "<center>";
                                            $res=mysqli_query($conn, $horario) or header("Location:error.php?emysql=".mysqli_error($conn));
                                            if(mysqli_num_rows($res)>0){
                                                $row=mysqli_fetch_array($res);
                                                if($row['e0']!="") { $row['e0'] = date("g:i A",strtotime($row['e0'])); }
                                                if($row['e1']!="") { $row['e1'] = date("g:i A",strtotime($row['e1'])); }
                                                if($row['e2']!="") { $row['e2'] = date("g:i A",strtotime($row['e2'])); }
                                                if($row['e3']!="") { $row['e3'] = date("g:i A",strtotime($row['e3'])); }
                                                if($row['e4']!="") { $row['e4'] = date("g:i A",strtotime($row['e4'])); }
                                                if($row['e5']!="") { $row['e5'] = date("g:i A",strtotime($row['e5'])); }
                                                if($row['e6']!="") { $row['e6'] = date("g:i A",strtotime($row['e6'])); }
                                                if($row['s0']!="") { $row['s0'] = date("g:i A",strtotime($row['s0'])); }
                                                if($row['s1']!="") { $row['s1'] = date("g:i A",strtotime($row['s1'])); }
                                                if($row['s2']!="") { $row['s2'] = date("g:i A",strtotime($row['s2'])); }
                                                if($row['s3']!="") { $row['s3'] = date("g:i A",strtotime($row['s3'])); }
                                                if($row['s4']!="") { $row['s4'] = date("g:i A",strtotime($row['s4'])); }
                                                if($row['s5']!="") { $row['s5'] = date("g:i A",strtotime($row['s5'])); }
                                                if($row['s6']!="") { $row['s6'] = date("g:i A",strtotime($row['s6'])); }
                                           
                                        }
                                        ?>
                                        
                                   
                                       <td>
                                       <!--domingo-->
                                              <?php 
                                               if(($row['e0']!="") and ($row['s0']!="") ){
                                                   echo "<b style='font-size: xx-small;' >" . $row['e0']."-".$row['s0']. "</b>"; 
                                                } ?> 
                                       </td>
                                       <td>
                                       <!--lunes-->
                                               <?php 
                                               if(($row['e1']!="") and ($row['s1']!="") ){
                                                   echo "<b style='font-size: xx-small;' >" . $row['e1']."-".$row['s1']. "</b>"; 
                                                } ?> 
                                       </td>
                                       <td>
                                       <!--martes-->
                                               <?php
                                               if(($row['e2']!="") and ($row['s2']!="") ){
                                                   echo "<b style='font-size: xx-small;' >" . $row['e2']."-".$row['s2']. "</b>"; 
                                                }?> 
                                       </td>
                                       <td>
                                       <!--miercoles-->
                                               <?php 
                                               if(($row['e3']!="") and ($row['s3']!="") ){
                                                   echo "<b style='font-size: xx-small;' >" . $row['e3']."-".$row['s3']. "</b>"; 
                                                }  ?> 
                                       </td>
                                       <td>
                                       <!--jueves-->
                                               <?php 
                                               if(($row['e4']!="") and ($row['s4']!="") ){
                                                   echo "<b style='font-size: xx-small;' >" . $row['e4']."-".$row['s4']. "</b>"; 
                                                } ?> 
                                       </td>
                                       <td>
                                       <!--viernes-->
                                               <?php 
                                               if(($row['e5']!="") and ($row['s5']!="") ){
                                                   echo "<b style='font-size: xx-small;' >" . $row['e5']."-".$row['s5']. "</b>"; 
                                                } ?> 
                                       </td>
                                       <td>
                                       <!--sábado-->
                                               <?php 
                                               if(($row['e6']!="") and ($row['s6']!="") ){
                                                   echo "<b style='font-size: xx-small;' >" . $row['e6']."-".$row['s6']. "  </b>"; 
                                                } ?> 
                                       </td>
                                    </tr>
                                        <?php
                                                }
                                        }
                                       ?>
                            </tbody>
                        </table>
	
			</form>
		</fieldset>  
    <!-- <button class="btn btn-primary" style="margin-left: 15%;">Hover for a new image</button> -->
    <div id="template" style="display: none; ">
        Cargando horario...
    </div>
   
    <br><br><br><br>
    <script src="https://unpkg.com/tippy.js@2.5.2/dist/tippy.all.min.js"></script>
    <script src="../js/tippy.js"></script>   
    </body>
</html>
