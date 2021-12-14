<?php 
    if(isset($_SESSION['correo_WS']) && isset($_SESSION['token_WS'])){
        if($_SESSION['tipo_WS'] == "Administrador"){
            $redirect = '<script> window.location.href="'.SERVERURL.'inicioAdministrador/"</script>';
        }elseif($_SESSION['tipo_WS'] == "Estudiante"){
            $redirect = '<script> window.location.href="'.SERVERURL.'inicioEstudiante/"</script>';
        }elseif($_SESSION['tipo_WS'] == "Empresa"){
            $redirect = '<script> window.location.href="'.SERVERURL.'inicioEmpresa/"</script>';

        }
        echo $redirect;
    }
?>
    <!-- ****** Preloader ******* -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- ****** Preloader ******* -->
    

    <!--Fondo lateral - Ola-->
    <img class="wave" src="<?php echo SERVERURL; ?>vistas/images/img/wave.png" alt="Fondo del página de inicio de sesión">


    <!-- ****** Contenedor ******* -->
    <div class="container-login-total">

        <!--Parte Izquierda-->
        <div class="img-lateral">
            <img src="<?php echo SERVERURL; ?>vistas/images/img/portadalogin.svg" alt="Imagen referencial del Login">
        </div>

        <!--Parte derecha-->
        <div class="contenedor-login">
            <form action="" class="form-login" method="POST" autocomplete="off">

                <img src="<?php echo SERVERURL; ?>vistas/images/img/logoCompleto.PNG" alt="Logo Workstudy">

                <h2 class="title">Bienvenidos</h2>

                <div class="input-div one">
                    <div class="i">
                            <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                            <h5>Correo Electrónico</h5>
                            <input type="email" class="input" name="correo" pattern="{1,50}" required maxlength="60" minlength="6">
                    </div>
                </div>

                <div class="input-div pass">
                    <div class="i"> 
                         <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                         <h5>Contraseña</h5>
                         <input type="password" class="input" name="clave" minlength="6" required maxlength="16">
                    </div>
                </div>

                <input type="submit" class="btn-solid-lg w-100 mb-1" value="INICIAR SESIÓN">
                <a href="#" class="enlaces">¿Olvidaste tu contraseña?</a>
                <a href="#details" class="enlaces popup-with-move-anim">¿No tienes cuenta? Registrate aquí</a>
                
            </form>
        </div>
    </div>
    <!-- ****** Contenedor ******* -->


    <!-- ****** Detalles Registro ******* -->
	<div id="details" class="lightbox-basic zoom-anim-dialog mfp-hide">
        <div class="container">
            <h3 class="text-center">Seleccione tipo de usuario</h3>
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="<?php echo SERVERURL; ?>vistas/images/img/portada5.svg" alt="Empresa">
                    </div> 
                    <h3><i class="fas fa-building"></i> Empresa</h3>
                    <hr>
                    <p>¿Eres una empresa? Registrarte como usario tipo empresa para poder publicar ofertas laborales y conseguir perfiles competentes para el trabajo.</p>
                    <div class="text-center">
                        <a href="../../registro-empresa.php" class="btn-solid-reg">Seleccionar</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="<?php echo SERVERURL; ?>vistas/images/img/portada2.svg" alt="Estudiante">
                    </div> 
                    <h3><i class="fas fa-user-graduate"></i> Estudiante</h3>
                    <hr>
                    <p>¿Eres un estudiante? Registrate como un estudiante para acceder a todas las funcionalidades que te ofrece Workstudy y se parte de esta comunidad.</p>
                    <div class="text-center">
                        <a href="../../registro-estudiante.php" class="btn-solid-reg">Seleccionar</a>
                    </div>
                </div> 
            </div> 
        </div> 
    </div> 
    <!-- ****** Detalles Registro ******* -->

    
    <!-- ****** Copyrigyth ******* -->
    <div class="copyright2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2021 - Derechos Reservados</p>
                </div> 
            </div> 
        </div> 
    </div> 
    <!-- ****** Copyrigyth ******* -->

    <?php
		if(isset($_POST['correo']) && isset($_POST['clave'])){
			require_once "./controladores/loginControlador.php";

			$login = new loginControlador();
			echo $login->iniciar_sesion_controlador();
		}
	?>

    <script>
    //FUNCIONES PARA SUBIR Y BAJAR LOS LABEL DE LOS INPUT LOGIN
    const inputs = document.querySelectorAll(".input");


    function addcl(){
	    let parent = this.parentNode.parentNode;
	    parent.classList.add("focus");
    }   

    function remcl(){
	    let parent = this.parentNode.parentNode;
	    if(this.value == ""){
		    parent.classList.remove("focus");
	    }
    }
    inputs.forEach(input => {
	    input.addEventListener("focus", addcl);
	    input.addEventListener("blur", remcl);
    });
    </script>