<?php
$email = $_POST['mail'];
$comentario = $_POST['txt'];

$cuerpo = "<strong>Datos de contacto</strong>";
$cuerpo .= "<p><strong>E-Mail</strong>: $email</p>\n";
$cuerpo .= "<p><strong>Comentario</strong>:</p>\n";
$cuerpo .= "<blockquote>$comentario</blockquote>";

$remitente = "smessina5@gmail.com";

$head = "From: " . strip_tags($email) . "\r\n";
$head .= "MIME-Version: 1.0\r\n";
$head .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if(mail($remitente, "Contacto desde App Liquidacion", $cuerpo, $head)) {
	echo true;
	} else {
	echo false;
	}
?>