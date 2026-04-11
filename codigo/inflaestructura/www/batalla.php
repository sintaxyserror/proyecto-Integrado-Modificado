<?php
session_start();
require_once "autoloader.php";
$jugador1 = $_COOKIE['correo'];
$jugador2 = isset($_SESSION['email']) ? $_SESSION['email'] : null;

if (!$jugador2) {
    die("Error: No se encontró el contrincante. Por favor intente de nuevo.");
}

$conexion = new Connection;
$conn = $conexion->getConn();
$sql1 = "SELECT * FROM `Personaje` where `correocuenta` = '$jugador1'";
$sql2 = "SELECT * FROM `Personaje` where `correocuenta` = '$jugador2'";
$result = mysqli_query($conn, $sql1);
$result1 = mysqli_query($conn, $sql2);
$arrayj1 = $result->fetch_assoc();
$arrayj2 = $result1->fetch_assoc();

if (!$arrayj1 || !$arrayj2) {
    die("Error: Uno de los jugadores no tiene personajes.");
}

$nombrej1 = $arrayj1['nombre'];
$nombrej2 = $arrayj2['nombre'];

$sql3 = "SELECT nombrePoder FROM `PersonajePoder` where `nombrePersonaje` = '$nombrej1'";
$sql4 = "SELECT nombrePoder FROM `PersonajePoder` where `nombrePersonaje` = '$nombrej2'";
$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);

$poderesj1 = array();
$poderesj2 = array();

while ($row = $result3->fetch_assoc()) {
    $poderesj1[] = $row['nombrePoder'];
}
while ($row = $result4->fetch_assoc()) {
    $poderesj2[] = $row['nombrePoder'];
}

if (count($poderesj1) < 3 || count($poderesj2) < 3) {
    die("Error: Uno de los personajes no tiene suficientes poderes.");
}

$nombrePoder1j1 = $poderesj1[0];
$nombrePoder2j1 = $poderesj1[1];
$nombrePoder3j1 = $poderesj1[2];
$nombrePoder1j2 = $poderesj2[0];
$nombrePoder2j2 = $poderesj2[1];
$nombrePoder3j2 = $poderesj2[2];
$vidaj1 = $arrayj1['vida'];
$vidaj2 = $arrayj2['vida'];
$dañoj1 = $arrayj1['daño'];
$dañoj2 = $arrayj2['daño'];
$energiaj1 = $arrayj1['energia'];
$energiaj2 = $arrayj2['energia'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <title>Batalla</title>
    <link href="logo.jpeg" rel="icon" type="image/x-icon">
    <link href="logo.jpeg" rel="apple-touch-icon" sizes="180x180">
    <link href="logo.jpeg" rel="icon" type="image/png">
    <meta name="theme-color" content="#343a40">
    <link rel="stylesheet" href="css/batalla.css">
</head>

<body>
    <div id="nombres">
        <div id="nom1"><?php echo $nombrej1; ?></div>
        <div id="nom2"><?php echo $nombrej2; ?></div>
    </div>
    <div id="container">
        <div id="barraVerde" class="barra"></div>
        <div id="barraBlanca" class="barra"></div>
        <div id="barraAzul" class="barra"></div>
    </div>

    <div id="botones">
        <div>
            <button class="boton"
                onclick="botonClickeado('<?php echo $nombrePoder1j1; ?>', 1)"><?php echo $nombrePoder1j1; ?></button>
            <button class="boton"
                onclick="botonClickeado('<?php echo $nombrePoder2j1; ?>', 1)"><?php echo $nombrePoder2j1; ?></button>
            <button class="boton"
                onclick="botonClickeado('<?php echo $nombrePoder3j1; ?>', 1)"><?php echo $nombrePoder3j1; ?></button>
                <br>
                <br>
            <button class="boton" onclick="botonClickeado('saltarTurno', 1)">Saltar turno</button>
        </div>
        
        <div>
            <button class="boton"
                onclick="botonClickeado('<?php echo $nombrePoder1j2; ?>', 2)"><?php echo $nombrePoder1j2; ?></button>
            <button class="boton"
                onclick="botonClickeado('<?php echo $nombrePoder2j2; ?>', 2)"><?php echo $nombrePoder2j2; ?></button>
            <button class="boton"
                onclick="botonClickeado('<?php echo $nombrePoder3j2; ?>', 2)"><?php echo $nombrePoder3j2; ?></button>
                <br>
                <br>


            <button class="boton" onclick="botonClickeado('saltarTurno', 2)">Saltar turno</button>
        </div>
    </div>

    <div class="turno-container">
        <h3 class="turno-text">Turno: <span id="numTurno">1</span></h3>
    </div>

    <h3 id="error"></h3>
    <div class="vida-container">

        <h3 id="pepe">Vida Jugador 2: <?php echo $vidaj2; ?></h3>
        <h3 id="pepe2">Vida Jugador 1: <?php echo $vidaj1; ?></h3>
    </div>

    <div class="energia-container">
    <h5 id="energiaJ1">Energia Jugador 1: <span id="energia1"><?php echo $energiaj1; ?></span></h5>
    <img id="fp1" src="img/j1.png" alt="Imagen Jugador 1" style="float: left; margin-right: 10px;">
    <h5 id="energiaJ2">Energia Jugador 2: <span id="energia2"><?php echo $energiaj2; ?></span></h5>
    <img id="fp2" src="img/j2.png" alt="Imagen Jugador 2" style="float: right; margin-left: 10px;">
</div>

</body>

</html>


<script>
    let array = [];
    let vidaj1 = <?php echo $vidaj1; ?>;
    let vidaj2 = <?php echo $vidaj2; ?>;
    let dañoj1 = <?php echo $dañoj1; ?>;
    let dañoj2 = <?php echo $dañoj2; ?>;
    let energiaj1 = <?php echo $energiaj1; ?>;
    let energiaj2 = <?php echo $energiaj2; ?>;
    let turno = 1;
    let jugador2Email = "<?php echo $jugador2; ?>";

    function botonClickeado(poder, jugador) {
        if (jugador === 1 && turno % 2 === 1) {
            realizarAccion(poder, 1);
        } else if (jugador === 2 && turno % 2 === 0) {
            realizarAccion(poder, 2);
        } else {
            document.getElementById("error").innerText = "No es tu turno";
        }
    }

    function realizarAccion(poder, jugador) {
        if (jugador === 1){
            moverP1()
        }else{
            moverP2()
        }
        if (poder === "saco") {
            saco(jugador);
        } else if (poder === "transfusion") {
            transfusion(jugador)
        } else if (poder === "curar") {
            curar(jugador);
        } else if (poder === "morder") {
            morder(jugador);
        } else if (poder === "embestida") {
            embestida(jugador);
        } else if (poder === "fumar") {
            fumar(jugador);
        } else if (poder === "saltarTurno") {
            saltarTurno(jugador)
        } else if (poder === "calambre"){
            calambre(jugador);
        }else if(poder === "puñetazo"){
            puñetazo(jugador)
        } else if(poder === "explosion"){
            explosion(jugador)
        }
        document.getElementById("numTurno").innerText = turno;
    }

    function actualizarBarraVida(jugador) {
        let porcentaje;
        if (jugador === 1) {
            porcentaje = ((vidaj1 * 100) / <?php echo $vidaj1; ?>)/2;
            document.getElementById("barraVerde").style.width = porcentaje + "%";
            document.getElementById("pepe2").innerText = "Vida Jugador 1: " + vidaj1;
            
        } else {
            porcentaje = ((vidaj2 * 100) / <?php echo $vidaj2; ?>)/2;
            document.getElementById("barraAzul").style.width = porcentaje + "%";
            document.getElementById("pepe").innerText = "Vida Jugador 2: " + vidaj2;
        }
       
        comprobar()
    }

    function saco(jugador) { //este poder escla con la vida enemiga 
        let dañoPoder = 5;
        let energiaPoder = 25;
        let errorElement = document.getElementById("error");

        if (jugador === 1) {
            if (energiaj1 < energiaPoder) {
                errorElement.innerText = "No tienes suficiente energía";
                return;
            }
            let daño = dañoPoder + (vidaj2 * 0.3) + dañoj1 / 2
            let dañoRedondeado = Math.ceil(daño);
            vidaj2 -= dañoRedondeado;

            if (vidaj2 < 0) {
                vidaj2 = 0;
            }

            energiaj1 -= energiaPoder;
            energiaj1 += 5;
            let arrayTurno = ['saco', 1, dañoRedondeado, energiaPoder];
            array.push(arrayTurno);
            document.getElementById("energia1").innerText = energiaj1;
            actualizarBarraVida(2);
        } else {
            if (energiaj2 < energiaPoder) {
                errorElement.innerText = "No tienes suficiente energía";
                return;
            }
            let daño = dañoPoder + (vidaj1 * 0.3) + dañoj2 / 2
            let dañoRedondeado = Math.ceil(daño);
            vidaj1 -= dañoRedondeado;

            if (vidaj1 < 0) {
                vidaj1 = 0;
            }

            energiaj2 -= energiaPoder;
            energiaj2 += 5;
            document.getElementById("energia2").innerText = energiaj2;
            let arrayTurno = ['saco', 2, dañoRedondeado, energiaPoder];
            array.push(arrayTurno);
            actualizarBarraVida(1);
        }

        errorElement.innerText = "";
        turno++;
    }
    function morder(jugador) { //este poder hace mucho daño que escala con tu daño y tu vida
        let dañoPoder = 25;
        let energiaPoder = 30;
        let errorElement = document.getElementById("error");

        if (jugador === 1) {
            if (energiaj1 < energiaPoder) {
                errorElement.innerText = "No tienes suficiente energía";
                return;
            }
            let daño = (dañoPoder + (dañoj1 / 2) + (vidaj1 / 6));
            let dañoRedondeado = Math.ceil(daño);
            vidaj2 -= dañoRedondeado;

            if (vidaj2 < 0) {
                vidaj2 = 0;
            }
            energiaj1 -= energiaPoder;
            energiaj1 += 5;
            let arrayTurno = ['morder', 1, dañoRedondeado, energiaPoder];
            array.push(arrayTurno);
            document.getElementById("energia1").innerText = energiaj1;
            actualizarBarraVida(2);
        } else {
            if (energiaj2 < energiaPoder) {
                errorElement.innerText = "No tienes suficiente energía";
                return;
            }
            let daño = (dañoPoder + (dañoj1 / 2) + (vidaj2 *0.25));
            let dañoRedondeado = Math.ceil(daño);
            vidaj1 -= dañoRedondeado;

            if (vidaj1 < 0) {
                vidaj1 = 0;
            }

            energiaj2 -= energiaPoder;
            energiaj2 += 5;
            document.getElementById("energia2").innerText = energiaj2;
            let arrayTurno = ['morder', 2, dañoRedondeado, energiaPoder];
            array.push(arrayTurno);
            actualizarBarraVida(1);
        }

        errorElement.innerText = "";
        turno++;
    }
    function curar(jugador) {  //este podcer te cura vida segun tu vida maxima
        let energiaPoder = 30;
        let errorElement = document.getElementById("error");

        if (jugador === 1) {
            if (energiaj1 < energiaPoder) {
                errorElement.innerText = "No tienes suficiente energía";
                return;
            }
            let cura = 15 + (vidaj1 * 0.98);
            let curarRedondeado = Math.ceil(cura);
            vidaj1 += curarRedondeado;
            if (vidaj1 > <?php echo $vidaj1; ?>){
                vidaj1 = <?php echo $vidaj1; ?>
            }
            energiaj1 -= energiaPoder;
            energiaj1 += 5;
            let arrayTurno = ['curar', 1, 0, energiaPoder];
            array.push(arrayTurno);
            document.getElementById("energia1").innerText = energiaj1;
            actualizarBarraVida(1);
        } else {
            if (energiaj2 < energiaPoder) {
                errorElement.innerText = "No tienes suficiente energía";
                return;
            }
            let cura = 15 + (vidaj2 * 0.98);
            let curarRedondeado = Math.ceil(cura);
            vidaj2 += curarRedondeado;
            if (vidaj2 > <?php echo $vidaj2; ?>){
                vidaj2 = <?php echo $vidaj2; ?>
            }
            energiaj2 -= energiaPoder;
            energiaj2 += 5;
            let arrayTurno = ['curar', 2, 0, energiaPoder];
            array.push(arrayTurno);
            document.getElementById("energia2").innerText = energiaj2;
            actualizarBarraVida(2);
        }

        errorElement.innerText = "";
        turno++;
    }
    function fumar(jugador) {
        let energiaPoder = 5;
        let dañoPoder = 10;
        let errorElement = document.getElementById("error");

        if (jugador === 1) {
            if (energiaj1 < energiaPoder) {
                errorElement.innerText = "No tienes suficiente energía";
                return;
            }
            let sumaEnergia = (<?php echo $energiaj1; ?> * 0.25) + 5;
            let vidaPerdida = <?php echo $vidaj1; ?> * 0.25; 
            energiaj1 += sumaEnergia;
            vidaj1 -= vidaPerdida;
            vidaj2 -= dañoPoder;
            energiaj1 -= energiaPoder;
            energiaj1 += 5;

            let arrayTurno = ['fumar', 1, dañoPoder, energiaPoder];
            array.push(arrayTurno);

            document.getElementById("energia1").innerText = energiaj1;
            actualizarBarraVida(1);
            actualizarBarraVida(2);
        } else {
            if (energiaj2 < energiaPoder) {
                errorElement.innerText = "No tienes suficiente energía";
                return;
            }
            let sumaEnergia = (<?php echo $energiaj2; ?> * 0.25) + 5;
            let vidaPerdida = <?php echo $vidaj2; ?> * 0.25; 
            energiaj2 += sumaEnergia;
            vidaj2 -= vidaPerdida;
            vidaj1 -= dañoPoder;
            energiaj2 -= energiaPoder;
            energiaj2 += 5;

            let arrayTurno = ['fumar', 2, dañoPoder, energiaPoder];
            array.push(arrayTurno);

            document.getElementById("energia2").innerText = energiaj2;
            actualizarBarraVida(2);
            actualizarBarraVida(1);
        }

        errorElement.innerText = "";
        turno++;
    }


    function saltarTurno(jugador) {
        if (jugador === 1) {
            energiaj1 += 10;
            document.getElementById("energia1").innerText = energiaj1;
        } else {
            energiaj2 += 10;
            document.getElementById("energia2").innerText = energiaj2;
        }

        turno++;
        let arrayTurno = ['saltarTurno', jugador, 0, 0];
        array.push(arrayTurno);
        document.getElementById("numTurno").innerText = turno;
    }
    function comprobar() {
        let botonesDiv = document.getElementById("botones");

        if (vidaj1 <= 0) {
            botonesDiv.innerHTML = "";
            let nuevoBoton = document.createElement("button");
            nuevoBoton.innerText = "¡Jugador 2 Gana!";
            nuevoBoton.className = "boton";
            nuevoBoton.onclick = function () {
                let arrayJSON = encodeURIComponent(JSON.stringify(array));
                window.location.href = "registrarBatalla.php?ganador=Jugador2&array=" + arrayJSON + "&jugador2=" + encodeURIComponent(jugador2Email);
            };
            botonesDiv.appendChild(nuevoBoton);
        }

        if (vidaj2 <= 0) {
            botonesDiv.innerHTML = "";
            let nuevoBoton = document.createElement("button");
            nuevoBoton.innerText = "¡Jugador 1 Gana!";
            nuevoBoton.className = "boton";
            nuevoBoton.onclick = function () {
                let arrayJSON = encodeURIComponent(JSON.stringify(array));
                window.location.href = "registrarBatalla.php?ganador=Jugador1&array=" + arrayJSON + "&jugador2=" + encodeURIComponent(jugador2Email);
            };
            botonesDiv.appendChild(nuevoBoton);
        }
    }
    
    function calambre(jugador) {
    let energiaPoder = 45;
    let dañoPoder = 20;
    let errorElement = document.getElementById("error");

    if (jugador === 1) {
        if (energiaj1 < energiaPoder) {
            errorElement.innerText = "No tienes suficiente energía";
            return;
        }
        let daño = energiaj1 * 0.58 + dañoPoder;
        let dañoRedondeado = Math.ceil(daño);
        vidaj2 -= dañoRedondeado;
        energiaj1 -= energiaPoder;
        let arrayTurno = ['calambre', 1, dañoRedondeado, energiaPoder];
        array.push(arrayTurno);

        document.getElementById("energia1").innerText = energiaj1;
        actualizarBarraVida(2);
    } else {
        if (energiaj2 < energiaPoder) {
            errorElement.innerText = "No tienes suficiente energía";
            return;
        }
        let daño = energiaj2 * 0.58 + dañoPoder;
        let dañoRedondeado = Math.ceil(daño);
        vidaj1 -= dañoRedondeado;
        energiaj2 -= energiaPoder;
        let arrayTurno = ['calambre', 2, dañoRedondeado, energiaPoder];
        array.push(arrayTurno);
        
        document.getElementById("energia2").innerText = energiaj2;
        actualizarBarraVida(1);
    }

    errorElement.innerText = "";
    turno++;
}

function puñetazo(jugador) {
    let energiaPoder = 15;
    let dañoPoder = 5;
    let errorElement = document.getElementById("error");

    if (jugador === 1) {
        if (energiaj1 < energiaPoder) {
            errorElement.innerText = "No tienes suficiente energía";
            return;
        }
        let daño = (dañoj1 * 0.25) + (energiaj2 * 0.73) + dañoPoder;
        let dañoRedondeado = Math.ceil(daño);

        vidaj2 -= dañoRedondeado;
        energiaj1 -= energiaPoder;
        energiaj1 += 5;

        let arrayTurno = ['puñetazo', 1, dañoRedondeado, energiaPoder];
        array.push(arrayTurno);

        document.getElementById("energia1").innerText = energiaj1;
        actualizarBarraVida(2);
    } else {
        if (energiaj2 < energiaPoder) {
            errorElement.innerText = "No tienes suficiente energía";
            return;
        }
        let daño = (dañoj2 * 0.25) + (energiaj1 * 0.73) + dañoPoder;
        let dañoRedondeado = Math.ceil(daño);

        vidaj1 -= dañoRedondeado;
        energiaj2 -= energiaPoder;
        energiaj2 += 5;

        let arrayTurno = ['puñetazo', 2, dañoRedondeado, energiaPoder];
        array.push(arrayTurno);

        document.getElementById("energia2").innerText = energiaj2;
        actualizarBarraVida(1);
    }

    errorElement.innerText = "";
    turno++;
}



function transfusion(jugador) { 
    let energiaPoder = 25;
    let dañoPoder = 15;
    let errorElement = document.getElementById("error");

    if (jugador === 1) {
        if (energiaj1 < energiaPoder) {
            errorElement.innerText = "No tienes suficiente energía";
            return;
        }
        let daño = (dañoj1 * 1.25 + dañoPoder) * 0.80;
        let vidaRobada = daño * 0.90;
        let roboRedondeado = Math.ceil(vidaRobada);
        let dañoRedondeado = Math.ceil(daño);

        energiaj1 -= energiaPoder;
        vidaj1 += roboRedondeado;
        vidaj2 -= dañoRedondeado;
        energiaj1 += 5;

        let arrayTurno = ['transfusion', 1, dañoRedondeado, energiaPoder];
        array.push(arrayTurno);

        document.getElementById("energia1").innerText = energiaj1;
        actualizarBarraVida(1);
        actualizarBarraVida(2);
    } else {
        if (energiaj2 < energiaPoder) {
            errorElement.innerText = "No tienes suficiente energía";
            return;
        }
        let daño = (dañoj2 * 1.25 + dañoPoder) * 0.80;
        let vidaRobada = daño * 0.90;
        let roboRedondeado = Math.ceil(vidaRobada);
        let dañoRedondeado = Math.ceil(daño);

        energiaj2 -= energiaPoder;
        vidaj2 += roboRedondeado;
        vidaj1 -= dañoRedondeado;
        energiaj2 += 5;

        let arrayTurno = ['transfusion', 2, dañoRedondeado, energiaPoder];
        array.push(arrayTurno);

        document.getElementById("energia2").innerText = energiaj2;
        actualizarBarraVida(2);
        actualizarBarraVida(1);
    }

    errorElement.innerText = "";
    turno++;
}

function embestida(jugador) { 
    let energiaPoder = 15;
    let dañoPoder = 15;
    let errorElement = document.getElementById("error");

    if (jugador === 1) {
        if (energiaj1 < energiaPoder) {
            errorElement.innerText = "No tienes suficiente energía";
            return;
        }
        let daño = vidaj1 * 0.5;
        let dañoRedondeado = Math.ceil(daño);

        vidaj2 -= dañoRedondeado;
        energiaj1 -= energiaPoder;
        energiaj1 += 5;

        let arrayTurno = ['embestida', 1, dañoRedondeado, energiaPoder];
        array.push(arrayTurno);

        document.getElementById("energia1").innerText = energiaj1;
        actualizarBarraVida(2);
    } else {
        if (energiaj2 < energiaPoder) {
            errorElement.innerText = "No tienes suficiente energía";
            return;
        }
        let daño = vidaj2 * 0.5;
        let dañoRedondeado = Math.ceil(daño);

        vidaj1 -= dañoRedondeado;
        energiaj2 -= energiaPoder;
        energiaj2 += 5;

        let arrayTurno = ['embestida', 2, dañoRedondeado, energiaPoder];
        array.push(arrayTurno);

        document.getElementById("energia2").innerText = energiaj2;
        actualizarBarraVida(1);
    }

    errorElement.innerText = "";
    turno++;
}
function explosion(jugador) { 
    let energiaPoder = 115;
    let dañoPoder = 45;
    let errorElement = document.getElementById("error");

    if (jugador === 1) {
        if (energiaj1 < energiaPoder) {
            errorElement.innerText = "No tienes suficiente energía";
            return;
        }
        let daño = dañoPoder + dañoj1 + ((<?php echo $vidaj1;?> *0.40) + vidaj2*0.35);
        let dañoRedondeado = Math.ceil(daño);

        vidaj2 -= dañoRedondeado;
        energiaj1 -= energiaPoder;
        energiaj1 += 5;

        let arrayTurno = ['explosion', 1, dañoRedondeado, energiaPoder];
        array.push(arrayTurno);

        document.getElementById("energia1").innerText = energiaj1;
        actualizarBarraVida(2);
    } else {
        if (energiaj2 < energiaPoder) {
            errorElement.innerText = "No tienes suficiente energía";
            return;
        }
        let daño = dañoPoder + dañoj1 + ((<?php echo $vidaj2;?>) * 0.40 ) + vidaj1 *0.35;
        let dañoRedondeado = Math.ceil(daño);

        vidaj1 -= dañoRedondeado;
        energiaj2 -= energiaPoder;
        energiaj2 += 5;

        let arrayTurno = ['explosion', 2, dañoRedondeado, energiaPoder];
        array.push(arrayTurno);

        document.getElementById("energia2").innerText = energiaj2;
        actualizarBarraVida(1);
    }

    errorElement.innerText = "";
    turno++;
}
function moverP1() {
    let foto = document.getElementById("fp1");

    foto.style.transition = "transform 1s ease-in-out"; 
    foto.style.transform = "translateX(100px)"; 
    setTimeout(function() {
        foto.style.transition = "transform 1s ease-in-out";
        foto.style.transform = "translateX(0)"; 
    }, 1000);
}
function moverP2() {
    let foto = document.getElementById("fp2");

    foto.style.transition = "transform 1s ease-in-out"; 
    foto.style.transform = "translateX(-100px)"; 
    setTimeout(function() {
        foto.style.transition = "transform 1s ease-in-out";
        foto.style.transform = "translateX(0)"; 
    }, 1000);
}
</script>