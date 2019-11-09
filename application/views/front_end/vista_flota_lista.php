<script type="text/javascript">
    function confirma() {
        if (confirm("¿Realmente desea Anulado?")) {
            alert("El registro ha sido Anulado.")
        }
        else {
            return false
        }
    }
    var save_method; //for save method string
    var table;
    $(document).ready(function () {
        $('#tablelstfl').DataTable();
    });
    function add_person()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Agregar Error'); // Set Title to Bootstrap modal title
    }

    function edit_person(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "utilitarios_control/ajax_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="coderr"]').val(data.coderr);
                $('[name="nomerr"]').val(data.nomerr);
                $('[name="obserr"]').val(data.obserr);


                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Editar Error'); // Set title to Bootstrap modal title

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
            url = "utilitarios_control/ajax_add";
        }
        else
        {
            url = "utilitarios_control/ajax_update";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data)
            {
                //if success close modal and reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function delete_person(id)
    {
        if (confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url: "utilitarios_control/ajax_delete/" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });

        }
    }
</script>
<section clase="container">
    <div class="row">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li><a href="rgtflota"  title="Registrar Flota"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></li>
                    <li class="active"><a href="lstflota"  title="Lista Flota"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a></li>
                </ul>
                <p>Lista de Flota</p>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="tablelstfl" class="table table-bordered" cellspacing="0" width="100%">
                        <thead><tr class="active"><th>Nro</th><th>Placa</th><th>Codigo</th><th>Tipo</th><th>Marca</th><th>Modelo</th><th>Configuracion</th><th>Ejes</th><th>Llantas</th><th>Repuesto</th><th>Kilometraje</th><th>Año</th><th>Estado</th><th>Accion</th></tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($listaflota) {
                                $conta = 0;
                                for ($d = 0; $d < count($listaflota); $d++) {
                                    $conta = $conta + 1;
                                    $cad = $listaflota[$d];
                                    $codflt = $cad['codflt'];
                                    $plaflt = $cad['plaflt'];
                                    $cdintflt = $cad['cdintflt'];
                                    $nommlttb = $cad['nommlttb'];
                                    $nommar = $cad['nommar'];
                                    $modflt = $cad['modflt'];
                                    $cfgflt = $cad['cfgflt'];
                                    $ejeflt = $cad['ejeflt'];
                                    $neoflt = $cad['neoflt'];
                                    $neorpsflt = $cad['neorpsflt'];
                                    $kmflt = $cad['kmflt'];
                                    $aniflt = $cad['aniflt'];
                                    $estflt = $cad['estflt'];
                                    ?>
                                    <tr>       
                                        <td><?php echo $conta; ?></td>
                                        <td><?php echo $plaflt; ?></td>
                                        <td><?php echo $cdintflt; ?></td> 
                                        <td><?php echo $nommlttb; ?></td>                                        
                                        <td><?php echo $nommar; ?></td>
                                        <td><?php echo $modflt; ?></td> 
                                        <td><?php echo $cfgflt; ?></td>
                                        <td><?php echo $ejeflt; ?></td>
                                        <td><?php echo $neoflt; ?></td>
                                        <td><?php echo $neorpsflt; ?></td>
                                        <td><?php echo $kmflt; ?></td>
                                        <td><?php echo $aniflt; ?></td>
                                        <td><?php echo $estflt; ?></td>

                                        <td align="center">
                                            <div class="dropdown">
                                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-sign-in" aria-hidden="true"></i>
                                                    <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Editar</a></li>                                                           
                                                    <li><a href="movillanta/<?php echo $plaflt;?>"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp;Llantas</a></li>
                                                    <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Eliminar</a></li>
                                                </ul>
                                            </div>
                                            <!--
                                            <a class="btn btn-success" href="editarlnt/<php echo $codllan; ?>"  title="Adenter"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                             <a onclick="if (confirma() == false)
                                                                 return false"  class="btn btn-danger" href="cancelar/pedido/<?php echo $codllan; ?>"  title="Anular"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
                                            -->
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>       
                                    <td align="center" colspan="14">no hay Datos para mostrar</td></tr>
                            <?php } ?>                         </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div> 
</section>


