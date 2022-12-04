<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Keychron | Eliminar Cliente</title>
  <link rel="shortcut icon" href="../../assets/favicon/favicon-k-key-16.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/styles/general.css">
</head>

<body>
  <!-- CONEXION -->
  <?php
  require("../../config/config.php");
  // REALIZAMOS A CONEXION COA BBDD
  try {
    $conexion = new PDO(
      "mysql:host=$servidor;dbname=$bbdd;charset=utf8mb4",
      $usuario,
      $pass
    );
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (Exception $e) {
    echo "Houbo un erro na conexión:\n\n" . $e->getMessage();
  }
  ?>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="../xestiona.php" style="font-family: 'Zen Dots', cursive;">
        <img src="../../assets/Logo/k-key-100.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        Keychron
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Artigos
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="../artigo/engadir.php">Engadir Artigo</a></li>
              <li><a class="dropdown-item" href="../artigo/eliminar.php">Eliminar Artigo</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="../artigo/aluga.php">Alugar Artigo</a></li>
              <li><a class="dropdown-item" href="../artigo/devolve.php">Devolver Artigo</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Clientes
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="./engadir.php">Engadir Cliente</a></li>
              <li><a class="dropdown-item" href="./eliminar.php">Eliminar Cliente</a></li>
            </ul>
          </li>
        </ul>
        <form action="../xestiona.php" method="post" class="d-flex" role="search">
          <input name="buscar" class="form-control me-2" type="search" placeholder="Buscar artigo" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- TARXETA -->
  <div class="container-sm mt-5">
    <div class="card text-center">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link" aria-current="true" href="./engadir.php" id="pestana_engadir">Introducir
              Cliente</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#" id="pestana_eliminar">Eliminar Cliente</a>
          </li>
        </ul>
      </div>
      <div class="card-body shadow">
        <!-- ELIMINAR CLIENTE -->
        <form action="eliminar.php" method="post" class="text-start" id="form_eliminar">
          <input name="form_eliminar" hidden>
          <label for="clientes">Clientes</label>
          <select name="clientes" class="form-select" id="clientes">
            <option disabled selected>Escolle un cliente para eliminar</option>
            <?php
            $pdo = $conexion->query("SELECT * FROM cliente");
            while ($fila = $pdo->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value=" . $fila["ID_Cliente"] . ">" . $fila["email"] . "</option>";
            }
            ?>
          </select>
          <input type="submit" class="btn btn-danger mt-3" value="Eliminar Cliente">
        </form>
      </div>
    </div>
  </div>
</body>

<!-- MANIPULACION DA BBDD -->
<?php
require("../../funcions/funcions.php");
// SI TODOS OS CAMPOS FORON CUBERTOS ENGADIMOS
if (isset($_POST["form_eliminar"])) {
  eliminar_cliente($conexion, $_POST);
}
?>

</html>