<?php
require_once __DIR__ . "/controllers/loginController.php";

$loginContoller = new LoginController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $loginContoller->loginAction();
  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ConectaMente - Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container-fluid vh-100 d-flex">
    <!-- Sección izquierda -->
    <div class="row w-100">
      <div class="col-lg-6 d-none d-lg-flex flex-column align-items-center justify-content-center bg-light">
        <img src="../conectamente/images/logoConectamente.png" alt="ConectaMente Logo" class="mb-3" style="width: 200px;">
        <h2 class="text-muted fst-italic">Cuidando tu bienestar</h2>
        <div>
          <img src="illustration.png" alt="Illustration" class="img-fluid mt-3" style="max-width: 80%;">
        </div>
      </div>

      <!-- Sección derecha -->
      <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center bg-white">
        <h1 class="mb-4 fw-bold">BIENVENIDO</h1>
        <form action="login.php" method="post" class="w-75">
          <div class="mb-3">
            <input type="text" name="user" class="form-control" placeholder="Ingresa tu usuario" required>
          </div>
          <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
          </div>
          <button type="submit" name="ingresar" class="btn btn-warning w-100">Ingresar</button>
        </form>
        <div class="mt-3 text-center">
          <a href="#" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
          <br>
          <a href="view/register.php" class="text-decoration-none">¿No tienes cuenta? <strong>Regístrate aquí</strong></a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
