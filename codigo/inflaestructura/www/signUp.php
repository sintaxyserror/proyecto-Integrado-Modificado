<?php
require_once "autoloader.php";
$security = new Security();
$security->singUp();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="img/logo.jpeg" rel="icon" type="image/x-icon">
    <link href="img/logo.jpeg" rel="apple-touch-icon" sizes="180x180">
    <link href="img/logo.jpeg" rel="icon" type="image/png">
    <meta name="theme-color" content="#343a40">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body id="main_body">
    <div id="form_container" class="container">
        <h1 class="text-center">Sign Up</h1>
        <form class="appnitro" method="post" action="">
            <div class="form-group">
                <label for="userName">User Name</label>
                <input name="userName" class="form-control" type="text" maxlength="255" value="" />
            </div>
            <div class="form-group">
            <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="userPassword">User Password</label>
                <input name="userPassword" class="form-control" type="password" maxlength="255" value="" />
            </div>
            <div class="buttons">
                <input id="saveForm" class="btn btn-primary" type="submit" name="submit" value="Log In" />
            </div>
        </form>
    </div>
</body>

</html>
