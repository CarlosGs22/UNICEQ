<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row ">
      <div class="col-8 col-sm-6 col-md-8 col-lg-4 grid-margin justify-content-center align-self-center">
        <div class="d-flex">
          <div>
            <h3 class="font-weight-bold mb-0">Lineas estratégicas</h3>
          </div>
        </div>
      </div>

      <div class="col-4 col-sm-6 col-md-4 offset-lg-4 grid-margin text-right">
        <div class="d-flex d-flex justify-content-end ">
          <div>
            <button type="button" class="btn btn-primary btn-rounded btn-fw btn-icon-text btnNuevaLinea">
              <i class="ti-plus btn-icon-prepend"></i>
              Nuevo
            </button>
          </div>
        </div>
      </div>
    </div>


    <div class="row">

      <div class="col-6 col-sm-6 col-md-3 col-lg-3" style="margin-bottom: 15px;">
        <h4 id="textoValor"></h4>
      </div>
    </div>

    <div class="row">

      <?php if ($listas_lineas)

      $acumValor = 0;
      $caraCubo = array("cara1.png", "cara2.png", "cara3.png", "cara4.png", "cara5.png", "cara6.png"); {
        $imagen = null;
        foreach ($listas_lineas   as $key => $value) {
          $acumValor += $value["valor"];


          if ($caraCubo[$key]) {
            $imagen = $caraCubo[$key];
          } else {
            $imagen = "imgVacia.png";
          }
          ?>

          <div class="col-6 col-sm-6 col-md-3 col-lg-3" style="margin-bottom: 15px;">
            <div class="card">

              <img class="card-img-top" src="<?php echo base_url("public/Publico/img/" . $imagen . "") ?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?php echo $value["area"] ?></h5>
                <p class="card-text">Valor: <small class="card-small"><?php echo $value["valor"] ?></small></p>
                <button type="button" id="<?php echo $value["idarea"]; ?>" class="btn btn-warning btn-rounded btn-fw btnEditarLinea" data-toggle="modal" data-target="#accion_linea"><i class="ti-pencil-alt btn-icon-prepend"></i>Editar</button>
              </div>
            </div>
          </div>
        <?php }
      } ?>



    </div>
  </div>


  <div class="modal fade" id="accion_linea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar linea estrategica</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formlinea" name="formlinea">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="formGroupExampleInput">Area</label>
                  <input type="text" class="form-control" id="txtArea" name="txtArea" placeholder="Nombre">
                  <input type="hidden" class="form-control" id="txtIdArea" name="txtIdArea">
                  <input type="hidden" class="form-control" id="txtTipo" name="txtTipo">

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="formGroupExampleInput">Valor</label>
                  <select id="txtValor" name="txtValor" class="form-control">
                    <?php for ($i = 1; $i <= $acumValor; $i++) { ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-center">
                <button type="button" class="btn btn-success btn-rounded btn-fw btn-icon-text btnGuardarLinea">
                  <i class="ti-save btn-icon-prepend"></i>
                  Guardar
                </button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Derechos reservados UNICEQ 2021</span>
    </div>
  </footer>

</div>


<script>
$(function() {

  $("#textoValor").text('Valor total : <?php echo $acumValor; ?>%');


  $(".btnNuevaLinea").click(function() {
    $('#formlinea input').val("");
    $('#formlinea select').val("1");
    $("#txtTipo").val("0");

    var valorT = <?php echo $acumValor; ?>;


    if(valorT >= 100){

      Swal.fire({
        icon: "error",
        title: '',
        text: "No hay suficiente espacio en el valor general"
      });
        $("#accion_linea").modal('hide');
    }else{
      $("#accion_linea").modal('show');
    }
  });


  $(".btnEditarLinea").click(function() {
    $("#txtArea").val($(this).closest(".card").find(".card-title").text());
    $("#txtValor").val($(this).closest(".card").find(".card-small").text());
    $("#txtTipo").val("1");


    $("#txtIdArea").val($(this).attr("id"));
  });

  $(".btnGuardarLinea").click(function() {
    var formulario = $('#formlinea').serialize();
    var valorTotal = <?php echo $acumValor; ?>;



    if ($('#txtArea').val().trim().length == 0) {
      Swal.fire({
        icon: "error",
        title: '',
        text: "Todos los campos son requeridos"
      });
      return false;
    }

    if($('#txtTipo').val() =="0"){
      var res = $('#txtValor').val() + valorTotal;
      if(res > 100){
        Swal.fire({
          icon: "error",
          title: '',
          text: "El valor excede el limite"
        });
        return false;
      }
    }



      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>/admin/accion_linea",
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
          Swal.fire({
            icon: "error",
            title: '',
            text: "Ocurrió un error interno"
          });
          console.log(request.responseText + " " + error);
        }
      });


    });
  });
  </script>
