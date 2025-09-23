<?php
$servername = "db";
$username = "userapp";
$password = "userpass";
$database = "miapp";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "🚀 Conexión exitosa a MySQL desde PHP!";
?>
