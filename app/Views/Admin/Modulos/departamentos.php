<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col-8 col-sm-6 col-md-8 col-lg-4 grid-margin text-center justify-content-center align-self-center">
                <div class="d-flex">
                    <div>
                        <h3 class="font-weight-bold mb-0">Departamentos</h3>
                    </div>
                </div>
            </div>

            <div class="col-4 col-sm-6 col-md-4 offset-lg-4 grid-margin text-right">
                <div class="d-flex d-flex justify-content-end ">
                    <div>
                        <button type="button" class="btn btn-primary btn-rounded btn-fw btn-icon-text btnNuevoDepartamento" data-toggle="modal" data-target="#accion_depa">
                            <i class="ti-plus btn-icon-prepend"></i>
                            Nuevo
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div id="no-more-tables" style="width: 100%;">
                <table class="col-md-12 table-bordered table-striped table-condensed cf" id="departamento_table">
                    <thead class="cf">
                        <tr>
                            <th>Id</th>
                            <th>Departamento</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($listas_departamentos) : ?>
                            <?php foreach ($listas_departamentos as $value) : ?>
                                <tr>
                                    <td id="textoIdDepartamento" data-title="Id"><?php echo $value['iddepartamento']; ?></td>
                                    <td id="textoDepartamento" data-title="Departamento"><?php echo $value['departamento']; ?></td>
                                    <td id="textoEstado" data-id="<?php echo $value['estado']; ?>" data-title="Estado"><?php echo ($value['estado'] == 1) ? 'Activo' : 'Inactivo'; ?></td>
                                    <td data-title="Acción">
                                        <button type="button" id="<?php echo $value['iddepartamento']; ?>" class="btn btn-warning btn-rounded btn-fw btnEditarDepartamento" data-toggle="modal" data-target="#accion_depa"><i class="ti-pencil-alt btn-icon-prepend"></i>Editar</button>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="accion_depa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar departamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmdepartamento" name="frmdepartamento">

                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="laIndi">Departamento: *</label>
                                <input type="text" class="form-control" id="txtDepartamento" name="txtDepartamento">
                                <input type="hidden" class="form-control" id="txtIdDepartamento" name="txtIdDepartamento">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="laCod">Estado : *</label>
                                <select name="txtEstado" id="txtEstado" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-center">
                            <button type="button" id="btnGuardarDepartamento" class="btn btn-success btn-rounded btn-fw uniceq-color"><i class="ti-save iconoLib"></i>Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


</div>
</div>



<script>
    $(document).ready(function() {
        $('#departamento_table').DataTable();

        $(".btnNuevoDepartamento").click(function() {
            $("#accion_depa").find("input").val('');
            $("#accion_depa").find("select").val('1');
        });


        $(document).delegate(".btnEditarDepartamento", "click", function(e) {
            $("#txtEstado").val($(this).closest("tr").find("#textoEstado").attr("data-id"));
            $("#txtDepartamento").val($(this).closest("tr").find("#textoDepartamento").text());
            $("#txtIdDepartamento").val($(this).closest("tr").find("#textoIdDepartamento").text());

        });


        $("#btnGuardarDepartamento").click(function(event) {
            var formulario = $('#frmdepartamento').serialize();

            if ($('#txtDepartamento').val().trim().length > 0) {

                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>/admin/accion_departamento",
                    dataType: 'json',
                    data: formulario,
                    beforeSend: function() {
                        $(".panelLoading").fadeIn(1000);
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: data[1],
                            title: '',
                            text: data[0]
                        }).then(function() {
                            location.reload();
                        });
                        $(".panelLoading").fadeOut(1000);
                    },
                    error: function(request, status, error) {
                        alert(request.responseText + " " + error);
                        $(".panelLoading").fadeOut(1000);
                    }
                });
            }

        });

    });
</script>