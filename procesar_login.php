<?php
session_start();

// Validar CSRF token
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Acceso no autorizado");
}

// Incluir archivo de conexión a la base de datos
require_once('conexion.php');

// Obtener datos del formulario
$correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
$contrasena = $_POST['contrasena'];

// Verificar credenciales en la base de datos usando prepared statements
$sql = "SELECT id, correo, contrasena FROM usuarios WHERE correo = :correo";
$statement = $conexion->prepare($sql);
$statement->bindParam(':correo', $correo);

try {
    $statement->execute();
    $fila = $statement->fetch(PDO::FETCH_ASSOC);

    if ($fila && password_verify($contrasena, $fila['contrasena'])) {
        // Iniciar sesión
        $_SESSION['usuario_id'] = $fila['id'];
        $_SESSION['correo'] = $fila['correo'];
        // Redirigir al contenido privado
        header("Location: contenido_privado.php");
        exit();
    } else {
        echo "Credenciales incorrectas";
    }
} catch (PDOException $e) {
    die("Error al consultar la base de datos: " . $e->getMessage());
}
?>
