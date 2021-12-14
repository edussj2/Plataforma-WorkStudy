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

        <!--Cabecera-->
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
                    <a href="<?php echo SERVERURL; ?>administradorLista/" class="enlace-lista activo1">
                        <i class="far fa-list-alt"></i> &nbsp; LISTADO
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>administradorNuevo/" class="enlace-nuevo">
                        <i class="fas fa-plus"></i> &nbsp; AGREGAR
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>administradorBuscar/" class="enlace-buscar">
                        <i class="fas fa-search"></i> &nbsp; BUSCAR
                    </a>
                </li>
            </ul>
        </div>

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
                          echo $insAdministrador->paginador_administrador_controlador($pagina[1],10,$_SESSION['codigo_cuenta_WS'],"");
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>