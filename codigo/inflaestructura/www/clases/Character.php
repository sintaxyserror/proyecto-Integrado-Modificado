<?php
class Character extends Connection
{

    protected $nombre;
    protected $energia;
    protected $correocuenta;
    protected $vida;
    protected $daño;


    public function __construct($nombre)
    {
        parent::__construct();
        $this->nombre = $nombre;
        $query = "SELECT * FROM Personaje WHERE nombre = '$nombre'";
        $result = mysqli_query($this->conn, $query);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row) {
            $this->nombre = $row['nombre'];
            $this->energia = $row['energia'];
            $this->correocuenta = $row['correocuenta'];
            $this->vida = $row['vida'];
            $this->daño = $row['daño'];
        } else {
            echo "No rows found for $nombre";
        }

    }

    public function getnombre()
    {
        return $this->nombre;
    }


    public function getEnergia()
    {
        return $this->energia;
    }

    public function getCorreoCuenta()
    {
        return $this->correocuenta;
    }

    public function getVida()
    {
        return $this->vida;
    }



    public function getDaño()
    {
        return $this->daño;
    }

    /*
        public function importar(){
            $personajes = fopen("personajes.csv", "r") or die("Unable to open file!");
            while (!feof($personajes)) {
                $data = fgetcsv($personajes);
                $query = "INSERT INTO Personaje (nombre, energia, correocuenta, vida, daño)
                 VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]');";
                $result = mysqli_query($this->conn, $query);
                
            }
            fclose($personajes);
        }

        public function borrar(){
            $query = "DELETE FROM Personaje;";
            $result = mysqli_query($this->conn, $query);
        }

        public function init(){
            $this->borrar();
            $query = "SELECT COUNT(*) FROM Personaje;";
            $result = mysqli_query($this->conn, $query)->fetch_row()[0];
            if ($result == 0 ){
                $this->importar();
            }
            echo "la tabla personaje ha sido poblada correctamente";
        }

    */
   
 
    function getAllCharacters(){
        $query = "SELECT nombre FROM Personaje";
        $result = $this->conn->query($query);

        $personajes = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $personajes[] = $row;
            }
        }
        $array=[];
       
         for ($i=0; $i < count($personajes) ; $i++) { 
            $array[$i]= $personajes[$i]['nombre'];
         }
        
        return $array;
        
    }
}
