<?php
   if ($_GET) {
    $errores = $_GET['errores'];
}

session_start();
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceder a Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
  <body>
  <?php 
        $usuario_default = $_SESSION['user'] ?? ''; 
        if($usuario_default === 'usuario'){ 
    ?>
    <h1>Bienvenido al videoclub 
      <?php echo $usuario_default?>
    </h1>
    <a href="logout.php">
        <button type="button" class="btn btn-danger">Logout</button>
    </a>


    <?php }else{ ?>

      <h2>No estas autorizado</h2>
      <a href="index.php">
        <button type="button" class="btn btn-danger">Inicia Sesión</button>
      </a>
      <a href="main.php">
        <button type="button" class="btn btn-info">VideoClub</button>
      </a>

    <?php } ?>
  </body>
</html>


