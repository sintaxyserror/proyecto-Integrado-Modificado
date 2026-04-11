<?php
require_once "autoloader.php";
$power = new Power("polla");
$array = $power->getAllPowers();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["nombrePoder"])) {
    $power_name = $_GET["nombrePoder"];
    
    $id_power = $poder->findName($power_name);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombrePoder"];
    $daño = $_POST["daño"];
    $coste = $_POST["coste"];
    $descripcion = $_POST["descripcion"];
    
    $power->updatePower($nombre, $daño, $coste, $descripcion);

    header("Location: home.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Poder</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/createPower.css">
</head>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Poder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">      
            <a class="navbar-brand" href="home.php">
                <img src="img/logo.jpeg" alt="Avatar Logo" class="d-inline-block align-top" style="height: 40px;">
            </a>
        </div>
    </nav>

    <div id="form_container" class="container mt-4">
        <h1>Editar Poder</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nombrePoder">Nombre poder:</label>
                <select id="nombrePoder" name="nombrePoder" class="form-control">
                </select>
                <br><br>
            </div>
            <div class="form-group">
                <label for="daño">Daño:</label>
                <input type="number" class="form-control" id="daño" name="daño" required>
            </div>
            <div class="form-group">
                <label for="coste">Coste:</label>
                <input type="number" class="form-control" id="coste" name="coste" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Poder</button>
        </form>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    </div>
    <script>
var poderes = <?php echo json_encode($array); ?>;

window.onload = agregarPoderes;

function agregarPoderes() {
    for (var i = 0; i < poderes.length; i++) {
        var option = document.createElement("option");
        option.text = poderes[i];
        option.value = poderes[i];
        var selectPoder1 = document.getElementById("nombrePoder");
        selectPoder1.add(option.cloneNode(true));
   
    }
}
//hla

</script>
</body>
</html>
