<?php
require_once 'autoloader.php';
$conexion = new Connection;
$nombrePoder = $_POST["nombrePoder"];
$daño = $_POST["daño"];
$coste = $_POST["coste"];
$descripcion = $_POST["descripcion"];

if (empty($nombrePoder) || empty($daño) || empty($coste) || empty($descripcion)) {
    die("Todos los campos son obligatorios.");
}

if ( $daño <0 || $coste <0) {
    die("No puede haber campos negativos");
}

$query = "INSERT INTO Poder (nombrePoder, daño, coste, descripcion) 
VALUES ('$nombrePoder', '$daño', '$coste', '$descripcion')";
$conn = $conexion->getConn();
$result = mysqli_query($conn, $query);
header("location: home.php");
?>