<section clase="container"> 
    <script type="text/javascript">
        $(document).ready(function () {
            //Registrar Personal Nuevo
            $(".modalload").hide();
            $("#btnGuardarflot").click(function () {
                var validado = $("#frmaddflot").valid();
                if (validado) {
                    // alert('El formulario es correcto.');
                    $(".modalload").show();
                    var frmediper = $('#frmaddflot').serialize();
                    $.ajax({
                        type: 'POST',
                        data: frmediper,
                        cache: false,
                        url: 'control_flota/add_flota',
                        success: function (msj) {
                            console.log(msj);
                            $(".modalload").hide();
                            if (parseInt(msj.existe) == 1) {
                                $('#msj_graboflt').modal('show');
                                jQuery.fn.reset = function () {
                                    $(this).each(function () {
                                        this.reset();
                                    });
                                };
                                $("#frmaddflot").reset();
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $('#msj_errorflr .modal-body').html(thrownError + " " + xhr.status + " si persiste contactese con el administrador de TI"),
                                    $('#msj_errorflt').modal('show');
                        }
                    });
                } else {
                    alert('El formulario no es correcto.');
                    return false;
                }
            });
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
            /*
             MARCA FLOTA  
             */
            var mrkflota = $.ajax({
                url: 'control_flota/getmrkFlota',
                type: 'post',
                dataType: 'json',
                async: false,
            }).responseText;
            mrkflota = JSON.parse(mrkflota);
            var listamrkflota = mrkflota.lista;
            var str = '<select name="selemrk" required id="selemrk" class="form-control">';
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
            $('#selemrk').html(str);

            $("#txtkmts").keydown(function (event) {
                if (event.shiftKey)
                {
                    event.preventDefault();
                }
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
                }
                else {
                    if (event.keyCode < 95) {
                        if (event.keyCode < 48 || event.keyCode > 57) {
                            event.preventDefault();
                        }
                    }
                    else {
                        if (event.keyCode < 96 || event.keyCode > 105) {
                            event.preventDefault();
                        }
                    }
                }
            });
            $("#txtnrollnts").keydown(function (event) {
                if (event.shiftKey)
                {
                    event.preventDefault();
                }
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
                }
                else {
                    if (event.keyCode < 95) {
                        if (event.keyCode < 48 || event.keyCode > 57) {
                            event.preventDefault();
                        }
                    }
                    else {
                        if (event.keyCode < 96 || event.keyCode > 105) {
                            event.preventDefault();
                        }
                    }
                }
            });
            $("#txtnroeje").keydown(function (event) {
                if (event.shiftKey)
                {
                    event.preventDefault();
                }
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
                }
                else {
                    if (event.keyCode < 95) {
                        if (event.keyCode < 48 || event.keyCode > 57) {
                            event.preventDefault();
                        }
                    }
                    else {
                        if (event.keyCode < 96 || event.keyCode > 105) {
                            event.preventDefault();
                        }
                    }
                }
            });
            $("#txtnrorpts").keydown(function (event) {

                if (event.shiftKey)
                {
                    event.preventDefault();
                }

                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
                }
                else {
                    if (event.keyCode < 95) {
                        if (event.keyCode < 48 || event.keyCode > 57) {
                            event.preventDefault();
                        }
                    }
                    else {
                        if (event.keyCode < 96 || event.keyCode > 105) {
                            event.preventDefault();
                        }
                    }
                }
            });


//ver codigo para registro
            $("#buscartperas").click(function (e) {
                e.preventDefault();
                // alert('data');
                var seltpcodas = $("#seltpcodas").val();
                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    cache: false,
                    data: {seltpcodas: seltpcodas
                    },
                    url: 'personal_control/listtpercod_as400',
                    success: function (json) {

                        var html = '';
                        var d;
                        var conta = 0;
                        var dato = json.length;
                        if (dato > 0) {

                            try {
                                for (d = 0; d < dato; d++) {
                                    conta = conta + 1;
                                    var item = json[d];
                                    var BMCODCIA = item[0];

                                    html += '<tr> '
                                    html += '<td style="width:20%">' + conta + '</td>'
                                    html += '<td aling="center"> <font size="0px">' + BMCODCIA + '</font></td>'
                                    html += '</tr>';
                                    $('#data tbody').html(html);
                                }
                            } catch (e) {

                                alert('Exception while request..');
                            }

                        } else {
                            $('#data tbody').html($('<td colspan=12>').text("No hay Informacion"));
                        }
                    }
                    ,
                    error: function (xhr, ajaxOptions, thrownError) {
                    }

                });



                return false;
            });
        });
        function get_esquemallanta(id) {
            $.ajax({
                type: 'POST',
                url: 'control_flota/get_esquemallanta',
                data: {id: id,
                },
                dataType: 'json',
                success: function (json) {
                    lista = json.lista;
                    str = '<select name="seledsn" required id="seledsn" class="form-control">';

                    if (lista != 0) {
                        str = '<option selected="true" value="">--ConDatos--</option>';
                        cad = lista.split("&&&");
                        num = cad.length;
                        for (e = 0; e < num; e++) {
                            dat = cad[e].split("#$#");
                            coddsn = dat[0];
                            nomdsn = dat[1];
                            str += '<option value="' + coddsn + '">' + nomdsn + '</option>';
                        }
                    } else {
                        str += '<option value="0">No tiene Equipos Asignados</option>';
                    }
                    str += '</select>';
                    $('#seledsn').html(str);
                }
            });
        }
        function get_esquemallanta_datos(id) {
            $.ajax({
                type: 'POST',
                url: 'control_flota/get_esquemallanta_datos',
                data: {id: id,
                },
                dataType: 'json',
                success: function (json) {
                    //var valorrsp = JSON.parse(json);
                    //console.log(valorrsp);
                    $("#frmaddflot #txtnroeje").val(json.nroejedsn);
                    $("#frmaddflot #txtnrollnts").val(json.nrolladsn);
                    //$("#imgdsnflt").attr("src", './assest/Llantas/' + json.adjdsn);
                    var src = ($("#imgdsnflt").attr('src') === '')
                            ? './assest/Llantas/diseniollan.png'
                            : './assest/Llantas/' + json.adjdsn;
                    $("#imgdsnflt").attr('src', src);
                }
            });
        }
        $(function () {
            $("#txtnomdni").keydown(function (event) {

                if (event.shiftKey)
                {
                    event.preventDefault();
                }

                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
                }
                else {
                    if (event.keyCode < 95) {
                        if (event.keyCode < 48 || event.keyCode > 57) {
                            event.preventDefault();
                        }
                    }
                    else {
                        if (event.keyCode < 96 || event.keyCode > 105) {
                            event.preventDefault();
                        }
                    }
                }
            });
        });


        $(function () {
            $("#txtanio").datepicker({
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy',
                yearRange: '-30:+0',
            }).focus(function () {
                var thisCalendar = $(this);
                $('.ui-datepicker-calendar').detach();
                $('.ui-datepicker-close').click(function () {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    thisCalendar.datepicker('setDate', new Date(year, 1));
                });
            });
        });

    </script>
    <div class="row">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;Flota</h4>
                <div class="btn-group pull-right">
                    <button class="btn btn-primary btn-sm" id="btnGuardarflot" type="button"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Guardar</button>
                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;Atras</a>

                </div>
                <!--
                <div class="btn-group pull-left">
                    <ul class="nav nav-tabs">
                        <li> <a href="rgtflota"  title="Registrar Flota"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                        </li>
                        <li> <a href="lstflota"  title="Lista Flota"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
                        </li>                      
                    </ul>
                </div>
                <h4 class="panel-title pull-right" style="padding-top: 7.5px;">
                    <button class="btn btn-primary" id="btnGuardarflot" type="button"> Guardar</button>
                    <input type="reset" class='btn btn-danger' value="Cancelar">
                </h4>
               <p></p>-->
            </div>
            <div class="panel-body">
                <form name="frmaddflot"  method="POST" class="form-horizontal" id="frmaddflot" action=""  enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="numdni" class="col-sm-3 control-label" for="txtplaca">Placa</label>
                                <div class="col-sm-9">
                                    <input type="text"  id="txtplaca" name="txtplaca" value="<?php
                                    if ($codpla == TRUE) {
                                        $plca = $codpla;
                                        echo $plca;
                                    } else {
                                        echo $plca = '';
                                    }
                                    ?>" class="form-control"  placeholder="Numero Placa" autofocus="" style="width:80%; float:left" maxlength="8" onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="selecate" class="col-sm-3 control-label">Tipo</label>
                                <div class="col-sm-9">
                                    <select name="seletp" id="seletp" class="form-control" style="width:80%; float:left" onchange="get_esquemallanta(this.value)"> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nompro" class="col-sm-3 control-label">Marca</label>
                                <div class="col-sm-9">
                                    <select name="selemrk" id="selemrk" class="form-control" style="width:80%; float:left"> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="selecate" class="col-sm-3 control-label">Diseño</label>
                                <div class="col-sm-9">
                                    <select name="seledsn" id="seledsn" class="form-control" style="width:80%; float:left" onchange="get_esquemallanta_datos(this.value)"> 
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="despro" class="col-sm-3 control-label">Modelo</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="txtmdl"  id="txtmdl" maxlength="45" placeholder="Modelo Flota" style="width:80%; float:left" onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5"> 

                            <div class="form-group">
                                <label for="apepat" class="col-sm-3 control-label">Padron</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="txtpdrn" requerid id="txtpdrn" placeholder="Nro Padron" style="width:80%; float:left" onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="selemar" class="col-sm-3 control-label">NroEjes</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="txtnroeje" id="txtnroeje" requerid maxlength="2" value="" placeholder="Nro Ejes"  style="width:80%; float:left" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="selemar" class="col-sm-3 control-label">NroLlantas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="txtnrollnts" id="txtnrollnts" requerid maxlength="2" value="" placeholder="Nro Llantas" style="width:80%; float:left" readonly="">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="selemar" class="col-sm-3 control-label">Repuesto</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control"min="0" max="4" name="txtnrorpts" id="txtnrorpts" maxlength="1" requerid  value="" placeholder="Nro Llantas Repuestos"  style="width:80%; float:left">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nompro" class="col-sm-3 control-label">Configuracion</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="txtcfg" requerid id="txtcfg" placeholder="Configuracion Flota"  style="width:80%; float:left" onkeyup="this.value = this.value.toLowerCase()">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"> 
                            <div class="form-group">

                                <div class="thumbnail">
                              <!--\assest\Llantas\<php echo $datamovil->adjdsn; >-->
                                    <img  src="./assest/Llantas/diseniollan.png" id="imgdsnflt" class="img-responsive img-rounded" alt="Responsive image"> 

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <fieldset> 



                                <div class="form-group">
                                    <label for="despro" class="col-sm-3 control-label">NroMotor</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="txtnromtr" id="txtnromtr" placeholder="Numero Motor" style="width:80%; float:left" onkeyup="this.value = this.value.toUpperCase()" maxlength="45">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="despro" class="col-sm-3 control-label">SerieMotor</label>
                                    <div class="col-sm-9"> 
                                        <input type="text" class="form-control" name="txtsermtr" id="txtsermtr" maxlength="45" placeholder="Serie Motor" style="width:80%; float:left" onkeyup="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>

                            </fieldset>  
                        </div>
                        <div class="col-md-6">
                            <fieldset> 



                                <div class="form-group">
                                    <label for="despro" class="col-sm-3 control-label">Año</label>
                                    <div class="col-sm-9">
                                        <div id="tex"></div>
                                        <input type="text" class="form-control" name="txtanio" id="txtanio" maxlength="4" requerid  value="" placeholder="Año Flota"  style="width:80%; float:left" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="despro" class="col-sm-3 control-label">Km</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="txtkmts" id="txtkmts" maxlength="15" value="" placeholder="Kilometraje Flota"  style="width:80%; float:left">
                                    </div>
                                </div>   
                                <!--
                                <select name="ctlMTipoVehiculos1$cboEsquemaLlantas" onchange="javascript:setTimeout('__doPostBack(\'ctlMTipoVehiculos1$cboEsquemaLlantas\',\'\')', 0)" id="ctlMTipoVehiculos1_cboEsquemaLlantas">
                                    <option value="0">Sin Esquema</option>
                                    <option value="1">2 Ejes, 4 llantas </option>
                                    <option value="2">2 Ejes, 6 Llantas </option>
                                    <option selected="selected" value="3">3 Ejes, 6 Llantas </option>
                                    <option value="4">3 Ejes, 10 Llantas</option>
                                    <option value="5">2 Ejes, 8 Llantas (Trailer)</option>
                                    <option value="6">3 Ejes, 12 Llantas (Trailer)</option>
                                    <option value="7">4 Ejes, 12 Llantas</option>
                                    <option value="8">Cabezote 3 Ejes + Trailer 2 Ejes</option>
                                    <option value="9">Cabezote 3 Ejes + Trailer 3 Ejes</option>
                                    <option value="10">Cabezote 2 Ejes + Trailer 2 Ejes</option>
                                    <option value="11">Cabezote 2 Ejes + Trailer 3 Ejes</option>
                                    <option value="12">Moto 2 Ejes</option>
                                    <option value="13">4 Ejes 16 llantas (Trailer)</option>
                                    <option value="14">2 Ejes, 3 llantas</option>
                                    <option value="15">2 Ejes, 4 Llantas (Trailer)</option>
                                    <option value="16">3 Ejes, 6 Llantas  (Trailer)</option>
                                    <option value="17">Cabezote 3 Ejes + Trailer 4 Ejes</option>
                                    <option value="18">Cabezote 3 Ejes + Trailer 2 Ejes</option>
                                    <option value="19">Tranvia de 6 ejes, 12 llantas</option>

                                </select>
                                -->
                            </fieldset>  
                        </div>
                    </div>                   

                </form>

            </div>
            <!--
            <div id="dvEsquemaPrincipal">
                <table class="tblScheme schemeId_1" id="tblScheme" border="0">
                    <tbody>
                        <tr class="axle" id="axle_1">
                            <td id="tdPos_1" class="tdPosVehicle" style="width: 95.76px;">
                                <hr class="barraEje" style="margin-top: 38px; width: 95.76px;">
                                <div id="divPos_1" class="posVehicle posLeft dropPosition ui-droppable" style="height: 79.8px;">
                                    <div class="numberPosition black" style="margin-top: 16.8px; font-size: 24px;">1</div></div></td>
                            <td class="separator closeTop" style="width: 57px;"></td>
                            <td id="tdPos_2" class="tdPosVehicle" style="width: 95.76px;">
                                <hr class="barraEje" style="margin-top: 38px; width: 95.76px;">
                                <div id="divPos_2" class="posVehicle posRight dropPosition ui-droppable" style="height: 79.8px;">
                                    <div class="numberPosition black" style="margin-top: 16.8px; font-size: 24px;">2</div></div></td>
                        </tr>
                        <tr><td class="tdBlankSpace" style="width: 95.76px; height: 79.8px;"></td>
                            <td class="tdBlankSpace separator" style="width: 57px; height: 79.8px;"></td>
                            <td class="tdBlankSpace" style="width: 95.76px; height: 79.8px;"></td></tr>
                        <tr><td class="tdBlankSpace" style="width: 95.76px; height: 79.8px;"></td>
                            <td class="tdBlankSpace separator" style="width: 57px; height: 79.8px;"></td>
                            <td class="tdBlankSpace" style="width: 95.76px; height: 79.8px;"></td></tr>
                        <tr class="axle" id="axle_2"><td id="tdPos_3" class="tdPosVehicle" style="width: 95.76px;">
                                <hr class="barraEje" style="margin-top: 38px; width: 95.76px;">
                                <div id="divPos_3" class="posVehicle posLeft dropPosition ui-droppable" style="height: 79.8px;">
                                    <div class="numberPosition black" style="margin-top: 16.8px; font-size: 24px;">3</div></div></td>
                            <td class="separator closeBottom" style="width: 57px;"></td>
                            <td id="tdPos_4" class="tdPosVehicle" style="width: 95.76px;">
                                <hr class="barraEje" style="margin-top: 38px; width: 95.76px;">
                                <div id="divPos_4" class="posVehicle posRight dropPosition ui-droppable" style="height: 79.8px;">
                                    <div class="numberPosition black" style="margin-top: 16.8px; font-size: 24px;">4</div></div></td></tr>
                    </tbody></table></div>
            -->

        </div>
    </div>

</section>

<div class="modalload"></div>

<div class="modal" id="msj_graboflt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-ok"></span>Registro de Flota</h4>
            </div>

            <div class="modal-body">
                <span>Se Registro Correctamente</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="msj_errorflt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-pencil"></span>Error en Registro de Flota</h4>
            </div>
            <div class="modal-body">
                <span>Registro Fallido, Vuelva a intentarlo...</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Close</button>
            </div>
        </div>
    </div>
</div>

