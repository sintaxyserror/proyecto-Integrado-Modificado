<?php
/*require_once "autoloader.php";

$modelo = new Connection();
$conn = $modelo->getConn();
if(isset($_GET['nombrePoder']) && !empty($_GET['nombrePoder'])) {
  
    $nombre = $conn->real_escape_string($_GET['nombrePoder']);
    $query = "DELETE FROM Poder WHERE nombrePoder = '$nombre'";
    if($conn->query($query)) {
      
        $conn->close();
        header("Location: home.php");
        exit; 
    }
}*/
require_once "autoloader.php";
$power= new Power('alah');
$array =$power->getAllPowers();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Poder</title>
</head>


<body>
   
    <form action="procesarEliminar.php" method="POST">
    <h1>Eliminar Poder</h1>
        <label for="poder1">Poder:</label>
        <select id="poder1" name="poder1">
        </select><br><br>
        <input type="submit" value="Crear Personaje">
    </form>

    <script>
          let array = <?php echo json_encode($array); ?>;
          window.onload = agregarPoderes;
        function agregarPoderes() {
            for (var i = 0; i < array.length; i++) {
                var option = document.createElement("option");
                option.text = array[i];
                option.value = array[i];
                var selectPoder1 = document.getElementById("poder1");

                slectPoder1.add(option.cloneNode(true));
                }
        }
    </script>
</body>
</html>
