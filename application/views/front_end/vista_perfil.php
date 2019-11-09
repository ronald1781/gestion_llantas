<section clase="container">
    <script type="text/javascript">
        //var nuevoalias = jQuery.noConflict();
        var save_method; //for save method string
        var table;

        $(document).ready(function () {
            table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "control_perfil/ajax_list",
                    "type": "POST"
                },
                "columnDefs": [
                    {
                        "targets": [-1],
                        "orderable": false,
                    },
                ],
            });


        });

        function add_person()
        {
            save_method = 'add';
            $('#formrgmkflt')[0].reset();
            $('#modal_form').modal('show');
            $('.modal-title').text('Agregar Marca');
        }

        function edit_person(id)
        {
            save_method = 'update';
            $('#formrgmkflt')[0].reset();

            $.ajax({
                url: "control_marca/llan_ajax_edit/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data)
                {
                    $('[name="codmar"]').val(data.codmar);
                    $('[name="nommar"]').val(data.nommar);
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar Marca');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function reload_table()
        {
            table.ajax.reload(null, false); //reload datatable ajax
        }

        function save()
        {
            var url;
            if (save_method == 'add')

            {
                nommk = $("#nommar").val();
                if (nommk == '') {
                    alert("Ingrese Marca de llanta");
                    $("#nommar").focus();
                    return false;
                }
                url = "control_marca/llan_ajax_add";
            }
            else
            {
                url = "control_marca/llan_ajax_update";
            }

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#formrgmkflt').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    //if success close modal and reload ajax table
                    $('#modal_form').modal('hide');
                    alert('Datos Registrados ' + data.status);
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error con los datos Ingresados ... :' + textStatus);
                }
            });
        }

        function delete_person(id)
        {
            if (confirm('Esta Seguro de Eliminar Este Dato?'))
            {
                // ajax delete data to database
                $.ajax({
                    url: "control_marca/llan_ajax_delete/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data)

                    {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        alert('Dato Eliminado :' + data.status);
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error en la eliminacion :' + textStatus);
                    }
                });

            }
        }

    </script>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"> <p align="right">
                    <!--<button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Registrar Marca</button>-->
                </p>
            </div>
            <div class="panel-body">

                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Perfil</th> 
                            <th>Menu</th>  
                           
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                        <tr>
                           <th>Perfil</th> 
                            <th>Menu</th> 
                         
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- Bootstrap modal -->
        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Registro Marca Flota</h3>
                    </div>
                    <div class="modal-body form">
                        <form  id="formrgmkflt" class="form-horizontal" action="javascript:void(0)" >
                            <input type="hidden" value="" name="codmar"/>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nombre</label>
                                    <div class="col-md-9">
                                        <input name="nommar" id="nommar" required placeholder="Nombre Marca" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Bootstrap modal -->
    </div>
</section>
