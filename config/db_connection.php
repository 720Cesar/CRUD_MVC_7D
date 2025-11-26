<?php

    // Crear las variables del servidor
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "prueba";

    // Función para la conexión a la BD
    $connection = new mysqli($server, $user, $password, $db);

    if($connection -> connect_errno){
        // Conexión fallida
        die("Error en la conexión " . $connection -> connect_errno);
    }

