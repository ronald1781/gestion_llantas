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
        $('#tablelstll').DataTable();


        var mrkflota = $.ajax({
            url: 'control_llanta/getmrkllanta',
            type: 'post',
            dataType: 'json',
            async: false,
        }).responseText;
        mrkflota = JSON.parse(mrkflota);
        var listamrkflota = mrkflota.lista;
        var str = '<select name="selemrkl" required id="selemrkl" class="form-control" onchange="getModel(this.value)">';
        str += '<option value="">--Seleccione--</option>';
        if (listamrkflota != 0) {
            var cad = listamrkflota.split("&&&");
            var num = cad.length;
            for (e = 0; e < num; e++) {
                dat = cad[e].split("#$#");
                codtipflot = dat[0];
                nomtipflot = dat[1];
                str += '<option value="' + codtipflot + '">' + nomtipflot + '</option>';
            }
        } else {
            str += '<option value="0">No hay resultados</option>';
        }
        str += '</select>';
        $('#selemrkl').html(str);
        var tipoflota = $.ajax({
                url: 'control_flota/getTipFlota',
                type: 'post',
                dataType: 'json',
                async: false,
            }).responseText;
            tipoflota = JSON.parse(tipoflota);
            var listaflota = tipoflota.lista;
            var str = '<select name="seletp" required id="seletp" class="form-control">';
            str += '<option value="">--Seleccione--</option>';
            if (listaflota != 0) {
                var cad = listaflota.split("&&&");
                var num = cad.length;
                for (e = 0; e < num; e++) {
                    dat = cad[e].split("#$#");
                    codtipflot = dat[0];
                    nomtipflot = dat[1];
                    str += '<option value="' + codtipflot + '">' + nomtipflot + '</option>';
                }
            } else {
                str += '<option value="0">No hay resultados</option>';
            }
            str += '</select>';
            $('#seletp').html(str);

        $("#btnaddllan").click(function (e) {
            e.preventDefault();
            var condillan = $("#condillan").val();
            if (condillan == '') {
                $("#condillan").focus();
                alertify.alert("Falta condicion llanta", function () {
                    alertify.error('debe ingresar Kilometraje');
                });
                return false;
            }

            alertify.confirm("Esta seguro de desmontar la llanta ", function (e) {
                if (e) {
                    set_inspectllant_vehi();
                    alertify.success("Se procede con el desmontaje de llanta.");
                } else {
                    alertify.error("Se cancelo el desmontaje de llanta");
                }
            }, function () {
                alertify.error("Se cancelo el montaje")
            });
            return false;
        });

    });
    function reg_nroser_llanta(textarea, coditem, coddata) {
        var nroserllan = textarea;
        var codllan = coddata;
        if (nroserllan == '') {
            alert("debe ingresar datos a Buscar");
            $("#txtnroser").focus();
            return false;
        }
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "control_llanta/save_nroser_llanta",
            cache: false,
            data: {codllan: codllan,
                nroserllan: nroserllan,
            },
            success: function (resp) {
                alert(resp);
                window.location.href = "listllan";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }

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


    function data_nroser_llanta(e, textarea, coditem, coddata) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) { //Enter keycode
            reg_nroser_llanta(textarea, coditem, coddata);

        }
    }
    function getModel(id) {
        $.ajax({
            type: 'POST',
            url: 'control_llanta/getModLlanta',
            data: {id: id},
            dataType: 'json',
            success: function (json) {
                lista = json.lista;
                str = '<select name="selemodl" required id="selemodl" class="form-control">';

                if (lista != 0) {
                    str = '<option selected="true" value="">--ConDatos--</option>';
                    cad = lista.split("&&&");
                    num = cad.length;
                    for (e = 0; e < num; e++) {
                        dat = cad[e].split("#$#");
                        codserv = dat[0];
                        nomserv = dat[1];
                        str += '<option value="' + codserv + '">' + nomserv + '</option>';
                    }
                } else {
                    str += '<option value="0">No hay resultados</option>';
                    $('#selemedl').html(str);
                }
                str += '</select>';
                $('#selemodl').html(str);
                stri += '<option value="0">No hay resultados</option>';
                $('#selemedl').html(stri);
            }
        });
    }
    function getMedilla(id) {
        $.ajax({
            type: 'POST',
            url: 'control_llanta/getMedLlanta',
            data: {id: id},
            dataType: 'json',
            success: function (json) {
                lista = json.lista;
                str = '<select name="selemedl" required id="selemedl" class="form-control">';
                if (lista != 0) {
                    str = '<option selected="true" value="">--ConDatos--</option>';
                    cad = lista.split("&&&");
                    num = cad.length;
                    for (e = 0; e < num; e++) {
                        dat = cad[e].split("#$#");
                        codserv = dat[0];
                        nomserv = dat[1];
                        str += '<option value="' + codserv + '">' + nomserv + '</option>';
                    }
                } else {
                    str += '<option value="0">No hay resultados</option>';
                }
                str += '</select>';
                $('#selemedl').html(str);
            }
        });
    }
    function getModel(id) {
        $.ajax({
            type: 'POST',
            url: 'control_llanta/getModLlanta',
            data: {id: id},
            dataType: 'json',
            success: function (json) {
                lista = json.lista;
                str = '<select name="selemodl" required id="selemodl" class="form-control">';

                if (lista != 0) {
                    str = '<option selected="true" value="">--ConDatos--</option>';
                    cad = lista.split("&&&");
                    num = cad.length;
                    for (e = 0; e < num; e++) {
                        dat = cad[e].split("#$#");
                        codserv = dat[0];
                        nomserv = dat[1];
                        str += '<option value="' + codserv + '">' + nomserv + '</option>';
                    }
                } else {
                    str += '<option value="0">No hay resultados</option>';
                    $('#selemedl').html(str);
                }
                str += '</select>';
                $('#selemodl').html(str);
                stri += '<option value="0">No hay resultados</option>';
                $('#selemedl').html(stri);
            }
        });
    }
    function set_addllant_invent() {
        $.ajax({
            type: 'POST',
            data: $('#forispllan').serialize(),
            url: "control_llanta/set_addllant_invent",
            success: function (msj) {
                var valorrsp = JSON.parse(msj);
                var valorrspt = parseInt(valorrsp.existe);
                if (valorrspt == 2) {
                    get_llanta();
                    get_llanta_vehi();
                    var dato = JSON.parse(msj);
                    alertify.alert(dato.msg, function () {
                        alertify.error(dato.msg);
                    });
                    jQuery.fn.reset = function () {
                        $(this).each(function () {
                            this.reset();
                        });
                    };
                    $("#forispllan").reset();
                } else {
                    get_llanta();
                    get_llanta_vehi();
                    var dato = JSON.parse(msj);
                    alertify.alert(dato.msg, function () {
                        alertify.success(dato.msg);
                    });
                    jQuery.fn.reset = function () {
                        $(this).each(function () {
                            this.reset();
                        });
                    };
                    $("#forispllan").reset();
                    $("#Modalinspecllan").modal('hide');
                }
            }, error: function (xhr, ajaxOptions, thrownError) {

            }
        });
    }
</script>
<section clase="container">
    <div class="row">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading clearfix">
                <div class="btn-group pull-left">
                    <ul class="nav nav-tabs">
                        <li><a href="rgstllan"  title="Compra Llanta"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></li>
                        <li><a href="listcmpllan"  title="Lista compra llanta"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a></li>
                        <li class="active"><a href="listllan"  title="Lista de llanta"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
                    </ul>
                    <!--  <a href="#" class="btn btn-default btn-sm">## Move</a>-->
                </div>
                <h4 class="panel-title pull-right" style="padding-top: 7.5px;">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mdaddllantinv"  title="Agregar llanta inventario"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<i class="fa fa-empire" aria-hidden="true"></i></button>
                </h4>

            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table id="tablelstll" class="table table-bordered" cellspacing="0" width="100%">
                        <thead><tr class="active"><th>Nro</th><th>Codigo</th><th>Condicion</th><th>Nro Serie</th><th>Marca</th><th>Modelo</th><th>Medida</th><th>Remanente</th><th>Estado</th><th>Accion</th></tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($listallan) {
                                $conta = 0;
                                for ($d = 0; $d < count($listallan); $d++) {
                                    $conta = $conta + 1;
                                    $cad = $listallan[$d];
                                    $codllan = $cad['codllan'];
                                    $codillan = $cad['codillan'];
                                    $condillan = $cad['condillan'];
                                    switch ($condillan) {
                                        case 'N':
                                            $condillan = 'Nuevo';
                                            break;
                                        default:
                                            $condillan = 'Rencaunchado';
                                            break;
                                    }
                                    $nrosrllan = $cad['nrosrllan'];
                                    $nommrkllan = strtoupper($cad['nommrkllan']);
                                    $nommod = $cad['nommod'];
                                    $nommedi = $cad['nommedi'];
                                    $remallan = $cad['remallan'];
                                    $estllan = $cad['estllan'];
                                    switch ($estllan) {
                                        case 'D':
                                            $estllan = 'Disponible';
                                            break;
                                        case 'M':
                                            $estllan = 'Actividad';
                                            break;
                                        case 'A':
                                            $estllan = 'Descarte';
                                            break;
                                        case 'R':
                                            $estllan = 'Reforma';
                                            break;
                                        default:
                                            $estllan = 'Averiado';
                                            break;
                                    }
                                    $estllantb = $cad['estllan'];
                                    switch ($estllantb) {
                                        case 'D':
                                            $clastr = '';
                                            break;
                                        case 'M':
                                            $clastr = 'class="info"';
                                            break;
                                        case 'A':
                                            $clastr = 'class="danger"';
                                            break;
                                        case 'R':
                                            $clastr = 'class="warning"';
                                            break;
                                    }
                                    ?>
                                    <tr <?php echo $clastr; ?>> 
                                <input type="hidden"  name="txtid" id="txtid" value=" <?php echo $conta; ?>" >
                                <td><?php echo $conta; ?><input type="hidden"  name="txtcodllan<?php echo $conta; ?>" id="txtcodllan<?php echo $conta; ?>" value="<?php echo $codllan; ?>" ></td>
                                <td><?php echo $codillan; ?></td>
                                <td><?php echo $condillan; ?></td> 
                                <td style="text-align: center; width:5%">   <?php if ($nrosrllan == '') { ?>  <input type="text" class="form-control" name="txtnroser<?php echo $conta; ?>" requerid id="txtnroser<?php echo $conta; ?>" value="<?php echo $nrosrllan; ?>"  onKeyPress="data_nroser_llanta(event, this.value, '<?php echo $conta; ?>', '<?php echo $codllan; ?>');">
                                        <?php
                                    } else {
                                        echo $nrosrllan;
                                    }
                                    ?></td>                                        
                                <td><?php echo $nommrkllan; ?></td>
                                <td style="text-align: center; width:20%"><?php echo $nommod; ?></td> 
                                <td><?php echo $nommedi; ?></td>
                                <td><span class="label label-success"><?php echo $remallan; ?></span></td>
                                <td><?php echo $estllan; ?></td>
                                <td align="center">
                                    <a class="btn btn-success" href="editarlnt/<?php echo $codllan; ?>"  title="Adenter"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                    <!-- <a onclick="if (confirma() == false)
                                                         return false"  class="btn btn-danger" href="cancelar/pedido/<php echo $codllan; ?>"  title="Anular"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
                                    -->
                                </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>       
                                <td align="center" colspan="10">no hay Datos para mostrar</td></tr>
                        <?php } ?>                         </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div> 

    <div class="modal fade" id="mdaddllantinv" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Agregar Llanta Inventario</h3>
                    <?php
                    date_default_timezone_set('America/Lima');
                    ?>
                </div>
                <form action="#" id="form_addllan" class="form-horizontal" method="post"  enctype="multipart/form-data" autocomplete="">
                    <div class="modal-body form">
                        <div class="form-body">
                            <div class="form-group">
                                <label for="inputEquip" class="col-sm-2 control-label">Condicion</label>
                                <div class="col-sm-10">									
                                    <select name="condillan" id="condillan" class="form-control" style="width:50%; float:left" >
                                        <option selected="" value="N">Nuevo</option>
                                        <option value="R">Rencauchado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="selemar" class="col-sm-2 control-label">Marca</label>
                                <div class="col-sm-10">
                                    <select name="selemrkl" id="selemrkl" class="form-control" style="width:50%; float:left" onchange="getModel(this.value)"> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apepat" class="col-sm-2 control-label">Modelo</label>
                                <div class="col-sm-10">
                                    <select name="selemodl" id="selemodl" class="form-control" style="width:50%; float:left" onchange="getMedilla(this.value)"> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apepat" class="col-sm-2 control-label">Medida</label>
                                <div class="col-sm-10">
                                    <select name="selemedl" id="selemedl" class="form-control" style="width:50%; float:left"> 
                                    </select>
                                </div>
                            </div>  
                             <div class="form-group">
                                <label for="apepat" class="col-sm-2 control-label">Aplicacion</label>
                                <div class="col-sm-10">
                                    <select name="seletp" id="seletp" class="form-control" style="width:50%; float:left"> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apepat" class="col-sm-2 control-label">Kilometraje</label>
                                <div class="col-sm-10">
                                    <input type="text" name="txtkmllan" id="txtkmllan" class="form-control" style="width:50%; float:left"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apepat" class="col-sm-2 control-label">Presion</label>
                                <div class="col-sm-10">
                                    <input type="text" name="txtprellan" id="txtprellan" class="form-control" style="width:50%; float:left"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apepat" class="col-sm-2 control-label">Serie</label>
                                <div class="col-sm-10">
                                    <input type="text" name="txtserllan" id="txtserllan" class="form-control" style="width:50%; float:left"> 
                                </div>
                            </div>
                        </div>					
                        <div class="showImage"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btnaddllan" name="btnaddllan"><i class="fa fa-eyedropper" aria-hidden="true"></i>&nbsp;Grabar</button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- /.modal -->
</section>


