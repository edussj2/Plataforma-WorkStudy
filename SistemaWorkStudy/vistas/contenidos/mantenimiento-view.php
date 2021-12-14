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
                            <i class="fas fa-tasks"></i> &nbsp; Mantenimiento
                        </h3>
                    </div>
                    <?php
                        require "./controladores/areaControlador.php";
                        $IArea = new areaControlador();
                        $CArea = $IArea->datos_area_controlador("Conteo",0);

                        require "./controladores/sectorComercialControlador.php";
                        $IsectorComercial = new sectorComercialControlador();
                        $CsectorComercial = $IsectorComercial->datos_sectorComercial_controlador("Conteo",0);

                        require "./controladores/categoriaControlador.php";
                        $Icategoria = new categoriaControlador();
                        $Ccategoria = $Icategoria->datos_categoria_controlador("Conteo",0);

                        require "./controladores/materiaControlador.php";
                        $Imateria = new materiaControlador();
                        $Cmateria = $Imateria->datos_materia_controlador("Conteo",0);

                        require "./controladores/idiomaControlador.php";
                        $Iidioma = new idiomaControlador();
                        $Cidioma = $Iidioma->datos_idioma_controlador("Conteo",0);

                        require "./controladores/universidadControlador.php";
                        $Iuniversidad = new universidadControlador();
                        $Cuniversidad = $Iuniversidad->datos_universidad_controlador("Conteo",0);

                        require "./controladores/categoriaCursoControlador.php";
                        $IcategoriaCurso = new categoriaCursoControlador();
                        $CcategoriaCurso = $IcategoriaCurso->datos_categoriaCurso_controlador("Conteo",0);

                        require "./controladores/subcategoriaControlador.php";
                        $Isubcategoria = new subcategoriaControlador();
                        $Csubcategoria = $Isubcategoria->datos_subcategoria_controlador("Conteo",0);
                    
                    ?>

                    <div class="full-box tile-container mb-5">

                        <a href="<?php echo SERVERURL; ?>areaLista/" class="tile">
                            <div class="tile-tittle">Áreas</div>
                            <div class="tile-icon">
                                <i class="fa fa-certificate"></i>
                                <p><?php echo $CArea->rowCount(); ?> Registradas</p>
                            </div>
                        </a>

                        <a href="<?php echo SERVERURL; ?>sectorComercialLista/" class="tile">
                            <div class="tile-tittle">Sec. Comerciales</div>
                            <div class="tile-icon">
                                <i class="fas fa-money-bill-wave"></i>
                                <p><?php echo $CsectorComercial->rowCount(); ?> Registrados</p>
                            </div>
                        </a>

                        <a href="<?php echo SERVERURL; ?>categoriaLista/" class="tile">
                            <div class="tile-tittle">Categorías-Ofertas</div>
                            <div class="tile-icon">
                                <i class="fas fa-tags fa-fw"></i>
                                <p><?php echo $Ccategoria->rowCount(); ?> Registradas</p>
                            </div>
                        </a>

                        <a href="<?php echo SERVERURL; ?>materiaLista/" class="tile">
                            <div class="tile-tittle">Materias</div>
                            <div class="tile-icon">
                                <i class="far fa-bookmark"></i>
                                <p><?php echo $Cmateria->rowCount(); ?> Registrados</p>
                            </div>
                        </a>
                        
                        <a href="<?php echo SERVERURL; ?>idiomaLista/" class="tile">
                            <div class="tile-tittle">Idiomas</div>
                            <div class="tile-icon">
                                <i class="fas fa-language"></i>
                                <p><?php echo $Cidioma->rowCount(); ?> Registrados</p>
                            </div>
                        </a>

                        <a href="<?php echo SERVERURL; ?>universidadLista/" class="tile">
                            <div class="tile-tittle">Universidades</div>
                            <div class="tile-icon">
                                <i class="fas fa-university"></i>
                                <p><?php echo $Cuniversidad->rowCount()-1; ?> Registrados</p>
                            </div>
                        </a>

                        <a href="<?php echo SERVERURL; ?>categoriaCursoLista/" class="tile">
                            <div class="tile-tittle">Categorías-Cursos</div>
                            <div class="tile-icon">
                                <i class="fas fa-project-diagram"></i>
                                <p><?php echo $CcategoriaCurso->rowCount(); ?> Registrados</p>
                            </div>
                        </a>

                        <a href="<?php echo SERVERURL; ?>subcategoriaLista/" class="tile">
                            <div class="tile-tittle">SubCategorías-Cursos</div>
                            <div class="tile-icon">
                                <i class="fas fa-table"></i>
                                <p><?php echo $Csubcategoria->rowCount(); ?> Registrados</p>
                            </div>
                        </a>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
