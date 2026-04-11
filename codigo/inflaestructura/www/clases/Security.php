<?php
class Security extends Connection
{
    private $loginPage = "login.php";
    private $homePage = "home.php";
    private $registerPage = "signUp.php";
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function checkLoggedIn()
    {
        if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
            header("Location: " . $this->loginPage);
        }
    }


    public function singUp()
    {
        if (count($_POST) > 0) {
            $mail = $_POST["email"];
            $password = $_POST["userPassword"];
            $nombre = $_POST["userName"];
            if (empty($mail) || empty($password) || empty($nombre)) {
                die('Todos los campos son obligatorios.');
            }
            $securePassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO Cuenta(correo, contraseña, nombre) VALUES ('$mail','$securePassword','$nombre')";
            $result = $this->conn->query($sql);
            header("Location: login.php ");
        }
        else{
         
        }
    }


    public function doLogin()
    {
        if (count($_POST) > 0) {
            $user = $this->getUser($_POST["email"]);
            $_SESSION["loggedIn"] = $this->checkUser($user, $_POST["userPassword"]) ? $user["correo"] : false;
            if ($_SESSION["loggedIn"]) {
                if (isset($_COOKIE["correo"])) {
                    setcookie("correo", "", time() - 3600, "/");
                }
                $nombreCookie = "correo";
                $valor = $user["correo"];
                $tiempo = time() + 3600;
                $ruta = "/";
                setcookie($nombreCookie, $valor, $tiempo, $ruta);

                header("Location: " . $this->homePage);
            } else {
                return "Incorrect email or Password";
            }
        } else {
            return null;
        }
    }
    private function checkUser($user, $userPassword)
    {
        if ($user) {
            return $this->checkPassword($user["contraseña"], $userPassword);
        } else {
            return false;
        }
    }
    private function getUser($email)
    {
        $sql = "SELECT * FROM Cuenta WHERE correo = '$email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    //e

    private function checkPassword($securePassword, $userPassword)
    {
        return password_verify($userPassword, $securePassword);

    }

}

?>