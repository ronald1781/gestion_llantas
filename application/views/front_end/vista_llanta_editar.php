<section clase="container">
    <div class="row">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#"  title="Detalle Llanta"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
                </ul>
                <p>Detalle Llanta</p>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <fieldset> 
                        <input type="hidden" class="form-control" name="txtcodillan" value="<?php echo $dateditllan->codllan; ?>"  readonly="" id="txtcodillan"  maxlength="8">

                        <div class="form-group">
                            <label for="numdni" class="col-sm-3 control-label">Codigo</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $dateditllan->codillan; ?></p>
                            </div>
                        </div>
                        <?php
                        $condillan = $dateditllan->condillan;
                        switch ($condillan) {
                            case 'N':
                                $condillan = 'Nuevo';
                                break;
                            default:
                                $condillan = 'Rencaunchate';
                                break;
                        }
                        ?>
                        <div class="form-group">
                            <label for="apepat" class="col-sm-3 control-label">Condicion</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $condillan; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apepat" class="col-sm-3 control-label">Serie</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $dateditllan->nrosrllan; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apepat" class="col-sm-3 control-label">Fecha_Compra</label>
                            <div class="col-sm-9">
                                <?php
                                $date = strtotime($dateditllan->fcmpllan);
                                $new_date = date('Y-m-d', $date);
                                ?>
                                <p class="form-control-static"><?php echo $new_date; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apepat" class="col-sm-3 control-label">Proveedor</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $dateditllan->rassocper; ?></p>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset> 
                        <div class="form-group">
                            <label for="numdni" class="col-sm-3 control-label">Marca</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $dateditllan->nommrkllan; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="numdni" class="col-sm-3 control-label">Modelo</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $dateditllan->nommod; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="numdni" class="col-sm-3 control-label">Medida</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $dateditllan->nommedi; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apepat" class="col-sm-3 control-label">Remanente</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><span class="label label-success"><?php echo $dateditllan->remallan; ?></span></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="numdni" class="col-sm-3 control-label">Estado</label>

                            <?php
                            $estllan = $dateditllan->estllan;
                            switch ($estllan) {
                                case 'D':
                                    $estllan = 'Disponible';
                                    break;
                                default:
                                    $estllan = 'Averiado';
                                    break;
                            }
                            ?>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $estllan; ?></p>

                            </div>
                        </div>
                    </fieldset>
                </div>

            </div>
        </div>
    </div>
</section>

