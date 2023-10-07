<?php
    $host = "localhost";
    $usuario = "root";
    $contraseña = "";
    $base_de_datos = "ayalatpblanco";
    $tabla = "personas";
    
    $conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

?>