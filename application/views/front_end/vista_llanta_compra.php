<style>
    .selected{
        cursor: pointer;
    }
    .selected:hover{
        background-color: #0585C0;
        color: white;
    }
    .seleccionada{
        background-color: #0585C0;
        color: white;
    }
</style>
<script type="text/javascript">
    $("#fechacomp").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy/mm/dd"
    });
    var lst_compra = new Array();
    $(document).ready(function () {

        //***//
        $("#btnGuardarcmpllta").click(function (e) {
            e.preventDefault();
            var seleprove = $("#seleprove").val();
            if (seleprove == '') {
                $("#seleprove").focus();
                return false;
            }
            var selepgo = $("#selepgo").val();
            if (selepgo == '') {
                $("#selepgo").focus();
                return false;
            }
            var txtndocu = $("#txtndocu").val();
            if (txtndocu == '') {
                $("#txtndocu").focus();
                return false;
            }

            var miJSON = JSON.stringify(lst_compra);
            //alert(miJSON);
            $('#imgLoader').show();
            $.ajax({
                type: 'POST',
                data: $('#frmaddcmpllta').serialize() + '&lst_compra=' + miJSON,
                url: 'control_llanta/save_compra_llanta',
                success: function (msj) {

                    if (parseInt(msj) == 2) {
                        $('#msj_nodata').modal('show');
                        jQuery.fn.reset = function () {
                            $(this).each(function () {
                                this.reset();
                            });
                        };
                        $("#frmaddcmpllta").reset();
                    } else {
                        (parseInt(msj) == 1)
                        $('#msj_grabo').modal('show');
                        jQuery.fn.reset = function () {
                            $(this).each(function () {
                                this.reset();
                            });
                        };
                        $("#frmaddcmpllta").reset();
                        var url = 'rgstllan';
                        window.location.href = url;
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {

                    $('#msj_error .modal-body').html(thrownError + " " + xhr.status + " Sin detalle agregar - si persiste contactese con TI"),
                            $('#msj_error').modal('show');
                }

            });
            return false;
        });
        //**Buscar Proveedor**///

        var listaprove = $.ajax({
            url: 'control_llanta/getLstProveedor',
            type: 'post',
            dataType: 'json',
            async: false,
        }).responseText;
        listaprove = JSON.parse(listaprove);
        var listaprovee = listaprove.lista;
        var str = '<select name="seleprove" required id="seleprove" class="form-control lstprov">';
        str += '<option value="">--Seleccione--</option>';
        if (listaprovee != 0) {
            var cad = listaprovee.split("&&&");
            var num = cad.length;
            for (e = 0; e < num; e++) {
                dat = cad[e].split("#$#");
                codtipflot = dat[0];
                nomtipflot = dat[1];
                nrodocper = dat[2];
                str += '<option value="' + codtipflot + '">' + nrodocper + ' ' + nomtipflot + '</option>';
            }
        } else {
            str += '<option value="0">No hay resultados</option>';
        }
        str += '</select>';
        $('#seleprove').html(str);

        //Cimprobantes// 
        var listacomp = $.ajax({
            url: 'control_llanta/getListacomproba',
            type: 'post',
            dataType: 'json',
            async: false,
        }).responseText;
        listacomp = JSON.parse(listacomp);
        var listacompro = listacomp.lista;
        var str = '<select name="selepgo" required id="selepgo" class="form-control">';
        str += '<option value="">--Seleccione--</option>';
        if (listacompro != 0) {
            var cad = listacompro.split("&&&");
            var num = cad.length;
            for (e = 0; e < num; e++) {
                dat = cad[e].split("#$#");
                codmlttb = dat[0];
                nommlttb = dat[1];
                str += '<option value="' + codmlttb + '">' + nommlttb + '</option>';
            }
        } else {
            str += '<option value="0">No hay resultados</option>';
        }
        str += '</select>';
        $('#selepgo').html(str);

        /*
         MARCA LLANTA
         */
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
        $("#btnGuardar").click(function (e) {
            e.preventDefault();
            var miJSON = JSON.stringify(lst_compra);
            //alert(miJSON);
            $('#imgLoader').show();
            $.ajax({
                type: 'POST',
                data: $('#foraddcomp').serialize() + '&lst_compra=' + miJSON,
                url: 'compra_control/registrar_compra',
                success: function (msj) {
                    if (parseInt(msj) == 2) {
                        $('#msj_nodata').modal('show');
                        jQuery.fn.reset = function () {
                            $(this).each(function () {
                                this.reset();
                            });
                        };
                        $("#foraddcomp").reset();
                    } else {
                        (parseInt(msj) == 1)
                        $('#msj_grabo').modal('show');
                        jQuery.fn.reset = function () {
                            $(this).each(function () {
                                this.reset();
                            });
                        };
                        $("#foraddcomp").reset();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#msj_error .modal-body').html(thrownError + " " + xhr.status + " Sin detalle agregar - si persiste contactese con TI"),
                            $('#msj_error').modal('show');
                }
            });
            return false;
        });
    });
    function listarCompra() {
        var compra = {};
        var condi = $("#condillan").val();
        var codmkl = $("#selemrkl").val();
        var nommkl = $("#selemrkl option:selected").text();
        var codmod = $("#selemodl").val();
        var nomodel = $("#selemodl option:selected").text();
        var codmed = $("#selemedl").val();
        var nommed = $("#selemedl option:selected").text();
        var prec = $("#txtimpo").val();
        var cant = $("#txtcant").val();
        var impo = ($("#txtcant").val() * $("#txtimpo").val()).toFixed(2);
        compra.condi = condi;
        compra.codmkl = codmkl;
        compra.nommkl = nommkl;
        compra.codmod = codmod;
        compra.nomodel = nomodel;
        compra.codmed = codmed;
        compra.nomedi = nommed;
        compra.prec = prec;
        compra.cant = cant;
        compra.impo = impo;

        var montos = 0.0;

        lst_compra.push(compra);
        $("#lstTabla").show();

        var tablas1 = $("#lstTabla");
        tablas1.find("table").remove();
        tablas1.append('<table class="table table-bordered"><thead><tr><th>#</th><th>Cond.</th><th>Marca</th><th>Modelo</th><th>Medida</th><th>Precio</th><th>Cantidad</th><th>Importe</th><th> Accion</th></tr></thead></table>');
        var tbody = $('<tbody></tbody>');
        jQuery.each(lst_compra, function (i, value) {
            cont = i + 1;
            tbody.append('<tr><td style="text-align: center;">' + cont +
                    '<input type="hidden"  name=codimark value=["codmkl"]/>' +
                    '<input type="hidden"  name=codimod value=["codmod"]/>' +
                    '<input type="hidden"  name=codimed value=["codmed"]/>' +
                    '</td><td style="text-align: center;">' + value["condi"] +
                    '</td><td style="text-align: center;">' + value["nommkl"] +
                    '</td><td style="text-align: center;">' + value["nomodel"] +
                    '</td><td style="text-align: center;">' + value["nomedi"] +
                    '</td><td style="text-align: center;">' + value["prec"] +
                    '</td><td style="text-align: center;">' + value["cant"] +
                    '</td><td style="text-align: center;">' + value["impo"] +
                    '</td><td class="actions">' +
                    '<div class="btn-group"><a onclick="del_listarCompra(' + i + ');" class="btn btn-mini deleteRow"> Eliminar' +
                    '</a></div></td></tr>'
                    );
            montos = montos + parseFloat(value["impo"])
        });



        calcular_pago(montos);
        tablas1.find("table").append(tbody);
        $("#selemrkl").val('');
        $("#txtmode").val('');
        $("#txtmed").val('');
        $("#txtnroprte").val('');
        $("#txtnrorem").val('0');
        $("#txtimpo").val('');
        $("#txtcant").val('');
        $("#txtgrta").val('');
        $("#condillan").focus();
    }
    function del_listarCompra(id) {
        jQuery.each(lst_compra, function (i, value) {
            if (i == id) {
                lst_compra.splice(i, 1);
            }
        });
        $("#lstTabla").show();
        var montos = 0;
        var tablas1 = $("#lstTabla");
        tablas1.find("table").remove();
        tablas1.append('<table class="table table-bordered"><thead><tr><th>#</th><th>Cond.</th><th>Marca</th><th>Modelo</th><th>Medida</th><th>Precio</th><th>Cantidad</th><th>Importe</th><th> Accion</th></tr></thead></table>');
        var tbody = $('<tbody></tbody>');
        jQuery.each(lst_compra, function (i, value) {
            cont = i + 1;
            tbody.append('<tr><td style="text-align: center;">' + cont +
                    '<input type="hidden"  name=codimark value=["codmkl"]/>' +
                    '<input type="hidden"  name=codimod value=["codmod"]/>' +
                    '<input type="hidden"  name=codimed value=["codmed"]/>' +
                    '</td><td style="text-align: center;">' + value["condi"] +
                    '</td><td style="text-align: center;">' + value["nommkl"] +
                    '</td><td style="text-align: center;">' + value["nomodel"] +
                    '</td><td style="text-align: center;">' + value["nomedi"] +
                    '</td><td style="text-align: center;">' + value["nrorem"] +
                    '</td><td style="text-align: center;">' + value["prec"] +
                    '</td><td style="text-align: center;">' + value["cant"] +
                    '</td><td style="text-align: center;">' + value["impo"] +
                    '</td><td class="actions">' +
                    '<div class="btn-group"><a onclick="del_listarCompra(' + i + ');" class="btn btn-mini deleteRow"> Eliminar' +
                    '</a></div></td></tr>'
                    );
            montos = montos + parseFloat(value["impo"])
        });

        calcular_pago(montos);
        tablas1.find("table").append(tbody);
    }

    function calcular_pago(montoTotal) {
        document.getElementById('totApagar').value = parseFloat((montoTotal)).toFixed(2);
        document.getElementById('montoigv').value = (montoTotal * ($("#igv").val() / 100)).toFixed(2);
        document.getElementById('subTotal').value = (montoTotal - document.getElementById('montoigv').value).toFixed(2);
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
    $(function () {
        $('.lstprov').chosen();
    });
    $(function () {
        $("#fechacomp").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        });
    });
</script>
<section clase="container">
    <div class="row">
        <div class="col-md-12"> 
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">                   
                        <li class="active"><a href="rgstllan"  title="Compra Llanta"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></li>
                        <li ><a href="listcmpllan"  title="Lista compra llanta"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a></li>
                        <li><a href="listllan"  title="Lista de llanta"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                    <div class="tab-content">
                        <div class="tab-pane active" id="registro">
                            <form   method="POST" class="form-horizontal" id="frmaddcmpllta" action="" name="frmaddcmpllta" enctype="multipart/form-data">
                                <input type="hidden" name="grabar" value="si" />
                                <div class="row">
                                    <div class="col-md-12">  
                                        <p aling="left">Compra llantas</p>
                                        <p align="right">
                                            <button class="btn btn-info" data-toggle="modal" data-target="#mdaddllant" title="Agregar Llanta"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></button>
                                            <button class="btn btn-primary" id="btnGuardarcmpllta" type="submit" title="Grabar"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></button>
                                            <button type="reset" class='btn btn-danger' title="Cancelar"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></button>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">                                  
                                    <div class="row">               
                                        <div class="col-md-6">                   
                                            <fieldset>                                       
                                                <div class="form-group">
                                                    <label for="inputtEquip" class="col-sm-3 control-label">Proveedor</label>
                                                    <div class="col-sm-9">
                                                        <select name="seleprove" id="seleprove" class="form-control lstprov" style="width:80%; float:left"> 
                                                        </select>
                                                    </div>
                                                </div>

                                                <?php
                                                date_default_timezone_set('UTC');
                                                ?>
                                                <div class="form-group">
                                                    <label for="inputtEquip" class="col-sm-3 control-label">Fecha</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="fechacomp" requerid id="fechacomp"  value="<?php echo date("Y-m-d"); ?>" style="width:80%; float:left">
                                                    </div>
                                                </div>	
                                            </fieldset> 
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset> 

                                                <div class="form-group">
                                                    <label for="inputtEquip" class="col-sm-3 control-label">Documento</label>
                                                    <div class="col-sm-9">
                                                        <select name="selepgo" required id="selepgo" class="form-control" style="width:80%; float:left" > 

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputtEquip" class="col-sm-3 control-label">NroDocumento</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="txtndocu" value="" class="form-control" required id="txtndocu" autofocus placeholder="Numero Documento" onkeyup="this.value = this.value.toUpperCase()" style="width:80%; float:left"  />
                                                    </div>
                                                </div>
                                            </fieldset> 
                                        </div>	
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="lstTabla" class="table-responsive">		
                                                <table class="table table-bordered">
                                                    <thead><tr><th>#</th><th>Cond.</th><th>Marca</th><th>Modelo</th><th>Medida</th><th>Cantidad</th><th>Precio</th><th>Importe</th><th>Accion</th></tr>
                                                    </thead>
                                                </table>
                                            </div>												
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <span class="add-on" >SubTotal:</span><input type="text" class='form-control' name="subTotal" id="subTotal" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <span class="add-on" >IGV:</span><input type="number" class='form-control' min="0.0" max="100.0" step="0.1" value="18.0" name="igv" id="igv" onkeyup="calcular_monto_base_porcentaje();">
                                                    <input type="text" class='form-control' name="montoigv" id="montoigv" readonly><span class="add-on" ></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <span class="add-on" >Total a Pagar:</span><input type="text" class='form-control' name="totApagar" id="totApagar" readonly>
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
    </div>
    <div class="modal fade" id="mdaddllant" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Agregar Llanta</h3>
                    <?php
                    date_default_timezone_set('America/Lima');
                    ?>
                </div>
                <form action="#" id="form_addctr" class="form-horizontal" method="post"  enctype="multipart/form-data" autocomplete="">
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
                                <label for="selemar" class="col-sm-2 control-label">Precio</label>
                                <div class="col-sm-10">
                                    <input type="number" step="any" class="form-control" name="txtimpo" requerid id="txtimpo" placeholder="Importe Llanta" placeholder="Importe Llanta" style="width:50%; float:left" maxlength="15" step="0.01">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="apepat" class="col-sm-2 control-label">Cantidad</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="txtcant" requerid id="txtcant" placeholder="Cantidad Llanta" value="" style="width:50%; float:left"   >
                                </div>
                            </div>					
                        </div>					
                        <div class="showImage"></div>
                        <div class="modal-footer">

                            <input type="button" name="btnagregar" value="Agregar" class="btn btn-primary " onclick="listarCompra()
                                            ;">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- /.modal -->
</section>