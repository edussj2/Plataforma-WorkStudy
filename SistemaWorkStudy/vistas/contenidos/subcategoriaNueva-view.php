<?php
	if($_SESSION['tipo_WS']!="Administrador"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 

<!-- Breadcrumbs -->
<div class="container">
  <div class="breadcrumbs p-2">
         <a href="<?php echo SERVERURL; ?>inicioAdministrador/">Inicio</a><i class="fa fa-angle-double-right"></i><a href="<?php echo SERVERURL; ?>mantenimiento/">Mantenimiento</a><i class="fa fa-angle-double-right"></i><span>Gestión de SubCategorías-Cursos</span>
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
                        <i class="fas fa-table"></i> &nbsp; Subcategoría de Cursos 
                    </h3>
                    <p class="text-justify">
                        En el módulo GESTIÓN DE SUBCATEGORÍAS DE CURSOS usted podrá registrar las subcategorías que permitirán identificar a las empresas. Además de lo antes mencionado, puede actualizar los datos de las subcategorías, realizar búsquedas de los mismos o eliminarlos si así lo desea.
                    </p>
                </div>

                <!--Opciones-->
                <div class="container-fluid">
                    <ul class="listado-panel">
                        <li>
                            <a href="<?php echo SERVERURL; ?>subcategoriaLista/" class="enlace-lista">
                                <i class="far fa-list-alt"></i> &nbsp; LISTADO
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>subcategoriaNueva/" class="enlace-nuevo activo2">
                                <i class="fas fa-plus"></i> &nbsp; AGREGAR
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>subcategoriaBuscar/" class="enlace-buscar">
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
                                            <i class="fas fa-plus"></i>&nbsp; NUEVA SUBCATEGORÍA
                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            <form class="FormularioAjax" data-form="save" action="<?php echo SERVERURL; ?>ajax/subcategoriaAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>
                                                        <i class="fas fa-database"></i> &nbsp; Datos Generales
                                                    </legend>
                                                    <div class="container-fluid pt-2">
                                                        <div class="row">

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="categoria_nombre">
                                                                        Categoría <span class="asterisco">*</span>
                                                                    </label>
                                                                    <select class="form-control" id="subcategoria_categoria" name="subcategoria_categoria_reg" required>
                                                                        <option value="Sin Registro" selected>Seleccione una Categoría</option>
                                                                    <?php 
                                                                        require_once "./controladores/categoriaCursoControlador.php";

                                                                        $inscategoriaCurso = new categoriaCursoControlador();

                                                                        $doc = $inscategoriaCurso->datos_categoriaCurso_controlador("Select",0);

                                                                        while ($rowD = $doc->fetch()) {
                                                                                echo '<option value="'.$rowD['idCategoriaCurso'].'">'.$rowD['CatCursoDescripcion'].'</option>';                            
                                                                        }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="subcategoria_nombre">
                                                                        Descripción <span class="asterisco">*</span>
                                                                    </label>
                                                                    <input pattern="{1,50}" class="form-control" type="text" name="subcategoria_nombre_reg" required="" maxlength="50" id="subcategoria_nombre">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="subcategoria_icono">
                                                                        Icono
                                                                    </label>
                                                                    <input class="form-control" type="text" name="subcategoria_icono_reg" required="" maxlength="45" id="subcategoria_icono" placeholder="Ejem: fa fa-user">
                                                                </div>
                                                                <div class="form-text">Utilize esta página para buscar un icono: <a href="https://fontawesome.com/" target="_blank">fontawesome</a>.</div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="subcategoria_estado">
                                                                        Vigencia <span class="asterisco">*</span>
                                                                    </label>
                                                                    <select class="form-control" name="subcategoria_estado_reg" required id="subcategoria_estado">
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