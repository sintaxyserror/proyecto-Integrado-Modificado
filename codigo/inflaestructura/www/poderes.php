<?php
require_once "autoloader.php";
$conexion = new Connection();

function poder($conexion) {
    $fichero = 'poderes.csv'; 
    $gestor = fopen($fichero, "r");

    if ($gestor !== false) {
        while (($element = fgetcsv($gestor)) !== false) {
            $query = "INSERT INTO Poder (nombrePoder, daño, coste) VALUES (?, ?, ?)";
            $statement = $conexion->getConn()->prepare($query);

            if ($statement !== false) {
                $nombrePoder = $element[0];
                $daño = $element[1];
                $coste = $element[2];

                $statement->bind_param("sii", $nombrePoder, $daño, $coste);
                $statement->execute();
            }
        }
        fclose($gestor); 
    } else {
        echo "Failed to open file.";
    }
}

poder($conexion);








?>