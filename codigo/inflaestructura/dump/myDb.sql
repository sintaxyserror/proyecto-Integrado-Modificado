/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET COLLATION_CONNECTION='utf8mb4_unicode_ci' */;

CREATE DATABASE IF NOT EXISTS Proyecto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE Proyecto;

CREATE TABLE Cuenta(
correo varchar(100) primary key,
contraseña varchar(100) not null,
nombre varchar(45) not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Poder(
nombrePoder varchar(40) not null primary key,
daño int,
coste int,
descripcion varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Personaje(
nombre varchar(45) primary key,
energia int,
correocuenta varchar(100),
vida int,
daño int,
foreign key (correocuenta) references Cuenta(correo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PersonajePoder(
nombrePersonaje varchar(45),
nombrePoder varchar(40),
primary key (nombrePersonaje, nombrePoder),
foreign key (nombrePersonaje) references Personaje(nombre),
foreign key (nombrePoder) references Poder(nombrePoder)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Batalla(
id int primary key auto_increment,
fecha date,
turnos int,
ganador varchar(30),
perdedor varchar(30),
Nombrepersonaje1 varchar(45),
Nombrepersonaje2 varchar(45),
foreign key (Nombrepersonaje1) references Personaje(nombre),
foreign key (Nombrepersonaje2) references Personaje(nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE BatallaDetalle(
id int,
idBatalla int,
nombrePoder varchar(40),
nombrePersonaje varchar(45),
daño int,
energia int,
primary key (id, idBatalla),
foreign key (idBatalla) references Batalla(id),
foreign key (nombrePoder) references Poder(nombrePoder),
foreign key (nombrePersonaje) references Personaje(nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE BatallaPersonaje(
idbatalla int,
nombrePersonaje varchar(45),
primary key (idbatalla, nombrePersonaje),
foreign key (idbatalla) references Batalla(id),
foreign key (nombrePersonaje) references Personaje(nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar poderes de ejemplo
INSERT INTO Poder (nombrePoder, daño, coste, descripcion) VALUES
('saco', 5, 25, 'Ataque que escala con la vida enemiga'),
('morder', 25, 30, 'Mordida que causa mucho daño'),
('curar', 0, 30, 'Te cura según tu vida máxima'),
('fumar', 10, 5, 'Obtén energía a costa de vida'),
('calambre', 20, 45, 'Ataque que escala con tu energía'),
('puñetazo', 5, 15, 'Golpe rápido y ágil'),
('transfusion', 15, 25, 'Roba vida al enemigo'),
('embestida', 0, 15, 'Ataque poderoso basado en tu vida'),
('explosion', 0, 0, 'Poder especial'),
('saltarTurno', 0, 0, 'Sin acción');

-- Insertar cuentas de ejemplo (contraseña: 'test' para todas)
INSERT INTO Cuenta (correo, contraseña, nombre) VALUES
('jonathan@gmail.com', '$2y$10$7t9NgHfMSXnVLD/H4F8Ot.V5arBt3ldx.MjBzpN.nlzl1DVu9wpCm', 'Jonathan'),
('test@test.com', '$2y$10$7t9NgHfMSXnVLD/H4F8Ot.V5arBt3ldx.MjBzpN.nlzl1DVu9wpCm', 'Test User'),
('player1@game.com', '$2y$10$7t9NgHfMSXnVLD/H4F8Ot.V5arBt3ldx.MjBzpN.nlzl1DVu9wpCm', 'Jugador 1'),
('player2@game.com', '$2y$10$7t9NgHfMSXnVLD/H4F8Ot.V5arBt3ldx.MjBzpN.nlzl1DVu9wpCm', 'Jugador 2');

-- Insertar personajes de ejemplo
INSERT INTO Personaje (nombre, energia, correocuenta, vida, daño) VALUES
('Guerrero', 50, 'jonathan@gmail.com', 100, 25),
('Mago', 80, 'test@test.com', 70, 35),
('Arquero', 60, 'player1@game.com', 85, 28),
('Nigromante', 75, 'player2@game.com', 95, 32);

-- Asignar poderes a personajes
INSERT INTO PersonajePoder (nombrePersonaje, nombrePoder) VALUES
('Guerrero', 'morder'),
('Guerrero', 'embestida'),
('Guerrero', 'saco'),
('Mago', 'puñetazo'),
('Mago', 'curar'),
('Mago', 'transfusion'),
('Arquero', 'calambre'),
('Arquero', 'fumar'),
('Arquero', 'embestida'),
('Nigromante', 'transfusion'),
('Nigromante', 'calambre'),
('Nigromante', 'morder');



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
