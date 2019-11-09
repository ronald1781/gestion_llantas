
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
        $('#table').DataTable();
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
                    <li><a href="rgstllan"  title="Compra Llanta"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></li>
                    <li class="active"><a href="listcmpllan"  title="Lista compra llanta"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a></li>
                    <li><a href="listllan"  title="Lista de llanta"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
                </ul>
                <p>Lista de Compra llantas</p>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered" cellspacing="0" width="100%">
                        <thead><tr class="active"><th>Nro</th><th>Compra</th><th>Proveedor</th><th>Documento</th><th>Numero</th><th>Fecha</th><th>Importe</th><th>Accion</th></tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($listacpl) {
                                $conta = 0;
                                for ($d = 0; $d < count($listacpl); $d++) {
                                    $conta = $conta + 1;
                                    $cad = $listacpl[$d];
                                    $codicmp = $cad['codicmp'];
                                    $codcmp = $cad['codcmp'];
                                    $nrodocper = $cad['nrodocper'];
                                    $rassocper = $cad['rassocper'];
                                    $comproban = $cad['comproban'];
                                    $nrodoccmp = $cad['nrodoccmp'];
                                    $str = $cad['fcmp'];
                                    $fcmp=date("d/m/Y", strtotime($str));
                                    $subtotacmp = $cad['subtotacmp'];
                                    $igvcmp = $cad['igvcmp'];
                                    $totacmp = $cad['totacmp'];
                                    ?>
                                    <tr>       
                                        <td><?php echo $conta; ?></td>
                                        <td><?php echo $codcmp; ?></td>
                                        <td><?php echo $rassocper; ?></td> 
                                        <td><?php echo $comproban; ?></td>                                        
                                        <td><?php echo $nrodoccmp; ?></td>
                                        <td><?php echo $fcmp; ?></td> 
                                        <td><?php echo $totacmp; ?></td>
                                        <td align="center">
                                            <a class="btn btn-info" href="detacmpllan/<?php echo $codicmp; ?>"  title="Adenter"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></a>
                                            <!-- <a onclick="if (confirma() == false)
                                                                 return false"  class="btn btn-danger" href="cancelar/pedido/<?php echo $codicmp; ?>"  title="Anular"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
                                            -->
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>       
                                    <TD align="center" colspan="8">no hay Datos para mostrar</TD></tr>
                            <?php } ?>                         </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div> 
</section>
