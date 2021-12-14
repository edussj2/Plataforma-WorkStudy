<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 

<!-- Breadcrumbs -->
<div class="container">
  <div class="breadcrumbs p-2">
         <a href="<?php echo SERVERURL; ?>inicioAdministrador/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>usuarios/">Usuarios</a><i class="fa fa-angle-double-right"></i><span>Gestión de Estudiantes</span>
  </div>
</div>

<section class="pb-4">
    <div class="container">
        <div class="row mb-5">
            <div class="contenedor-formularios mb-2">

                <!--Cabecera-->
                <div class="full-box page-header">
                    <hr>
                    <h3 class="text-left">
                        <i class="fas fa-user-graduate"></i> &nbsp; Estudiantes 
                    </h3>
                    <p class="text-justify">
                        En el módulo GESTIÓN DE ESTUDIANTES usted podrá visualizar los estudiantes registradosan. Además de lo antes mencionado, puede actualizar los datos de los estudiantes si se es nescesario, realizar búsquedas de los mismos o desactivar su cuenta si así lo desea.
                    </p>
                </div>

                <!-- Opciones-->
                <div class="container-fluid">
                    <ul class="listado-panel">
                        <li>
                            <a href="<?php echo SERVERURL; ?>estudianteLista/" class="enlace-lista">
                                <i class="far fa-list-alt"></i> &nbsp; LISTADO
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>estudianteBuscar/" class="enlace-buscar activo3">
                                <i class="fas fa-search"></i> &nbsp; BUSCAR
                            </a>
                        </li>
                    </ul>
                </div>

                <?php 
	                if(!isset($_SESSION['busqueda_estudiante']) && empty($_SESSION['busqueda_estudiante'])):
                ?>

                <!-- BUSCAR  -->
                <div class="contenedor-busqueda">
                    <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="default" method="POST" autocomplete="off">
                        <input type="hidden" name="modulo" value="">
                        <div class="container-fluid">
                            <div class="row justify-content-md-center">
                                <div class="col-12 col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" name="busqueda_estudiante" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" id="inputSearch" maxlength="30" placeholder="¿Qué estudiante estas buscando?" required>
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
                <!-- BUSCAR -->

                <?php else: ?>

                <!-- Eliminar busqueda -->
                <div class="contenedor-eliminar">
                    <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="search" method="POST" autocomplete="off">
                        <input type="hidden" name="eliminar_busqueda_estudiante" value="1">
                        <div class="container-fluid">
                            <div class="row justify-content-md-center">
                                <div class="col-12 col-md-6">
                                    <p class="text-center" style="font-size: 20px;">
                                        Resultados de la búsqueda <strong>“<?php echo $_SESSION['busqueda_estudiante'];?>”</strong>
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
                                            <h3 class="panel-title"><i class="fas fa-list"></i> &nbsp; LISTA DE ESTUDIANTES</h3>
                                        </div>
                                        <div class="panel-body">
                                        <?php 
                                            require_once "./controladores/estudianteControlador.php";
                                            $insestudiante = new estudianteControlador();

                                            $pagina = explode("/", $_GET['views']);
                                            echo $insestudiante->paginador_estudiante_controlador($pagina[1],10,$_SESSION['busqueda_estudiante']);
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endif;?>
                  
            </div>
        </div>
    </div>
</section> 