<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 pb-5">
                <div class="contenedor-formularios mb-2">
                    
                    <div class="full-box page-header">
                        <hr>
                        <h3 class="text-left">
                            <i class="fas fa-file-medical-alt"></i> &nbsp; Reportes
                        </h3>
                    </div>
                    

                    <div class="caja-reporte">
                        <h4 class="text-center"><i class="far fa-building"></i> Generar reporte de Empresas</h4>
                        <form action="<?php echo SERVERURL;?>reports/reporte_estudiantes.php" method="POST" autocomplete="off">
                            <div class="container-fluid">
                                <div class="row justify-content-md-center">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="orden_reporte_inventario" class="bmd-label-floating">Ordenar por</label>
                                            <select class="form-control" name="orden_reporte_inventario" id="orden_reporte_inventario" required>
                                                    <option value="nasc" selected="">Nombre (ascendente)</option>
                                                    <option value="ndesc">Nombre (descendente)</option>
                                                    <option value="fasc">Fecha (menor - mayor)</option>
                                                    <option value="fdesc">Fecha (mayor - menor)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="text-center" style="margin-top: 10px;">
                                            <button type="submit" class="btn btn-success"> <i class="fas fa-download"></i> &nbsp; GENERAR</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="caja-reporte">
                        <h4 class="text-center"> <i class="fas fa-user-graduate"></i> Generar reporte de Estudiantes</h4>
                        <form action="<?php echo SERVERURL;?>reports/reporte_empresas.php" method="POST" autocomplete="off">
                            <div class="container-fluid">
                                <div class="row justify-content-md-center">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label for="orden_reporte_inventario" class="bmd-label-floating">Ordenar por</label>
                                            <select class="form-control" name="orden_reporte_inventario" id="orden_reporte_inventario" required>
                                                    <option value="nasc" selected="">Nombre (ascendente)</option>
                                                    <option value="ndesc">Nombre (descendente)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="text-center" style="margin-top: 10px;">
                                            <button type="submit" class="btn btn-success"> <i class="fas fa-download"></i> &nbsp; GENERAR</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
