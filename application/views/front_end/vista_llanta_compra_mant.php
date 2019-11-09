
<section clase="container">
    <div class="row">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#"  title="Detalle Compra Llanta"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
                </ul>
                <p>Detalle Compra Llanta</p>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <fieldset> 
                        <div class="form-group">
                            <label for="numdni" class="col-sm-2 control-label">Codigo</label>
                            <div class="col-sm-10">

                                <input type="text" class="form-control" name="txtnomdni" value="<?php echo $cmpllcab->codcmp; ?>" requerid readonly="" id="txtnomdni"  style="width:50%; float:left" maxlength="8">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apepat" class="col-sm-2 control-label">Proveedor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txtappat" requerid id="txtappat" value="<?php echo $cmpllcab->rassocper; ?>" readonly="" style="width:50%; float:left" onkeyup="this.value = this.value.toLowerCase()" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apepat" class="col-sm-2 control-label">Fecha</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txtappat" requerid id="txtappat" value="<?php echo $cmpllcab->fcmp; ?>" readonly="" style="width:50%; float:left" onkeyup="this.value = this.value.toLowerCase()" >
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset> 
                        <div class="form-group">
                            <label for="numdni" class="col-sm-2 control-label">Documento</label>
                            <div class="col-sm-10">

                                <input type="text" class="form-control" name="txtnomdni" value="<?php echo $cmpllcab->comproban; ?>" requerid readonly="" id="txtnomdni"  style="width:50%; float:left" maxlength="8">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="numdni" class="col-sm-2 control-label">Numero</label>
                            <div class="col-sm-10">

                                <input type="text" class="form-control" name="txtnomdni" value="<?php echo $cmpllcab->nrodoccmp; ?>" requerid readonly="" id="txtnomdni"  style="width:50%; float:left" maxlength="8">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="numdni" class="col-sm-2 control-label">Importe</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txtnomdni" value="<?php echo $cmpllcab->totacmp; ?>" requerid readonly="" id="txtnomdni"  style="width:50%; float:left" maxlength="8">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-12">
                <div class="table-responsive">
                    <table id="tablelstll" class="table table-bordered" cellspacing="0" width="100%">
                        <thead><tr class="active"><th>Nro</th><th>Condicion</th><th>Marca</th><th>Modelo</th><th>Medida</th><th>Cantidad</th><th>Precio</th><th>Importe</th></tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($cmplldet) {
                                $conta = 0;
                                for ($d = 0; $d < count($cmplldet); $d++) {
                                    $conta = $conta + 1;
                                    $cad = $cmplldet[$d];
                                    $codcplldt = $cad['codcplldt'];
                                    $condicplldt = $cad['condicplldt'];
                                    switch ($condicplldt) {
                                        case 'N':
                                            $condicplldt = 'Nuevo';
                                            break;
                                        default:
                                            $condicplldt = 'Rencaunchate';
                                            break;
                                    }
                                    $nommrkllan = $cad['nommrkllan'];
                                    $nommod = $cad['nommod'];
                                    $nommedi = $cad['nommedi'];
                                    $ctdcplldt = $cad['ctdcplldt'];
                                    $pucplldt = $cad['pucplldt'];
                                    $impcplldt = $cad['impcplldt'];
                                    ?>
                                    <tr>       
                                        <td><?php echo $conta; ?></td>
                                        <td><?php echo $condicplldt; ?></td>                                         
                                        <td><?php echo $nommrkllan; ?></td>
                                        <td><?php echo $nommod; ?></td> 
                                        <td><?php echo $nommedi; ?></td>
                                        <td align="center"><?php echo $ctdcplldt; ?></td>
                                        <td><?php echo $pucplldt; ?></td>
                                        <td><?php echo $impcplldt; ?></td>
                                       
                                            <!-- <td align="center"><a class="btn btn-success" href="editarlnt/<?php echo $codllan; ?>"  title="Adenter"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                             <a onclick="if (confirma() == false)
                                                                 return false"  class="btn btn-danger" href="cancelar/pedido/<?php echo $codllan; ?>"  title="Anular"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
                                            </td>-->
                                        
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>       
                                    <td align="center" colspan="9">no hay Datos para mostrar</td></tr>
                            <?php } ?>                         </tbody>
                    </table>
                </div>
                    </div>
            </div>
        </div>
    </div>
</section>

