<!-- partial -->



<div class="main-panel">

  <div class="content-wrapper">

    <div class="row ">

      <div class="col-8 col-sm-6 col-md-8 col-lg-4 grid-margin text-center justify-content-center align-self-center">

        <div class="d-flex">

          <div>

            <h3 class="font-weight-bold mb-0">Usuarios</h3>

          </div>

        </div>



      </div>



      <div class="col-4 col-sm-6 col-md-4 offset-lg-4 grid-margin text-right">

        <div class="d-flex d-flex justify-content-end ">

          <div>

            <button type="button" class="btn btn-primary btn-rounded btn-fw btn-icon-text btnNuevoUsuario" data-toggle="modal" data-target="#accion_usuario">
              <i class="ti-plus btn-icon-prepend"></i>
              Nuevo
            </button>
            <input type="hidden" id="txtValUsuario" value="0">
          </div>

        </div>

      </div>

    </div>



    <div class="row">



      <?php



      if ($listas_usuarios) {
        foreach ($listas_usuarios as $key => $value) {
      ?>
          <div class="col-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
              <div class="panelImgUsuario">
                <?php
                $image;
                if($value["imagen"] != null){
                  $image = $value["imagen"];
                } else{
                    $image = "user.png";
                }?>
                <img class="card-img-top" src="<?php echo base_url("public/Admin/images/imgUsuarios/" . $image. "") ?>" alt="Imagen usuario" style="height:246px;">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $value["nombre"] . " " . $value["apellido_paterno"]; ?></h5>
                <p class="card-text">Usuario: <?php echo $value["usuario"]; ?> </p>
                <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 paneldetalleUsuarios">
                    <button type="button" id="<?php echo $value["idusuario"];  ?>" class="btn btn-warning btn-rounded btn-fw btnEditarUsuario btn-block" data-toggle="modal" data-target="#accion_usuario"><i class="ti-pencil-alt btn-icon-prepend"></i>Editar</button>
                  </div>
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 paneldetalleUsuarios">
                    <button type="button" id="<?php echo $value["idusuario"];  ?>" class="btn btn-info btn-rounded btn-fw btnPermisoUsuario btn-block" data-toggle="modal" data-target="#accion_usuario_permiso"><i class="ti-key
                      btn-icon-prepend"></i>Permisos</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php }} ?>
    </div>

  </div>





  <div class="modal fade" id="accion_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



    <div class="modal-dialog modal-xl" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Registrar usuario</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <form id="formusuario" name="formusuario">

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label for="formGroupExampleInput">Nombre: *</label>

                  <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre">

                  <input type="hidden" class="form-control" id="txtId" name="txtId">

                </div>

              </div>



              <div class="col-md-4">

                <div class="form-group">

                  <label for="formGroupExampleInput">Apellido paterno: *</label>

                  <input type="text" class="form-control" id="txtApe1" name="txtApe1" placeholder="Apellido paterno">

                </div>

              </div>



              <div class="col-md-4">

                <div class="form-group">

                  <label for="formGroupExampleInput">Apellido materno: *</label>

                  <input type="text" class="form-control" id="txtApe2" name="txtApe2" placeholder="Apellido materno">

                </div>

              </div>

            </div>





            <div class="row">

              <div class="col-md-5">

                <div class="form-group">

                  <label for="formGroupExampleInput">Imagen: *</label>

                  <div class="file-upload">



                    <div class="image-upload-wrap">

                      <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" id="imgUsuario" name="imgUsuario" />

                      <div class="drag-text">

                        <h3>Arrastra o selecciona una imagen</h3>

                      </div>

                    </div>

                    <div class="file-upload-content">

                      <img class="file-upload-image" src="#" alt="your image" />

                      <div class="image-title-wrap">

                        <button type="button" onclick="removeUpload()" class="remove-image">Borrar <span class="image-title">Imagen cargada</span></button>

                      </div>

                    </div>

                  </div>

                </div>

              </div>



              <div class="col-md-7">

                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="formGroupExampleInput">Usuario: *</label>

                      <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" placeholder="Usuario">

                    </div>

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="formGroupExampleInput">Contraseña: *</label>

                      <input type="password" class="form-control" id="txtContrasenia" name="txtContrasenia" placeholder="Contraseña">

                    </div>

                  </div>



                </div>



                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="formGroupExampleInput">Departamento: *</label>

                      <select class="form-control" name="txtDepartamento" id="txtDepartamento">

                        <option value="0"></option>

                        <?php if ($listas_departamentos) {

                          foreach ($listas_departamentos as $key => $value) {

                        ?> ?>

                            <option value="<?php echo $value["iddepartamento"]; ?>"><?php echo $value["departamento"]; ?></option>

                        <?php }
                        } ?>

                      </select>

                    </div>

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="formGroupExampleInput">Estado: *</label>

                      <select class="form-control" name="txtEstado" id="txtEstado">

                        <option value="1">Activo</option>

                        <option value="0">Inactivo</option>

                      </select>

                    </div>

                  </div>



                  <div class="col-md-12">

                    <div class="form-group">

                      <div class="col text-center">

                        <button type="button" class="btn btn-success btn-rounded btn-fw btn-icon-text btnGuardarUsuario">

                          <i class="ti-save btn-icon-prepend"></i>

                          Guardar

                        </button>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </form>

        </div>

      </div>

    </div>

  </div>

</div>



<div class="modal fade" id="accion_usuario_permiso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-xl" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Indicadores por usuario</h5>

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
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-ante" role="tab" aria-controls="pills-profile" aria-selected="false">Indicadores</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent" style="width:100%;">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
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

                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                  <div class="form-group">
                    <label for="laPe">Acción:</label>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <button class="form-control form-control btn btn-primary btn-rounded btn-fw btn-icon-text btnMasOp" id="3">Añadir todos</button>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <button class="form-control btn btn-danger btn-rounded btn-fw btn-icon-text btnMasOp" id="4">Borrar todos</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row" id="tablaAnteConse">
              </div>
            </div>

            <div class="tab-pane fade" id="pills-ante" role="tabpanel" aria-labelledby="pills-profile-tab" style="width:100%;">
              <div class="row" id="panelIndi">

              </div>

            </div>

          </div>
        </div>

      </div>

    </div>

  </div>





  <script>
    $(function() {



      $(".btnNuevoUsuario").click(function() {

        $("#accion_usuario").find("input").val('');

        $("#accion_usuario").find("select").val('0');

        $("#accion_usuario #txtEstado").val('1');

      });



      $(".btnEditarUsuario").click(function() {

        $.ajax({

          type: "GET",

          url: "<?= base_url() ?>/admin/consultaUsuario",

          data: {

            idusuario: $(this).attr("id")

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

              var idusuario = data[i].idusuario;

              var nombre = data[i].nombre;

              var apellido_paterno = data[i].apellido_paterno;

              var apellido_materno = data[i].apellido_materno;

              var usuario = data[i].usuario;

              var contrasenia = data[i].contrasenia;

              var estado = data[i].estado;

              var departamento = data[i].iddepartamento;



              $("#txtId").val(idusuario);

              $("#txtNombre").val(nombre);

              $("#txtApe1").val(apellido_paterno);

              $("#txtApe2").val(apellido_materno);

              $("#txtUsuario").val(usuario);

              $("#txtContrasenia").val(contrasenia);

              $("#txtEstado").val(estado);

              $("#txtDepartamento").val(departamento);


              $(".panelLoading").fadeOut(1000);





            }

          },

          error: function(request, status, error) {

            alert(request.responseText + " " + error);

            $(".panelLoading").fadeOut(1000);

          }

        });





      });



      $(".btnGuardarUsuario").click(function() {


        var form = $("#formusuario");

        var formData = new FormData(form[0]);

        if (validacionInput("formusuario")) {

          $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/admin/accion_usuario",
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
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
        }

      });

      $("#pills-home #txtArea").change(function() {
        if ($(this).val() !== "0") {

          $.ajax({
            type: "GET",
            url: "<?= base_url() ?>/admin/obtenerIndicadoresPorAreaUsuPer",
            dataType: 'json',
            data: {
              txtArea: $(this).val(),
              txtUsuario: $("#txtValUsuario").val()
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

                $("#tablaAnteConse").append('<div class="col-6 col-sm-2 col-md-3 col-lg-3 panelIndicadoresAnteConse" id="' + idIndicador + '" style="margin-bottom: 17px;"><div class="card" ><div class="card-body"><h5 class="card-title">' + codigoIndicador + '</h5><h6>' + indicador + '</h6><div class="panelCheckUsu text-center"><input class="form-check-input checkPerUsuario" type="checkbox" value="' + idIndicador + '"></div></div></div></div>');

              }

            },
            error: function(request, status, error) {
              alert(request.responseText + " " + error);
            }
          });
        }
      });

      $(document).delegate(".btnPermisoUsuario ", "click", function(e) {
        $("#txtValUsuario").val($(this).attr("id"));
        $("#panelIndi div").remove();
        $("#txtArea").val("0");
        $.ajax({
          type: "GET",
          url: "<?= base_url() ?>/admin/obtenerPermisosUsuarios",
          dataType: 'json',
          data: {
            id: $(this).attr("id")
          },
          beforeSend: function() {
            $(".panelLoading").fadeIn(1000);
          },
          success: function(data) {
            $("#panelIndi div").remove();
            if (data){
              for (var i = 0; i < data.length; i++) {
                var id = data[i].idindicador;
                var codigo = data[i].codigo;
                var area = data[i].area;
                var indicador = data[i].indicador;
                $("#panelIndi").append('<div class="col-6 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:15px;"><div class="card border-dark mb-3"><div class="card-header">' + codigo + '</div><div class="card-body text-dark"><h5 class="card-title">' + area + '</h5><p class="card-text">' + indicador + '</p><div class="panelBtn text-center"><i class="ti-close iconoPerUsu" id="' + id + '" ></i></div></div></div></div>');


              }

            }
            $(".panelLoading").fadeOut(1000);

          },
          error: function(request, status, error) {
            Swal.fire({
              icon: "error",
              title: '',
              text: "Ocurrió un error interno"
            });
            console.log(request.responseText + " " + error);

            $(".panelLoading").fadeOut(1000);
          }
        });

      });



      $(document).delegate(".checkPerUsuario", "click", function(e) {
        $(this).unbind('click');
        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>/admin/accion_indicador_usuario",
          dataType: 'json',
          data: {
            idindicador: $(this).val(),
            idusuario: $("#txtValUsuario").val(),
            opcion: "1"
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
              icon: "error",
              title: '',
              text: "Ocurrió un error interno"
            });
            console.log(request.responseText + " " + error);
          }
        });
      });

      $(document).delegate(".iconoPerUsu ", "click", function(e) {
        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>/admin/accion_indicador_usuario",
          dataType: 'json',
          data: {
            idindicador: $(this).attr("id"),
            idusuario: $("#txtValUsuario").val(),
            opcion: "2"
          },
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

      });


      $(".btnMasOp").click(function() {
        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>/admin/accion_indicador_usuario",
          dataType: 'json',
          data: {
            idindicador: "0",
            idusuario: $("#txtValUsuario").val(),
            opcion: $(this).attr("id")
          },
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
      });






    });
  </script>
