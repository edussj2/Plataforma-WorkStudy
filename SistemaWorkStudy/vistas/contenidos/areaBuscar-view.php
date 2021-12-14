<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?>  
<!-- Breadcrumbs -->
<div class="container">
    <div class="breadcrumbs p-2">
        <a href="<?php echo SERVERURL; ?>inicioAdministrador/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>mantenimiento/">Mantenimiento</a><i class="fa fa-angle-double-right"></i><span>Gestión de Áreas</span>
    </div>
</div>

<section class="pb-4">   
    <div class="container">
        <div class="row mb-5">
            <div class="contenedor-formularios mb-2">

                <!-- Cabecera-->
                <div class="full-box page-header">
                    <hr>
                    <h3 class="text-left">
                        <i class="fa fa-certificate"></i> &nbsp; Áreas 
                    </h3>
                    <p class="text-justify">
                        En el módulo GESTIÓN DE ÁREAS usted podrá registrar las áreas que servirán para filtrar las publicaciones hechas por los estudiantes. Además de lo antes mencionado, puede actualizar los datos de las áreas, realizar búsquedas de las mismas o eliminarlas si así lo desea.
                    </p>
                </div>

                <!-- Opciones-->
                <div class="container-fluid">
                    <ul class="listado-panel">
                        <li>
                            <a href="<?php echo SERVERURL; ?>areaLista/" class="enlace-lista">
                                <i class="far fa-list-alt"></i> &nbsp; LISTADO
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>areaNueva/" class="enlace-nuevo ">
                                <i class="fas fa-plus"></i> &nbsp; AGREGAR
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>areaBuscar/" class="enlace-buscar activo3">
                                <i class="fas fa-search"></i> &nbsp; BUSCAR
                            </a>
                        </li>
                    </ul>
                </div>

                <?php 
                    if(!isset($_SESSION['busqueda_area']) && empty($_SESSION['busqueda_area'])):
                ?>

                <!-- Buscar  -->
                <div class="contenedor-busqueda">
                    <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="default" method="POST" autocomplete="off">
                        <input type="hidden" name="modulo" value="">
                        <div class="container-fluid">
                            <div class="row justify-content-md-center">
                                <div class="col-12 col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" name="busqueda_area" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" id="inputSearch" maxlength="30" placeholder="¿Qué área estas buscando?" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="text-center">
                                        <button type="submit" class="btn btn-sm btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="RespuestaAjax"></div>
                    </form>
                </div>
                <!-- Buscar -->

                <?php else: ?>

                <!-- Eliminar busqueda -->
                <div class="contenedor-eliminar">
                    <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="search" method="POST" autocomplete="off">
                        <input type="hidden" name="eliminar_busqueda_area" value="1">
                        <div class="container-fluid">
                            <div class="row justify-content-md-center">
                                <div class="col-12 col-md-6">
                                    <p class="text-center" style="font-size: 20px;">
                                        Resultados de la búsqueda <strong>“<?php echo $_SESSION['busqueda_area'];?>”</strong>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p class="text-center" style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="RespuestaAjax"></div>
                    </form>
                </div>
                <!-- Eliminar busqueda -->

                <!--Listado-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div class="contenedor-paneles mb-5">
                                <div class="container-fluid">
                                    <div class="panel panel-info shadow mt-4">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="fas fa-list"></i> &nbsp; LISTA DE ÁREAS</h3>
                                        </div>
                                        <div class="panel-body">
                                            <?php 
                                                require_once "./controladores/areaControlador.php";
                                                $insarea = new areaControlador();

                                                $pagina = explode("/", $_GET['views']);
                                                echo $insarea->paginador_area_controlador($pagina[1],10,$_SESSION['busqueda_area']);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Listado-->

                <?php endif;?>
                
            </div>
        </div>
    </div>
</section>