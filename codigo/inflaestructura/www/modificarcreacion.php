<?php
require_once 'autoloader.php';
$conexion = new Connection;

$daño = $_POST["danio"];
$energia = $_POST["energia"];
$vida = $_POST["vida"];
$poder1 = $_POST["poder1"];
$poder2 = $_POST["poder2"];
$poder3 = $_POST["poder3"];
$correo = $_COOKIE['correo'];
$conn = $conexion->getConn();

$query = "SELECT nombre FROM Personaje WHERE correocuenta='$correo'";
$resultado = mysqli_query($conn, $query);
$fila = $resultado->fetch_assoc();
$nombrePersonaje = $fila['nombre'];

if ($poder1 == $poder2 || $poder1 == $poder3 || $poder2 == $poder3) {
    echo "Error: No se pueden asignar poderes iguales.";
} else {
    
    $dañoT = 10 + ($daño * 3);
    $energiaT = 50 + ($energia * 5);
    $vidaT = 100 + ($vida * 10);
    
    
    $sql = "UPDATE Personaje SET energia='$energiaT', vida='$vidaT', daño='$dañoT' WHERE nombre='$nombrePersonaje' AND correocuenta='$correo'";
    $result = mysqli_query($conn, $sql);
    
    $sqlDelete = "DELETE FROM PersonajePoder WHERE nombrePersonaje='$nombrePersonaje'";
    $resultDelete = mysqli_query($conn, $sqlDelete);


    $sqlInsert1 = "INSERT INTO PersonajePoder (nombrePersonaje, nombrePoder) VALUES ('$nombrePersonaje', '$poder1')";
    $sqlInsert2 = "INSERT INTO PersonajePoder (nombrePersonaje, nombrePoder) VALUES ('$nombrePersonaje', '$poder2')";
    $sqlInsert3 = "INSERT INTO PersonajePoder (nombrePersonaje, nombrePoder) VALUES ('$nombrePersonaje', '$poder3')";
    
    $resultInsert1 = mysqli_query($conn, $sqlInsert1);
    $resultInsert2 = mysqli_query($conn, $sqlInsert2);
    $resultInsert3 = mysqli_query($conn, $sqlInsert3);
    
    if ($result && $resultDelete && $resultInsert1 && $resultInsert2 && $resultInsert3) {
        header("Location: home.php");
    } else {
        echo "Error al actualizar el personaje.";
    }
}
?>
