<?php
require_once 'autoloader.php';
$correo = $usuario = $_COOKIE['correo'];
$correo = $_COOKIE['correo'];
$conexion = new Connection;
$conn = $conexion->getConn();
$sql = "SELECT `nombre` FROM `Personaje` where `correocuenta` = '$correo'";
$result = mysqli_query($conn, $sql);
$lineas= mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <title>Home</title>
    <link href="img/logo.jpeg" rel="icon" type="image/x-icon">
    <link href="img/logo.jpeg" rel="apple-touch-icon" sizes="180x180">
    <link href="img/logo.jpeg" rel="icon" type="image/png">
    <meta name="theme-color" content="#343a40">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="img/logo.jpeg" alt="Avatar Logo" style="width:40px;" class="rounded-pill" > 
            </a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ajustes
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li class="dropdown-item-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg> <?php echo $correo; ?></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.php">Cerrar Sesión</a></li>
                        <li><a class="dropdown-item" href="confirmacion.php">Eliminar Cuenta</a></li>
                        <li><a class="dropdown-item" href="registroBatalla.php">Registro Batalla</a></li>
                        <li><a class="dropdown-item" href="derechos.html">Derechos imagenes</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto.html">Contacto</a>
                   
                </li>
            </ul>
        </div>
    </nav>
    <header>
        <h1>PoketGame</h1>
    </header>
    <footer>
        <div class="container-full-height">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <a href="modificarPersonaje.php" class="btn btn-primary">MODIFICAR PERSONAJE</a>
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="init.php" class="btn btn-secundary" style="background-image: url('/img/cofre.png'); background-size: contain; background-repeat: no-repeat; background-position: right; height: 100px; width: 100px;"></a>
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="contrincante.php" class="btn btn-success">BUSCAR CONTRINCANTE</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let correo = <?php echo json_encode($correo); ?>;
            let lineas = <?php echo json_encode($lineas); ?>;
            if (correo === 'admin@gmail.com') {
                let dropdownMenu = document.querySelector('.dropdown-menu');
                let createPowerItem = document.createElement('li');
                createPowerItem.innerHTML = '<a class="dropdown-item" href="createPower.php">Crear Poderes</a>';
                dropdownMenu.appendChild(createPowerItem);
                let editPowerItem = document.createElement('li');
                editPowerItem.innerHTML = '<a class="dropdown-item" href="editPower.php">Editar poder</a>';
                dropdownMenu.appendChild(editPowerItem);

            }
            if (lineas === 0) {
          
            let botonBuscarContrincante = document.querySelector('.btn-success');
            botonBuscarContrincante.innerText = 'CREAR PERSONAJE';
            botonBuscarContrincante.setAttribute('href', 'createPersonaje.php');

        
            let botonModificarPersonaje = document.querySelector('.btn-primary');
            botonModificarPersonaje.innerText = 'CREAR PERSONAJE';
            botonModificarPersonaje.setAttribute('href', 'createPersonaje.php');
        }
        });
    </script>
</body>
</html>
