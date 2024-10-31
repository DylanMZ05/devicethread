<?php
// Leer los datos JSON recibidos
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $options = $data['options'];

    // Crear el cuerpo del mensaje
    $asunto = "Solicitud de Cotización - Opciones Seleccionadas";
    $mensaje = "Nombre: $name\n";
    $mensaje .= "Email: $email\n";
    $mensaje .= "Opciones seleccionadas:\n";
    foreach ($options as $opcion) {
        $mensaje .= "- $opcion\n";
    }

    // Configuración de cabeceras
    $cabeceras = "From: $email\r\n";
    $cabeceras .= "Reply-To: $email\r\n";
    $cabeceras .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Enviar el correo
    $destinatario = "dylanmazurzgainer@gmail.com";
    if (mail($destinatario, $asunto, $mensaje, $cabeceras)) {
        echo "Correo enviado exitosamente.";
    } else {
        echo "Error al enviar el correo.";
    }
} else {
    echo "No se recibieron datos válidos.";
}
?>