<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row ">
      <div class="col-8 col-sm-6 col-md-8 col-lg-4 grid-margin text-center justify-content-center align-self-center">
        <div class="d-flex">
          <div>
            <?php $codigo = null;
            if ($listas_indicador) : ?>
            <?php foreach ($listas_indicador as $key => $value) : ?>


              <?php $codigo = $value->codigo;
              break;
            endforeach; ?>
          <?php endif; ?>


          <h3 class="font-weight-bold mb-0">Metas <?php echo $codigo; ?></h3>
        </div>
      </div>
    </div>

    <div class="col-4 col-sm-6 col-md-4 offset-lg-4 grid-margin text-right">
      <div class="d-flex d-flex justify-content-end ">
        <div>
          <button type="button" class="btn btn-primary btn-rounded btn-fw btn-icon-text btnNuevoIndicador" data-toggle="modal" data-target="#accion_meta">
            <i class="ti-file btn-icon-prepend"></i>
            Nuevo
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active muno" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">General</a>
          <a class="nav-item nav-link mdos" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Mensual</a>
          <a class="nav-item nav-link mtres" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Anual</a>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="row">
            <div id="no-more-tables" style=" width: 100%; padding: 15px;">
              <table class="col-md-12 table-bordered table-striped table-condensed cf" id="metas_table">
                <thead class="cf">
                  <tr>
                    <th>Id</th>
                    <th>Año</th>
                    <th>Planeado</th>
                    <th>Alcanzado</th>
                    <th>Estado</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($listas_general) : ?>
                    <?php foreach ($listas_general as $key => $value) : ?>
                      <tr>
                        <td><?php echo $value->id; ?></td>
                        <td><?php echo $value->anio; ?></td>
                        <td style="width: 40%;"><?php echo $value->planeado; ?>%</td>
                        <td><?php echo $value->alcanzado; ?>%</td>
                        <td><?php echo ($value->estado == 1) ? 'Activo' : 'Inactivo'; ?></td>
                        <td>
                          <button type="button" id="<?php echo $value->id; ?>" class="btn btn-warning btn-rounded btn-fw btnEditarMeta meta_general" data-toggle="modal" data-target="#accion_meta">Editar</button>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div id="no-more-tables" style="padding-top: 15px;">
              <table class="col-md-12 table-bordered table-striped table-condensed cf" id="metas_table">
                <thead class="cf">
                  <tr>
                    <th>Id</th>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Planeado</th>
                    <th>Alcanzado</th>
                    <th>Estado</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($listas_mensual) : ?>
                    <?php foreach ($listas_mensual as $key => $value) : ?>
                      <tr>
                        <td><?php echo $value->id; ?></td>
                        <td><?php echo $value->anio; ?></td>
                        <td><?php echo $value->mes; ?></td>
                        <td style="width: 40%;"><?php echo $value->planeado; ?>%</td>
                        <td><?php echo $value->alcanzado; ?>%</td>
                        <td><?php echo ($value->estado == 1) ? 'Activo' : 'Inactivo'; ?></td>
                        <td>
                          <button type="button" id="<?php echo $value->id; ?>" class="btn btn-warning btn-rounded btn-fw btnEditarMeta meta_mensual" data-toggle="modal" data-target="#accion_meta">Editar</button>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <div id="no-more-tables" style="padding-top: 15px;">
                <table class="col-md-12 table-bordered table-striped table-condensed cf" id="metas_table">
                  <thead class="cf">
                    <tr>
                      <th>Id</th>
                      <th>Año</th>
                      <th>Planeado</th>
                      <th>Alcanzado</th>
                      <th>Estado</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($listas_anual) : ?>
                      <?php foreach ($listas_anual as $key => $value) : ?>
                        <tr>
                          <td><?php echo $value->id; ?></td>
                          <td><?php echo $value->anio; ?></td>
                          <td style="width: 40%;"><?php echo $value->planeado; ?>%</td>
                          <td><?php echo $value->alcanzado; ?>%</td>
                          <td><?php echo ($value->estado == 1) ? 'Activo' : 'Inactivo'; ?></td>
                          <td>
                            <button type="button" id="<?php echo $value->id; ?>" class="btn btn-warning btn-rounded btn-fw btnEditarMeta meta_anual" data-toggle="modal" data-target="#accion_meta">Editar</button>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>




      </div>
    </div>


    <div class="modal fade" id="accion_meta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar meta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="frmmeta" name="frmmeta">
              <div class="row" id="panelTipo">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="laCod">Tipo : *</label>
                    <select name="txtTipo" id="txtTipo" class="form-control">
                      <option value="meta_general">Meta general</option>
                      <option value="meta_mensual">meta mensual</option>
                      <option value="meta_anual">Meta anual</option>
                    </select>
                  </div>
                </div>

              </div>
              <div class="row" id="panelEstado">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="laCod">Estado : *</label>
                    <select name="txtEstado" id="txtEstado" class="form-control">
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4" id="panelMes" style="display: none;">
                  <div class="form-group">
                    <label for="laCod">Mes : *</label>
                    <select name="txtMes" id="txtMes" class="form-control">
                      <?php if ($listas_mes) : ?>
                        <?php foreach ($listas_mes as $key => $value) : ?>
                          <option value="<?php echo  $value->id; ?>"><?php echo  $value->mes; ?></option>

                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="laCod">Año : *</label>
                    <select name="txtAnio" id="txtAnio" class="form-control">
                      <?php
                      for ($i = 2021; $i < 2099; $i++) {  ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>

                    </select>

                    <input type="hidden" class="form-control" id="txtIdmeta" name="txtIdmeta">
                    <input type="hidden" class="form-control" id="txtIndicador" name="txtIndicador">

                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="laIndi">Planeado: *</label>
                    <input type="text" onkeypress="return isNumber(event)" class="form-control" id="txtPlaneado" name="txtPlaneado" minlength="1" maxlength="3">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="laIndi">Alcanzado: *</label>
                    <input type="text" onkeypress="return isNumber(event)" class="form-control" id="txtAlcanzado" name="txtAlcanzado">
                  </div>
                </div>
                <div class="col-md-3 text-center" id="panelSistemico" style="display:none;">
                  <div class="form-group">
                    <label for="laIndi">¿Sistemico?: </label>
                    <input type="checkbox" class="form-control"  id="txtSistemico">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col text-center">
                  <button type="button" id="btnGuardarMeta" class="btn btn-success btn-rounded btn-fw uniceq-color"><i class="ti-save iconoLib"></i>Guardar</button>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>


  </div>
</div>


<?php
$promedioTotal = 0;
if($lista_promedio){
  foreach ($lista_promedio as $lista => $value) {
    $promedioTotal += $value->promedio;
  }
}

?>



<script>
$(document).ready(function() {

  var url = $(location).attr('href'),
  parts = url.split("/"),
  last_part = parts[parts.length - 1];

  $("#txtIndicador").val(last_part);


  $('body #metas_table').each(function() {
    $(this).DataTable();
  });

  $(".btnNuevoIndicador").click(function() {
    $('#txtIdmeta').val("");
    $('#txtAnio').val("");
    $('#txtPlaneado').val("0");
    $('#txtAlcanzado').val("0");

    $('#panelTipo').show();
    $('#panelEstado').hide();
    $("#txtEstado").val("1");
    $("#txtAnio").val("2021");
    $('#txtTipo').val("meta_general");
    $("#panelSistemico").hide();

  });

  $(".muno").click(function() {
    $('#txtTipo').val("meta_general");
    $('#panelMes').hide();
    $("#panelSistemico").hide();

  });

  $(".mdos").click(function() {
    $('#panelEstado').show();
    $('#panelMes').show();
    $('#txtTipo').val("meta_general");
    $("#panelSistemico").show();
  });

  $(".mtres").click(function() {
    $('#panelMes').hide();
    $('#txtTipo').val("meta_general");
    $("#panelSistemico").hide();
  });


  $(document).delegate(".btnEditarMeta", "click", function(e) {
    $('#panelTipo').hide();


    var ultimaClase = $(this).attr('class').split(' ').pop();


    $("#txtTipo").val(ultimaClase);

    $.ajax({
      type: "GET",
      url: "<?= base_url() ?>/admin/consultaMetaModal",
      data: {
        idMeta: $(this).attr("id"),
        tipo: ultimaClase
      },
      dataType: 'json',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      beforeSend: function() {
        $(".panelLoading").fadeIn(1000);
      },
      success: function(data) {
        for (var i = 0; i < data.length; i++) {
          var idMeta = data[i].id;
          var anio = data[i].anio;

          if (data[i].mes !== null) {
            var mes = data[i].mes;
            $('#panelEstado').show();
            $("#txtMes").val(mes);

          }

          var planeado = data[i].planeado;
          var alcanzado = data[i].alcanzado;
          var estado = data[i].estado;

          $("#txtIdmeta").val(idMeta);
          $("#txtAnio").val(anio);
          $("#txtPlaneado").val(planeado);
          $("#txtAlcanzado").val(alcanzado);
          $("#txtEstado").val(estado);


          $(".panelLoading").fadeOut(1000);

        }

      },
      error: function(request, status, error) {
        alert(request.responseText + " " + error);

        $(".panelLoading").fadeOut(1000);
      }
    });


  });

  $(document).delegate("#btnGuardarMeta", "click", function(e) {
    if ($('#txtPlaneado').val().trim().length > 0 && $('#txtAlcanzado').val().trim().length > 0) {
      var formulario = $('#frmmeta').serialize();

      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>/admin/accion_meta",
        dataType: 'json',
        data: formulario,
        success: function(data) {
          Swal.fire({
            icon: data[1],
            title: '',
            text: data[0]
          });
        },
        error: function(request, status, error) {
          alert(request.responseText + " " + error);
        }
      });

    } else {
      Swal.fire({
        icon: 'error',
        title: '',
        text: 'Todos los campos son requeridos',
      });
    }



  });

  $("#txtTipo").change(function() {
    if($(this).val() === 'meta_mensual'){
      $('#panelEstado').show();
      $("#panelMes").show();
      $("#panelSistemico").show();
    }else{
      $('#panelEstado').hide();
      $("#panelMes").hide();
      $("#panelSistemico").hide();
    }



  });


  $("#txtSistemico").click(function(){
    if ($(this).is(':checked')) {
       $("#txtPlaneado").val("100");
       $("#txtAlcanzado").val(<?php echo $promedioTotal; ?>);
    }else{
      $("#txtPlaneado").val("0");
      $("#txtAlcanzado").val("0");
    }

  });



});


function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}
</script>
