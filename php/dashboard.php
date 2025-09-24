<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

    <h3>Datos en vivo de los checadores</h3>
    <iframe src="/getDataZkt.php" width="100%" height="600"></iframe>
</body>
</html>