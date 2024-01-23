<?php
// Configuración de la base de datos (modifica según tu configuración)
$host = 'localhost';
$dbname = 'nombre_de_tu_base_de_datos';
$usuario = 'tu_usuario';
$contrasena = 'tu_contraseña';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
