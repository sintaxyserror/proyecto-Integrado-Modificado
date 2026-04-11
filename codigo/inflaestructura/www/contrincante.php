<?php
require_once "autoloader.php"; 
session_start();

$jugador1 = $_COOKIE['correo'];
$jugador2 = isset($_SESSION['email']) ? $_SESSION['email'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $emailJugador2 = $_POST['email']; 
    $passwordJugador2 = $_POST['userPassword']; 

    if (empty($emailJugador2) || empty($passwordJugador2)) { 
        echo "El correo electrónico o la contraseña no fueron proporcionados."; 
    } else {
        $conexion = new Connection(); 
        $conn = $conexion->getConn(); 

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error); 
        }

        $stmt = $conn->prepare("SELECT * FROM Cuenta WHERE correo = ?");
        $stmt->bind_param('s', $emailJugador2); 

        $stmt->execute(); 
        $result = $stmt->get_result(); 

        if ($result->num_rows > 0) { 
            $user2 = $result->fetch_assoc();

            if ($jugador1 == $emailJugador2) {
                echo "No es válido poner las mismas credenciales"; 
            } else {
                if (password_verify($passwordJugador2, $user2['contraseña'])) { 
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['email'] = $user2['correo']; 

                    header("Location: batalla.php"); 
                    exit(); 
                } else {
                    echo "Correo electrónico o contraseña incorrectos."; 
                }
            }
        } else {
            echo "Correo electrónico o contraseña incorrectos."; 
        }
    }
}
?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Contrincante</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="img/logo.jpeg" rel="icon" type="image/x-icon">
    <link href="img/logo.jpeg" rel="apple-touch-icon" sizes="180x180">
    <link href="img/logo.jpeg" rel="icon" type="image/png">
    <meta name="theme-color" content="#343a40">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/contrincante.css">
</head>
<body>
    <div id="form_container">
        <h2 class="form_description">Contrincante</h2>
        <form action="contrincante.php" method="post">
            <div class="form-group">
                <label for="email">Correo:</label>
                <input name="email" type="text" class="form-control" maxlength="255" value="">
            </div>
            <div class="form-group">
                <label for="userPassword">Contraseña:</label>
                <input name="userPassword" type="password" class="form-control" maxlength="255" value="">
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Iniciar Batalla</button>
            
        </form>
    </div>
</body>

    </a>

</html>