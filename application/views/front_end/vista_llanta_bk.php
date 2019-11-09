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
	$(function () {
		$("input.switch").bootstrapSwitch();

		$("#fechacomp").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy/mm/dd"
		});
	});
	var lst_compra = new Array();
	$(document).ready(function () {
		$('#bt_add').click(function () {
			agregar();
		});
		$('#bt_del').click(function () {
			eliminar(id_fila_selected);
		});
		$('#bt_delall').click(function () {
			eliminarTodasFilas();
		});
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
        //********Subir Archivo Factura producto********//
        $('#adjfact').click(function (e) {
        	e.preventDefault();
            // alert('datass'),
            $('input:file').each(function () {
            	$.ajaxFileUpload({
            		type: 'POST',
            		fileElementId: $(this).attr('id'),
            		async: 'true',
            		dataType: 'json',
            		url: 'compra_control/subir_factura',
            		secureuri: false,
            		contentType: 'multipart/form-data',
            		mimeType: 'multipart/form-data',
            		success: function (data, status)
            		{
            			if (data.status != 'fallo')
            			{
            				nfile = data.fdata;
            				nfile = JSON.stringify(nfile);
            				nfile = $.parseJSON(nfile);
            				$('#txtfacts').val(nfile['fname']);
            				refresh_files();
                            // $('#adjserv').val('');
                            $('#filefact').val('');
                        }
                    }
                });
            	return false;
            });
        });

        //********BUSCAR PROVEEDOR********//

        $("#txtcdprv").autocomplete({
        	source: function (request, response) {
        		$.ajax({
        			url: "control_llanta/buscarproveedor",
        			dataType: "json",
        			data: {term: request.term},
        			success: function (data) {
        				var ex = data.existe;
        				switch (ex) {
        					case 1:
        					response($.map(data.datos, function (item) {
        						return {
        							label: item.rucprove + " " + item.rasprove,
        							value: item.rucprove,
        							nombr: item.rasprove,
        							codpr: item.codprove,
        							codcpg: item.codcondpag,
        						};
        					}));
        					break;
        					case 0:
        					response($.map(data, function (item) {
        						return {
        							label: data.men,
        						};
        					}))
        					break;
        				}
        			}
        		});
        	},
        	minLength: 2,
        	select: function (event, ui) {
        		$('#txtcodprv').val(ui.item.codpr);
        		$('#txtnomprv').val(ui.item.nombr);
        		$('#txtcodcpg').val(ui.item.codcpg);
        		return false;
        	},
        	open: function () {
        		$(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        	},
        	error: function (xhr, ajaxOptions, thrownError) {
        		alert(xhr.status);
        		alert(thrownError);
        	},
        	close: function () {
        		$(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        	}
        });
    });


var n = 0;
var fila;
var cont = 0;
var id_fila_selected = [];
function agregar() {
	var compra = {};
	var condi = $("#condillan").val();
	var codmkl = $("#selemrkl").val();
	var nommkl = $("#selemrkl option:selected").text();
	var codmod = $("#selemodl").val();
	var nomodel = $("#selemodl option:selected").text();
	var codmed = $("#selemedl").val();
	var nomedi = $("#selemedl option:selected").text();
	var nrorem = $("#txtnrorem").val();
	var impo = $("#txtimpo").val();
	var cant = $("#txtcant").val();
	compra.condi = condi;
	compra.codmkl = codmkl;
	compra.nommkl = nommkl;
	compra.codmod = codmod;
	compra.nomodel = nomodel;
	compra.codmed = codmed;
	compra.nomedi = nomedi;
	compra.nrorem = nrorem;
	compra.impo = impo;
	lst_compra.push(compra);
	var montos = 0;
	n = cant;
	for (var i = 0; i < n; i++) {
		cont++;
		jQuery.each(lst_compra, function (i, value) {
			fila = '<tr class="selected" id="fila' + cont + '" onclick="seleccionar(this.id);"><td style="text-align: center;">' + cont +
			'<input type="hidden"  name=codimark value=["codmkl"]/>' +
			'<input type="hidden"  name=codimod value=["codmod"]/>' +
			'<input type="hidden"  name=codimed value=["codmed"]/>' +
			'</td><td style="text-align: center;">' + value["condi"] +
			'</td><td style="text-align: center;">' + value["nommkl"] +
			'</td><td style="text-align: center;">' + value["nomodel"] +
			'</td><td style="text-align: center;">' + value["nomedi"] +
			'</td><td style="text-align: center;">' + value["nrorem"] +
			'</td><td style="text-align: center;">' + value["impo"] +
			'</td><td><input type="text" class="form-control" name="txtserll[]" value="" placeholder="Serie de llanta"></td>' +
			'<td></td></tr>';
		});
		$('.data tbody').append(fila);
		reordenar();
	}
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
function seleccionar(id_fila) {
	if ($('#' + id_fila).hasClass('seleccionada')) {
		$('#' + id_fila).removeClass('seleccionada');
	}
	else {
		$('#' + id_fila).addClass('seleccionada');
	}
        //2702id_fila_selected=id_fila;
        id_fila_selected.push(id_fila);
    }
    function eliminar(id_fila) {
        /*$('#'+id_fila).remove();
        reordenar();*/
        alert('llego');
        for (var i = 0; i < id_fila.length; i++) {
        	$('#' + id_fila[i]).remove();
        }
        reordenar();
    }
    function reordenar() {
    	var num = 1;
    	$('.data tbody tr').each(function () {
    		$(this).find('td').eq(0).text(num);
    		num++;
    	});
    }
    function eliminarTodasFilas() {
    	$('.data tbody tr').each(function () {
    		$(this).remove();
    	});
    }
    function listarServi() {
    	var servicio = {};
    	var actrea = $("#txtactrea").val();
    	var factrea = $("#txtfactrea").val();
    	var nomestact = $("#selestact option:selected").text();
    	if (actrea == '') {
    		alert('Ingrese Informacion');
    		$('#txtactirea').focus();
    	}
    	else {
    		servicio.actrea = actrea;
    		servicio.factrea = factrea;
    		servicio.nomestact = nomestact;
    		lst_servi.push(servicio);
    		$("#lstTabla").show();
    		var $tabla = $("#lstTabla");
    		$tabla.find("table").remove();
    		$tabla.append('<table class="table table-bordered">' +
    			'<thead><tr class="active"><th>#</th><th>Actividad</th><th>Fecha</th><th>Action</th></tr>' +
    			'</thead></table>');
    		var tbody = $('<tbody></tbody>');
    		jQuery.each(lst_servi, function (i, value) {
    			cont = i + 1;
    			tbody.append(
    				'<tr><td style="text-align: center;">' + cont +
    				'</td><td style="text-align: center;">' + value["actrea"] +
    				'</td><td style="text-align: center;">' + value["factrea"] +
    				'</td><td class="actions">' +
    				'<div class="btn-group"><a onclick="del_listaServi(' + i + ');" class="btn btn-mini deleteRow"> Eliminar' +
    				'</a></div></td></tr>'
    				);
    		});
    		$tabla.find("table").append(tbody);
    		$('#txtactrea').val('');
    		$('#txtfactrea').val('<?php echo date("Y-m-d H:i:s"); ?>');
    		$('#txtactrea').focus();
    	}

    }

    function del_listaServi(id) {
    	jQuery.each(lst_servi, function (i, value) {
    		if (i == id) {
    			lst_servi.splice(i, 1);
    		}
    	});
    	$("#lstTabla").show();
    	var $tabla = $("#lstTabla");
    	$tabla.find("table").remove();
    	$tabla.append('<table class="table table-bordered">' +
    		'<thead><tr class="active"><th>#</th><th>Actividad</th><th>Fecha</th><th>Action</th></tr>' +
    		'</thead></table>');
    	var tbody = $('<tbody></tbody>');
    	jQuery.each(lst_servi, function (i, value) {
    		cont = i + 1;
    		tbody.append(
    			'<tr><td style="text-align: center;">' + cont +
    			'</td><td style="text-align: center;">' + value["actrea"] +
    			'</td><td style="text-align: center;">' + value["factrea"] +
    			'</td><td class="actions">' +
    			'<div class="btn-group"><a onclick="del_listaServi(' + i + ');" class="btn btn-mini deleteRow"> Eliminar' +
    			'</a></div></td></tr>'
    			);
    	});
    	$tabla.find("table").append(tbody);
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

</script>
<section clase="container">
	<div class="row">
		<div class="col-md-12"> 

			<div class="panel panel-info">
				<div class="panel-heading">Registro de Llanta</div>
				<div class="panel-body">
					<div class="tab-content">
						<div class="tab-pane active" id="registro">
							<form   method="POST" class="form-horizontal" id="frmaddflot" action=""  enctype="multipart/form-data">
								<input type="hidden" name="grabar" value="si" />
								<div class="row">
									<div class="col-md-12">
										<p align="right">
											<button class="btn btn-info" data-toggle="modal" data-target="#mdaddllant" title="Agregar Llanta"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></button>
											<button class="btn btn-primary" id="btnGuardarflot" type="submit" title="Grabar"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></button>
											<button type="reset" class='btn btn-danger' title="Cancelar"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></button>
										</p>
									</div>
								</div>
								<div class="row">
									<form name="grabar" action="" method="POST" id="foraddhard">
										<div class="row">               
											<div class="col-md-6">                   
												<fieldset>                                       
													<div class="form-group">
														<label for="inputtEquip" class="col-sm-3 control-label">Proveedor</label>
														<div class="col-sm-9">
															<input type="text" name="txtcdprv" value="" class="form-control" required id="txtcdprv" autofocus placeholder="RUC,Nombre Prov." autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" onkeyup="this.value = this.value.toUpperCase()" style="width:50%; float:left" />
														</div>
													</div>
													<input type="hidden" name="txtcodprv" id="txtcodprv">
													<input type="hidden" name="txtcodcpg" id="txtcodcpg">

													<?php
													date_default_timezone_set('UTC');
													?>
													<div class="form-group">
														<label for="inputtEquip" class="col-sm-3 control-label">F.Compra</label>
														<div class="col-sm-9">
															<input type="text" class="form-control" name="fechacomp" requerid id="fechacomp"  value="<?php echo date("Y-m-d"); ?>" style="width:50%; float:left">
														</div>
													</div>	
												</fieldset> 
											</div>
											<div class="col-md-6">
												<fieldset> 
													<?php
													date_default_timezone_set('UTC');
													?>
													<div class="form-group">
														<label for="inputtEquip" class="col-sm-3 control-label">Tipo Documento</label>
														<div class="col-sm-9">
															<select name="selepgo" required id="selepgo" class="form-control" style="width:50%; float:left" > 
																<option selected="true" value="">--Seleccione--</option>
																<option value="1">Factura</option>
																<option value="2">Boleta</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="inputtEquip" class="col-sm-3 control-label">N.Factura</label>
														<div class="col-sm-9">
															<input type="text" name="txtnfact" value="" class="form-control" required id="txtnfact" autofocus placeholder="Numero F." onkeyup="this.value = this.value.toUpperCase()" style="width:50%; float:left"  />
														</div>
													</div>
												</fieldset> 
											</div>	
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="panel panel-default">

													<div class="table-responsive">
														<table class="table table-bordered data">
															<thead>
																<tr>
																	<th>#</th>
																	<th>Cond.</th>
																	<th>Marca</th>
																	<th>Modelo</th>
																	<th>Medida</th>
																	<th>Remanente</th>
																	<th>Costo</th>             <th>Serie</th>             </tr>
															</thead>
															<tbody>

															</tbody>
															<thead>
																<tr>
																	<th>Accion</th>
																	<th colspan="10" align="right"><button id="bt_delall" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>todo</button><button id="bt_del" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></th>
																</tr>
															</thead>
														</table>
													</div>                      
</div>												
												<div class="row">
													<div class="col-md-12"> 
														<div class="form-group">
															<div class="col-sm-4">
																<span class="add-on" >SubTotal:</span><input type="text" class='input-square input-small' name="subTotal" id="subTotal" readonly>
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-4">
																<span class="add-on" >IGV:</span><input type="number" class='input-square input-mini' min="0.0" max="100.0" step="0.1" value="18.0" name="igv" id="igv" onkeyup="calcular_monto_base_porcentaje();">
																<input type="text" class='input-square input-small' name="montoigv" id="montoigv" readonly><span class="add-on" ></span>
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-4">
																<span class="add-on">Total Pagar:</span><input type="text" class='input-square input-small' name="totApagar" id="totApagar" readonly>
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
											<option value="R">Renovado</option>
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
									<label for="numdni" class="col-sm-2 control-label">remanente</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" name="txtnrorem" requerid id="txtnrorem" placeholder="Remanente Llanta" value="0"  style="width:50%; float:left"  >
									</div>
								</div>

								<div class="form-group">
									<label for="selemar" class="col-sm-2 control-label">Importe</label>
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
                            <!--
                                    <input type="button" name="btnagregar" value="Agregar" class="btn btn-primary " onclick="listarCompra()
                                    ;">
                                -->
                                <input type="button" name="bt_add" id="bt_add" value="Agregar" class="btn btn-primary " >

                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </section>