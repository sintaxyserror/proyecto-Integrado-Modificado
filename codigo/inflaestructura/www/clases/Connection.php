<?php

class Connection
{
    private $host;
    private $userName;
    private $password;
    private $db;    
    protected $conn;
    protected $configFile = "conf.csv";

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function connect()
    {
        // Intentar leer de variables de entorno (para producción en Railway)
        if (getenv('DB_HOST')) {
            $this->host = getenv('DB_HOST');
            $this->userName = getenv('DB_USER') ?: 'root';
            $this->password = getenv('DB_PASSWORD') ?: 'test';
            $this->db = getenv('DB_NAME') ?: 'Proyecto';
        } else {
            // Fallback: leer de conf.csv (para desarrollo local)
            $configFile = fopen($this->configFile, "r") or die("Unable to open file!");
            if (!feof($configFile)) {
                $connData = fgetcsv($configFile);
                $this->host = $connData[0];
                $this->userName = $connData[1];
                $this->password = $connData[2];
                $this->db = $connData[3];
            }
            fclose($configFile);
        }
        
        $this->conn = new mysqli($this->host, $this->userName, $this->password, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

}
?>