<?php
session_start();

// Validar CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Acceso no autorizado");
}

// Resto del código...


// Incluir archivo de conexión a la base de datos
require_once('conexion.php');

// Obtener datos del formulario
$correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

// Insertar datos en la base de datos usando prepared statements
$sql = "INSERT INTO ejercicio1 (correo, contrasena) VALUES (:correo, :contrasena)";
$statement = $conexion->prepare($sql);
$statement->bindParam(':correo', $correo);
$statement->bindParam(':contrasena', $contrasena);

try {
    $statement->execute();
    // Aquí puedes manejar el almacenamiento de archivos si es necesario
    echo "Registro exitoso.";
} catch (PDOException $e) {
    die("Error al insertar datos en la base de datos: " . $e->getMessage());
}
?>

