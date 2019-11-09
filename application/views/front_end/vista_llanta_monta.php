<section clase="container">
    <script language="JavaScript" >
        $(document).ready(function () {
            $("#loadSearchDoc").hide();
            function search() {
                var title = $("#txtnroplaca").val();
                if (title == '') {
                    alert("Ingrese el Codigo o Serie del equipo");
                    $("#loadSearchDoc").hide();
                    $("#buscarpla").attr('disabled', false);
                    $("#txtnroplaca").focus();
                    return false;
                }
                //$("#finalResult").html("<img alt="ajax search" src='assest/imagen/images.png'/>");
                $.ajax({
                    type: "post",
                    url: "control_llanta/buscarporplaca_flota",
                    cache: false,
                    data: {txtdatae: title},
                    success: function (response) {
                        $("#loadSearchDoc").hide();
                        $("#buscarpla").attr('disabled', false);
                        var html = '';
                        var monthString = '';
                        var obj = JSON.parse(response);

                        if (obj.length > 0) {
                            try {
                                $.each(obj, function (i, item) {

                                    if (item.estrgflt == 'I') {
                                        html += '<tr><td>' + item.plaflt + '</td>'
                                    } else {
                                        html += '<td><a  href="detallehard/' + item.codflt + '" title="Detalle">' + item.plaflt + '</a></td>'
                                    }
                                    html += '<td>' + item.cdintflt + '</td>'
                                    html += '<td>' + item.nommlttb + '</td>'
                                    html += '<td>' + item.nommar + '</td>'
                                    html += '<td>' + item.modflt + '</td>'
                                    html += '<td>' + item.cfgflt + '</td>'
                                    html += '<td>' + item.ejeflt + '</td>'
                                    html += '<td>' + item.neoflt + '</td>'
                                    html += '<td>' + item.neorpsflt + '</td>'
                                    html += '<td>' + monthString + '</td>'
                                    if (item.estrgflt == 'I') {
                                        html += '<td><span class="label label-danger"><span class="glyphicon glyphicon-tag" aria-hidden="true" alt="Estado Baja"></span></span></td>'
                                    } else {
                                        html += '<td><a href="visualizar/mante/' + item.codflt + '" title="Mantenimiento"><span class="label label-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></span></a><a href="visualizar/historial/' + item.codflt + '" title="Movimientos"><span class="label label-primary"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span></span></a><a href="editarhardware/' + item.codflt + '" title="Editar"><span class="label label-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></span></a><a href="histohardware/' + item.codflt + '" title="Historial"><span class="label label-info"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></span></a></td>'
                                    }
                                    html += '</tr>';
                                    $("#dataflt tbody").html(html);
                                });
                            } catch (e) {
                                alert('Exception while request..');
                            }
                        } else {
                            $('#dataflt tbody').html($('<td colspan=12>').text("No hay Informacion"));
                        }
                        $("#txtnroplaca").val("");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });

            }
            $("#buscarpla").click(function () {
                $("#loadSearchDoc").show();
                $("#buscarhard").attr('disabled', true);
                search();
            });
            $('#txtnroplaca').on('keyup', function (e) {
                if (e.keyCode == 13) {
                    search();
                }
            });
        });
        /*
         $('#txtcodprv').on('keyup', function (e) {
         if (e.keyCode == 13) {
         $("#loadSearchDoc").show();
         $("#buscarhard").attr('disabled', true);
         search();
         }
         });
         */
    </script>
    <div class="row">
        <div class="col-md-12"> 
            <ul class="nav nav-tabs">

                <li class="active">
                    <a  href="busca/personal">Buscar</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
            <?php
            echo '<div class="error">' . $this->session->flashdata("mensajepernohar") . '</div>';
            ?>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-6"> 
            
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-8"> 
            <form class="form-inline" action="movillanta" method="post">
                <div class="form-group">
                    <label for="Placa">Placa:</label>
                    <input type="text" class="form-control" placeholder="Ingrese placa" name="txtnroplaca" id="txtnroplaca">
                </div>
                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            
            
                </form>
            <!--
            <form class="navbar-form navbar-left" role="search">
                <label for="txtnomdni">Placa</label> 
                <div class="form-group">
                    <input type="text" name="txtnroplaca" class="form-control" id="txtnroplaca" placeholder="Nro placa">
                </div> 
                <button type="button" class="btn btn-info" name="buscarpla"id="buscarpla">Buscar</button>
                <div id="finalResult"><img id="loadSearchDoc" src="assest/imagen/ajax-loaderbr.gif" border="0" /></div>
            </form> 
            -->
        </div>
    </div> 
    <!--
    <div class="row">
        <div class="col-md-12">
            <div id="finalResult">
            </div>
            <div class="table-responsive">
                <table class="table table-responsive" id="dataflt">
                    <thead>
                        <tr class="active">                            
                            <th>Placa</th>
                            <th>Codigo</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Configuracion</th>
                            <th>Ejes</th>
                            <th>Lantas</th>
                            <th>Rptos</th>
                            <th>Estado</th>
                            <th>Accion</th> 
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <form class="ember-view">
                    <div id="ember1928" class="ember-view row white-bg s-page-header"><h2 class="pull-left" style="max-width: 91.5878%;">
                            <i class="sofit-view-icon sofit-view-icon-tire-transaction"></i>
                            Movimentação de Pneus
                        </h2>
                        <div class="pull-right page-header-buttons">
                            <button type="button" class="btn btn-danger" title="" disabled="" data-ember-action="1929" data-original-title="Cancelar movimentações"><i class="fa fa-times" aria-hidden="true"></i></button>
                            <button type="submit" class="btn btn-primary" title="" disabled="" data-original-title="Salvar"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-8">.col-xs-12 .col-md-8</div>
                        <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="media">
                    <div class="media-left media-middle">
                        <img src=".\assest\imagen\fotovehi.png" class="media-object" style="width:60px">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">PL-234</h4>
                        <p>Lorem ipsum...</p>
                        <div class="col-xs-2">
                            <label for="ex1">modelo</label>
                            <p class="form-control-static">fh10</p>
                        </div>
                        <div class="col-xs-4">
                            <label for="ex2">Marca</label>
                            <p class="form-control-static">volvo</p>
                        </div>
                        <div class="col-xs-4">
                            <label for="ex3">estado</label>
                            <p class="form-control-static">Activo</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12">

                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">someone@example.com</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12">


                <div class="col-xs-2">
                    <label for="ex1">col-xs-2</label>
                    <p class="form-control-static">someone@example.com</p>

                </div>
                <div class="col-xs-3">
                    <label for="ex2">col-xs-3</label>
                    <p class="form-control-static">someone@example.com</p>

                </div>
                <div class="col-xs-4">
                    <label for="ex3">col-xs-4</label>
                    <p class="form-control-static">someone@example.com</p>

                </div>
                <div class="col-xs-3">
                    <label for="ex2">col-xs-3</label>
                    <p class="form-control-static">someone@example.com</p>

                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-sm-8">
                <h3>Column 1</h3>
                <form>
                    <div class="col-xs-2">
                        <label for="ex1">col-xs-2</label>
                        <input class="form-control" id="ex1" type="text">
                    </div>
                    <div class="col-xs-3">
                        <label for="ex2">col-xs-3</label>
                        <input class="form-control" id="ex2" type="text">
                    </div>
                    <div class="col-xs-4">
                        <label for="ex3">col-xs-4</label>
                        <input class="form-control" id="ex3" type="text">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Text</span>
                        <input id="msg" type="text" class="form-control" name="msg" placeholder="Additional Info">
                    </div>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
                    <div class="form-group">
                        <label for="inputdefault">Default input</label>
                        <input class="form-control" id="inputdefault" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputlg">input-lg</label>
                        <input class="form-control input-lg" id="inputlg" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputsm">input-sm</label>
                        <input class="form-control input-sm" id="inputsm" type="text">
                    </div>
                </form>
                <form class="form-inline">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox"> Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
    
    <div class="form-group">
        <label class="sr-only" for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label class="sr-only" for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Enter password">
    </div>
    <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<form class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" placeholder="Enter email">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Password:</label>
        <div class="col-sm-10"> 
            <input type="password" class="form-control" id="pwd" placeholder="Enter password">
        </div>
    </div>
    <div class="form-group"> 
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>
        </div>
    </div>
    <div class="form-group"> 
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>
</div>

<div class="col-sm-4">
    <h3>Column </h3>        
    <form>
        <div class="form-group">
            <label for="usr">Name:</label>
            <input type="text" class="form-control" id="usr">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="email" type="text" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
        </div>
    </form> </div>
</div>
</div>
    -->
</section>

