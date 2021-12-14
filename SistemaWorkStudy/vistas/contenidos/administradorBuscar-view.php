<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 
<!-- Breadcrumbs -->
<div class="container">
  <div class="breadcrumbs p-2">
         <a href="<?php echo SERVERURL; ?>inicioAdministrador/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>usuarios/">Usuarios</a><i class="fa fa-angle-double-right"></i><span>Gestión de Administradores</span>
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
                        <i class="fas fa-user-cog"></i> &nbsp; Administradores 
                    </h3>
                    <p class="text-justify">
                        En el módulo GESTIÓN DE ADMINISTRADORES usted podrá registrar los administradores que mantendrán actualizados los datos del sistema. Además de lo antes mencionado, puede actualizar los datos de los administradores, realizar búsquedas de los mismos o eliminarlos si así lo desea.
                    </p>
                </div>

                <!-- Opciones-->
                <div class="container-fluid">
                    <ul class="listado-panel">
                        <li>
                            <a href="<?php echo SERVERURL; ?>administradorLista/" class="enlace-lista">
                            <i class="far fa-list-alt"></i> &nbsp; LISTADO
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>administradorNuevo/" class="enlace-nuevo">
                                <i class="fas fa-plus"></i> &nbsp; AGREGAR
                            </a>
                        </li>
                        <li>
                        <a href="<?php echo SERVERURL; ?>administradorBuscar/" class="enlace-buscar activo3">
                            <i class="fas fa-search"></i> &nbsp; BUSCAR
                        </a>
                        </li>
                    </ul>
                </div>

                <?php 
	                if(!isset($_SESSION['busqueda_admin']) && empty($_SESSION['busqueda_admin'])):
                ?>

                <!-- BUSCAR  -->
                <div class="contenedor-busqueda">
                    <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" data-form="default" method="POST" autocomplete="off">
                        <input type="hidden" name="modulo" value="">
                        <div class="container-fluid">
                            <div class="row justify-content-md-center">
                                <div class="col-12 col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" name="busqueda_admin" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" id="inputSearch" maxlength="30" placeholder="¿Qué administrador estas buscando?" required>
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
                        <input type="hidden" name="eliminar_busqueda_admin" value="1">
                        <div class="container-fluid">
                            <div class="row justify-content-md-center">
                                <div class="col-12 col-md-6">
                                    <p class="text-center" style="font-size: 20px;">
                                        Resultados de la búsqueda <strong>“<?php echo $_SESSION['busqueda_admin'];?>”</strong>
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

                <!-- Lista -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div class="contenedor-paneles mb-5">
                                <div class="container-fluid">
                                    <div class="panel panel-info shadow mt-4">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="fas fa-list"></i> &nbsp; LISTA DE ADMINISTRADORES</h3>
                                        </div>
                                        <div class="panel-body">
                                        <?php 
                                            require_once "./controladores/administradorControlador.php";
                                            $insAdministrador = new administradorControlador();
                    
                                            $pagina = explode("/", $_GET['views']);
                                            echo $insAdministrador->paginador_administrador_controlador($pagina[1],10,$_SESSION['codigo_cuenta_WS'],$_SESSION['busqueda_admin']);
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