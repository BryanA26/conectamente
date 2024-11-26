<?php

require_once __DIR__ . "/../models/modelConnection.php";
require_once __DIR__ . "/../models/modelEntities.php";
require_once __DIR__ . "/../entities/EntityModel.php";

$objModelUser = new ModelEntities('usuarios');
$getAllUser = $objModelUser->getForAll();

$objModelRol = new ModelEntities('roles');
$getAllRoles = $objModelRol->getForAll();


$register = $_POST['register'] ?? '';
$dataUser = [];

if ($register) {
    $fields = ['nombre', 'contrasena', 'email', 'documento', 'carnet', 'tipo_documento', 'rol_id'];

    foreach ($fields as $field) {
        $dataUser[$field] = $_POST[$field] ?? '';
    }

    $objUser =  new Entitie($dataUser);
    $objModelUser->saveRecord($objUser);
    header('Location: ../login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .illustration {
            max-width: 100%;
            height: auto;
        }

        .custom-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            /* Espaciado interno más amplio */
            border-radius: 10px;
            min-height: 500px;
            /* Define una altura mínima */
        }

        .form-control,
        .form-select {
            margin-bottom: 20px;
            /* Espaciado entre los campos */
        }

        body {
            background-color: #f8f9fa;
        }

        .btn-custom {
            width: 50%;
            /* Reduce el ancho del botón */
            display: block;
            margin: 0 auto;
            /* Centra el botón */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <!-- Left Section -->
            <div class="col-md-6 text-center">
                <img src="your-image-url.png" alt="Illustration" class="illustration">
                <p class="mt-4 fw-bold">Únete y descubre cómo conectar con el bienestar de tu cuerpo y mente</p>
            </div>

            <!-- Right Section -->
            <div class="col-md-6">
                <div class="custom-card bg-white">
                    <h2 class="text-center mb-4">Crear cuenta</h2>
                    <form method="post" action="register.php">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="nombre" class="form-control" placeholder="Ingresa tu nombre">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="tipo_documento" class="form-select">
                                    <option selected>Tipo de documento</option>
                                    <option value="1">Cédula</option>
                                    <option value="2">Pasaporte</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" name="documento" class="form-control" placeholder="Ingresa tu documento">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="email" name="email" class="form-control" placeholder="Ingresa tu correo">
                            </div>
                            <div class="col">
                                <input type="text" name="carnet" class="form-control" placeholder="Ingresa tu carnet">
                            </div>
                        </div>

                        <!-- Campo de contraseña -->
                        <div class="row">
                            <div class="col">
                                <input type="password" name="contrasena" class="form-control" placeholder="Ingresa tu contraseña">
                            </div>
                        </div>

                        <!-- Selección de rol -->
                        <div class="row">
                            <div class="col">
                                <select name="rol_id" class="form-select">
                                    <option selected>Selecciona un rol</option>
                                    <?php foreach ($getAllRoles as $rol): ?>
                                        <option value="<?= $rol->__get('id') ?>" <?= (isset($dataUser['roles']) && $dataUser['roles'] == $rol->__get('id')) ? 'selected' : '' ?>>
                                            <?= $rol->__get('nombre') ?>
                                        </option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="terms">
                            <label class="form-check-label" for="terms">
                                Al seleccionar, significa que está de acuerdo con nuestros
                                <a href="#">Términos de servicio</a>, <a href="#">Política de Privacidad</a> y nuestra <a href="#">Configuración predeterminada</a>.
                            </label>
                        </div>
                        <input type="submit" name="register" value="Registrar" class="btn btn-primary btn-custom">

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>