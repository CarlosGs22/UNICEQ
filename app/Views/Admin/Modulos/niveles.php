<!-- partial -->

<div class="main-panel">

    <div class="content-wrapper">

        <div class="row ">

            <div class="col-8 col-sm-6 col-md-8 col-lg-4 grid-margin text-center justify-content-center align-self-center">

                <div class="d-flex">

                    <div>

                        <h3 class="font-weight-bold mb-0">Niveles BSC</h3>

                    </div>

                </div>

            </div>



            <div class="col-4 col-sm-6 col-md-4 offset-lg-4 grid-margin text-right">

                <div class="d-flex d-flex justify-content-end ">

                    <div>

                        <button type="button" class="btn btn-primary btn-rounded btn-fw btn-icon-text btnNuevoNivel" data-toggle="modal" data-target="#accion_nivel">

                            <i class="ti-plus btn-icon-prepend"></i>

                            Nuevo

                        </button>

                    </div>

                </div>

            </div>

        </div>



        <div class="row">



            <?php

            if ($listas_niveles) {

                foreach ($listas_niveles as $key => $value) {

            ?>

                    <div class="col-6 col-sm-6 col-md-3 col-lg-3" style="margin-bottom: 15px;">

                        <div class="card border-danger mx-sm-1 p-3">

                            <div id="<?php echo $value["estado"] ?>" class="card border-danger shadow text-danger p-3 my-card claseEstado"><i class="<?php echo ($value["estado"] == 1) ? 'ti-check' : 'ti-close btn-icon-prepend'; ?> text-center"></i></div>

                            <div class="text-danger text-center mt-3">

                                <h4 id="textoNivel"><?php echo $value['niveles'] ?></h4>

                            </div>

                            <div class="text-danger text-center mt-2">

                                <button type="button" id="<?php echo $value["idniveles"]; ?>" class="btn btn-warning btn-rounded btn-fw btnEditarNivel" data-toggle="modal" data-target="#accion_nivel"><i class="ti-pencil-alt btn-icon-prepend"></i>Editar</button>

                            </div>

                        </div>

                    </div>



            <?php }

            } ?>

        </div>

    </div>







    <footer class="footer">

        <div class="d-sm-flex justify-content-center justify-content-sm-between">

            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Derechos reservados UNICEQ 2021</span>

        </div>

    </footer>



    <div class="modal fade" id="accion_nivel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-md" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Registrar nivel BSC</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <form id="formnivel" name="formnivel">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="formGroupExampleInput">Área</label>

                                    <input type="text" class="form-control" id="txtNivel" name="txtNivel" placeholder="Nombre">

                                    <input type="hidden" class="form-control" id="txtIdNivel" name="txtIdNivel">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="formGroupExampleInput">estado</label>

                                    <select name="txtEstado" id="txtEstado" class="form-control">

                                        <option value="1">Activo</option>

                                        <option value="0">Inactivo</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col text-center">

                                <button type="button" class="btn btn-success btn-rounded btn-fw btn-icon-text btnGuardarNivel">

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



</div>





<script>

    $(function() {





        $(".btnNuevoNivel").click(function() {

            $('#formnivel input').val("");

            $('#formnivel selet').val("1");

        });





        $(".btnEditarNivel").click(function() {

            $("#txtNivel").val($(this).closest(".card").find("#textoNivel").text());

            $("#txtEstado").val($(this).closest(".card").find(".claseEstado").attr("id"));

            $("#txtIdNivel").val($(this).attr("id"));

        });



        $(".btnGuardarNivel").click(function() {

            var formulario = $('#formnivel').serialize();



            if ($('#txtNivel').val().trim().length > 0 && $('#txtIdNivel').val() !== undefined) {

                $.ajax({

                    type: "POST",

                    url: "<?= base_url() ?>/admin/accion_nivel",

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

            } else {

                Swal.fire({

                    icon: "error",

                    title: '',

                    text: "Todos los campos son requeridos"

                });



            }



        });

    });

</script>