<?php

require_once __DIR__ . "/../models/modelConnection.php";
require_once __DIR__ . "/../models/modelEntities.php";
require_once __DIR__ . "/../entities/EntityModel.php";

session_start();
$userId = $_SESSION['user_id'];
$rol = $_SESSION['rol'];

$objModelUser = new ModelEntities('usuarios');
$objModelRol = new ModelEntities('roles');
$getAllUser = $objModelUser->getForId('id', $userId);
$roleId = $getAllUser->__get('rol_id');
$getAllRoles = $objModelRol->getForId('id', $roleId);



$update = $_POST['update'] ?? '';
$delete = $_POST['delete'] ?? '';
$dataUser = [];

if ($update) {
    $fields = ['nombre', 'contrasena', 'email', 'documento', 'carnet', 'tipo_documento', 'rol_id'];

    foreach ($fields as $field) {
        // Si $_POST tiene un valor, úsalo; de lo contrario, utiliza la propiedad del objeto
        $dataUser[$field] = !empty($_POST[$field]) ? $_POST[$field] : $getAllUser->$field;
    }


    $objUser = new Entitie($dataUser);
    $objModelUser->updateRecord('id', $userId, $objUser);

    header('Location: profile.php');
    exit;
}

if (isset($_POST['id'])) {
    $id = $_POST['id']; 
    $objModelUser->deleteRecord('id', $id); 
    header('Location: ../login.php'); 
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
                <p class="mt-4 fw-bold"><?= $getAllUser->__get('nombre') ?></p> <!-- Nombre del usuario -->
                <form method="post" action="profile.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
                    <input type="hidden" name="id" value="<?= $userId ?>">
                    <button type="submit" name="delete" class="btn btn-danger btn-sm mt-3">Eliminar cuenta</button>
                </form>
            </div>

            <!-- Right Section: Formulario de edición -->
            <div class="col-md-6">
                <div class="custom-card bg-white">
                    <h2 class="text-center mb-4">Editar cuenta</h2>
                    <form method="post" action="profile.php">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="nombre" class="form-control" value="<?= $getAllUser->__get('nombre') ?>" placeholder="Ingresa tu nombre">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="tipo_documento" class="form-select" disabled>
                                    <option value="<?= $getAllUser->__get('tipo_documento') ?>" selected>
                                        <?= $getAllUser->__get('tipo_documento') ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col">
                                <input disabled type="text" name="documento" class="form-control" value="<?= $getAllUser->__get('documento') ?>" placeholder="Ingresa tu documento">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="email" name="email" class="form-control" value="<?= $getAllUser->__get('email') ?>" placeholder="Ingresa tu correo">
                            </div>
                            <div class="col">
                                <input type="text" name="carnet" class="form-control" value="<?= $getAllUser->__get('carnet') ?>" placeholder="Ingresa tu carnet" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <input type="password" name="contrasena" class="form-control" value="<?= $getAllUser->__get('contrasena') ?>" placeholder="Ingresa tu contraseña">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <select name="rol_id" class="form-select" disabled>
                                    <option value="<?= $getAllRoles->__get('id') ?>" selected>
                                        <?= $getAllRoles->__get('nombre') ?>
                                    </option>
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