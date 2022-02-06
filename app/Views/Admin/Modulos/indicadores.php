<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row ">
      <div class="col-8 col-sm-6 col-md-8 col-lg-4 grid-margin text-center justify-content-center align-self-center">
        <div class="d-flex ">
          <div>
            <h3 class="font-weight-bold mb-0">Indicadores</h3>
          </div>
        </div>
      </div>

      <div class="col-4 col-sm-6 col-md-4 offset-lg-4 grid-margin text-right">
        <div class="d-flex d-flex justify-content-end ">
          <div>
            <button type="button" class="btn btn-primary btn-rounded btn-fw btn-icon-text btnNuevoIndicador" data-toggle="modal" data-target="#accion_indi">
              <i class="ti-plus btn-icon-prepend"></i>
              Nuevo
            </button>
          </div>
        </div>
      </div>

    </div>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-reg" role="tab" aria-controls="pills-home" aria-selected="true">Regulares</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-estra" role="tab" aria-controls="pills-profile" aria-selected="false">Estratégicos</a>
      </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-reg" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="row">
          <div id="no-more-tables" style="width: 100%;">
            <table class="col-md-12 table-bordered table-striped table-condensed cf" id="indicadores_table">
              <thead class="cf">
                <tr>
                  <th>Id</th>
                  <th>Código</th>
                  <th>Indicador</th>
                  <th>Área</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($lista_indicadores) : ?>
                  <?php foreach ($lista_indicadores as $value) : ?>
                    <tr>
                      <td data-title="Id"><?php echo $value->idindicador; ?></td>
                      <td data-title="Código"><?php echo $value->codigo; ?></td>
                      <td data-title="Indicador" style="width: 25%;"><?php echo $value->indicador; ?></td>
                      <td data-title="Área"><?php echo $value->area; ?></td>
                      <td data-title="Acción">
                        <button type="button" id="<?php echo $value->idindicador; ?>" class="btn btn-warning btn-rounded btn-fw btnEditarIndicador"><i class="ti-pencil-alt btn-icon-prepend"></i>Editar</button>
                        <a class="btn btn-uniceq btn-rounded btn-fw uniceq-color" href="<?php echo base_url("admin/consultaMetas/" . $value->idindicador . "") ?>"><i class="ti-stats-up btn-icon-prepend"></i>Metas</a>
                        <button type="button" id="<?php echo $value->idindicador; ?>" class="btn btn-info btn-rounded btn-fw btnAnteCon" data-toggle="modal" data-target="#accion_ante_con"><i class="ti-direction-alt btn-icon-prepend"></i>Ante/Conse</button>

                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-estra" role="tabpanel" aria-labelledby="pills-profile-tab">

        <div class="row">
          <div id="no-more-tables" style="width:100%;">
            <table class="col-md-12 table-bordered table-striped table-condensed cf" id="indicadores_table">
              <thead class="cf">
                <tr>
                  <th>Id</th>
                  <th>Código</th>
                  <th>Indicador</th>
                  <th>Área</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($lista_indicadores_estra) : ?>
                  <?php foreach ($lista_indicadores_estra as $value) : ?>
                    <tr>
                      <td data-title="Id"><?php echo $value->idindicador; ?></td>
                      <td data-title="Código"><?php echo $value->codigo; ?></td>
                      <td data-title="Indicador" style="width: 25%;"><?php echo $value->indicador; ?></td>
                      <td data-title="Área"><?php echo $value->area; ?></td>
                      <td data-title="Acción">
                        <button type="button" id="<?php echo $value->idindicador; ?>" class="btn btn-warning btn-rounded btn-fw btnEditarIndicador"><i class="ti-pencil-alt btn-icon-prepend"></i>Editar</button>
                        <a class="btn btn-uniceq btn-rounded btn-fw uniceq-color" href="<?php echo base_url("admin/consultaMetas/" . $value->idindicador . "") ?>"><i class="ti-stats-up btn-icon-prepend"></i>Metas</a>
                        <button type="button" id="<?php echo $value->idindicador; ?>" class="btn btn-info btn-rounded btn-fw btnAnteCon" data-toggle="modal" data-target="#accion_ante_con"><i class="ti-direction-alt btn-icon-prepend"></i>Ante/Conse</button>

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


<div class="modal fade" id="accion_indi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar indicador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmindicador" name="frmindicador">

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="laCod">Código : *</label>
                <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" maxlength="10">
                <input type="hidden" class="form-control" id="txtInIndicador" name="txtInIndicador">
              </div>
            </div>
            <div class="col-md-9">
              <div class="form-group">
                <label for="laIndi">Indicador: *</label>
                <input type="text" class="form-control" id="txtIndicador" name="txtIndicador">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="laNi">Nivel: * </label>
                <select class="form-control" name="txtNivel" id="txtNivel">
                  <option value="0"></option>
                  <?php if ($listas_niveles) : ?>
                    <?php foreach ($listas_niveles as $key => $value) : ?>
                      <option value="<?php echo $value->idniveles; ?>"><?php echo $value->niveles; ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="laFor">Formula: * </label>
                <input type="text" class="form-control" id="txtFormula" name="txtFormula">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="laFor">Estado: * </label>
                <select name="txtEstado" id="txtEstado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="laPe">Periodicidad: </label>
                <input type="text" class="form-control" id="txtPeriodicidad" name="txtPeriodicidad">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="laPe">Cuando: </label>
                <input type="text" class="form-control" id="txtCuando" name="txtCuando">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="laPe">Unidad de medida </label>
                <input type="text" class="form-control" id="txtUnidad" name="txtUnidad">
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="laPe">Área: * </label>
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
            <div class="col-md-6">
              <div class="form-group">
                <label for="laPe">Departamento: * </label>
                <select class="form-control" name="txtDepartamento" id="txtDepartamento">
                  <option value="0"></option>
                  <?php if ($listas_depa) : ?>
                    <?php foreach ($listas_depa as $key => $value) : ?>
                      <option value="<?php echo $value->iddepartamento; ?>"><?php echo $value->departamento; ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="laPe">Tipo: * </label>
                <select class="form-control" name="txtTipo" id="txtTipo">
                  <option value="1">Regular</option>
                  <option value="2">Estrategico</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col text-center">
              <button type="button" id="btnGuardarIndicador" class="btn btn-success btn-rounded btn-fw uniceq-color"><i class="ti-save iconoLib"></i>Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>


<div class="modal fade" id="accion_ante_con" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Antececentes/Consecuentes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="txtIndicadorTipo" name="txtIndicadorTipo">

        <div class="row" style="margin-left: 12px;
          margin-right: 12px;
          }">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="width:100%;">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Añadir</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-ante" role="tab" aria-controls="pills-profile" aria-selected="false">Antececentes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-conse" role="tab" aria-controls="pills-contact" aria-selected="false">Consecuentes</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent" style="width:100%;">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="laPe">Área:</label>
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
              </div>
              <div class="row" id="tablaAnteConse">
              </div>
            </div>

            <div class="tab-pane fade" id="pills-ante" role="tabpanel" aria-labelledby="pills-profile-tab" style="width:100%;">
              <div class="row" id="panelAntss">


              </div>

            </div>
            <div class="tab-pane fade show " id="pills-conse" role="tabpanel" aria-labelledby="pills-home-tab">
              <div class="row" id="panelConss">


              </div>


            </div>
          </div>
        </div>

      </div>
    </div>


  </div>
</div>


<script>
  $(document).ready(function() {
    $('body #indicadores_table').DataTable();


    $(".btnNuevoIndicador").click(function() {

      $("#accion_indi").find("input").val('');
      $("#accion_indi").find("select").val('0');
      $("#accion_indi #txtEstado").val('1');
      $("#accion_indi #txtTipo").val('1');

    });


    $(document).delegate(".btnEditarIndicador", "click", function(e) {

      $.ajax({
        type: "GET",
        url: "<?= base_url() ?>/admin/consultaIndicador",
        data: {
          idindicador: $(this).attr("id")
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
            var idIndicador = data[i].idindicador;
            var codigoIndicador = data[i].codigo;
            var indicador = data[i].indicador;
            var formula = data[i].formula;
            var periodicidad = data[i].periodicidad;
            var cuando = data[i].cuando;
            var unidad_medida = data[i].unidad_medida;
            var estado = data[i].indiEstado;
            var tipo = data[i].tipo;
            var area = data[i].idarea;
            var departamento = data[i].iddepartamento;
            var niveles = data[i].idniveles;

            $("#txtInIndicador").val(idIndicador);
            $("#txtCodigo").val(codigoIndicador);
            $("#txtIndicador").val(indicador);
            $("#txtNivel").val(niveles);
            $("#txtFormula").val(formula);
            $("#txtPeriodicidad").val(periodicidad);
            $("#txtCuando").val(cuando);
            $("#txtUnidad").val(unidad_medida);
            $("#txtEstado").val(estado);
            $("#txtTipo").val(tipo);
            $("#txtArea").val(area);
            $("#txtDepartamento").val(departamento);


            $("#accion_indi").modal('show');


          }

          $(".panelLoading").fadeOut(1000);

        },
        error: function(request, status, error) {
          alert(request.responseText + " " + error);
          $(".panelLoading").fadeOut(1000);
        }
      });
    });



    $("#btnGuardarIndicador").click(function(event) {
      var formulario = $('#frmindicador').serialize();

      if (validacionLenght("frmindicador")) {
        if (validacionInput("frmindicador") && validacionSelect("frmindicador")) {
          $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/admin/accion_indicador",
            dataType: 'json',
            data: formulario,
            success: function(data) {
              Swal.fire({
                icon: data[1],
                title: '',
                text: data[0]
              }).then(function() {
                location.reload();
              });
            },
            error: function(request, status, error) {
              alert(request.responseText + " " + error);
            }
          });
        }


      }

    });


    $(document).delegate(".btnAnteCon", "click", function(e) {
      $("#txtIndicadorTipo").val($(this).attr("id"));
      $.ajax({
        type: "GET",
        url: "<?= base_url() ?>/admin/obtenerAnteConse",
        dataType: 'json',
        data: {
          id: $(this).attr("id")
        },
        beforeSend: function() {
          $(".panelLoading").fadeIn(1000);
        },
        success: function(data) {
          if (data.antecedente) {
            $("#panelAntss div").remove();
            for (var i = 0; i < data.antecedente.length; i++) {
              var id = data.antecedente[i].idantecedente;
              var codigo = data.antecedente[i].codigo;
              var area = data.antecedente[i].area;
              var indicador = data.antecedente[i].indicador;
              $("#panelAntss").append('<div class="col-6 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:15px;"><div class="card border-dark mb-3"><div class="card-header">' + codigo + '</div><div class="card-body text-dark"><h5 class="card-title">' + area + '</h5><p class="card-text">' + indicador + '</p><div class="panelBtn text-center"><input type="hidden" value="' + id + '" class="txtId"><i class="ti-close btnAnteCons antecedente"></i></div></div></div></div>');
            }
          }

          if (data.consecuente) {
            $("#panelConss div").remove();
            for (var i = 0; i < data.consecuente.length; i++) {
              var id = data.consecuente[i].idconsecuente;
              var codigo = data.consecuente[i].codigo;
              var area = data.consecuente[i].area;
              var indicador = data.consecuente[i].indicador;
              $("#panelConss").append('<div class="col-6 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:15px;"><div class="card border-dark mb-3"><div class="card-header">' + codigo + '</div><div class="card-body text-dark"><h5 class="card-title">' + area + '</h5><p class="card-text">' + indicador + '</p><div class="panelBtn text-center"><input type="hidden" value="' + id + '" class="txtId"><i class="ti-close btnAnteCons consecuente"></i></div></div></div></div>');
            }
          }
          $(".panelLoading").fadeOut(1000);

        },
        error: function(request, status, error) {
          alert(request.responseText + " " + error);
          $(".panelLoading").fadeOut(1000);
        }
      });

    });

    $(document).delegate(".btnAnteCons", "click", function(e) {
      var param = $(this).attr('class').split(' ').pop();
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>/admin/accion_ante_con",
        dataType: 'json',
        data: {
          txtId: $(this).closest(".panelBtn").find(".txtId").val(),
          txtTipo: param
        },
        success: function(data) {
          Swal.fire({
            icon: data[1],
            title: '',
            text: data[0]
          }).then(function() {
            location.reload();
          });
        },
        error: function(request, status, error) {
          alert(request.responseText + " " + error);
        }
      });

    });

    $("#pills-home #txtArea").change(function() { // 1st
      $.ajax({
        type: "GET",
        url: "<?= base_url() ?>/admin/obtenerIndicadoresPorArea",
        dataType: 'json',
        data: {
          txtArea: $(this).val(),
          txtIndicador: $("#txtIndicadorTipo").val()
        },
        beforeSend: function() {
          $(".panelLoading").fadeIn(1000);
        },
        success: function(data) {
          $("#tablaAnteConse div").remove();
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

            $("#tablaAnteConse").append('<div class="col-6 col-sm-2 col-md-3 col-lg-3 panelIndicadoresAnteConse" id="' + idIndicador + '" style="margin-bottom: 17px;"><div class="card" ><div class="card-body"><h5 class="card-title">' + codigoIndicador + '</h5><h6>' + indicador + '</h6><select id="txtTipoindi" name="txtTipoindi" class="form-control ' + idIndicador + '"><option value="0">Tipo:</option><option value="1">Antececente</option><option value="2">Consecuente</option></select></div></div></div>');

          }

          $(".panelLoading").fadeOut(1000);

        },
        error: function(request, status, error) {
          alert(request.responseText + " " + error);

          $(".panelLoading").fadeOut(1000);
        }
      });
    });

    $(document).delegate("#txtTipoindi", "change", function(e) {
      var idprimario = $("#txtIndicadorTipo").val();
      var idsecundario = $(this).attr('class').split(' ').pop();
      var valor = $(this).val();

      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>/admin/accion_ante_con_add",
        dataType: 'json',
        data: {
          idprim: idprimario,
          idsec: idsecundario,
          val: valor
        },
        success: function(data) {
          Swal.fire({
            icon: data[1],
            title: '',
            text: data[0]
          });

        },
        error: function(request, status, error) {
          Swal.fire({
            icon: 'error',
            title: '',
            text: 'Ocurrió un error interno'
          });
          console.log(request.responseText + " " + error);
        }
      });


    });

  });
</script>
