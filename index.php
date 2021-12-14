<?php 
    include 'lib/config.php';
    include 'lib/funciones.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Plataforma para generar ingresos económicos en los estudiantes, Worstudy.">
    <meta name="author" content="Edu Cespedes Ordinola">
	<meta property="og:site_name" content="WorkStudy" /> <!-- Nombre website -->
	<meta property="og:site" content="www.workstudy.com" /> <!-- Link Website -->
	<meta property="og:title" content=""/> <!-- Título que se muestra en la publicación compartida -->
	<meta property="og:description" content="" /> <!-- Descripción que se muestra en la publicación compartida real -->
	<meta property="og:url" content="" /> <!-- ¿A dónde quieres que se vincule tu publicación? -->
	<meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>Workstudy</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="css/swiper.css" rel="stylesheet">
	<link href="css/magnific-popup.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!-- Favicon  -->
    <link rel="icon" href="images/logoCompleto.PNG">
</head>

<body data-spy="scroll" data-target=".fixed-top">
    
    <!-- ****** Preloader ******* -->
	<div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- ****** Preloader ******* -->
    

    <!-- ****** Barra de Navegación ******* -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">

        <!-- Imagen Logo -->
        <a class="navbar-brand logo-image" href="./">
            <img src="images/logoRectangulo.png" alt="Logo WorkStudy">
        </a>
        <!-- Imagen Logo -->
        
        <!-- Toggle Button Responsiva -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- Toggle Button Responsiva -->

        <!-- Opciones barra de navegación -->
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#header">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#estudiante">Estudiantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#empresa">Empresas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#testimonios">Testimonios</a>
                </li>

                <li class="nav-item mr-1 mt-esp">
                    <a class="btn-solid-reg" href="SistemaWorkStudy/login/">Iniciar Sesión</a>
                </li>

                <li class="nav-item mt-esp">
                    <a class="btn-solid-reg popup-with-move-anim" href="#details">Registrate</a>
                </li>

            </ul>
        </div>
        <!-- Opciones barra de navegación -->

    </nav> 
    <!-- ****** Barra de Navegación ******* -->


    <!-- ****** Modal de registro ******* -->
	<div id="details" class="lightbox-basic zoom-anim-dialog mfp-hide">
        <div class="container">
            <h3 class="text-center">Seleccione tipo de usuario</h3>
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>

                <!-- Registro Empresa -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="images/portada5.svg" alt="Empresa">
                    </div> 
                    <h3><i class="fas fa-building"></i> Empresa</h3>
                    <hr>
                    <p>¿Eres una empresa? Registrarte como usario tipo empresa para poder publicar ofertas laborales y conseguir perfiles competentes para el trabajo.</p>
                    <div class="text-center">
                        <a href="registro-empresa.php" class="btn-solid-reg">Seleccionar</a>
                    </div>
                </div>
                <!-- Registro Empresa -->

                <!-- Registro Estudiante -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="images/portada2.svg" alt="Estudiante">
                    </div> 
                    <h3><i class="fas fa-user-graduate"></i> Estudiante</h3>
                    <hr>
                    <p>¿Eres un estudiante? Registrate como un estudiante para acceder a todas las funcionalidades que te ofrece Workstudy y se parte de esta comunidad.</p>
                    <div class="text-center">
                        <a href="registro-estudiante.php" class="btn-solid-reg">Seleccionar</a>
                    </div>
                </div> 
                <!-- Registro Estudiante -->

            </div> 
        </div> 
    </div> 
    <!-- ****** Modal de registro ******* -->


    <!-- ****** Portada ******* -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="text-container">
                            <h1><span class="turquoise">Una comunidad para</span> aprender y trabajar</h1>
                            <p class="p-large">Somos la comunidad para estudiantes
                                que está cambiando la forma de estudiar y conseguir trabajo.</p>
                            <a class="btn-solid-lg page-scroll" href="#estudiante">Conocer más</a>
                        </div> 
                    </div> 

                    <div class="col-lg-6">
                        <div class="image-container">
                            <img class="img-fluid" src="images/portada1.svg" alt="Imagen de Presentación Workstudy">
                        </div> 
                    </div> 

                </div> 
            </div> 
        </div> 
    </header> 
    <!-- ****** Portada ******* -->


    <!-- ****** Respaldo ******* -->
    <div class="slider-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h5>Respaldado por</h5>
                    
                    <!-- Slider  -->
                    <div class="slider-container">
                        <div class="swiper-container image-slider">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="image-container">
                                        <img class="img-responsive" src="images/uss.png" alt="Universidad Señor de Sipán">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="image-container">
                                        <img class="img-responsive" src="images/epici.jpg" alt="Escuela de Computación e Informática">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="image-container">
                                        <img class="img-responsive" src="images/unprg.png" alt="Universidad Pedro Ruiz Gallo">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="image-container">
                                        <img class="img-responsive" src="images/usat.png" alt="Universidad Santo Toribio de Mogrovejo">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="image-container">
                                        <img class="img-responsive" src="images/ucv.png" alt="Universidad Cesar Vallejo">
                                    </div>
                                </div>

                            </div> 
                        </div> 
                    </div> 
                    
                </div> 
            </div> 
        </div> 
    </div> 
    <!-- ****** Respaldo ******* -->


    <!-- ****** Información para Estudiantes 1 ******* -->
    <div id="estudiante" class="cards-1">
        <div class="container">

            <div class="row">

                <!-- Cabecera -->
                <div class="col-lg-12">
                    <h2>¿Cómo funciona para los estudiantes?</h2>
                    <p class="p-heading p-large">Regístrate en la plataforma Workstudy y empieza a usar todas las funcionalidades que te ofrecemos para que obtengas un trabajo y empiezes a generar ingresos económicos.</p>
                </div>
                <!-- Cabecera -->

            </div> 

            <div class="row">

                <!-- Tarjetas -->
                <div class="col-lg-12">

                    <div class="card">
                        <img class="card-image" src="images/salesman.png" alt="Ofertas Laborales">
                        <div class="card-body">
                            <h4 class="card-title">Accede a Ofertas Laborales</h4>
                            <p>Conoce las ofertas laborales de distintas empresas que se alinien con tu perfil y aplica a las ofertas a través de tu CV.</p>
                        </div>
                    </div>

                    <div class="card">
                        <img class="card-image" src="images/teacher.png" alt="Servicios de tutoria">
                        <div class="card-body">
                            <h4 class="card-title">Ofrece Servicios de Tutoría</h4>
                            <p>Si eres bueno en alguna materia, ofrece tus servicios como tutor a los alumnos de las distintas universidades.</p>
                        </div>
                    </div>

                    <div class="card">
                        <img class="card-image" src="images/aprender-en-linea.png" alt="Venta de Contenido">
                        <div class="card-body">
                            <h4 class="card-title">Vende Contenido Educativo</h4>
                            <p>Vende tus proyectos o videos de cursos de tu propiedad para generar ingresos y fomentar el desarrollo del aprendizaje.</p>
                        </div>
                    </div>
                    
                </div> 
                <!-- Tarjetas -->

            </div> 

        </div> 
    </div> 
    <!-- ****** Información para Estudiantes 1******* -->

    
    <!-- ****** Información para Estudiantes 2******* -->
    <div class="basic-2">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="images/portada3.svg" alt="Imagen Referencial Estudiantes">
                    </div> 
                </div> 

                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Mejora tus procesos de aprendizaje</h2>
                        <p class="p-large">Workstudy además te ofrece funcionalidades que te ayudarán a solucionar algunos de los inconvenientes de la vida estudiantil.</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-check"></i>
                                <div class="media-body">Contáctate con tutores que refuerzen tus conocimientos.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i>
                                <div class="media-body">Compra cursos de tu interés creados por estudiantes para estudiantes.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i>
                                <div class="media-body">Adquiere proyectos finales de calidad hechos por estudiantes.</div>
                            </li>
                        </ul>
                        <a class="btn-solid-reg" href="registro-estudiante.php">Registrarme</a>
                    </div>
                </div>

            </div> 
        </div> 
    </div> 
    <!-- ****** Información para Estudiantes 2******* -->


    <!-- ****** Información para Empresa ******* -->
    <div id="empresa" class="cards-2">
        <div class="container">
            
            <!-- Cabecera -->
            <div class="row">
                <div class="col-lg-12">
                    <h2>¿Cómo funciona para las empresas?</h2>
                    <p class="p-heading p-large">Workstudy te permitirá publicar tus ofertas laborales y reclutar perfiles operativos y sobre todo talento joven, a través de procesos de convocatoria y selección.</p>
                </div> 
            </div> 
            <!-- Cabecera -->

            <!-- Tarjetas -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Convocatoria</div>
                            <div class="card-subtitle">Crea una convocatoria de personal a través de una publicación.</div>
                            <hr class="cell-divide-hr">
                            <div class="price">
                                <img src="images/convocatoria.svg" alt="Convocatoria">
                            </div>
                        </div>
                    </div> 

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Selección</div>
                            <div class="card-subtitle">Selecciona los perfiles de los postulantes.</div>
                            <hr class="cell-divide-hr">
                            <div class="price">
                                <img src="images/seleccion.svg" alt="Selección">
                            </div>
                        </div>
                    </div> 

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Notificación</div>
                            <div class="card-subtitle">Notificar las contrataciones y los detalles.</div>
                            <hr class="cell-divide-hr">
                            <div class="price">
                                <img src="images/notificacion.svg" alt="Selección">
                            </div>
                        </div>
                    </div> 

                </div> 
            </div>
            <!-- Tarjetas -->


            <div class="oferta-btn">
                <a href="registro-empresa.php" class="btn-solid-lg">!Publica tu oferta ya!</a>
            </div>

        </div> 
    </div> 
    <!-- ****** Información para Empresa ******* -->


    <!-- ****** Empresas Registradas ******* -->
    <div  class="basic-4">
        <div class="container">

            <?php 
                $consultaEmpresas = "SELECT E.EmpNomComercial, E.EmpDireccion, D.DisDescripcion  FROM empresa AS E INNER JOIN  distrito AS D ON E.idDistrito = D.idDistrito ORDER BY idEmpresa LIMIT 4";
                $rptaEmpresas = $conexion->query($consultaEmpresas);

                if($rptaEmpresas->rowCount()>=2){
            ?>

            <!-- Cabecera -->
            <div class="row">
                <div class="col-lg-12">
                    <h2>Empresas Registradas</h2>
                    <p class="p-large">Algunas de las empresas registradas que ya forman parte de Workstudy y estan usando sus funcionalidades.</p>
                    <a href="registro-empresa.php" class="btn-outline-reg mb-5">Registrarme</a>
                </div> 
            </div> 
            <!-- Cabecera -->

            <!-- Empresas -->
            <div class="row">
                <div class="col-lg-12">
                    
                    <?php 
                        while($datos = $rptaEmpresas->fetch()){
                    ?>
                    <!-- Team Member -->
                    <div class="team-member">
                        <div class="image-wrapper">
                            <img class="img-fluid" src="images/telmex.png" alt="alternative">
                        </div> 
                        <p class="p-large"><strong><?php echo $datos['EmpNomComercial'];?></strong></p>
                        <p class="job-title"><?php echo $datos['EmpDireccion'];?> - Lambayeque</p>
                        <span class="social-icons">
                            <span class="fa-stack">
                                <a href="#">
                                    <i class="fas fa-circle fa-stack-2x facebook"></i>
                                    <i class="fab fa-facebook-f fa-stack-1x"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="#">
                                    <i class="fas fa-circle fa-stack-2x twitter"></i>
                                    <i class="fab fa-twitter fa-stack-1x"></i>
                                </a>
                            </span>
                        </span> 
                    </div> 
                    <?php 
                        }
                    ?>

                </div> 
            </div> 

            <?php }else{?>

            <div class="row justify-content-md-center">
                <div class="col-12 col-md-6">
                    <figure class="full-box">
                        <img src="./images/registrate.svg" alt="Registrate en Workstudy" class="img-fluid">
                    </figure>
                </div>
                <div class="w-100"></div>
                <div class="col-12 col-md-6">
                    <h2>Crea tu cuenta de empresa con Workstudy</h2>
                    <p class="p-large">Empieza a disfrutar de los beneficios que te ofrecemos para encontrar el personal que buscas.</p>
                    <a href="registro-empresa.php" class="btn-outline-reg mb-5">Registrarme</a>
                </div>
            </div>

            <?php }?>

        </div> 
    </div>
    <!-- ****** Empresas Registradas ******* -->


    <!-- ****** Testimonios ******* -->
    <div class="slider-2" id="testimonios">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="images/testimonials-2-men-talking.svg" alt="alternative">
                    </div> 
                </div>
                <div class="col-lg-6">
                    <h2>Testimonios</h2>

                    <!-- Card Slider -->
                    <div class="slider-container">
                        <div class="swiper-container card-slider">

                            <?php 
                                $consultaTestimonios = "SELECT T.TesDescripcion, C.CtaTipo, C.CtaFoto, C.CtaEmail FROM testimonioplataforma AS T INNER JOIN cuenta AS C ON T.idUsuario = C.idCuenta WHERE T.TesEstado = 'Visible'";
                                $rptaTestimonios = $conexion->query($consultaTestimonios);

                                if($rptaTestimonios->rowCount()>=1){
                            ?>

                            <div class="swiper-wrapper">
                                
                            <?php        
                                    while($datos = $rptaTestimonios->fetch()){
                            ?>
                                <!-- Slide -->  
                                <div class="swiper-slide">
                                    <div class="card">
                                        <img class="card-image" src="SistemaWorkStudy/adjuntos/avatars/<?php echo $datos['CtaFoto'];?>" alt="alternative">
                                        <div class="card-body">
                                            <p class="testimonial-text"><?php echo $datos['TesDescripcion'];?>.</p>
                                            <p class="testimonial-author"><?php echo $datos['CtaEmail'];?> - <?php echo $datos['CtaTipo'];?></p>
                                        </div>
                                    </div>
                                </div> 
                            <?php 
                                    }
                            ?>       
                               
                            </div> 
        
                            <!-- Add Arrows -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <!-- end of add arrows -->
        
                            <?php
                                }else{?>
                                
                                <div class="alert alert-info p-4">
                                    <i class="fas fa-comment-dots"></i>
                                    Aún no se registrarón testimonios, para ser el primero <strong><a href="./SistemaWorkStudy/login/">Inicia sesión</a></strong>
                                </div>
                            <?php
                                    }    
                            ?> 

                        </div> 
                    </div> 

                </div> 
            </div> 
        </div> 
    </div>
    <!-- ****** Testimonios ******* -->

    
    <!-- ****** Footer ******* -->
    <div class="footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="footer-col">
                        <h4>Sobre Workstudy</h4>
                        <p>Esta plataforma fue creada bajo la supervisión del ingeniero Manuel Leiva, con el fin de aumentar las oportunidades de generar ingresos laborarales a los estudiantes de las distintas universidades e intitutos del Perú.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Datos del Desarrollador</h4>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Nombres: Cespedes Ordinola Edú</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Escuela: Computación e Informática</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Universidad: Pedro Ruiz Gallo</div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Social Media</h4>
                        <span class="fa-stack">
                            <a href="#">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                    </div> 
                </div> 

            </div> 
        </div> 
    </div> 
    <!-- ****** Footer ******* -->


    <!-- ****** Copyrigth ******* -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2021 <a href="https://web.facebook.com/CespedesOrdinolaEdu/" alt="_blank">Edú</a> - Derechos Reservados</p>
                </div> 
            </div> 
        </div> 
    </div>  
   <!-- ****** Copyrigth ******* -->
    
    	
    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>