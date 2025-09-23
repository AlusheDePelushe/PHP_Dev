<?php
$host = "db";
$user = "userapp";
$password = "userpass";
$database = "miapp";

$conexion = new mysqli($host, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
