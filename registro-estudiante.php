<?php 
    include 'lib/config.php';
    include 'lib/funciones.php';
    $correo = "";
    $nombre = "";
    $paterno = "";
    $materno = "";
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
	<link href="css/sweetalert2.css" rel="stylesheet">
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
    <nav class="navbar bg-white">
        <div class="container nav-especial">
            <a class="navbar-brand p-1" href="./">
                <img src="images/logoRectangulo.png" alt="Logo WorkStudy" width="165" height="65">
            </a>

            <div class="d-flex">
                <a href="SistemaWorkStudy/login/" class="btn btn-solid-lg">Iniciar Sesisón</a>
            </div>
        </div>
    </nav>
    <!-- ****** Barra de Navegación ******* -->


    <!-- ****** Migas de pan ******* -->
    <div class="ex-basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs">
                        <a href="./">Inicio</a><i class="fa fa-angle-double-right"></i><span>Registro de Estudiantes</span>
                    </div>
                </div> 
            </div> 
        </div> 
    </div> 
    <!-- ****** Migas de pan ******* -->


    <!-- ****** Registro Estudiante ******* -->
    <main class="main-company">
        <div class="main-company-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <!-- Cabecera -->
                        <div class="pb-3 text-center mb-2">
                            <h2>¿Estudiante Nuevo? Bienvenidos a Workstudy</h2>
                            <p>¡Comienza a trabajar y a aprender desde una misma plataforma!</p>
                        </div>
                        <!-- Cabecera -->

                        <!-- Validaciones -->
                        <?php 
                            if(isset($_POST['registrarUser']) && isset($_POST['correo']) && isset($_POST['paterno']) && isset($_POST['materno']))
                            {
                                $nombre = limpiar_cadena($_POST['nombres']);
                                $paterno = limpiar_cadena($_POST['paterno']);
                                $materno = limpiar_cadena($_POST['materno']);
                                $correo = limpiar_cadena($_POST['correo']);
                                $pass1 = limpiar_cadena($_POST['pass1']);
                                $pass2 = limpiar_cadena($_POST['pass2']);

                                if($nombre == "" || $paterno == "" || $materno == "" || $correo == "" || $pass1 == "" || $pass2 == ""){
                                    echo '  <div class="alert alert-warning" role="alert">
                                                <i class="fas fa-exclamation-triangle"></i> Complete los campos requeridos.
                                            </div>';
                                }else{
                                    $comprobarCorreo = "SELECT CtaEmail FROM cuenta WHERE CtaEmail = '$correo'";
                                    $resultado = $conexion->query($comprobarCorreo);

                                    if($resultado->rowCount()>=1){
                                        echo '  <div class="alert alert-warning" role="alert">
                                                    <i class="fas fa-exclamation-triangle"></i> El correo ingresado ya ha sido registrado.
                                                </div>';
                                    }else{
                                        if($pass1 != $pass2){
                                            echo '  <div class="alert alert-warning" role="alert">
                                                        <i class="fas fa-exclamation-triangle"></i> Las contraseñas ingresadas no coinciden.
                                                    </div>';
                                        }else{
                                            if(filter_var($correo, FILTER_VALIDATE_EMAIL)==false){
                                                echo '<div class="alert alert-warning" role="alert">
                                                        <i class="fas fa-exclamation-triangle"></i> El Correo electrónico ingresado no es válido.
                                                    </div>';
                                            }else{
                                                $clave = encryption($pass1);
                                                $NumCuenta = "SELECT idCuenta FROM cuenta";
                                                $resultado2 = $conexion->query($NumCuenta);
                                                $numero = ($resultado2->rowCount())+1;

                                                $codigo = generar_codigo_aleatorio('WS',10,$numero);
                                                $foto = 'avatar.png';

                                                $insertarCuenta = "INSERT INTO cuenta(CtaCodigo,CtaClave,CtaEmail,CtaEstado,CtaTipo,CtaFoto,CtaFechaRegistro) VALUES ('$codigo','$clave','$correo','Activo','Estudiante','$foto',now())";
                                                
                                                $resultado3 = $conexion->query($insertarCuenta);

                                                if($resultado3->rowCount()>=1){
                                                    $insertarEstudiante = "INSERT INTO estudiante(EstDNI,EstNombres,EstApePaterno,EstApeMaterno,EstCelular,EstSexo,EstDireccion,EstNacimiento,EstBiografia,EstEscProfesional,idDistrito,	idUniversidad,CuentaCodigo) VALUES('Sin Datos','$nombre','$paterno','$materno','Sin Datos','Sin Datos','Sin Datos','00/00/0000','Sin Datos','Sin Datos',1832,1,'$codigo')";

                                                    $resultado4 = $conexion->query($insertarEstudiante);

                                                    if($resultado4->rowCount()>=1){
                                                        echo '<div class="alert alert-success" role="alert">
                                                                <strong><i class="fas fa-check-circle"></i> REGISTRO EXITOSO!</strong> Se le redirigirá automáticamente a la página de inicio de sesión.
                                                            </div>';
                                                        echo '<script> setTimeout("redireccionarPagina()", 3000);</script>';
                                                    }else{
                                                        $eliminarCuenta = "DELETE FROM cuenta WHERE CuentaCodigo = '$codigo'";
                                                        $resultado5 = $conexion->query($eliminarCuenta);
                                                        echo '<div class="alert alert-danger" role="alert">
                                                                <i class="fas fa-bug"></i> Ops! Hubo un problema con el registro de los datos, intente nuevamente.
                                                            </div>';
                                                    }
                                                }else{
                                                    echo '<div class="alert alert-danger" role="alert">
                                                            <i class="fas fa-bug"></i> Ops! Hubo un problema con el registro de la cuenta, intente nuevamente.
                                                        </div>';
                                                }

                                            }
                                        }
                                    }
                                }

                                
                            }
                        ?>
                        <!-- Validaciones -->

                        <!-- Formulario -->
                        <form action="" method="POST" autocomplete="off" onsubmit="return validarRegistroUsuario();">
                            <div class="card">
                                <div class="card-header turquoise font-weight-bold text-left" style="font-size: 1rem;">
                                    <i class="fas fa-user-circle"></i> &nbspEstudiante Nuevo
                                </div>
                                <div class="card-body registro-estudiante-cel">
                                    <div class="row pl-5 pr-5 registro-estudiante-cel">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Nombres"  name="nombres" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,60}" maxlength="60" id="nombres" value="<?php echo $nombre; ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Ape. Paterno" required name="paterno" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" id="apePaterno" value="<?php echo $paterno; ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Ape. Materno" required name="materno" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" id="apeMaterno" value="<?php echo $materno; ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="email" class="form-control" placeholder="Correo Electrónico" required name="correo" maxlength="50" minlength="6" id="correo" value="<?php echo $correo; ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="password" class="form-control" placeholder="Contraseña" required name="pass1" minlength="6" maxlength="16" id="pass1">
                                            <div class="form-text">Mínimo 6 carácteres y máximo 16 carácteres.</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="password" class="form-control" placeholder="Repita Contraseña" required name="pass2" minlength="6" maxlength="16" id="pass2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header text-center">
                                    <button type="submit" class="btn btn-solid-lg" name="registrarUser">Crear Cuenta </button> 
                                </div>
                            </div>
                        </form> 
                        <!-- Formulario -->

                    </div> 
                </div> 
            </div> 
        </div> 
    </main> 
    <!-- ****** Registro Estudiante ******* -->
    
    
    <!-- ****** Opcion de registro ******* -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-right">
                    ¿No eres estudiante? <a href="./registro-empresa.php">Registrate como Empresa</a>
                </div>
            </div> 
        </div> 
    </div> 
    <!-- ****** Opcion de registro ******* -->


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
    <script language="JavaScript">
    function redireccionarPagina() {
        window.location = "SistemaWorkStudy/login/";
    }
    </script>
    
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/sweetalert2.min.js"></script> <!-- Sweet alert -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>