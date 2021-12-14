<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?>  

<!-- Breadcrumbs -->
<div class="container">
  <div class="breadcrumbs p-2">
         <a href="<?php echo SERVERURL; ?>inicioAdministrador/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>usuarios/">Usuarios</a><i class="fa fa-angle-double-right"></i><span>Gestión de Empresas</span>
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
            <i class="far fa-building"></i> &nbsp; Empresas 
          </h3>
          <p class="text-justify">
            En el módulo GESTIÓN DE EMPRESAS usted podrá visualizar las empresas registradas. Además de lo antes mencionado, puede actualizar los datos de las empresas si se es nescesario, realizar búsquedas de los mismos o desactivar su cuenta si así lo desea.
          </p>
        </div>

        <!-- Opciones-->
        <div class="container-fluid">
            <ul class="listado-panel">
                <li>
                    <a href="<?php echo SERVERURL; ?>empresaLista/" class="enlace-lista activo1">
                        <i class="far fa-list-alt"></i> &nbsp; LISTADO
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>empresaBuscar/" class="enlace-buscar">
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
                      <h3 class="panel-title"><i class="fas fa-list"></i> &nbsp; LISTA DE EMPRESAS</h3>
                    </div>
                    <div class="panel-body">
                    <?php 
                          require_once "./controladores/empresaControlador.php";
                          $insempresa = new empresaControlador();
 
                          $pagina = explode("/", $_GET['views']);
                          echo $insempresa->paginador_empresa_controlador($pagina[1],20,"");
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