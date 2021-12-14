<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 
<!-- Breadcrumbs -->
<div class="container">
  <div class="breadcrumbs p-2">
         <a href="<?php echo SERVERURL; ?>inicioAdministrador/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>mantenimiento/">Mantenimiento</a><i class="fa fa-angle-double-right"></i><span>Gestión de Materias</span>
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
                        <i class="far fa-bookmark"></i> &nbsp; Materias 
                    </h3>
                    <p class="text-justify">
                        En el módulo GESTIÓN DE MATERIA usted podrá registrar las materias que permitirán el registro de otras entidades. Además de lo antes mencionado, puede actualizar los datos de los administradores, realizar búsquedas de los mismos o eliminarlos si así lo desea.
                    </p>
                </div>

                <!--Opciones-->
                <div class="container-fluid">
                    <ul class="listado-panel">
                        <li>
                            <a href="<?php echo SERVERURL; ?>materiaLista/" class="enlace-lista ">
                                <i class="far fa-list-alt"></i> &nbsp; LISTADO
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>materiaNueva/" class="enlace-nuevo activo2">
                                <i class="fas fa-plus"></i> &nbsp; AGREGAR
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>materiaBuscar/" class="enlace-buscar">
                                <i class="fas fa-search"></i> &nbsp; BUSCAR
                            </a>
                        </li>
                    </ul>
                </div>

                <!--Formulario-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div class="contenedor-paneles mb-5">
                                <div class="container-fluid">
                                    <div class="panel panel-agregar shadow mt-4">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                            <i class="fas fa-plus"></i>&nbsp; NUEVA MATERIA
                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            <form class="FormularioAjax" data-form="save" action="<?php echo SERVERURL; ?>ajax/materiaAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>
                                                        <i class="fas fa-database"></i> &nbsp; Datos Generales
                                                    </legend>
                                                    <div class="container-fluid pt-2">
                                                        <div class="row">

                                                            <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <label for="materia_nombre">
                                                                        Nombre <span class="asterisco">*</span>
                                                                    </label>
                                                                    <input pattern="{1,45}" class="form-control" type="text" name="materia_nombre_reg" required="" maxlength="45" id="materia_nombre">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="materia_estado">
                                                                        Vigencia <span class="asterisco">*</span>
                                                                    </label>
                                                                    <select class="form-control" name="materia_estado_reg" required id="materia_estado">
                                                                        <option value="Vigente" selected>Vigente</option>
                                                                        <option value="Sin Vigencia">Sin Vigencia</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <br>
                                                <p class="text-center" style="margin-top: 10px;">
                                                    <button type="reset" class="boton-limpiar"><i class="fas fa-eraser"></i> &nbsp; Limpiar</button>
                                                        &nbsp; &nbsp;
                                                    <button type="submit" class="boton-guardar"><i class="far fa-save"></i> Guardar</button>
                                                </p>
                                                <p class="text-center">
                                                        <small style="font-size:14px">Los campos marcados con &nbsp; (<span class="asterisco">*</span>) &nbsp; son obligatorios</small>
                                                </p>
                                                <div class="RespuestaAjax"></div>
                                            </form>
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