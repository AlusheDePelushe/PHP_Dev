<?php
// Importar conexión
require_once __DIR__ . "/../db/conexion.php";

// Revisar si el formulario se envió
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar la consulta para evitar inyección SQL
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar contraseña
        if (password_verify($password, $usuario['password'])) {
            // Inicio de sesión exitoso
            echo "<h2>¡Bienvenido, " . htmlspecialchars($usuario['username']) . "!</h2>";
            // Aquí podrías redirigir a un dashboard:
            // header("Location: dashboard.php");
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: ../index.php?error=Usuario o contraseña incorrectos");
            exit();
        }
    } else {
        // Usuario no existe
        header("Location: ../index.php?error=Usuario o contraseña incorrectos");
        exit();
    }

    $stmt->close();
}

// Cerrar conexión
$conexion->close();
?>
