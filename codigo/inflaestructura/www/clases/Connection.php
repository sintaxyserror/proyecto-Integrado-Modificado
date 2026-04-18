<?php

class Connection
{
    private $host;
    private $userName;
    private $password;
    private $db;    
    private $port;
    private $dbType; // 'mysql' o 'pgsql'
    protected $conn;
    protected $configFile = "conf.csv";

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        if ($this->conn) {
            $this->conn = null;
        }
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function connect()
    {
        // Prioridad 1: Variables de entorno de Supabase (producción)
        if (getenv('DATABASE_URL')) {
            // Formato: postgresql://user:password@host:port/database
            $dbUrl = parse_url(getenv('DATABASE_URL'));
            $this->host = $dbUrl['host'];
            $this->userName = $dbUrl['user'];
            $this->password = $dbUrl['pass'];
            $this->db = ltrim($dbUrl['path'], '/');
            $this->port = $dbUrl['port'] ?? 5432;
            $this->dbType = 'pgsql';
        }
        // Prioridad 2: Variables individuales de Supabase
        elseif (getenv('DB_HOST') && strpos(getenv('DB_HOST'), 'supabase') !== false) {
            $this->host = getenv('DB_HOST');
            $this->userName = getenv('DB_USER');
            $this->password = getenv('DB_PASSWORD');
            $this->db = getenv('DB_NAME') ?: 'postgres';
            $this->port = getenv('DB_PORT') ?: 5432;
            $this->dbType = 'pgsql';
        }
        // Prioridad 3: Variables de Render (MySQL)
        elseif (getenv('MYSQLHOST')) {
            $this->host = getenv('MYSQLHOST');
            $this->userName = getenv('MYSQLUSER');
            $this->password = getenv('MYSQLPASSWORD');
            $this->db = getenv('MYSQLDATABASE');
            $this->port = 3306;
            $this->dbType = 'mysql';
        }
        // Prioridad 4: Leer de conf.csv (desarrollo local)
        else {
            $configFile = fopen($this->configFile, "r") or die("Unable to open file!");
            if (!feof($configFile)) {
                $connData = fgetcsv($configFile);
                $this->host = $connData[0];
                $this->userName = $connData[1];
                $this->password = $connData[2];
                $this->db = $connData[3];
                $this->dbType = $connData[4] ?? 'pgsql'; // Por defecto PostgreSQL localmente
                $this->port = $connData[5] ?? 5432;
            }
            fclose($configFile);
        }

        // Conectar usando PDO (funciona con MySQL y PostgreSQL)
        try {
            if ($this->dbType === 'pgsql') {
                // Para Supabase y PostgreSQL en general, agregar sslmode=require
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db};sslmode=require";
            } else {
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db}";
            }
            
            $this->conn = new PDO($dsn, $this->userName, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
        }
    }
}
?>