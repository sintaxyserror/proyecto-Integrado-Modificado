<?php
require_once 'autoloader.php';

session_start();

if (!isset($_COOKIE['correo'])) {
    echo "No estás autenticado.";
    exit;
}

$correo = $_COOKIE['correo'];
$conexion = new Connection;
$conn = $conexion->getConn();
$sql = "SELECT `contraseña` FROM `Cuenta` WHERE `correo` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();
$array = $result->fetch_array();
$contraseña_bd = $array['contraseña'];

$secure = 0;
$error="";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contraseña_usuario = $_POST['contraseña'];

    if (password_verify($contraseña_usuario, $contraseña_bd)) {
            header("Location: eliminarCuenta.php");
            exit; 
        
    } else {
       $error = "Contraseña incorrecta. Inténtalo de nuevo.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="img/logo.jpeg" rel="icon" type="image/x-icon">
    <link href="img/logo.jpeg" rel="apple-touch-icon" sizes="180x180">
    <link href="img/logo.jpeg" rel="icon" type="image/png">
    <meta name="theme-color" content="#343a40">
    <link rel="stylesheet" href="css/confirmacion.css">
</head>
<body>
    <div class="container">
        <h2>Ingresar Contraseña para Confirmar</h2>
        <form action="" method="POST">
            <label for="contraseña">Contraseña:</label>
            <h3 id="error"></h3>
            <input type="password" id="contraseña" name="contraseña" required><br><br>
            <input type="submit" value="Ingresar">
        </form>
    </div>
    <script>    
   let error = <?php echo json_encode($error); ?>;
   let text = document.getElementById('error');
   text.innerHTML = error;
   text.style.color = 'red';
</script>
</body>
</html>
