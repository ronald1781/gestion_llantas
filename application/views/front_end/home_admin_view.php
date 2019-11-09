<section clase="contenedor">
    <script type="text/javascript">
        $(document).ready(function () {
            function load_page_data() {
                $.ajax({
                    url: 'get_data.php',
                    data: {'startdate': startdate,
                        'enddate': enddate
                    },
                    async: false,
                    success: function (data) {
                        if (data) {
                            chart_data = $.parseJSON(data);
                            google.load("visualization", "1", {packages: ["corechart"]});
                            google.setOnLoadCallback(function () {
                                drawChart(chart_data, "My Chart", "Data")
                            })
                        }
                    },
                });
            }

            load_page_data();
        });

    </script>
 <div class="row"> 
     <div class="col-lg-3 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-unlock fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php
                                if (isset($labiertos)) {
                                    $abierto = count($labiertos);
                                    if ($abierto > 0) {
                                        echo '<h1>' . $labiertos->generados . '</h1>';
                                    } else {
                                        echo '<h1>0</h1>';
                                    }
                                } else {
                                    echo 'Sin Conexion';
                                }
                                ?></div>
                            <div>Generados!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver Detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-pause fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php
                                if (isset($lpendientes)) {
                                    $pendientes = count($lpendientes);
                                    if ($pendientes > 0) {
                                        echo '<h1>' . $lpendientes->pendientes . '</h1>';
                                    } else {
                                        echo '<h1>0</h1>';
                                    }
                                } else {
                                    echo 'Sin Conexion';
                                }
                                ?></div>
                            <div>Pendiente!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver Detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php
                                if (isset($lprocesos)) {
                                    $proceso = count($lprocesos);
                                    if ($proceso > 0) {

                                        echo '<h1>' . $lprocesos->proceso . '</h1>';
                                    } else {
                                        echo '<h1>0</h1>';
                                    }
                                } else {
                                    echo 'Sin Conexion';
                                }
                                ?></div>
                            <div>Proceso!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver Detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-lock fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php
                                if (isset($lcerrados)) {
                                    $cerrados = count($lcerrados);
                                    if ($cerrados > 0) {

                                        echo '<h1>' . $lcerrados->cerrados . '</h1>';
                                    } else {
                                        echo '<h1>0</h1>';
                                    }
                                } else {
                                    echo 'Sin Conexion';
                                }
                                ?></div>
                            <div>Atendidos!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver Detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>



</section>
