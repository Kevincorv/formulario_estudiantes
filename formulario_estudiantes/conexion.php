<?php
$host = 'localhost';
$dbname = 'universidad';
$username = 'tu_usuario'; // Reemplaza 'tu_usuario' con tu nombre de usuario de MySQL
$password = 'tu_contraseña'; // Reemplaza 'tu_contraseña' con tu contraseña de MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
