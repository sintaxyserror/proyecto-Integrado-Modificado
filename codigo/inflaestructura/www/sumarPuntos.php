<?php
require_once "autoloader.php";

$poderes = new Power("Poder1");
$array = $poderes->getAllPowers();

$correo = $_GET['jugadorGanador'];
$conexion = new Connection;
$conn = $conexion->getConn();
$sql1 = "SELECT * FROM `Personaje` where `correocuenta` = '$correo'";
$result = mysqli_query($conn, $sql1);
$arrayj1 = $result->fetch_assoc();

$vida= $arrayj1['vida'];
$energia = $arrayj1['energia'];
$daño= $arrayj1['daño'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vida += ($_POST['vida'] * 10);
    $energia += $_POST['energia'] *5;
    $daño += $_POST['danio'] *3;

    $sql2 = "UPDATE `Personaje` SET `energia` = '$energia', `vida` = '$vida', `daño` = '$daño' WHERE `correocuenta` = '$correo'";
    $result = mysqli_query($conn, $sql2);
    header("Location: home.php");
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Character</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="img/logo.jpeg" rel="icon" type="image/x-icon">
    <link href="img/logo.jpeg" rel="icon" type="image/png">
    <link href="img/logo.jpeg" rel="apple-touch-icon" sizes="180x180">
    <meta name="theme-color" content="#343a40">
    <link rel="stylesheet" href="css/modificarP.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="img/logo.jpeg" alt="Avatar Logo" class="d-inline-block align-top" style="height: 40px;">
            </a>
        </div>
    </nav>
    <div class="container form-container">
        <div class="form-box">
            <h1 class="text-center">add points</h1>
            <h3>Puntos disponibles:</h3>
            <h3 id="puntos">3</h3>
            <form action="" method="POST" onsubmit="return validarFormulario()">
                <label for="danio">Daño:</label>
                <input type="number" id="danio" name="danio" value="0" min="0" step="1">
                <button type="button" onclick="incrementar('danio')">+</button>
                <button type="button" onclick="decrementar('danio')">-</button><br><br>

                <label for="energia">Energía:</label>
                <input type="number" id="energia" name="energia" value="0" min="0" step="1">
                <button type="button" onclick="incrementar('energia')">+</button>
                <button type="button" onclick="decrementar('energia')">-</button><br><br>

                <label for="vida">Vida:</label>
                <input type="number" id="vida" name="vida" value="0" min="0" step="1">
                <button type="button" onclick="incrementar('vida')">+</button>
                <button type="button" onclick="decrementar('vida')">-</button><br><br>
                <div id="error-message" class="error-message"></div>
                <button type="submit" class="btn btn-primary btn-block">Update Character</button>
            </form>
        </div>
    </div>
    <script>
   
    function incrementar(id) {
        var input = document.getElementById(id);
        var valor = parseInt(input.value);
        let puntos = parseInt(document.getElementById("puntos").textContent);

        if (puntos > 0) {
            input.value = valor + 1;
            document.getElementById("puntos").textContent = puntos - 1;
        }
    }

    function decrementar(id) {
        var input = document.getElementById(id);
        var valor = parseInt(input.value);
        var puntos = parseInt(document.getElementById("puntos").textContent);

        if (valor > 0) {
            input.value = valor - 1;
            document.getElementById("puntos").textContent = puntos + 1;
        }
    }

    function validarFormulario() {
        var errorMessage = document.getElementById("error-message");
        errorMessage.textContent = "";

        var danio = parseInt(document.getElementById("danio").value);
        var energia = parseInt(document.getElementById("energia").value);
        var vida = parseInt(document.getElementById("vida").value);
        var puntosDisponibles = parseInt(document.getElementById("puntos").textContent);

        if (danio + energia + vida !== 3) {
            errorMessage.textContent = `La suma de los campos de daño, energía y vida debe ser igual a 3.`;
            return false;
        }

        return true;
    }
</script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <a href="home.php" class="fixed-button-left">
</body>
</html>