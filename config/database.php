<?php
$host = 'localhost';
$db = 'sistema_usuarios';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error en la conexión: ' . $e->getMessage();
    exit();
}
?>
