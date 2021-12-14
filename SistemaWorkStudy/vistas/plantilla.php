<?php 
	session_start(['name'=>'WS']);
?>
<!DOCTYPE html>
<html lang="es">
<head>

    <title><?php echo COMPANY; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Meta Tags -->
    <?php include "vistas/modulos/metaTags.php"; ?>

    <!-- Estilos -->
    <?php include "vistas/modulos/estilos.php"; ?>
    
	<!-- Scripts -->
    <?php include "vistas/modulos/scripts.php"; ?>

	<!-- Favicon  -->
    <link rel="icon" href="<?php echo SERVERURL; ?>vistas/images/img/logoCompleto.PNG">

</head>
<body>
    <?php
		$peticionAjax = false;
		require_once "./controladores/vistasControlador.php";
		$insVistas = new vistasControlador();
		$vistas  = $insVistas-> obtener_vistas_controlador();

		if($vistas=="login" || $vistas=="404"):
			require_once "./vistas/contenidos/".$vistas."-view.php";
		else:
			require_once "./controladores/loginControlador.php";
			$lc = new loginControlador();

			if(!isset($_SESSION['token_WS']) || !isset($_SESSION['correo_WS'])){
				echo $lc->forzar_cierre_sesion_controlador();
			} 
	?>

    <div id="body-pd" class="body-home">
        <!-- Nav lateral-->
        <?php include "vistas/modulos/navLateral.php"; ?>

        <div class="content-page">
            <!-- Nav barra -->
            <?php include "vistas/modulos/navBarra.php"; ?>

            <div class="contenido-general">
            <!-- Contenido General -->
            <?php require_once $vistas; ?>
            </div>
        </div>
    </div>
    <?php include "vistas/modulos/logout.php"; ?>
    <?php endif; ?>
    <!-- Scripts Personales-->
    <script src="<?php echo SERVERURL; ?>vistas/js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>