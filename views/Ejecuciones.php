<?php

// Conexión a la base de datos
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'AppSalon1';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta SQL
$sql = "INSERT INTO usuarios(Usuario,Clave,Tipo_Usuario,Estatus,Token) VALUES('ClaudiaFigueroa28','987654321','1','1','123456789')";

if ($result = $conn->query($sql)) {
    /*// Acción a realizar con los resultados
    while ($row = $result->fetch_assoc()) {
        // Acción a realizar con cada registro
    }*/

    // Liberar los recursos
    $result->free();
} /*else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}*/
// Cerrar la conexión
$conn->close();
?>