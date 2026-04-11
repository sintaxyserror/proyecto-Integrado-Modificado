<?php
require_once 'autoloader.php';

$poderes = new Power("Poder1");
$array = $poderes->getAllPowers();

if (isset($_COOKIE['correo'])) {
    $usuario = $_COOKIE['correo'];
} else {
    echo "Error inesperado, vuelve a iniciar sesión";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Personaje</title>
    <link href="img/logo.jpeg" rel="icon" type="image/x-icon">
    <link href="img/logo.jpeg" rel="icon" type="image/png">
    <link href="img/logo.jpeg" rel="apple-touch-icon" sizes="180x180">
    <meta name="theme-color" content="#343a40">
    <link href="css/createPersonaje.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="img/logo.jpeg" alt="Avatar Logo" class="d-inline-block align-top" style="height: 40px;">
            </a>
        </div>
    </nav>
    <form action="procesarCreacion.php" method="POST" onsubmit="return validarFormulario()">
        <h2>Crear Personaje</h2>
        <h3> Puntos disponibles: </h3>
        <h3 id="puntos">10</h3>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

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

        <label for="poder1">Poder1:</label>
        <select id="poder1" name="poder1">
        </select><br><br>

        <label for="poder2">Poder 2:</label>
        <select id="poder2" name="poder2">
        </select><br><br>

        <label for="poder3">Poder 3:</label>
        <select id="poder3" name="poder3">
        </select><br><br>

        <input type="submit" value="Crear Personaje">
    </form>

    <script>
        var poderes = <?php echo json_encode($array); ?>;

        window.onload = function() {
            agregarPoderes();
            bloquearEntradaManual();
        };

        function incrementar(id) {
            var input = document.getElementById(id);
            var valor = parseInt(input.value);
            var puntos = parseInt(document.getElementById("puntos").textContent);

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

        function bloquearEntradaManual() {
            var inputs = document.querySelectorAll('input[type=number]');
            inputs.forEach(input => {
                input.addEventListener('keydown', function(event) {
                    event.preventDefault();
                });
            });
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
            var danio = parseInt(document.getElementById("danio").value);
            var energia = parseInt(document.getElementById("energia").value);
            var vida = parseInt(document.getElementById("vida").value);
            var poder1 = document.getElementById("poder1").value;
            var poder2 = document.getElementById("poder2").value;
            var poder3 = document.getElementById("poder3").value;

            var puntos = danio + energia + vida;

            if (puntos !== 10) {
                alert("La suma de los campos de daño, energía y vida debe ser igual a 10.");
                return false;
            }

            if (poder1 === poder2 || poder1 === poder3 || poder2 === poder3) {
                alert("No puedes seleccionar el mismo poder en diferentes campos.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
