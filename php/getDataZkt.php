<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

// Rutas
$venvPath = __DIR__ . "/venv/bin/python3";
$scriptPath = __DIR__ . "/get_data_zkt.py";

// Ejecutar Python
$output = shell_exec("$venvPath $scriptPath 2>&1");
$data = json_decode($output, true);

echo "<h2>Datos crudos del checador</h2>";

if (is_array($data)) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Dispositivo</th><th>User ID</th><th>Fecha/Hora</th><th>Status</th></tr>";
    
    foreach ($data as $row) {
        if (isset($row['error'])) {
            echo "<tr><td>{$row['device']}</td><td colspan='3'>Error: {$row['error']}</td></tr>";
        } else {
            echo "<tr>
                    <td>{$row['device']}</td>
                    <td>{$row['user_id']}</td>
                    <td>{$row['timestamp']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
        }
    }
    echo "</table>";
} else {
    echo "<pre>$output</pre>"; // fallback para debug
}
?>
