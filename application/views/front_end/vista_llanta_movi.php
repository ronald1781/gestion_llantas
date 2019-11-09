<section clase="container">
    <script language="javaScript" >
        $(document).ready(function () {

            $(".btndesmonllan").on('click', function () {
                alert('FASAS');
                //dat = $(this).attr('data-bind');
                //openModaldmtll(dat);
            });
            addnroeje();
            get_llanta();
            get_llanta_vehi();
            get_motivo_montaje_llanta();

            $("#btnmonllan").click(function (e) {
                e.preventDefault();
                var prfllanintmnt = $("#prfllanintmnt").val();
                if (prfllanintmnt == '' || prfllanintmnt == 0) {
                    $("#prfllanintmnt").focus();
                    alertify.alert("Falta Profundidad Interna", function () {
                        alertify.error('debe ingresar Profundidad Interna');
                    });
                    return false;
                }
                var prfllancntmnt = $("#prfllancntmnt").val();
                if (prfllancntmnt == '' || prfllancntmnt == 0) {
                    $("#prfllancntmnt").focus();
                    alertify.alert("Falta ingresar Profundidad Centro", function () {
                        alertify.error('debe ingresar Profundidad Centro');
                    });
                    return false;
                }
                var prfllanextmnt = $("#prfllanextmnt").val();
                if (prfllanextmnt == '' || prfllanextmnt == 0) {
                    $("#prfllanextmnt").focus();
                    alertify.alert("Falta ingresar Profundidad Exterior", function () {
                        alertify.error('debe ingresar Profundidad Centro');
                    });
                    return false;
                }
                var txtkmllan = $("#txtkmllan").val();
                if (txtkmllan == '' || txtkmllan == 0) {
                    $("#txtkmllan").focus();
                    alertify.alert("Falta ingresar Kilometraje", function () {
                        alertify.error('debe ingresar Kilometraje');
                    });
                    return false;
                }
                alertify.confirm("Esta seguro de montar la llanta ", function (e) {
                    if (e) {
                        set_add_montllant_vehi();
                        alertify.success("Se procede con el montaje de llanta.");
                    } else {
                        alertify.error("Se cancelo el montaje de llanta");
                    }
                }, function () {
                    alertify.error("Se cancelo el montaje")
                });
                return false;
            });
            $("#btndsmonllan").click(function (e) {
                e.preventDefault();
                var txtkmdsmon = $("#txtkmdsmon").val();
                if (txtkmdsmon == '') {
                    $("#txtkmdsmon").focus();
                    alertify.alert("Falta Kilometraje", function () {
                        alertify.error('debe ingresar Kilometraje');
                    });
                    return false;
                }
                var selemtvdsmont = $("#selemtvdsmont").val();
                if (selemtvdsmont == '' || selemtvdsmont == 0) {
                    $("#selemtvdsmont").focus();
                    alertify.alert("Falta Motivo Desmotaje", function () {
                        alertify.error('debe ingresar Motivo Desmotaje');
                    });
                    return false;
                }
                var prfllanintdsmnt = $("#prfllanintdsmnt").val();
                if (prfllanintdsmnt == '') {
                    $("#prfllanintdsmnt").focus();
                    alertify.alert("Falta Profundidad Interior", function () {
                        alertify.error('debe ingresar Profundidad Interior');
                    });
                    return false;
                }
                var prfllancntdsmnt = $("#prfllancntdsmnt").val();
                if (prfllancntdsmnt == '') {
                    $("#prfllancntdsmnt").focus();
                    alertify.alert("Falta Profundidad Centro", function () {
                        alertify.error('debe ingresar Profundidad Centro');
                    });
                    return false;
                }
                var prfllanextdsmnt = $("#prfllanextdsmnt").val();
                if (prfllanextdsmnt == '') {
                    $("#prfllanextdsmnt").focus();
                    alertify.alert("Falta Profundidad Exterior", function () {
                        alertify.error('debe ingresar Profundidad Exterior');
                    });
                    return false;
                }
                alertify.confirm("Esta seguro de desmontar la llanta ", function (e) {
                    if (e) {
                        set_desmontllant_vehi();
                        alertify.success("Se procede con el desmontaje de llanta.");
                    } else {
                        alertify.error("Se cancelo el desmontaje de llanta");
                    }
                }, function () {
                    alertify.error("Se cancelo el montaje")
                });
                return false;
            });
            $("#btnispllan").click(function (e) {
                e.preventDefault();
                var txtkmispllan = $("#txtkmispllan").val();
                if (txtkmispllan == '') {
                    $("#txtkmispllan").focus();
                    alertify.alert("Falta Kilometraje", function () {
                        alertify.error('debe ingresar Kilometraje');
                    });
                    return false;
                }
                var txtprsispllan = $("#txtprsispllan").val();
                if (txtprsispllan == '' || txtprsispllan == 0) {
                    $("#txtprsispllan").focus();
                    alertify.alert("Falta presion", function () {
                        alertify.error('debe ingresar presion');
                    });
                    return false;
                }
                var prfllanintisp = $("#prfllanintisp").val();
                if (prfllanintisp == '') {
                    $("#prfllanintisp").focus();
                    alertify.alert("Falta Profundidad Interior", function () {
                        alertify.error('debe ingresar Profundidad Interior');
                    });
                    return false;
                }
                var prfllancntisp = $("#prfllancntisp").val();
                if (prfllancntisp == '') {
                    $("#prfllancntisp").focus();
                    alertify.alert("Falta Profundidad Centro", function () {
                        alertify.error('debe ingresar Profundidad Centro');
                    });
                    return false;
                }
                var prfllanextisp = $("#prfllanextisp").val();
                if (prfllanextisp == '') {
                    $("#prfllanextisp").focus();
                    alertify.alert("Falta Profundidad Exterior", function () {
                        alertify.error('debe ingresar Profundidad Exterior');
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
        function addnroeje() {
            var nroeje = "<?php echo $datamovil->neoflt; ?>";
            str = '<select name="selepos" required id="selepos" class="form-control">';
            if (nroeje != 0) {


                for (e = 1; e <= nroeje; e++) {

                    str += '<option value="' + e + '">' + e + '</option>';
                }

            } else {
                str += '<option value="0">No hay resultados</option>';
            }

            str += '</select>';
            $('#selepos').html(str);
        }
        function get_llanta() {
            var tipvehi = "<?php echo $datamovil->tipflt; ?>";
            $.ajax({
                type: 'POST',
                url: 'control_llanta/get_llanta',
                data: {tipvehi: tipvehi},
                dataType: 'json',
                success: function (json) {

                    lista = json.lista;
                    str = '<select name="selellan" required id="selellan" class="form-control">';
                    if (lista != 0) {
                        cad = lista.split("&&&");
                        num = cad.length;
                        for (e = 0; e < num; e++) {
                            dat = cad[e].split("#$#");
                            codllan = dat[0];
                            codillan = dat[1];
                            nommrkllan = dat[2];
                            nommod = dat[3];
                            nommedi = dat[4];
                            remallan = dat[5];
                            str += '<option value="' + codllan + '">' + codillan + ', ' + nommrkllan + ', ' + nommod + ' ' + nommedi + '</option>';
                        }
                    } else {
                        str += '<option value="0">No hay resultados</option>';
                    }

                    str += '</select>';
                    $('#selellan').html(str);
                }
            });
        }
        function get_motivo_montaje_llanta() {

            $.ajax({
                type: 'POST',
                url: 'control_llanta/get_motivo_montaje_llanta',
                dataType: 'json',
                success: function (json) {
                    lista = json.lista;
                    str = '<select name="selemtvdsmont" required id="selemtvdsmont" class="form-control">';
                    if (lista != 0) {
                        str += '<option value="0">--MotivoDesmotaje--</option>';
                        cad = lista.split("&&&");
                        num = cad.length;
                        for (e = 0; e < num; e++) {
                            dat = cad[e].split("#$#");
                            codllan = dat[0];
                            codillan = dat[1];
                            str += '<option value="' + codllan + '">' + codillan + '</option>';
                        }
                    } else {
                        str += '<option value="0">No hay resultados</option>';
                    }

                    str += '</select>';
                    $('#selemtvdsmont').html(str);
                }
            });
        }
        function get_llanta_vehi() {
            var codvehi = "<?php echo $datamovil->codflt; ?>";
            $.ajax({
                type: 'POST',
                url: 'control_llanta/get_llanta_vehi',
                data: {codvehi: codvehi},
                dataType: 'json',
                success: function (json) {
                    var html = '';
                    var d;
                    var hab;
                    var conta = 0;
                    var dato = json.length;
                    if (dato > 0) {
                        try {
                            for (d = 0; d < dato; d++) {
                                conta = conta + 1;
                                var item = json[d];
                                var codfltd = item['codfltd'];
                                var codllan = item['codllan'];
                                var codillan = item['codillan'];
                                var poslland = item['poslland'];
                                var nommrkllan = item['nommrkllan'];
                                var nommod = item['nommod'];
                                var nommedi = item['nommedi'];
                                var remallan = item['remallan'];
                                html += '<tr>'
                                html += '<input type="hidden" name="hdcodlla" id="hdcodlla" value="' + codllan + '">'
                                html += '<td style="text-align: center;" class="td_pos" > <span class="badge">' + poslland + '</span></td>'
                                html += '<td style="text-align: center;">' + codillan + '</td>'
                                html += '<td style="text-align: center;">' + nommrkllan + '</td>'
                                html += '<td>' + nommod + '</td>'
                                html += '<td style="text-align: center;">' + nommedi + '</td>'
                                html += '<td style="text-align: center;"><span class="label label-success">' + remallan + '</span></td>'//
                                html += '<td style="text-align: center;"><button class="btn btn-danger" onclick="get_desmotallan(' + codllan + ',' + codillan + ',' + poslland + ');"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>'
                                html += '<button title="Registrar Remanente" class="btn btn-info" onclick="get_inspecllan(' + codllan + ',' + codillan + ',' + poslland + ');"><i class="fa fa-eyedropper" aria-hidden="true"></i></button>'
                                html += '</td></tr>';
                                $('#tblllanmon tbody').html(html);
                            }
                        } catch (e) {
                            alert('Exception while request..');
                        }
                    } else {
                        $('#tblllanmon tbody').html($('<td colspan=6>').text("No hay Informacion"));
                    }
                }
            });
        }
        function set_add_montllant_vehi() {
            $.ajax({
                type: 'POST',
                data: $('#frmmonllan').serialize(),
                url: "control_llanta/set_add_montllant_vehi",
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
                        $("#frmmonllan").reset();
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
                        $("#frmmonllan").reset();
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {

                }
            });
        }
        function set_desmontllant_vehi() {
            $.ajax({
                type: 'POST',
                data: $('#fordsmntllan').serialize(),
                url: "control_llanta/set_desmontllant_vehi",
                success: function (msj) {
                    var valorrsp = JSON.parse(msj);
                    var valorrspt = parseInt(valorrsp.existe);
                    if (valorrspt == 2) {
                        var dato = JSON.parse(msj);
                        alertify.alert(dato.msg, function () {
                            alertify.error(dato.msg);
                        });
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
                        $("#fordsmntllan").reset();
                        $("#Modaldsmonllan").modal('hide');
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {

                }
            });
        }
        function set_inspectllant_vehi() {
            $.ajax({
                type: 'POST',
                data: $('#forispllan').serialize(),
                url: "control_llanta/set_inspectllant_vehi",
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
        $(function () {
            $("#txtfmon").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy/mm/dd",
                yearRange: '-5:+0'

            });
        });
        $(function () {
            $("#txtfdsmon").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy/mm/dd",
                yearRange: '-2:+0'

            });
        });
        $(function () {
            $("#txtfispllan ").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy/mm/dd",
                yearRange: '-1:+0'

            });
        });

        function get_desmotallan(codllan, codillan, poslland) {

            $("#txtcodillandsmt").val(codllan);
            $("#txtcodllandsmt").val(codillan);
            $("#txtposllandsmt").val(poslland);
            $("#Modaldsmonllan").modal('show');
        }
        function get_inspecllan(codllan, codillan, poslland) {
            $("#txtcodillanisp").val(codllan);
            $("#txtcodllanisp").val(codillan);
            $("#txtposllanisp").val(poslland);
            $("#Modalinspecllan").modal('show');
        }

    </script>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Datos de vehiculo</h4>
                <div class="btn-group pull-right">
                    <a href="lstflota" class="btn btn-info btn-sm"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;</a>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addmonllan"  title="Montar Llanta"><i class="fa fa-arrow-up" aria-hidden="true"></i>&nbsp;<i class="fa fa-empire" aria-hidden="true"></i></button>
                    <!--  <a href="#" class="btn btn-default btn-sm">## Move</a>-->
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-10">
                        <input type="hidden" name="hdcodtpfta" id="hdcodtpfta" value="<?php echo $datamovil->tipflt; ?>">
                        <input type="hidden" name="hdcodfta" id="hdcodfta" value="<?php echo $datamovil->codflt; ?>">
                        <div class="media">
                            <div class="media-left media-middle">
                                <img src=".\assest\fotovehi\fotovehi1.png" class="media-object" style="width:60px">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $datamovil->plaflt; ?></h4>
                                <p><?php echo $datamovil->estflt; ?></p>
                                <div class="col-xs-2">
                                    <label for="ex1">modelo</label>
                                    <p class="form-control-static"><?php echo $datamovil->modflt; ?></p>
                                </div>
                                <div class="col-xs-4">
                                    <label for="ex2">Marca</label>
                                    <p class="form-control-static"><?php echo $datamovil->nommar; ?></p>
                                </div>
                                <div class="col-xs-4">
                                    <label for="ex2">Tipo</label>
                                    <p class="form-control-static"><?php echo $datamovil->nommlttb; ?></p>
                                </div>
                                <div class="col-xs-2">
                                    <label for="ex3">Km.</label>
                                    <p class="form-control-static"><?php echo $datamovil->kmflt; ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="thumbnail">
                            <img  src=".\assest\Llantas\<?php echo $datamovil->adjdsn; ?>" class="img-responsive img-rounded" alt="Responsive image"> 

                        </div>

                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Llantas&nbsp;Principales</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tblllanmon">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Pos.</th>
                                                <th style="text-align: center;">Codigo</th>
                                                <th style="text-align: center;">Marca</th>
                                                <th style="text-align: center;">Modelo</th>
                                                <th style="text-align: center;">Medida</th>
                                                <th style="text-align: center;">Rema.</th>
                                                <th style="text-align: center;">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--
                                        <div class="col-sm-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Llanta(s)&nbsp;de Repuesto(s)</div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <td>Pos.</td>
                                                                    <td>Codigo</td>
                                                                    <td>Marca</td>
                                                                    <td>Medida</td>
                                                                    <td>Remanente</td>
                                                                    <th>Accion</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Michilin</td>
                                                                    <td>12.0</td>
                                                                    <td>05.3</td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                                                                <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu">
                                                                                <li><a href="#"><i class="fa fa-arrow-down" aria-hidden="true"></i>&nbsp;Desmontar</a></li>
                                                                                <li><a href="#"><i class="fa fa-eyedropper" aria-hidden="true"></i>&nbsp;Remanente</a></li>
                    
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                    
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                    
                                        </div>
                    -->
                </div>              


            </div>
        </div>
    </div>
    <div class="modal fade" id="addmonllan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Montaje Llanta</h4>
                </div>
                <form class="form-horizontal" role="form" name="frmmonllan" id="frmmonllan" action="" method="">
                    <div class="modal-body">
                        <input type="hidden" name="hdcodfta" id="hdcodfta" value="<?php echo $datamovil->codflt; ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-indent-left"></i>&nbsp;Posecion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <select name="selepos"  id="selepos" class="form-control"> 
                                <option selected="true" value="">--Seleccione--</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i>&nbsp;Montaje&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input type="text" name="txtfmon" value="<?php echo date("Y-m-d H:i:s"); ?>" class="form-control"  id="txtfmon" />
                        </div>                              

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-universal-access" aria-hidden="true"></i>&nbsp;Llanta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <select name="selellan"  id="selellan" class="form-control"> 
                                <option selected="true" value="">--Seleccione--</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i>&nbsp;Kilometraje&nbsp;</span>
                            <input type="number" name="txtkmllan" min="0.0" max="100" value="" class="form-control"  id="txtkmllan" placeholder="Kilometraje" />

                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-thermometer-full" aria-hidden="true"></i>&nbsp;Precion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input type="number" name="txtprsllan" min="0.0" max="100" value="" class="form-control"  id="txtprsllan" placeholder="Precion Llanta"/>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Pof.&nbsp;Interior&nbsp;</span>
                            <input id="prfllanintmnt" type="number" class="form-control" name="prfllanintmnt" min="0" max="20" placeholder="Profundidad Interior">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Pof.&nbsp;Centro&nbsp;</span>
                            <input id="prfllancntmnt" type="number" class="form-control" name="prfllancntmnt" min="0" max="20" placeholder="Profundidad Centro">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Pof.&nbsp;Exterior</span>
                            <input id="prfllanextmnt" type="number" class="form-control" name="prfllanextmnt" min="0" max="20" placeholder="Profundidad Exterior">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnmonllan" name="btnmonllan">Grabar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog  #8ba987-->
    </div><!-- /.modal -->

    <div class="modal fade in" id="Modaldsmonllan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Desmontar Llanta</h4>
                </div>
                <form name="grabar" action="" method="POST" class="form-horizontal" id="fordsmntllan" name="fordsmntllan">
                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group" >
                                    <span id="respuesta2"></span>
                                </div>
                                <input type="hidden" name="grabar" value="si" />
                                <input type="hidden" name="hdcodftadsmnt" id="hdcodftadsmnt" value="<?php echo $datamovil->codflt; ?>">
                                <input type="hidden" id="txtcodllandsmt" name="txtcodllandsmt" value="" />
                                <input type="hidden" id="txtposllandsmt" name="txtposllandsmt" value="" />
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i>&nbsp;Codigo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input type="text" name="txtcodillandsmt" value="" class="form-control"  id="txtcodillandsmt" readonly="" />
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i>&nbsp;Remanente</span>
                                    <input type="text" name="txtfdsmon" class="form-control" id="txtfdsmon" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i>&nbsp;Kilometraje&nbsp;</span>
                                    <input type="number" name="txtkmdsmon" value="" class="form-control"  id="txtkmdsmon" placeholder="Kilometraje"/>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Motivo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <select name="selemtvdsmont"  id="selemtvdsmont" class="form-control"> 
                                        <option selected="true" value="">--Seleccione--</option>
                                    </select> 
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-thermometer-full" aria-hidden="true"></i>&nbsp;Precion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input type="number" name="txtprsllan" min="0.0" max="100" value="" class="form-control"  id="txtprsllan" placeholder="Precion Llanta"/>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Pof.&nbsp;Interior&nbsp;</span>
                                    <input id="prfllanintdsmnt" type="number" class="form-control" name="prfllanintdsmnt" min="0" max="20" placeholder="Profundidad Interior">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Pof.&nbsp;Centro&nbsp;</span>
                                    <input id="prfllancntdsmnt" type="number" class="form-control" name="prfllancntdsmnt" min="0" max="20" placeholder="Profundidad Centro">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Pof.&nbsp;Exterior</span>
                                    <input id="prfllanextdsmnt" type="number" class="form-control" name="prfllanextdsmnt" min="0" max="20" placeholder="Profundidad Exterior">
                                </div>
                            </div>
                        </div>     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btndsmonllan" name="btndsmonllan"><i class="fa fa-arrow-down" aria-hidden="true"></i>&nbsp;Desmontar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade in" id="Modalinspecllan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Control remanente de Llanta</h4>
                </div>
                <form name="grabar" action="" method="POST" class="form-horizontal" id="forispllan" name="forispllan">
                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group" >
                                    <span id="respuesta2"></span>
                                </div>
                                <input type="hidden" name="grabar" value="si" />
                                <input type="hidden" name="hdcodftaisp" id="hdcodftaisp" value="<?php echo $datamovil->codflt; ?>">
                                <input type="hidden" id="txtcodllanisp" name="txtcodllanisp" value="" />
                                <input type="hidden" id="txtposllanisp" name="txtposllanisp" value="" />
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i>&nbsp;Codigo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input type="text" name="txtcodillanisp" value="" class="form-control"  id="txtcodillanisp" readonly="" />
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i>&nbsp;Desmontaje</span>
                                    <input type="text" name="txtfispllan" class="form-control" id="txtfispllan" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i>&nbsp;Kilometraje&nbsp;</span>
                                    <input type="number" name="txtkmispllan" value="" class="form-control"  id="txtkmispllan" placeholder="Kilometraje"/>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-thermometer-full" aria-hidden="true"></i>&nbsp;Precion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input type="number" name="txtprsispllan" min="0.0" max="100" value="" class="form-control"  id="txtprsispllan" placeholder="Precion Llanta"/>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Pof.&nbsp;Interior&nbsp;</span>
                                    <input id="prfllanintisp" type="number" class="form-control" name="prfllanintisp" min="0" max="20" placeholder="Profundidad Interior">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Pof.&nbsp;Centro&nbsp;</span>
                                    <input id="prfllancntisp" type="number" class="form-control" name="prfllanintisp" min="0" max="20" placeholder="Profundidad Centro">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Pof.&nbsp;Exterior</span>
                                    <input id="prfllanextisp" type="number" class="form-control" name="prfllanextisp" min="0" max="20" placeholder="Profundidad Exterior">
                                </div>
                            </div>
                        </div>     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnispllan" name="btnispllan"><i class="fa fa-eyedropper" aria-hidden="true"></i>&nbsp;Grabar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <style>
        .td_posz{
            background: url('./assest/imagen/llanta_textura.jpg') no-repeat center center;
            background-size:40% 100%;
        }
    </style>
</section>

