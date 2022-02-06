
<?php

function colores($planeado,$alcanzado)
{
  $color = null;
  if($planeado == "100.00" && $alcanzado == "100.00"){
    $color = "#1ac6bd";
  }else{
    if($planeado == "0.00" && $alcanzado == "0.00"){
      $color = "#f45f25";
    }else if($alcanzado >= $planeado){
      $color = "#1ac6bd";
    }else{
      $color = "#f45f25";
    }
  }

  return $color;
}

$caraCubo = array("cara1.png","cara1.png", "cara2.png", "cara3.png", "cara4.png", "cara5.png", "cara6.png");?>

<div class="content-wrapper">
  <div class="row ">
    <div class="col-8 col-sm-6 col-md-8 col-lg-4 grid-margin justify-content-center align-self-center">
      <div class="d-flex">
        <div>
          <h3 class="font-weight-bold mb-0">Gráfica de conexiones</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-sm-12 col-md-5 col-lg-5">
      <div class="form-group">
        <label for="laPe">Area: * </label>
        <select class="form-control" name="txtArea" id="txtArea">
          <option value="0"></option>
          <?php if ($listas_areas) : ?>
            <?php foreach ($listas_areas as $key => $value) : ?>
              <option value="<?php echo $value->idarea; ?>"><?php echo $value->area; ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
    </div>
    <div class="col-12 col-sm-12 col-md-7 col-lg-7">
      <div class="form-group">
        <label for="laPe">Indicador: * </label>
        <select class="form-control" name="txtIndicador" id="txtIndicador">
          <option value="0"></option>
        </select>
      </div>
    </div>
  </div>

  <div class="row" id="panelConexiones" style="margin-bottom:17px;">
    <div class="col-12 col-sm-12 col-md-5 col-lg-5">
      <?php if ($listas_indicador) : ?>
        <?php foreach ($listas_indicador as $key => $value) : ?>
          <h3>Conexiones: <small><?php echo $value->codigo; ?></small></h3>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="row" id="indicadorGen" >
    <div class="col-12 col-sm-12 col-md-4 col-lg-4">

      <div class="row"  style="justify-content: center;">
        <?php if ($listas_indicadoresAnte) {?>
          <h4 class="text-center">Antececentes</h4>
          <?php foreach ($listas_indicadoresAnte as $key => $value) {
            ?>
            <div class="col-12 text-center" style="margin-bottom:8px;" id="indicadorAnte">
              <div class="card" style="border-radius:60px; border: 10px solid white; background-color: <?php echo colores($value->planeado,$value->alcanzado); ?>;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <img src="<?php echo base_url("public/Publico/img/" . $caraCubo[$value->idareaIndi] . "") ?>" alt="Linea estratégica" class="img-fluid">
                    </div>
                    <div class="col-8  justify-content-center align-self-center">
                      <h3 id="<?php echo $value->idindicador;?>" class="text-light iconIndi" style="cursor:pointer;"><?php echo $value->codigo; ?><i class="ti-eye menu-icon" style="font-size: 20px; margin: 5px;"></i></h3>
                    </div>
                  </div>
                  <h6 class=" mb-2"><?php echo $value->indicador; ?></h6>
                  <p class="card-text">Planeado: <?php echo $value->planeado; ?>% </p>
                  <p class="card-text">Alcanzado: <?php echo $value->alcanzado; ?>% </p>
                </div>
              </div>
            </div>
          <?php }} ?>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4" style="margin-bottom:8px;">
        <div class="row"  style="justify-content: center;">
          <div class="col-12 text-center">
            <?php if ($listas_indicador) { ?>
              <h4 class="text-center">Indicador primario</h4>
              <?php foreach ($listas_indicador as $key => $value) {?>
                <div class="card" style="border-radius:60px; border: 10px solid white; background-color: <?php echo colores($value->planeado,$value->alcanzado); ?>;" >
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <img src="<?php echo base_url("public/Publico/img/" . $caraCubo[$value->idareaIndi] . "") ?>" alt="Linea estratégica" class="img-fluid">
                      </div>
                      <div class="col-8  justify-content-center align-self-center">
                        <h3 id="<?php echo $value->idindicador;?>" class="text-light iconIndi" style="cursor:pointer;"><?php echo $value->codigo; ?><i class="ti-eye menu-icon" style="font-size: 20px; margin: 5px;"></i></h3>
                      </div>
                    </div>
                    <h6 class="mb-2"><?php echo $value->indicador; ?></h6>
                    <p class="card-text">Planeado: <?php echo $value->planeado; ?>% </p>
                    <p class="card-text">Alcanzado: <?php echo $value->alcanzado; ?>% </p>
                  </div>
                </div>
              <?php } } ?>

            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">

          <div class="row" style="justify-content: center;">
            <?php if ($listas_indicadoresConse) {?>
              <h4 class="text-center">Consecuentes</h4>
              <?php foreach ($listas_indicadoresConse as $key => $value) { ?>
                <div class="col-12 text-center" style="margin-bottom:8px;">
                  <div class="card"  style="border-radius:60px; border: 10px solid white; background-color: <?php echo colores($value->planeado,$value->alcanzado); ?>;">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-4">
                          <img src="<?php echo base_url("public/Publico/img/" . $caraCubo[$value->idareaIndi] . "") ?>" alt="Linea estratégica" class="img-fluid">
                        </div>
                        <div class="col-8  justify-content-center align-self-center">
                          <h3 id="<?php echo $value->idindicador;?>" class="text-light iconIndi" style="cursor:pointer;"><?php echo $value->codigo; ?><i class="ti-eye menu-icon" style="font-size: 20px; margin: 5px;"></i></h3>
                        </div>
                      </div>
                      <h6 class="mb-2"><?php echo $value->indicador; ?></h6>
                      <p class="card-text">Planeado: <?php echo $value->planeado; ?>% </p>
                      <p class="card-text">Alcanzado: <?php echo $value->alcanzado; ?>% </p>
                    </div>
                  </div>
                </div>
              <?php }  } ?>

            </div>
          </div>
        </div>
      </div>



      <script>

      $(function(){


        $("#txtArea").change(function() {
          $.ajax({
            type: "GET",
            url: "<?= base_url() ?>/admin/obtenerIndicadoresGrafica",
            dataType: 'json',
            data: {
              txtArea: $(this).val()
            },
            beforeSend: function() {
              $(".panelLoading").fadeIn(1000);
            },
            success: function(data) {
              $("#panelConexiones").remove();
              $("#indicadorGen").remove();

              $("#txtIndicador option").remove();
              $("#txtIndicador").append("<option value='0'></option>");
              for (var i = 0; i < data.length; i++) {
                var idIndicador = data[i].idindicador;
                var codigoIndicador = data[i].codigo;
                var indicador = data[i].indicador.split(/\s+/).slice(0, 7).join(" ");
                var formula = data[i].formula;
                var periodicidad = data[i].periodicidad;
                var cuando = data[i].cuando;
                var unidad_medida = data[i].unidad_medida;
                var estado = data[i].estado;
                var area = data[i].idarea;
                var departamento = data[i].iddepartamento;
                var niveles = data[i].idniveles;
                $("#txtIndicador").eq(0).append("<option value="+idIndicador+">"+ codigoIndicador + " " +  indicador+"</option>");
              }
              $(".panelLoading").fadeOut(1000);
            },
            error: function(request, status, error) {
              alert(request.responseText + " " + error);
              $(".panelLoading").fadeOut(1000);
            }
          });

        });

      });

      $("#txtIndicador").change(function() {
        if($(this).val() != "0"){
          window.location.href = 'grafica?idIndicador=' + $(this).val();
        }
      });

      $(document).delegate(".iconIndi", "click", function(e) {


      });

      $(".iconIndi").click(function() {
        window.location.href = 'grafica?idIndicador=' + $(this).attr("id");
      });

      </script>
