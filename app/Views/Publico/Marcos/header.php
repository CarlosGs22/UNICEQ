<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNICEQ</title>
  <link rel="shortcut icon" href="<?php echo base_url("public/Admin/images/logoSVG.svg") ?>" />

  <link rel="stylesheet" href="<?php echo base_url("public/Publico/css/estilo.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/Publico/css/cubo.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/Publico/css/cargando.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/Publico/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/Publico/css/all.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/Admin/vendors/ti-icons/css/themify-icons.css") ?>">

  <script type="text/javascript" src="<?php echo base_url("public/Publico/js/jquery.min.js") ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="<?php echo base_url("public/Publico/js/bootstrap.min.js") ?>"></script>
  <script src="<?php echo base_url("public/Publico/js/bootstrap.min.js") ?>"></script>
  <script src="<?php echo base_url("public/Publico/js/sweetAlert.js") ?>"></script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

</head>

<body id="bodyIndex">
  <div class="modal-body" id="modalSemaforo" style="
    position: absolute;
    right: 10px;
    top: 20vh;
">
    <div class="row">
      <div class="text-center w-100"><h6 style="margin:11px; color: white;">Porcentaje lineas estratégicas</h6></div>
      <?php
      $colores = array(
        'fondo1.png' => array(
          'de' => "91",
          'hasta'  => "100"
        ),
        'fondo2.png' => array(
          'de' => "71",
          'hasta'  => "90"
        ),
        'fondo3.png' => array(
          'de' => "51",
          'hasta'  => "70"
        ),
        'fondo4.png' => array(
          'de' => "31",
          'hasta'  => "50"
        ),
        'fondo5.png' => array(
          'de' => "11",
          'hasta'  => "30"
        ),
        'fondo6.png' => array(
          'de' => "10",
          'hasta'  => "0"
        )
      );


      foreach ($colores as $color => $detalles) {
        ?>
        <div class="col-12">
          <div class="card text-white mb-3" style=" background-image: url('<?php echo base_url("public/Publico/img/" . $color . "") ?>');  background-repeat:no-repeat; background-size:cover; background-position:center;">
            <div class="card-body" style="padding:0;">
              <div class="row text-center">
                <?php foreach ($detalles as $indice => $valor) { ?>

                  <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <p class="card-text text-uppercase"><?php echo $indice . " " .  $valor . "%" ?></p>
                  </div>

                <?php } ?>
              </div>
            </div>
          </div>
        </div>

      <?php } ?>

    </div>
  </div>

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


  <script>

  $(function () {
    $("#semaforoPanel").popover({
      html: true,
      trigger: "focus",
      content: function() {
        return $('#modalSemaforo').html();
      }

    });


  });

  </script>

  <div class="container" id="tabs">
    <div class="row">
      <div class="col-12">

        <?php

        function fn_promedio($progreso)
        {
          $color = "";
          if ($progreso != null) {
            if ($progreso < 11) {
              $color = "navImgFondo6.png";
            } else if ($progreso > 10 && $progreso < 31) {
              $color = "navImgFondo5.png";
            } else if ($progreso > 30 && $progreso < 51) {
              $color = "navImgFondo4.png";
            } else if ($progreso > 50 && $progreso < 71) {
              $color = "navImgFondo2.png";
            } else if ($progreso > 70 && $progreso < 91) {
              $color = "navImgFondo3.png";
            } else if ($progreso > 90) {
              $color = "navImgFondo1.png";
            }
          } else {
            $color = "navImgFondo6.png";
          }

          return $color;
        }

        $promedioTotal;
        foreach ($lista_promedio as $lista => $value) {
          $promedioTotal += $value->promedio;
        }
        ?>

        <nav class="navbar navbar-expand-lg navbar-dark " id="navIndex" style=" background-image: url('<?php echo base_url("public/Publico/img/" . fn_promedio($promedioTotal) . "") ?>');">
          <div class="container">
            <!-- <a class="navbar-brand " href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#al-center-nav" aria-controls="al-center-nav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="al-center-nav">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle enlace" style="color: white; font-size: 17px;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menús
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if ($listas_submenu) { ?>
                      <?php foreach ($listas_submenu as $key => $value) {
                        if($value["tipo"] == 1){ ?>
                          <a class="dropdown-item" href="<?php echo base_url("" . $value["url_submenu_web"] . ""); ?>"><?php echo $value["nombre_submenu_web"];  ?></a>
                        <?php } } ?>
                      <?php } ?>

                    </div>
                  </li>
                </ul>
                <ul class="navbar-nav ml-auto">

                  <li class="nav-item">
                    <a class="nav-link enlace2" href="<?php echo base_url("salir"); ?>" id="sMenuDropdown" style="font-size: 17px;">Salir</i></a>
                  </li>

                </ul>
              </div>

            </div>
          </nav>
        </div>
      </div>
