<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit();
}
?>

<!-- Página de contenido privado -->
<h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['correo']); ?>!</h1>
<p>Este es tu contenido privado.</p>
