<?php
require_once 'autoloader.php';

session_start();

if (!isset($_COOKIE['correo'])) {
    echo "No estás autenticado.";
    exit;
}

$correo = $_COOKIE['correo'];
$conexion = new Connection;
$conn = $conexion->getConn();

$conn->begin_transaction();


$sql = "DELETE FROM `Personaje` WHERE `correocuenta` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$stmt->close();


$sql = "DELETE FROM `Cuenta` WHERE `correo` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$stmt->close();

$conn->commit();
setcookie('correo', '', time() - 3600, '/');

$conn->close();

header("Location: login.php");
?>
