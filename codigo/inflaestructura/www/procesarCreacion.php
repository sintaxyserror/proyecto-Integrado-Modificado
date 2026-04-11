<?php
    require_once 'autoloader.php';
    $conexion = new Connection;
   $nombre = $_POST["nombre"];
   $daño = $_POST["danio"];
   $energia = $_POST["energia"];
   $vida = $_POST["vida"];
   $poder1 = $_POST["poder1"];
   $poder2 = $_POST["poder2"];
   $poder3 = $_POST["poder3"];
   $correo = $usuario = $_COOKIE['correo'];

   $dañoT=10;
   $energiaT=50;
   $vidaT = 100;

   $dañoT+=$daño*3;
   $energiaT+= $energia*5;
   $vidaT+= $vida*10;


    $sql = "INSERT INTO `Personaje`(`nombre`, `energia`, `correocuenta`, `vida`, `daño`) VALUES ('$nombre','$energiaT','$correo','$vidaT','$dañoT')";
    $conn = $conexion->getConn();
    $result = mysqli_query($conn, $sql);
    $sql2 = "INSERT INTO `PersonajePoder`(`nombrePersonaje`, `nombrePoder`) VALUES ('$nombre','$poder1')";
    $result = $result = mysqli_query($conn, $sql2);
    $sql3 = "INSERT INTO `PersonajePoder`(`nombrePersonaje`, `nombrePoder`) VALUES ('$nombre','$poder2')";
    $result = $result = mysqli_query($conn, $sql3);
    $sql4 = "INSERT INTO `PersonajePoder`(`nombrePersonaje`, `nombrePoder`) VALUES ('$nombre','$poder3')";
    $result = mysqli_query($conn, $sql4);

    header("location: home.php");
  
?>