<?php
require_once "autoloader.php";

$poderes = new Power("Poder1");
$array = $poderes->getAllPowers();

if (isset($_COOKIE['correo'])) {
    $usuario = $_COOKIE['correo'];
    
} else {
    echo "Error inesperado, vuelve a iniciar sesión";
    exit();
}

$conexion = new Connection;
$conn = $conexion->getConn();
$sql1 = "SELECT * FROM `Personaje` where `correocuenta` = '$usuario'";
$result = mysqli_query($conn, $sql1);
$arrayj1 = $result->fetch_assoc();

$vida= $arrayj1['vida'];
$energia = $arrayj1['energia'];
$daño= $arrayj1['daño'];
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
            <h1 class="text-center">Update Character</h1>
            <h3>Puntos disponibles:</h3>
            <h3 id="puntos"></h3>
            <form action="modificarcreacion.php" method="POST" onsubmit="return validarFormulario()">
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

                <div class="form-group">
                    <label for="poder1">Poder1:</label>
                    <select id="poder1" name="poder1" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="poder2">Poder 2:</label>
                    <select id="poder2" name="poder2" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="poder3">Poder 3:</label>
                    <select id="poder3" name="poder3" class="form-control"></select>
                </div>
                <div id="error-message" class="error-message"></div>
                <button type="submit" class="btn btn-primary btn-block">Update Character</button>
            </form>
        </div>
    </div>
    <script>
    var poderes = <?php echo json_encode($array); ?>;
    var dañoP = <?php echo $daño;?>;
    var vidaP = <?php echo $vida;?>;
    var energiaP = <?php echo $energia;?>;
    var puntosI;

    window.onload = function() {
        dañoP -= 10;
        vidaP -= 100;
        energiaP -= 50;

        let dañoE = dañoP / 3;
        let vidaE = vidaP / 10;
        let energiaE = energiaP / 5;

        puntosI = Math.round(dañoE + vidaE + energiaE);
        document.getElementById("puntos").textContent = puntosI;

        agregarPoderes();
    }

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

    function agregarPoderes() {
        for (var i = 0; i < poderes.length; i++) {
            var option = document.createElement("option");
            option.text = poderes[i];
            option.value = poderes[i];

            document.getElementById("poder1").add(option.cloneNode(true));
            document.getElementById("poder2").add(option.cloneNode(true));
            document.getElementById("poder3").add(option.cloneNode(true));
        }
    }

    function validarFormulario() {
        var errorMessage = document.getElementById("error-message");
        errorMessage.textContent = "";

        var danio = parseInt(document.getElementById("danio").value);
        var energia = parseInt(document.getElementById("energia").value);
        var vida = parseInt(document.getElementById("vida").value);
        var puntosDisponibles = parseInt(document.getElementById("puntos").textContent);

        if (danio + energia + vida !== puntosI) {
            errorMessage.textContent = `La suma de los campos de daño, energía y vida debe ser igual a ${puntosI}.`;
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