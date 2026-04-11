<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Nuevo Poder</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/createPower.css">
</head>
<body id="main_body">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">      
            <a class="navbar-brand" href="home.php">
                <img src="img/logo.jpeg" alt="Avatar Logo" class="d-inline-block align-top" style="height: 40px;">
            </a>
        </div>
    </nav>
    <div id="form_container">
        <h1>Nuevo Poder</h1>
        <form class="appnitro" method="post" action="procesarPoder.php">
            <div class="form-description">
                <p>¡Prepara tu mejor ataque!</p>
            </div>
            <div class="form-group">
                <label for="nombrePoder">Nombre del Poder</label>
                <input name="nombrePoder" class="form-control" type="text" maxlength="255" value="">
            </div>
            <div class="form-group">
                <label for="daño">Daño</label>
                <input name="daño" class="form-control" type="number">
            </div>
            <div class="form-group">
                <label for="coste">Coste</label>
                <input name="coste" class="form-control" type="number">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input name="descripcion" class="form-control" type="text">
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="12028">
                <input class="btn btn-primary" type="submit" name="submit" value="¡A la Batalla!">
            </div>
        </form>
    </div>
</body>
</html>