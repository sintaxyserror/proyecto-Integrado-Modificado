<?php
/*
class Repoblar extends Connection{

    public function importarCuentas(){
        $cuentas = fopen("cuenta.csv", "r") or die("Unable to open file!"); 
        while (($data = fgetcsv($cuentas)) !== false) {
            $contraseñaEncriptada = password_hash($data[1], PASSWORD_DEFAULT);
            $query = "INSERT INTO Cuenta (correo, contraseña, nombre) VALUES ('$data[0]', '$contraseñaEncriptada', '$data[2]')";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                echo "Cuenta importada: $data[0], $data[1], $data[2]<br>";
            } else {
                echo "Error importando cuenta: " . mysqli_error($this->conn) . "<br>";
            }
        }
        fclose($cuentas);
    }

    public function importarPersonajes() {
        $personajes = fopen("Personajes.csv", "r") or die("Unable to open file!"); 
        while (($data = fgetcsv($personajes)) !== false) {
            $query = "INSERT INTO Personaje (nombre, energia, correocuenta, vida, daño) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]')";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                echo "Personaje importado: $data[0], $data[1], $data[2], $data[3], $data[4]<br>";
            } else {
                echo "Error importando personaje: " . mysqli_error($this->conn) . "<br>";
            }
        }
        fclose($personajes);
    }

    public function importarPoderes(){
        $poderes = fopen("Poderes.csv", "r") or die("Unable to open file!"); 
        while (($data = fgetcsv($poderes)) !== false) {
            $query = "INSERT INTO Poder (nombrePoder, daño, coste, descripcion) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]')";
            $result = mysqli_query($this->conn, $query); 
            if ($result) {
                echo "Poder importado: $data[0], $data[1], $data[2], $data[3]<br>";
            } else {
                echo "Error importando poder: " . mysqli_error($this->conn) . "<br>";
            }
        }
        fclose($poderes);
    }

    public function borrar() {
        $query1 = "DELETE FROM Personaje";
        $query2 = "DELETE FROM Poder";
        $query3 = "DELETE FROM Cuenta";

        $result1 = mysqli_query($this->conn, $query1);
        $result2 = mysqli_query($this->conn, $query2);
        $result3 = mysqli_query($this->conn, $query3);

        if ($result1 && $result2 && $result3) {
            echo "Todas las tablas han sido borradas correctamente.<br>";
        } else {
            echo "Error borrando las tablas: " . mysqli_error($this->conn) . "<br>";
        }
    }

    public function importar(){
        $this->importarCuentas();
        $this->importarPersonajes();
        $this->importarPoderes(); 
    }

    public function init() {
        $this->borrar();

        $query1 = "SELECT COUNT(*) FROM Personaje";
        $query2 = "SELECT COUNT(*) FROM Poder";
        $query3 = "SELECT COUNT(*) FROM Cuenta";
        $result1 = mysqli_query($this->conn, $query1)->fetch_row()[0];
        $result2 = mysqli_query($this->conn, $query2)->fetch_row()[0];
        $result3 = mysqli_query($this->conn, $query3)->fetch_row()[0];
        
        echo "Personajes en la tabla: $result1<br>";
        echo "Poderes en la tabla: $result2<br>";
        echo "Cuentas en la tabla: $result3<br>";
        
        if ($result1 == 0 && $result2 == 0 && $result3 == 0) {
            $this->importar();
        }
    }
}
?>
