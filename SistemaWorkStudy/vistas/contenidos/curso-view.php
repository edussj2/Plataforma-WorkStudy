<div class="curso-unico">  
    <?php 
       $datos = explode("/", $_GET['views']);

       require_once "./controladores/cursoControlador.php";
       $classcurso = new cursoControlador();
   
       $filesC = $classcurso->datos_curso_controlador("Unico",$datos[1]);
   
       if($filesC->rowCount()==1){
   
            $campos = $filesC->fetch();

            require_once "./controladores/subcategoriaControlador.php";
            $classsubcategoria = new subcategoriaControlador();

            $filesS = $classsubcategoria->datos_subcategoria_controlador("Unico",mainModel::encryption($campos['idSubCategoria']));

            $camposS = $filesS->fetch();

            require_once "./controladores/estudianteControlador.php";
            $classestudiante = new estudianteControlador();

            $filesE = $classestudiante->datos_estudiante_controlador("Unico2",mainModel::encryption($campos['idEstudiante']));

            $camposE = $filesE->fetch();

    ?>
    <div class="row pb-4 border-bottom">

        <div class="col-lg-5">
            <div class="breadcrumbs">
                <a href="<?php echo SERVERURL; ?>cursos/all/">Cursos</a><i class="fa fa-angle-double-right"></i><span><?php echo $camposS['SubDescripcion'];?></span>
            </div>
            <div class="titulo-curso">
                <h2><?php echo $campos['CurTitulo'];?></h2>
            </div>
            <div class="subtitulo-curso">
                <p><?php echo $campos['CurSubTitulo'];?></p>
            </div>
            <div class="informacion-curso">
                <div class="info">
                    <i class="fas fa-signal"></i> &nbsp; Nivel: <?php echo $campos['CurNivel'];?>
                </div>
                <div class="info">
                    <i class="far fa-calendar-alt"></i> &nbsp; Fecha de publicación: <?php echo $campos['CurFecha'];?>
                </div>
                <div class="info">
                    <i class="far fa-clock"></i> &nbsp; Duración: <?php echo $campos['CurDuracion'];?> horas
                </div>
                <div class="info">
                    <i class="fas fa-sitemap"></i> &nbsp; Subcategoría: <?php echo $camposS['SubDescripcion'];?>
                </div>
            </div>
            <div class="opciones">
                <a href="https://api.whatsapp.com/send?phone=<?php echo $camposE['EstCelular'];?>&text=Hola, encontre tu curso de en WorkStudy. Más información porfavor." class="btn btn-info text-decoration-none mb-1" style="font-size:14px"><i class="fas fa-shopping-cart"></i> Comprar por S/ <?php echo $campos['CurPrecio'];?> soles</a>
                &nbsp;&nbsp;
                <?php if($campos['CurVideo']!=""){?>
                <a href="<?php echo $campos['CurVideo'];?>" class="popup-youtube btn btn-outline-info text-decoration-none mb-1" style="font-size:14px"><i class="far fa-play-circle"></i> Video de presentación</a>
                <?php } ?>
            </div>
        </div>

        <div class="col-lg-7">
            <!-- Video Preview -->
            <div class="image-container">
                <div class="video-wrapper">
                    <a class="popup-youtube" <?php if($campos['CurVideo']!=""){echo 'href=" '.$campos['CurVideo'].'"';}?> data-effect="fadeIn">
                        <img class="img-fluid" src="<?php echo SERVERURL; ?>adjuntos/cursos/<?php echo $campos['CurImagen'];?>" alt="<?php echo $campos['CurTitulo'];?>">
                        <?php if($campos['CurVideo']!=""){?>
                        <span class="video-play-button">
                            <span></span>
                        </span>
                        <?php } ?>
                    </a>
                </div> 
            </div>
            <!-- end of video preview -->
        </div>

    </div>

    <div class="row pt-4 mt-2">

        <div class="col-lg-8">
            <div class="contededor-detalles-curso">
                <div class="acerca-curso">
                    <h4>Acerca de este curso</h4>
                    <p><?php echo $campos['CurDescripcion'];?></p>
                </div>
                <hr>
                <div class="row m-1">
                    <div class="col-lg-4 detalle-curso">
                        <h4><i class="fas fa-file-alt"></i> ¿Qué aprenderás?</h4>
                        <p><i class="far fa-check-circle"></i> <?php echo $campos['CurObjetivos'];?></p>
                    </div>
                    <div class="col-lg-4 detalle-curso">
                        <h4><i class="far fa-lightbulb"></i> ¿Qué conocimientos previos necesitas?</h4>
                        <p><i class="far fa-check-circle"></i> <?php echo $campos['CurRequisitos'];?></p>
                    </div>
                    <div class="col-lg-4 detalle-curso">
                        <h4><i class="fas fa-users"></i> ¿A quién está dirigido este curso?</h4>
                        <p><i class="far fa-check-circle"></i> <?php echo $campos['CurDirigido'];?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">

            <div class="contenedor-profesor-curso">
                <div class="imagen-profesor">
                    <img src="<?php echo SERVERURL; ?>adjuntos/avatars/avatar.png" alt="">
                </div>
                <div class="descripcion-profesor">
                    <h5><?php echo $camposE['EstNombres'];?> <?php echo $camposE['EstApePaterno'];?> <?php echo $camposE['EstApeMaterno'];?></h5>
                    <p><?php echo $camposE['CtaEmail'];?></p>
                    <ul>
                        <?php if($camposE['idUniversidad']!=1){?>
                        <li><i class="fas fa-university"></i> Universidad Nacional Pedro Ruiz</li>
                        <li><i class="fas fa-user-graduate"></i> <?php echo $camposE['EstEscProfesional'];?></li>
                        <?php }?>
                    </ul>
                </div>
            </div>

            <div class="mas-cursos">

                <?php 
                    require_once "./controladores/cursoControlador.php";
                    $inscurso = new cursoControlador();

                    echo $inscurso->listar_small_curso_controlador($campos['idSubCategoria'],$datos[1]);
                ?>
                
            </div>

        </div>

    </div>

    <?php 
        }else{
    ?>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404"></div>
            <h1>Oops!</h1>
            <h2>Ocurrió un error inesperado</h2>
            <p>Hubo un problema, se recomienda recargar la página o volver al Inicio.</p>
        </div>
    </div>
    <?php   
        }
    ?> 

</div>

<div class="container">
    <hr>
    <?php include "./vistas/modulos/footer.php";?>
</div>

<script>
    (function($) {
	/* Video Lightbox - Magnific Popup */
    $('.popup-youtube, .popup-vimeo').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        iframe: {
            patterns: {
                youtube: {
                    index: 'youtube.com/', 
                    id: function(url) {        
                        var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                        if ( !m || !m[1] ) return null;
                        return m[1];
                    },
                    src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                },
                vimeo: {
                    index: 'vimeo.com/', 
                    id: function(url) {        
                        var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
                        if ( !m || !m[5] ) return null;
                        return m[5];
                    },
                    src: 'https://player.vimeo.com/video/%id%?autoplay=1'
                }
            }
        }
    });
    })(jQuery);
</script>