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
                        <h3 class="text-left centrado-titulo">
                            <i class="fas fa-desktop"></i> &nbsp; Aspectos de la Página de Inicio
                        </h3>
                    </div>
                    
                    <div class="aspectos-pagina-contenedor">

                        <div class="item-aspecto-pagina">
                            
                            <div class="izquierda-aspecto-pagina">
                                <div class="titulo-izquierda-aspecto">
                                    Testimonios
                                </div>
                                <div class="icono-izquierda-aspecto">
                                    <i class="far fa-comment-alt"></i>
                                </div>
                            </div>

                            <div class="derecha-aspecto-pagina">

                                <div class="item-derecha-aspecto-pagina">
                                <?php
                                    $fechaActual = date('Y-m-d');
                                    require "./controladores/testimonioPlataformaControlador.php";
                                    $ItestimonioPlataforma = new testimonioPlataformaControlador();
                                    $NTfecha = $ItestimonioPlataforma->datos_testimonioPlataforma_controlador("Fecha",0,$fechaActual);
                                ?>
                                    Testimonios de hoy &nbsp; <span class="badge badge-pill badge-danger"><?php echo $NTfecha->rowCount(); ?></span>
                                </div>

                                <div class="item-derecha-aspecto-pagina">
                                <?php
                                    $ItestimonioPlataforma2 = new testimonioPlataformaControlador();
                                    $NTestado = $ItestimonioPlataforma2->datos_testimonioPlataforma_controlador("Estado",0,"Visible");
                                ?>
                                    Testimonios Visibles &nbsp; <span class="badge badge-pill badge-success"><?php echo $NTestado->rowCount(); ?></span>
                                </div>

                                <div class="item-derecha-aspecto-pagina">
                                <?php
                                    $ItestimonioPlataforma3 = new testimonioPlataformaControlador();
                                    $NTall = $ItestimonioPlataforma3->datos_testimonioPlataforma_controlador("Conteo",0,0);
                                ?>
                                    Total de testimonios &nbsp; <span class="badge badge-pill badge-primary"><?php echo $NTall->rowCount(); ?></span>
                                </div>

                                <div class="item-derecha-aspecto-pagina mt-3">
                                    <a href="<?php echo SERVERURL; ?>testimonioLista/">Gestionar</a>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
