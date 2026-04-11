<?php
require_once "autoloader.php";
$security = new Security();
$loginMessage = $security->doLogin();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="img/logo.jpeg" rel="icon" type="image/x-icon">
    <link href="img/logo.jpeg" rel="apple-touch-icon" sizes="180x180">
    <link href="img/logo.jpeg" rel="icon" type="image/png">
    <meta name="theme-color" content="#343a40">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<link rel="stylesheet" href="css/login.css">
<body>
    <div id="form_container">
        <h2 class="form_description">Iniciar sesión</h2>
        <form action="" method="post">
            <div class="form-group">
            <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="userPassword">Contraseña:</label>
                <input name="userPassword" type="password" class="form-control" maxlength="255" value="">
            </div>
            <h4 id="error" text-color="red"></h4>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
            <button type="button" name="submit" class="btn btn-primary btn-block" onclick="window.location.href='signUp.php'">Registrarse</button>
        </form>
    </div>
</body>
<script>    
   let error = <?php echo json_encode($loginMessage); ?>;
   let text = document.getElementById('error');
   text.innerHTML = error;
   text.style.color = 'red';
</script>

</html>