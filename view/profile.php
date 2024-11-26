<?php

require_once __DIR__ . "/../models/modelConnection.php";
require_once __DIR__ . "/../models/modelEntities.php";
require_once __DIR__ . "/../entities/EntityModel.php";

session_start();
$userId = $_SESSION['user_id'];
$rol = $_SESSION['rol'];
var_dump($userId);

$objModelUser = new ModelEntities('usuarios');
$objModelRol = new ModelEntities('roles');
$getAllRoles = $objModelRol->getForAll();

$update = $_POST['update'] ?? '';
$dataUser = [];

if ($update) {
    $fields = ['nombre', 'contrasena', 'email', 'documento', 'carnet', 'tipo_documento', 'rol_id'];

    foreach ($fields as $field) {
        $dataUser[$field] = $_POST[$field] ?? '';
    }

    $objUser = new Entitie($dataUser);
    header('Location: ../profile.php?id=' . $userId); // Redirecciona al perfil después de editar
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cuenta</title>
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
            border-radius: 10px;
            min-height: 500px;
        }

        .form-control,
        .form-select {
            margin-bottom: 20px;
        }

        body {
            background-color: #f8f9fa;
        }

        .btn-custom {
            width: 50%;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <!-- Left Section: Imagen de la persona -->
            <div class="col-md-6 text-center">
                <!-- Foto de la persona -->
                <img src="<?= $userData['foto'] ?>" alt="Foto de perfil" class="illustration">
                <p class="mt-4 fw-bold"><?= $userData['nombre'] ?></p> <!-- Nombre del usuario -->
            </div>

            <!-- Right Section: Formulario de edición -->
            <div class="col-md-6">
                <div class="custom-card bg-white">
                    <h2 class="text-center mb-4">Editar cuenta</h2>
                    <form method="post" action="edit.php?id=<?= $userId ?>">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="nombre" class="form-control" value="<?= $userData['nombre'] ?>" placeholder="Ingresa tu nombre">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="tipo_documento" class="form-select">
                                    <option <?= ($userData['tipo_documento'] == 1) ? 'selected' : '' ?> value="1">Cédula</option>
                                    <option <?= ($userData['tipo_documento'] == 2) ? 'selected' : '' ?> value="2">Pasaporte</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" name="documento" class="form-control" value="<?= $userData['documento'] ?>" placeholder="Ingresa tu documento">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="email" name="email" class="form-control" value="<?= $userData['email'] ?>" placeholder="Ingresa tu correo">
                            </div>
                            <div class="col">
                                <input type="text" name="carnet" class="form-control" value="<?= $userData['carnet'] ?>" placeholder="Ingresa tu carnet">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <input type="password" name="contrasena" class="form-control" placeholder="Ingresa tu contraseña">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <select name="rol_id" class="form-select">
                                    <option selected>Selecciona un rol</option>
                                    <?php foreach ($getAllRoles as $rol): ?>
                                        <option value="<?= $rol->__get('id') ?>" <?= ($userData['rol_id'] == $rol->__get('id')) ? 'selected' : '' ?>>
                                            <?= $rol->__get('nombre') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="terms" checked>
                            <label class="form-check-label" for="terms">
                                Al seleccionar, significa que está de acuerdo con nuestros
                                <a href="#">Términos de servicio</a>, <a href="#">Política de Privacidad</a> y nuestra <a href="#">Configuración predeterminada</a>.
                            </label>
                        </div>
                        <input type="submit" name="update" value="Actualizar" class="btn btn-primary btn-custom">

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>