<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js'></script>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="font-weight-bold mb-0">Inicio</h4>
          </div>
          <!--<div>
          <button type="button" class="btn btn-primary btn-icon-text btn-rounded">
          <i class="ti-clipboard btn-icon-prepend"></i>Report
        </button>
      </div>
    -->
  </div>
</div>
</div>
<div class="row">
  <?php

  use phpDocumentor\Reflection\PseudoTypes\True_;

  if ($listas_datos) {
    $pieces = "";
    foreach ($listas_datos as $key => $value) {
      $pieces .=  $value->conteos . " ";
    }
    $valores = explode(" ", $pieces);

    $areas = $valores[0];
    $usuarios = $valores[1];
    $niveles = $valores[2];
    $informes = $valores[3];
  }


  ?>

  <div class="col-6 col-sm-6 col-md-4 col-lg-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title text-md-center text-xl-left">Áreas</p>
        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
          <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $areas; ?></h3>
          <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
        </div>
        <!--<p class="mb-0 mt-2 text-danger">0.12% <span class="text-black ml-1"><small>(30 days)</small></span></p>-->
      </div>
    </div>
  </div>
  <div class="col-6 col-sm-6 col-md-4 col-lg-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title text-md-center text-xl-left">Usuarios</p>
        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
          <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $usuarios; ?></h3>
          <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
        </div>

      </div>
    </div>
  </div>
  <div class="col-6 col-sm-6 col-md-4 col-lg-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title text-md-center text-xl-left">Niveles</p>
        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
          <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $niveles; ?></h3>

          <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
        </div>
      </div>
    </div>
  </div>



</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card position-relative">
      <div class="card-body">
        <p class="card-title">Detalle reportes</p>
        <div class="row">
          <div class="col-12 col-sm-12 col-md-6 col-lg-6" style="margin-top:10%;">
            <div class="col-md-12 text-center justify-content-center align-self-center">
              <div class="ml">
                <?php
                if ($listas_promedio) {
                  $promedioTotal;
                  foreach ($listas_promedio as $key => $value) {
                    $promedioTotal += $value->promedio;
                  }
                }

                $total = 0;
                if ($listas_conteo) {
                  foreach ($listas_conteo as $key => $value) {
                    $total += $value->conteo;
                  }
                }

                function fn_promedioPanel($progreso)
                {
                  $color = "";
                  if ($progreso != null) {
                    if ($progreso < 11) {
                      $color = "#fc7f3e";
                    } else if ($progreso > 10 && $progreso < 31) {
                      $color = "#f2951e";
                    } else if ($progreso > 30 && $progreso < 51) {
                      $color = "#fcca4f";
                    } else if ($progreso > 50 && $progreso < 71) {
                      $color = "#1d9fba";
                    } else if ($progreso > 70 && $progreso < 91) {
                      $color = "#18e3ec";
                    } else if ($progreso > 90) {
                      $color = "#14c9c1";
                    }
                  } else {
                    $color = "#fc7f3e";
                  }

                  return $color;
                }
                ?>


                <h1><?php echo $total; ?></h1>
                <h3 class="font-weight-light mb-xl-4">Indicadores</h3>
                <p class="text-muted mb-2 mb-xl-0">Número total de indicadores</p>
              </div>
            </div>
            <div class="col-md-12 justify-content-center align-self-center text-center" style="margin-top: 10%;">
              <div class="progressbar" data-animate="false">
                <div class="circle" id="<?php echo fn_promedioPanel($promedioTotal); ?>" data-percent="<?php echo $promedioTotal; ?>">
                  <div></div>
                </div>
              </div>
              <p>Promedio general ponderado de indicadores</p>

            </div>
          </div>

          <div class="col-md-5">
            <div class="table-responsive mb-3 mb-md-0">
              <table class="table table-borderless report-table">
                <?php

                if ($listas_promedio) {
                  foreach ($listas_promedio as $key => $value) { ?>
                    <tr>
                      <td class="text-muted">
                        <?php echo $value->area; ?>
                        <br>
                        <small> Valor: <?php echo $value->valor; ?></small>
                      </td>
                      <td class="w-100 px-0" style="white-space:pre;">
                        <div class="progress progress-md mx-4">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo ($value->metas_cum / $value->metas_por) * 100; ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td>
                        <h5 class="font-weight-bold mb-0"><?php echo $value->promedio; ?></h5>
                      </td>
                    </tr>

                  <?php }
                } ?>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Derechos reservados UNICEQ 2021</span>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->

<style>
/*=====================
CIRCLE PROGRESS BARe
======================*/

.progressbar {
  display: inline-block;
  width: 100%;

}

.circle {
  width: 180px;
  height: 180px;
  margin: 0 auto;
  margin-top: 10px;
  display: inline-block;
  position: relative;
  text-align: center;
}

.circle:after {
  width: 120px;
  height: 100%;
  content: "";

  border-radius: 50%;
  display: block;
  position: absolute;
  top: 30px;
  left: 30px;
}

.circle canvas {
  vertical-align: middle;

  border-radius: 50%;
}

.circle div {
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -20px 0 0 -86px;
  width: 100%;
  text-align: center;
  line-height: 40px;
  font-size: 31px;

}

.circle strong i {
  font-style: normal;
  font-size: 0.6em;
  font-weight: normal;
}

.circle span {
  display: block;
  color: white;
  margin-top: 12px;
}
</style>

<script>
$(document).ready(function($) {
  function animateElements() {
    $('.progressbar').each(function() {
      var elementPos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      var percent = $(this).find('.circle').attr('data-percent');
      var percentage = parseInt(percent, 10) / parseInt(100, 10);
      var animate = $(this).data('animate');
      if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
        $(this).data('animate', true);
        var color = $(this).find('.circle').attr("id");
        $(this).find('.circle').circleProgress({
          startAngle: -Math.PI / 2,
          value: percent / 100,
          size: 180,
          thickness: 30,
          emptyFill: "rgba(0,0,0, .2)",
          fill: {
            color: color
          }
        }).on('circle-animation-progress', function(event, progress, stepValue) {
          $(this).find('div').text((stepValue * 100).toFixed(1) + "%");
        }).stop();
      }
    });
  }

  // Show animated elements
  animateElements();
  $(window).scroll(animateElements);




}); //end document ready function
</script>
