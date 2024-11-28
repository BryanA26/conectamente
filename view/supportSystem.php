<?php

require_once __DIR__ . "/../models/modelConnection.php";
require_once __DIR__ . "/../models/modelEntities.php";
require_once __DIR__ . "/../entities/EntityModel.php";

session_start();
$userId = $_SESSION['user_id'];

// Instancia del modelo para red de apoyo
$objModelRedApoyo = new ModelEntities('red_apoyo');

$saveNetwork = $_POST['saveNetwork'] ?? '';
$dataRedApoyo = [];

if ($saveNetwork) {
    
    $fields = ['nombre','relacion','usuario_id'];
    foreach ($fields as $field) {
        $dataRedApoyo[$field] = $_POST[$field] ?? '';
    }

    $objRed = new Entitie($dataRedApoyo);
    $objModelRedApoyo->saveRecord($objRed);

    header('Location: ../index.php');
    exit;
}
// Procesar el envío del formulario

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Red de Apoyo</title>
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
            <div class="col-md-8 offset-md-2">
                <div class="custom-card bg-white">
                    <h2 class="text-center mb-4">Mi Red de Apoyo</h2>
                    <form method="post" action="supportSystem.php">
                        <input type="hidden" name="usuario_id" value="<?= $userId ?>"> 

                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="nombre" class="form-control"
                                    placeholder="Nombre del contacto">
                            </div>
                            <div class="col-md-6">
                                <select name="relacion" class="form-select">
                                    <option selected>Tipo de relación</option>
                                    <option value="Amigo">Amigo</option>
                                    <option value="Familiar">Familiar</option>
                                    <option value="Compañero">Compañero</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>

                        <!-- Botón para agregar más contactos -->
                        <div id="contactContainer"></div>
                        <div class="text-center mb-3">
                            <button type="button" class="btn btn-secondary" id="addContact">Añadir otro contacto</button>
                        </div>

                        <input type="submit" name="saveNetwork" value="Guardar Red de Apoyo"
                            class="btn btn-primary btn-custom">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('addContact').addEventListener('click', function () {
            const container = document.createElement('div');
            container.className = 'row align-items-center mb-3';
            container.innerHTML = `
                <div class="col-md-6">
                    <input type="text" name="red_apoyo[nombre][]" class="form-control" placeholder="Nombre del contacto">
                </div>
                <div class="col-md-6">
                    <select name="red_apoyo[relacion][]" class="form-select">
                        <option selected>Tipo de relación</option>
                        <option value="Amigo">Amigo</option>
                        <option value="Familiar">Familiar</option>
                        <option value="Compañero">Compañero</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            `;
            document.getElementById('contactContainer').appendChild(container);
        });
    </script>
</body>

</html>
