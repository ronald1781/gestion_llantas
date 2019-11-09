<!DOCTYPE html  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
            <base href="<?php echo base_url(); ?>"></base>
            <title><?php echo $titulo ?></title>
            <link rel="shortcut icon" type="image/x-icon" href="assest/imagen/servti.ico" />
           
            <link href="assest/css/login.css" rel="stylesheet" type="text/css"></link>
           
            <link href="assest/css/rrgstilos.css" rel="stylesheet" type="text/css"></link>
           
            <link href="assest/css/bootstrap.css" rel="stylesheet" type="text/css"></link>
            
    </head>
    <body>
        <section clase="container">
            <div class="container">

                <!--echo form_open('verifylogin_control'); ?>-->
                <?php echo validation_errors('<p class="error">'); ?> 
                <form class="form-signin" role="form" name="login" action="valida/login" method="POST" id="forlogin">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <?php
//                   $clv = 'demo123';
 //                  echo $pas = md5($clv);
                            ?>
                            <h2 class="form-signin-heading">Debe identificarse</h2>
                            <input type="text" name="username" value="<?php echo set_value('username'); ?>" required id="username" class="form-control" placeholder="Usuario"  id="username" autofocus>
                                <input type="password" name="password"class="form-control" placeholder="Password" required id="password" placeholder="Password">
                                    <label class="checkbox">
                                        <?PHP echo $msg; ?>
                                    </label>
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                                    </div>
                                    <div class="card-mask">
                                        <a href="#">
                                            Crear cuenta
                                        </a>
                                    </div>
                                    </div>

                                    </form>


                                    </div>
                                    </section>
                                    </body>
                                    </html>

