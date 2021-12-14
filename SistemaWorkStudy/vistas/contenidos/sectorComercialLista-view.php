<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 

<!-- Breadcrumbs -->
<div class="container">
  <div class="breadcrumbs p-2">
         <a href="<?php echo SERVERURL; ?>inicioAdministrador/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>mantenimiento/">Mantenimiento</a><i class="fa fa-angle-double-right"></i><span>Gestión de S. Comerciales</span>
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
              <i class="fas fa-money-bill-wave"></i> &nbsp; Sector Comercial
          </h3>
          <p class="text-justify">
            En el módulo GESTIÓN DE SECTOR COMERCIAL usted podrá registrar los sectores comerciales que permitirán identificar a las empresas. Además de lo antes mencionado, puede actualizar los datos de los administradores, realizar búsquedas de los mismos o eliminarlos si así lo desea.
          </p>
        </div>

        <!-- Opciones-->
        <div class="container-fluid">
            <ul class="listado-panel">
                <li>
                    <a href="<?php echo SERVERURL; ?>sectorComercialLista/" class="enlace-lista activo1">
                      <i class="far fa-list-alt"></i> &nbsp; LISTADO
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>sectorComercialNuevo/" class="enlace-nuevo">
                        <i class="fas fa-plus"></i> &nbsp; AGREGAR
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>sectorComercialBuscar/" class="enlace-buscar">
                      <i class="fas fa-search"></i> &nbsp; BUSCAR
                    </a>
                </li>
            </ul>
        </div>

        <!-- Lista-->
        <div class="container">
          <div class="row">
            <div class="col-lg-12 mb-5">
              <div class="contenedor-paneles mb-5">
                <div class="container-fluid">
                  <div class="panel panel-info shadow mt-4">
                    <div class="panel-heading">
                      <h3 class="panel-title"><i class="fas fa-list"></i> &nbsp; LISTA DE SECTORES COMERCIALES</h3>
                    </div>
                    <div class="panel-body">
                      <?php 
                          require_once "./controladores/sectorComercialControlador.php";
                          $insSectorComercial = new sectorComercialControlador();
                    
                          $pagina = explode("/", $_GET['views']);
                          echo $insSectorComercial->paginador_sectorComercial_controlador($pagina[1],10,"");
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