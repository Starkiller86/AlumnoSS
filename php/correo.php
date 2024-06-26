<?php
header("Content-Type: text/html;charset=utf-8");
require("class.phpmailer.php");
require("class.smtp.php");
$mail = new PHPMailer();
session_start(); 
$correo =  "joakin461@gmail.com";
$nombre = "nombre";

//echo $correo;
//echo $nombre;
$body = "<html> 

<head>
    <meta charset='utf-8'>
    <title>Correo Credenciales</title> 
</head> 
<body> 
    <h1>Hola! Has Sido Aceptado En El ITSJR</h1>   
    <p>
    Ve INSCRIBETEC Para Completar Tu Proceso
    </p>
    <p> <strong>Recuerda Realizar Tu Pago Para Subirlo A La Plataforma </strong>
    </p>
    <p style='color:red;'> <strong>Cuenta: </strong>
    </p>
    <p > <strong>17506</strong>
    </p>
    <p style='color:red;'> <strong>Cantidad: </strong>
    </p>
    <p > <strong>$1950.00</strong>
    </p>
    <p>
    Instituto Tecnológico de San Juan Del Río
    Tel. (427)272 4118
    </p>
</body> 
</html>";
 
$mail->IsSMTP(); 
 
// la dirección del servidor, p. ej.: smtp.servidor.com
$mail->Host = "servidor3303.tl.controladordns.com";
 
// dirección remitente, p. ej.: no-responder@miempresa.com
$mail->From = "joakin_hq@hotmail.com";
 
// nombre remitente, p. ej.: "Servicio de envío automático"
$mail->FromName = "Servicio Automatico InscribeTEC ";
 
// asunto y cuerpo alternativo del mensaje
$mail->Subject = "Seguimiento Proceso De Admision Instituto Tecnologico De San Juan Del Rio";
$mail->AltBody = "Cuerpo alternativo para cuando el visor no puede leer HTML en el cuerpo"; 
 
// si el cuerpo del mensaje es HTML
$mail->MsgHTML($body);
 
// podemos hacer varios AddAdress
$mail->AddAddress($correo,$nombre);
 
// si el SMTP necesita autenticación
$mail->SMTPAuth = true;
 
// credenciales usuario
$mail->Username = "joakin_hq@hotmail.com";
$mail->Password = "#Jhq&14*12@93$#"; 
 
if(!$mail->Send()) {
echo "Error enviando: " . $mail->ErrorInfo;
} else {
    echo"<script  language='javascript'>    
        </script>";
}
?>
