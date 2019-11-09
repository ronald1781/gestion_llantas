<!DOCTYPE html  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" >
            <meta name="viewport" content="width=device-width, initial-scale=1"></meta>
            <?php date_default_timezone_set('America/Lima'); ?>
            <base href="<?php echo base_url(); ?>">
                <title><?php echo $titulo ?></title>
                <link rel="shortcut icon" type="image/x-icon" href="assest/img/iconeoma.ico" />
                <link  rel="stylesheet" type="text/css" href="assest/css/bootstrap.css"></link> 
                <link  rel="stylesheet" type="text/css" href="assest/css/jquery-ui.min.css"></link> 
                <link  rel="stylesheet" type="text/css" href="assest/css/chosen.min.css"></link> 
                <link  rel="stylesheet" type="text/css" href="assest/css/bootstrap-multiselect.css"></link>
                <link  rel="stylesheet" type="text/css" href="assest/css/bootstrap-switch.min.css"></link>
                <link  rel="stylesheet" type="text/css" href="assest/css/font-awesome.css"></link>
                <link  rel="stylesheet" type="text/css" href="assest/css/alertify.css"></link>
                <link  rel="stylesheet" type="text/css" href="assest/css/rrgstilos.css"></link>
                <link  rel="stylesheet" type="text/css" href="assest/css/vehiclescheme.css"></link> 
               <script src="assest/js/jquery.min.js"></script>  
                <script src="assest/js/jquery-ui.min.js"></script> 
                <script src="assest/js/bootstrap.min.js"></script> 
                <script src="assest/js/jquery.validate.js"></script> 
                <script src="assest/js/chosen.jquery.min.js"></script>
                <script src="assest/js/chosen.proto.min.js"></script>
                <script src="assest/js/alertify.js"></script>
                <script src="assest/js/bootstrap-filestyle.min.js"></script>                
                <script src="assest/js/jquery.dataTables.min.js"></script> 
                <script src="assest/js/dataTables.bootstrap.js"></script>
                <script src="assest/js/ajaxfileupload.js"></script>
                <script src="assest/js/jquery.ajax-progress.min.js"></script>
                <script src="assest/js/bootstrap-multiselect.js"></script>
                <script src="assest/js/generales_js.js"></script>  
                <script src="assest/js/bootstrap-switch.min.js"></script>  
                <script src="assest/js/vehiclescheme.js"></script>  

                <script>
                    $.datepicker.regional['es'] = {
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                        weekHeader: 'Sm',
                        dateFormat: 'dd/mm/yy',
                        firstDay: 1,
                        isRTL: false,
                        showMonthAfterYear: false,
                        yearSuffix: ''
                    };
                    $.datepicker.setDefaults($.datepicker.regional['es']);
                </script>
                <style>
                    .dropdown-submenu{position:relative;}
                    .dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
                    .dropdown-submenu:hover>.dropdown-menu{display:block;}
                    .dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
                    .dropdown-submenu:hover>a:after{border-left-color:#ffffff;}
                    .dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}


                    .modal-header,  .close {
                        background-color: #1E90FF;
                        color:white !important;
                        text-align: center;
                        font-size: 30px;
                    }
                    .modal-footer {
                        background-color: #f9f9f9;
                    }
                </style>
                </head>
                <body>
                    <?php
                    $usernam = $this->session->userdata('usuaper');
                    $username = strtoupper($usernam);
                    $menu = $this->session->userdata('menu');
                    $llavpfmn = $this->session->userdata('llavpfmn');
                    $id = '';
                    ?>
                    <nav>
                        <div class="navbar navbar-default" role="navigation">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                                </button>
                            </div>
                            <a class="navbar-brand"><img src="assest/imagen/logovll.png" style="height: 30px; margin-top: -5px;" ></img></a>
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="inicio">Inicio</a></li>
                                    <?php
                                    foreach ($menu as $item) {
                                        if ($item['paremenu'] == 0 and $llavpfmn = 1) {
                                            ?>
                                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $item['nommenu']; ?><b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    <?php
                                                    $id = $item['codmenu'];
                                                    foreach ($menu as $row) {
                                                        if ($row['paremenu'] == $id and $llavpfmn = 1) {
                                                            ?>
                                                            <li><a href="<?php echo $row['linkmenu']; ?>"> <?php echo $row['nommenu']; ?></a></li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li> <a data-toggle="modal" data-target="#myModalh"><?php
                                            $data = $this->session->userdata('pend');
                                            if ($data > 0) {
                                                ?><span class="glyphicon glyphicon-bell" aria-hidden="true"><span class="badge progress-bar-warning"><?php echo $data; ?></span></span><?php } ?></a></li>
                                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $username; ?>
                                            <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="datos/personal"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>Datos</a></li>
                                            <li><a href="loginin"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>Salir</a></li>
                                        </ul>
                                    </li>


                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>

                    </nav>
                    <!--
                    <div class="row">
                        <div class="col-md-12"> 
                            <div style="text-align: center"><php echo $_SERVER['REQUEST_URI']; ?></div>
                        </div>
                    </div>

                    -->

                    <section class="container">
