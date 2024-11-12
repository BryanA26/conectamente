<?php

require_once __DIR__ ."/connection/DbConnection.php";

$connection = new ConnectionBd;

$connection->getConexion();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Inmobiliaria</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="navbar-left">
                <a href="#">ARRENDATARIO</a>
                <a href="#">PROPIETARIO</a>
                <a href="#">PAGAR ARRIENDO</a>
            </div>
            <div class="navbar-center">
                <img src="logo.png" alt="Portada Inmobiliaria Logo" class="logo">
            </div>
            <div class="navbar-right">
                <div class="dropdown">
                    <a href="#">NOSOTROS</a>
                </div>
                <div class="dropdown">
                    <a href="#">PROMOCIONAR INMUEBLE</a>
                </div>
                <a href="#" class="exclusive-btn">INMUEBLES EXCLUSIVOS<span class="notification">1</span></a>
                <div class="icon">
                    <img src="user-icon.png" alt="User Icon">
                </div>
            </div>
        </nav>
    </header>
</body>
</html>
