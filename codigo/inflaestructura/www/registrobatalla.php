<?php
require_once("autoloader.php");
$connection = new Connection();

function drawlist($conn, $nombrePersonaje) {
    $sql5 = "SELECT b.*
    FROM Batalla b
    JOIN BatallaPersonaje bp ON b.id = bp.idbatalla
    WHERE bp.nombrePersonaje = '$nombrePersonaje'";
    $result = $conn->query($sql5);

    $batallas = [];

    $i = 1;
   
    $output = '';

    while ($row = $result->fetch_assoc()) {
        $output .= "
            <div class='col-sm-3'> 
                <div class='batalla'>
                    <div class='card'>
                        <div class='card-body'>
                            <p><strong>ID Batalla:</strong> {$row['id']}</p>
                            <p><strong>Fecha:</strong> {$row['fecha']}</p>
                            <p><strong>Ganador:</strong> {$row['ganador']}</p>
                            <a href='infoBatalla.php?id={$row['id']}&NBatalla={$i}' class='btn btn-primary'>Info</a>

                        </div>
                    </div>
                </div>
            </div>";
            $i++;
    }
    
    return $output;
}
    
    



$conn = $connection->getConn();

$jugadorCorreo = $_COOKIE["correo"];

$sql3 = "SELECT nombre FROM Personaje WHERE correoCuenta = '$jugadorCorreo'";
$resultado = $conn->query($sql3);

$batallas = [];
if ($resultado && $resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $nombrePersonaje = $row['nombre'];
    $batallas = drawlist($conn, $nombrePersonaje);
} 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Batalla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <link href="img/logo.jpeg" rel="icon" type="image/x-icon">
    <link href="img/logo.jpeg" rel="apple-touch-icon" sizes="180x180">
    <link href="img/logo.jpeg" rel="icon" type="image/png">
    <meta name="theme-color" content="#343a40">

    <link rel="stylesheet" href="css/registrobatalla.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php">
            <img src="img/logo.jpeg" alt="Avatar Logo" class="d-inline-block align-top" style="height: 40px;">
        </a>
        <a style="text-align: center; width: 100%;"><h1>PoketGame</h1></a>
    </div>
</nav>

<br>
<div class="container">
    <h1 id="titulo" class="text-center">Historial de Batallas</h1>
    <br>
    <div class="row">
        <?php echo drawlist($conn, $nombrePersonaje); ?>
    </div>
</div>

</body>
</html>