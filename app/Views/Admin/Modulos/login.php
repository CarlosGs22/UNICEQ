<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Iniciar sesion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="<?php echo base_url("public/Admin/js/jquery.min.js") ?>"></script>
  <link rel="stylesheet" href="<?php echo base_url("public/Admin/css/login.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/Admin/css/bootstrap.min.css") ?>">

  <script src="<?php echo base_url("public/Admin/js/bootstrap.min.js") ?>"></script>
  <script src="<?php echo base_url("public/Publico/js/sweetAlert.js") ?>"></script>


</head>
<body>

  <?php if (isset($_SESSION['error'])): ?>
    <script>
    Swal.fire({
      icon: "error",
      title: '',
      text: '<?= $_SESSION['error']; ?>'
    });

  </script>
  <?php unset($_SESSION['error']); endif;?>






  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="<?php echo base_url("public/Admin/images/logo_ch.png") ?>" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form id="frmlogin" name="frmlogin" method="post" action="<?php echo base_url("accion_login") ?>" >
        <input type="text" id="txtUsuario" class="fadeIn second" name="txtUsuario" required placeholder="Usuario" autocomplete="off">
        <input type="password" id="txtContra" class="fadeIn third" name="txtContra" required placeholder="Contraseña" autocomplete="off">
        <input type="submit" class="fadeIn fourth" value="Inicia sesión">
      </form>



  </div>
</div>
</body>
</html>
