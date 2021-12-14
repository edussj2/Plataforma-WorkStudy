<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 
<!-- Breadcrumbs -->
<div class="container">
  <div class="breadcrumbs p-2">
         <a href="<?php echo SERVERURL; ?>inicioAdministrador/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>pagina/">Página</a><i class="fa fa-angle-double-right"></i><span>Gestión de Testimonios</span>
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
                        <i class="far fa-comment-alt"></i> &nbsp; Testimonios
                    </h3>
                    <p class="text-justify">
                        En el módulo TESTIMONIOS usted podrá gestioanr los testimonios que se visualizarán en la página principal de la plataforma. Además de lo antes mencionado, puede eliminarlos si así lo desea.
                    </p>
                </div>

                <!--Opciones-->
                <div class="container-fluid">
                    <ul class="listado-panel">
                        <li>
                            <a href="<?php echo SERVERURL; ?>testimonioLista/" class="enlace-lista activo1">
                                <i class="far fa-list-alt"></i> &nbsp; LISTADO
                            </a>
                        </li>
                    </ul>
                </div>

                <!--Listado-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div class="contenedor-paneles mb-5">
                                <div class="container-fluid">
                                    <div class="panel panel-info shadow mt-4">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="fas fa-list"></i> &nbsp; LISTA DE TESTIMONIOS</h3>
                                        </div>
                                        <div class="panel-body">
                                        <?php 
                                            require_once "./controladores/testimonioPlataformaControlador.php";
                                            $instestimonioPlataforma = new testimonioPlataformaControlador();

                                            $pagina = explode("/", $_GET['views']);
                                            echo $instestimonioPlataforma->paginador_testimonioPlataforma_controlador($pagina[1],10);
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