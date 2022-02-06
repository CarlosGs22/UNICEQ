<style>
#modalSemaforo{
  display: none;
}
</style>

<?php

function progreso($progreso)
{
  $color = "";
  if ($progreso != null) {
    if ($progreso <= 11) {
      $color = "fondo6.png";
    } else if ($progreso > 11 && $progreso <= 31) {
      $color = "fondo5.png";
    } else if ($progreso > 31 && $progreso <= 51) {
      $color = "fondo4.png";
    } else if ($progreso > 51 && $progreso <= 71) {
      $color = "fondo2.png";
    } else if ($progreso > 71 && $progreso <= 91) {
      $color = "fondo3.png";
    } else if ($progreso > 91) {
      $color = "fondo1.png";
    }
  } else {
    $color = "fondo6.png";
  }

  return $color;
}


?>



<?php

$planeado_mensual;
$alcanzado_mensual;
$progreso;

$planeado_anual;
$alcanzado_anual;

$planeado_general;
$alcanzado_general;

$colorGeneral;


foreach ($listas_metas as $listas_metas => $valuesm) {



  $planeado_mensual = $valuesm->planeado_mensual;
  $alcanzado_mensual = $valuesm->alcanzado_mensual;

  if ((int) $alcanzado_mensual >= (int) $planeado_mensual) {
    $progreso = 100;
  } else {
    /*if ($alcanzado_mensual > 0 && $planeado_mensual > 0) {
      $progreso = ($alcanzado_mensual / $planeado_mensual) * 100;
    } else {

    }*/
    $progreso = 0;
  }


  $planeado_anual = $valuesm->planeado_anual;
  $alcanzado_anual = $valuesm->alcanzado_anual;


  $planeado_general = $valuesm->planeado_general;
  $alcanzado_general = $valuesm->alcanzado_general;

  $colorGeneral = progreso($progreso);
}

?>


<div class="modal fade" id="modalAlcances" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alcances</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">

          <div class="row">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group text-center">
                <div class="form-group">
                  <label for="exampleInputPassword1">Plan mensual</label>
                  <input type="text" class="form-control" value=" <?php echo $planeado_mensual; ?>" disabled>
                </div>
              </div>
            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group text-center">
                <div class="form-group">
                  <label for="exampleInputPassword1">Alcance mensual</label>
                  <input type="text" class="form-control" value=" <?php echo $alcanzado_mensual ?>" disabled>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group text-center">
                <div class="form-group">
                  <label for="exampleInputPassword1">Plan anual</label>
                  <input type="text" class="form-control" value=" <?php echo $planeado_anual; ?>" disabled>
                </div>
              </div>
            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group text-center">
                <div class="form-group">
                  <label for="exampleInputPassword1">Alcance anual</label>
                  <input type="text" class="form-control" value=" <?php echo $alcanzado_anual; ?>" disabled>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group text-center">
                <div class="form-group">
                  <label for="exampleInputPassword1">Plan general</label>
                  <input type="text" class="form-control" value=" <?php echo $planeado_general; ?>" disabled>
                </div>
              </div>
            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group text-center">
                <div class="form-group">
                  <label for="exampleInputPassword1">Alcance general</label>
                  <input type="text" class="form-control" value=" <?php echo $alcanzado_general; ?>" disabled>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>

<?php foreach ($listas as $lista => $value) {

  $fondos =  array(
    "subFondo1.png",
    "subFondo1.png",
    "subFondo2.png",
    "subFondo3.png",
    "subFondo4.png",
    "subFondo5.png",
    "subFondo6.png"
  );


?>
  <div class="panelGenDetalle" >
    <div class="row">
      <div class="col-6 text-center">
        <img src="<?php echo base_url("public/Publico/img/" . $fondos[$value["idarea"]] . ""); ?>" class="img-fluid" id="imagenSubpanelDetalle">
      </div>

      <div class="col-6 text-center justify-content-center align-self-center">
        <h1 class="codigoDetalle"><?php echo $value["codigo"] ?></h1>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="form-group panelIndicadorDetalle">
          <label class="text-white">Indicador</label>
          <textarea type="text" class="form-control" rows="3" disabled><?php echo $value["indicador"]; ?></textarea>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="form-group panelIndicadorDetalle">

          <label class="text-white">Fórmula</label>
          <textarea type="text" class="form-control" rows="2" disabled><?php echo $value["formula"]; ?></textarea>


        </div>
      </div>
    </div>

    <div class="row panelIndicadorDetalle">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">
        <div class="textoPeriodo">
          <p class="text-uppercase">Nivel</p>
        </div>

        <div class="row">
          <?php
          $nivel = "";
          foreach ($lista_niveles as $lista_niveles => $values) { ?>
            <div class="col-md-12">
              <?php if ($value["idniveles"] == $values["idniveles"]) { ?>
                <div class="panelNiveles" style="background: #dc3545;border-radius: 10px; margin-bottom:10px;">
                  <p class="parrafoNiveles"><?php echo $values["niveles"];
                                            $nivel = $values["niveles"];  ?> </p>
                  <span style="color: chartreuse;">&#10003;</span>
                </div>
              <?php }  ?>

            </div>
          <?php } ?>
        </div>

        <div class="row" style="margin-top:10px;">
          <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              <button type="button" id="<?php echo $value["idindicador"]; ?>" class="form-control btn-success btnAntecedentes" data-toggle="modal" data-target="#modalAntecedentes">Antecedentes</button>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              <button type="button" id="<?php echo $value["idindicador"]; ?>" class="form-control btn-success btnConsecuentes" data-toggle="modal" data-target="#modalConsecuentes">Consecuentes</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">
        <div class="row">
          <div class="col-12">
            <div class="textoPeriodo">
              <p class="text-uppercase">PERÍODO MENSUAL</p>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-7 col-sm-6 col-md-8 col-lg-8">
            <div class="form-group">
              <input type="text" class="form-control text-center" value="Val planeado" disabled>
            </div>
          </div>

          <div class="col-5 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group">
              <input type="text" class="form-control text-center" value=" <?php echo $planeado_mensual; ?>" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7 col-sm-6 col-md-8 col-lg-8">
            <div class="form-group">
              <input type="text" class="form-control text-center" value="Val alcanzado" disabled>
            </div>
          </div>

          <div class="col-5 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group">
              <input type="text" class="form-control text-center" value=" <?php echo $alcanzado_mensual; ?>" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7 col-sm-12 col-md-7 col-lg-7">
            <div class="form-group">
              <input type="text" class="form-control text-center" value="Progreso" disabled>
            </div>
          </div>
          <div class="col-5 col-sm-12 col-md-5 col-lg-5">
            <div class="form-group">
              <button type="button" id="btnAlcances" class="form-control text-center" data-toggle="modal" data-target="#modalAlcances" style="background-size: cover;background-position: center;width: 100%; background-image: url('<?php echo base_url("public/Publico/img/" . $colorGeneral . "") ?>');">
                <?php echo $progreso; ?> <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(function() {
      $(".cardIndicador").each(function() {
        $(this).find("#codigoModalIndicador").text("<?php echo $value["codigo"]; ?>");
        $(this).find("#indicadorModalIndicador").text("<?php echo $value["indicador"]; ?>");
        $(this).find("#nivelMdalIndicador").text("Nivel: <?php echo $nivel ?>");
        $(this).find("#progresoModalIndicador").text("<?php echo $value["progreso"]; ?> %");
      });
    });
  </script>



<?php } ?>
</div>


<div class="modal fade" id="modalAntecedentes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modalGrande">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Antecedentes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-7">
            <div class="cardAntecedente">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center elementoPrinicipal text-white">
                  # de Antecedentes
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div class="row" id="panelAntecedente">

                  </div>
                </li>

              </ul>
            </div>

          </div>
          <div class="col-2  d-none d-sm-block  d-md-none d-lg-block text-center justify-content-center align-self-center">
            <i style='font-size:50px' id="flechaDerec" class='fas'>&#xf105;</i>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-3">
            <div class="card text-center cardIndicador">
              <div class="card-header elementoPrinicipal text-white" id="codigoModalIndicador">

              </div>
              <div class="card-body">
                <p class="card-text" id="indicadorModalIndicador"></p>
                <a href="#" class="btn btn-primary" id="nivelMdalIndicador"></a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalConsecuentes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modalGrande">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Antecedentes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-7">
            <div class="cardAntecedente">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center elementoPrinicipal text-white">
                  # de Antecedentes
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div class="row" id="panelConsecuentes">

                  </div>
                </li>

              </ul>
            </div>

          </div>
          <div class="col-2  d-none d-sm-block  d-md-none d-lg-block text-center justify-content-center align-self-center">
            <i style='font-size:50px' id="flechaDerec" class='fas'>&#xf105;</i>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-3">
            <div class="card text-center cardIndicador">
              <div class="card-header elementoPrinicipal text-white" id="codigoModalIndicador">

              </div>
              <div class="card-body">
                <p class="card-text" id="indicadorModalIndicador"></p>
                <a href="#" class="btn btn-primary" id="nivelMdalIndicador"></a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




</div>

<script>
  var subfondos = [
    "subFondo1.png",
    "subFondo1.png",
    "subFondo2.png",
    "subFondo3.png",
    "subFondo4.png",
    "subFondo5.png",
    "subFondo6.png"
  ];

  var subcoloresFondos = [
    "#da621c",
    "#da621c",
    "#ee7f01",
    "#e19e06",
    "#1e7c8c",
    "#34c6cc",
    "#1fc6be",
  ];

  $(function() {

    $("#btnCubopanel").click(function() {
      $(".panelGen").delay(300).fadeOut(500);
      $("#wrapper").css("opacity", "1");
      $("#wrapper").delay(800).fadeIn(500);
    });

    $(".btnAntecedentes").click(function() {
      $.ajax({
        type: "GET",
        url: "<?= base_url() ?>/antecedentes",
        data: {
          idindicador: $(this).attr("id")
        },
        dataType: 'json',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(data) {
          $("#panelAntecedente div").remove();
          for (var i = 0; i < data.length; i++) {
            var codigo = data[i].codigo;
            var progreso = data[i].progreso;
            var indicador = data[i].indicador;
            $("#panelAntecedente").append('<div class="subpanelAntecedente"><div class="col-2"> <span class="badge badge-primary badge-pill">' + codigo + '</span></div> <div class="col-2"> </div><div class="col-8"><p>' + indicador + '</p> </div></div>');
          }

        },
        error: function(request, status, error) {
          Swal.fire({
            icon:"error",
            title: '',
            text: "Ocurrió un error interno"
          });

          console.log(request.responseText + " " + error);
        }
      });
    });


    $(".btnConsecuentes").click(function() {
      $.ajax({
        type: "GET",
        url: "<?= base_url() ?>/consecuentes",
        data: {
          idindicador: $(this).attr("id")
        },
        dataType: 'json',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(data) {
          $("#panelConsecuentes div").remove();
          for (var i = 0; i < data.length; i++) {
            var codigo = data[i].codigo;
            var indicador = data[i].indicador;
            $("#panelConsecuentes").append('<div class="subpanelAntecedente"><div class="col-2"> <span class="badge badge-primary badge-pill">' + codigo + '</span></div> <div class="col-2"> </div><div class="col-8"><p>' + indicador + '</p> </div></div>');
          }

        },
        error: function(request, status, error) {
          Swal.fire({
            icon:"error",
            title: '',
            text: "Ocurrió un error interno"
          });

          console.log(request.responseText + " " + error);

        }
      });
    });

  });
</script>
