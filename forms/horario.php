<?php    
require "../php/security.php";
require "../db/connectDB.php";
    if(!isset($_POST['jsonPHP']))
    {
        echo '{"R":"404}' ;
    }
    else
    {
         $json_data = $_POST['jsonPHP']; 
        $jsonPHP = json_decode($json_data,true);

        $sql="SELECT * FROM horario where id_alumno='".$jsonPHP['IDAL']."' ";
        $res=mysqli_query($conn, $sql) or header("Location:error.php?emysql=".mysqli_error($conn));
        if(mysqli_num_rows($res)>0){
            $row=mysqli_fetch_array($res);
            $datos=json_encode($row) ;
            echo '{"R":"200","DATOS":'.$datos.'}' ;      
         }
         else
         {
             echo '{"R":"404"}' ;  
         }
    }
   
?>