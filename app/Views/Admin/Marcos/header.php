<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNICEQ</title>

  <link rel="stylesheet" href="<?php echo base_url("public/Admin/css/estilo.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/Admin/css/propios.css") ?>">

  <link rel="stylesheet" href="<?php echo base_url("public/Admin/css/no_more_tables.css") ?>">

  <link rel="stylesheet" href="<?php echo base_url("public/Admin/css/cardUsuarios.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/Admin/css/cargando.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/Admin/vendors/ti-icons/css/themify-icons.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/Admin/vendors/base/vendor.bundle.base.css") ?>">

  <link rel="shortcut icon" href="<?php echo base_url("public/Admin/images/logoSVG.svg") ?>" />
  <script type="text/javascript" src="<?php echo base_url("public/Admin/js/jquery351.min.js") ?>"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url("public/Admin/js/jquery.html-svg-connect.js") ?>"></script>

  <link rel="stylesheet" href="<?php echo base_url("public/Admin/css/dataTable.min.css") ?>">

  <script src="<?php echo base_url("public/Admin/js/sweetalter2.js") ?>"></script>


</head>

<body id="bodyIndex">
  <div class="panelLoading">
    <div class="loading">
      <div class="loading__letter">C</div>
      <div class="loading__letter">a</div>
      <div class="loading__letter">r</div>
      <div class="loading__letter">g</div>
      <div class="loading__letter">a</div>
      <div class="loading__letter">n</div>
      <div class="loading__letter">d</div>
      <div class="loading__letter">o</div>
      <div class="loading__letter">.</div>
      <div class="loading__letter">.</div>
      <div class="loading__letter">.</div>
    </div>
  </div>


  <script type="text/javascript">
    $(window).on('load', function() {
      $(".panelLoading").fadeOut(1000);
    });
  </script>


  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="border-bottom: 7px solid #96232e;">
      <div class=" navbar-brand-wrapper d-flex align-items-center " style="width:30%">
        <a class="navbar-brand brand-logo mr-5"><img src=" <?php echo base_url("public/Admin/images/logo_ch.png") ?>" style="width:90%;height:100px;" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini"><img src="<?php echo base_url("public/Admin/images/logo_ch.png") ?>" alt="logo" style="width:100%; height:80px;" /></a>

      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="width:70%;">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <h2>Bienvenid@ <?php echo session()->get('nombre'); ?></h2>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown mr-1">
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">

            </div>
          </li>

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?php echo base_url("public/Admin/images/imgUsuarios/" . session()->get('imagen') . "") ?>" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <!--<a class="dropdown-item">
              <i class="ti-settings text-primary"></i>
              Mi cuenta
            </a>-->
              <a class="dropdown-item" href="<?php echo base_url("salir") ?>">
                <i class="ti-power-off text-primary"></i>
                Salir
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">



          <?php if ($listas_submenu) { ?>
            <?php foreach ($listas_submenu as $key => $value) {
              if ($value["tipo"] == 1) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url("" . $value["url_submenu_web"] . ""); ?>">
                    <i class="<?php echo $value["icono_submenu_web"]; ?>"></i>
                    <span class="menu-title"><?php echo $value["nombre_submenu_web"];  ?></span>
                  </a>
                </li>
            <?php } }?>
          <?php } ?>
        </ul>
      </nav>
