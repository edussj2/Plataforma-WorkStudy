<?php 
    include 'lib/config.php';
    include 'lib/funciones.php';
    $correo = "";
    $nomComercial = "";
    $razSocial = "";
    $ruc = "";
    $nomContacto = "";
    $apeContacto = "";
    $telContacto = "";
    $direccion = "";
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
                        <a href="./">Inicio</a><i class="fa fa-angle-double-right"></i><span>Registro de Empresa</span>
                    </div>
                </div> 
            </div> 
        </div> 
    </div> 
    <!-- ****** Migas de pan ******* -->

    
    <!-- ****** Registro Empresa ******* -->
    <main class="main-company">
        <div class="main-company-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <!-- Cabecera -->
                        <div class="pb-4 text-center">
                            <h2>¿Eres nuevo en Workstudy? Registra tu Empresa</h2>
                            <p>¡Regístrate ahora y disfruta de las funcionalidades que te ofrecemos!</p>
                        </div>
                        <small class="p-small p-2">Los campos seleccionados con (<span class="asterisco">*</span>) son obligatorios</small>
                        <!-- Cabecera -->

                        <!-- Validaciones y guardado -->
                        <?php 
                            if(isset($_POST['registrarCompany']) && 
                                isset($_POST['correo']) && 
                                isset($_POST['nomComercial']) && 
                                isset($_POST['razSocial']) && 
                                isset($_POST['ruc']) &&
                                isset($_POST['nomContacto']) &&
                                isset($_POST['apeContacto']) &&
                                isset($_POST['telContacto']) &&
                                isset($_POST['direccion']))
                            {
                                $correo = limpiar_cadena($_POST['correo']);
                                $pass1 = limpiar_cadena($_POST['pass1']);
                                $pass2 = limpiar_cadena($_POST['pass2']);

                                $nomComercial = limpiar_cadena($_POST['nomComercial']);
                                $razSocial = limpiar_cadena($_POST['razSocial']);
                                $ruc = limpiar_cadena($_POST['ruc']);
                                $cboDistrito = limpiar_cadena($_POST['cboDistrito']);
                                $direccion = limpiar_cadena($_POST['direccion']);
                                $cboSecComercial = limpiar_cadena($_POST['cboSecComercial']);
                                $cboNumTrabajadores = limpiar_cadena($_POST['cboNumTrabajadores']);
                                $descripcion = limpiar_cadena($_POST['descripcion']);
                                $web = limpiar_cadena($_POST['web']);
                                $nomContacto = limpiar_cadena($_POST['nomContacto']);
                                $apeContacto = limpiar_cadena($_POST['apeContacto']);
                                $cboCargo = limpiar_cadena($_POST['cboCargo']);
                                $telContacto = limpiar_cadena($_POST['telContacto']);



                                if($nomComercial == "" || $razSocial == "" || $ruc == "" ||$correo == "" || $pass1 == "" || $pass2 == "" || $nomContacto == "" || $apeContacto == "" || $telContacto == "" || $direccion == "" || $cboSecComercial == "Sin Registro" || $cboDistrito == "Sin Registro"){
                                    echo '  <div class="alert alert-warning" role="alert">
                                                <i class="fas fa-exclamation-triangle"></i> Complete los campos requeridos.
                                            </div>';
                                }else{
                                    $comprobarCorreo = "SELECT CtaEmail FROM cuenta WHERE CtaEmail = '$correo'";
                                    $rptaCorreo = $conexion->query($comprobarCorreo);

                                    if($rptaCorreo->rowCount()>=1){
                                        echo '  <div class="alert alert-warning" role="alert">
                                                    <i class="fas fa-exclamation-triangle"></i> Este correo ya ha sido registrado.
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
                                                $comprobarRuc = "SELECT EmpRUC FROM empresa WHERE EmpRUC = '$ruc'";
                                                $rptaRuc = $conexion->query($comprobarRuc);

                                                if($rptaRuc->rowCount()>=1){
                                                    echo '  <div class="alert alert-warning" role="alert">
                                                                <i class="fas fa-exclamation-triangle"></i> Este RUC ya ha sido registrado.
                                                            </div>';
                                                }else{
                                                    /*----FOTO Empresa---*/
                                                    $foto1 = $_FILES['logo']['name'];
                                                    $ruta1 = $_FILES['logo']['tmp_name'];
                                                    if($foto1 != ""){
                                                        $fotoEmpresa="SistemaWorkStudy/adjuntos/avatars/EMP".$ruc."-".$foto1;
                                                        copy($ruta1,$fotoEmpresa);
                                                        $nombreFoto= "EMP".$ruc."-".$foto1;
                                                    }else{
                                                        $nombreFoto="company.png";
                                                    }

                                                    $clave = encryption($pass1);

                                                    $NumCuenta = "SELECT idCuenta FROM cuenta";
                                                    $resultado1 = $conexion->query($NumCuenta);
                                                    $numero = ($resultado1->rowCount())+1;
                                                    $codigo = generar_codigo_aleatorio('WS',10,$numero);

                                                    $insertarCuenta = "INSERT INTO cuenta(CtaCodigo,CtaClave,CtaEmail,CtaEstado,CtaTipo,CtaFoto,CtaFechaRegistro) VALUES ('$codigo','$clave','$correo','Activo','Empresa','$nombreFoto',now())";
                                                    
                                                    $rptaCuenta = $conexion->query($insertarCuenta);

                                                    if($rptaCuenta->rowCount()>=1){

                                                        $insertarEmpresa = "INSERT INTO empresa(EmpNomComercial,EmpRazSocial,EmpRUC,EmpDireccion,idSecComercial,EmpNumTrabajadores,EmpDescripcion,EmpPagWeb,EmpContNombres,EmpContApellidos,EmpContCargo,EmpContCelular,idDistrito,CuentaCodigo) VALUES('$nomComercial','$razSocial','$ruc','$direccion','$cboSecComercial','$cboNumTrabajadores','$descripcion','$web','$nomContacto','$apeContacto','$cboCargo','$telContacto','$cboDistrito','$codigo')";

                                                        $rptaEmpresa = $conexion->query($insertarEmpresa);

                                                        if($rptaEmpresa->rowCount()>=1){
                                                            echo '<div class="alert alert-success" role="alert">
                                                                    <strong><i class="fas fa-check-circle"></i> ¡REGISTRO EXITOSO!</strong> Se le redirigirá automáticamente a la página de inicio de sesión.
                                                                </div>';
                                                            echo '<script> setTimeout("redireccionarPagina()", 3000);</script>';
                                                        }else{
                                                            $eliminarCuenta = "DELETE FROM cuenta WHERE CtaCodigo = '$codigo'";
                                                            $resultado5 = $conexion->query($eliminarCuenta);
                                                            @unlink('SistemaWorkStudy/adjuntos/avatars/'.$nombreFoto);
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

                                
                            }
                        ?>
                        <!-- Validaciones y guardado -->

                        <!-- Formulario -->
                        <form action="" method="POST" autocomplete="off" enctype="multipart/form-data" onsubmit="return validarRegistroEmpresa();">
                            <div class="card ">
                                <div class="card-header turquoise font-weight-bold text-left" style="font-size: 1rem;">
                                    <i class="fas fa-key"></i> &nbspDatos de Acceso
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="row mb-3 justify-content-center">
                                                <label for="correo" class="col-sm-2 col-form-label">Correo Electrónico<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                    <input type="email" class="form-control" id="inputCorreo"  required name="correo" maxlength="50" minlength="6" id="correo" value="<?php echo $correo; ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label for="pass1" class="col-sm-2 col-form-label">Contraseña<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                    <input type="password" class="form-control" id="pass1" required name="pass1" minlength="6" maxlength="16">
                                                </div>
                                                <div class="form-text">Mínimo 6 carácteres y máximo 16 carácteres.</div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label for="pass2" class="col-sm-2 col-form-label">Confimar Contraseña<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="password" class="form-control" id="pass2" required name="pass2" minlength="6" maxlength="16">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="alert alert-warning" role="alert">
                                                <strong><i class="fas fa-info-circle"></i></strong> Escriba el correo electrónico de forma correcta ya que se verificará su existencia para la creación de la cuenta.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header turquoise font-weight-bold text-left" style="font-size: 1rem;">
                                    <i class="fas fa-building"></i> &nbspDatos de la Empresa
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="row mb-3 justify-content-center">
                                                <label for="nomComercial" class="col-sm-2 col-form-label">Nombre Comercial<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" class="form-control" id="nomComercial" required name="nomComercial" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,70}" maxlength="70" value="<?php echo $nomComercial; ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label for="razSocial" class="col-sm-2 col-form-label">Razón Social<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" class="form-control" id="razSocial" required name="razSocial" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,70}" maxlength="70" value="<?php echo $razSocial; ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label for="inputRuc" class="col-sm-2 col-form-label">RUC<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" class="form-control" id="inputRuc" required pattern="[0-9-]{1,15}" maxlength="15" minlength="15" name="ruc" onkeypress="return valideKey(event);" value="<?php echo $ruc; ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label class="col-sm-2 col-form-label">Departamento<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" aria-label=".form-select-sm example" name="cboDepartamento" id="cboDepartamento" required>
                                                        <option value="Sin Registro" selected="true">Seleccione un Departamento</option>
                                                        <?php 
                                                            $Departamento = "SELECT idDepartamento, DepDescripcion FROM departamento ORDER BY DepDescripcion";
                                                            $rptaDepartamento = $conexion->query($Departamento);
                                                            while ($rowD = $rptaDepartamento->fetch()) {
                                                                echo '<option value="'.$rowD['idDepartamento'].'">'.$rowD['DepDescripcion'].'</option>';
                                                            }
                                                        ?>
                                                      </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label class="col-sm-2 col-form-label">Provincia<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" aria-label=".form-select-sm example" name="cboProvincia" id="cboProvincia" required>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label class="col-sm-2 col-form-label">Distrito<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" aria-label=".form-select-sm example" name="cboDistrito" id="cboDistrito" required>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label for="direccion" class="col-sm-2 col-form-label">Dirección<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" class="form-control" id="direccion" required name="direccion" pattern="{1,80}" value="<?php echo $direccion; ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label class="col-sm-2 col-form-label">Sector Empresarial<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" aria-label=".form-select-sm example" required name="cboSecComercial" id="cboSecComercial">
                                                        <option value="Sin Registro" selected="true">Seleccione un Sector Comercial</option>
                                                        <?php 
                                                            $SectorComercial = "SELECT idSecComercial, SecDescripcion FROM sectorcomercial WHERE SecVigencia = 'Vigente' ORDER BY SecDescripcion";
                                                            $rptaSectorComercial = $conexion->query($SectorComercial);
                                                            while ($rowD = $rptaSectorComercial->fetch()) {
                                                                echo '<option value="'.$rowD['idSecComercial'].'">'.$rowD['SecDescripcion'].'</option>';
                                                            }
                                                        ?>
                                                      </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label class="col-sm-2 col-form-label">Número de trabajadores<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" aria-label=".form-select-sm example" required name="cboNumTrabajadores">
                                                        <option value="MicroEmpresa" selected>De 1 a 10 trabajadores</option>
                                                        <option value="PequeñaEmpresa">De 11 a 50 trabajadores</option>
                                                        <option value="MedianaEmpresa">De 51 a 200 trabajadores</option>
                                                        <option value="GrandeEmpresa">De 201 a 500 trabajadores</option>
                                                        <option value="GrandeEmpresa1000">De 501 a 1000 trabajadores</option>
                                                        <option value="MacroEmpresa">Más de 1000 trabajadores</option>
                                                      </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label class="col-sm-2 col-form-label">Descripción</label>
                                                <div class="col-sm-7">
                                                  <textarea class="form-control" cols="30" rows="5" name="descripcion"></textarea>
                                                </div>
                                                <div class="form-text">Máximo 2000 carácteres entre números y letras.</div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label for="inputWeb" class="col-sm-2 col-form-label">Página Web</label>
                                                <div class="col-sm-7">
                                                  <input type="text" class="form-control" id="inputWeb" name="web">
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label class="col-sm-2 col-form-label">Logo Empresa</label>
                                                <div class="col-sm-7">
                                                    <input class="form-control p-1" type="file" name="logo" id="archivoInput" onchange="return validarExt()" accept=".jpg, .png, .jpeg">
                                                </div>
                                                <div class="form-text">Formatos permitidos jpg/jpeg/png/svg.</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="alert alert-info" role="alert">
                                                <strong><i class="fas fa-info-circle"></i></strong> RUC es es el registro informático a cargo de la SUNAT donde se encuentran inscritos los contribuyentes de todo el país, así como otros obligados a inscribirse en él por mandato legal.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header turquoise font-weight-bold text-left" style="font-size: 1rem;">
                                    <i class="fas fa-user"></i> &nbspDatos de Persona de Contacto
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="row mb-3 justify-content-center">
                                                <label for="inputNomContacto" class="col-sm-2 col-form-label">Nombres<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" class="form-control" id="inputNomContacto" name="nomContacto" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,70}" required maxlength="70" value="<?php echo $nomContacto; ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label for="inputApeContacto" class="col-sm-2 col-form-label">Apellidos<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" class="form-control" id="inputApeContacto" name="apeContacto" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,70}" required maxlength="70" value="<?php echo $apeContacto; ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label for="inputNum" class="col-sm-2 col-form-label">Teléfono<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                  <input type="text" class="form-control" id="inputNum" required name="telContacto" pattern="[0-9-]{1,9}" maxlength="9" minlength="9" onkeypress="return valideKey(event);" value="<?php echo $telContacto; ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 justify-content-center">
                                                <label class="col-sm-2 col-form-label">Cargo<span class="asterisco">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" aria-label=".form-select-sm example" required name="cboCargo">
                                                        <option value="Presidente">Presidente</option>
                                                        <option value="Director" selected>Director</option>
                                                        <option value="Gerente">Gerente</option>
                                                        <option value="Jefe">Jefe</option>
                                                        <option value="Coordinador">Coordinador</option>
                                                        <option value="Analista">Analista</option>
                                                      </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="alert alert-warning" role="alert">
                                                <strong><i class="fas fa-info-circle"></i></strong> Estos campos son muy importantes para tener un contacto directo con la empresa a través de esta persona.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header text-center">
                                    <button type="submit" class="btn btn-solid-lg" name="registrarCompany">Crear Cuenta </button> 
                                </div>
                            </div>
                        </form>
                        <!-- Formulario -->

                    </div> 
                </div> 
            </div> 
        </div> 
    </main> 
    <!-- ****** Registro Empresa ******* -->


    <!-- ****** Opcion de registro ******* -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-right">
                    ¿No eres una empresa? <a href="./registro-estudiante.php">Registrate como Estudiante</a>
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
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/sweetalert2.min.js"></script> <!-- Sweet alert -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->

    <!-- Redireccionar -->
    <script language="JavaScript">
    function redireccionarPagina() {
        window.location = "SistemaWorkStudy/login/";
    }
    </script>

    <!-- UBIGEO -->
    <script>
        $(document).ready(function(){
            $("#cboDepartamento").change(function(){

                $('#cboDistrito').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                $("#cboDepartamento option:selected").each(function(){
                    idDepartamento = $(this).val();
                    $.post("provincia.php",{idDepartamento: idDepartamento},function(data){
                        $("#cboProvincia").html(data);
                    })
                })
            })
            
        })
        $(document).ready(function(){
                $("#cboProvincia").change(function () {
                    $("#cboProvincia option:selected").each(function () {
                        idProvincia = $(this).val();
                        $.post("distrito.php", { idProvincia: idProvincia }, function(data){
                            $("#cboDistrito").html(data);
                        });            
                    });
                })
        });
    </script>
    
</body>
</html>