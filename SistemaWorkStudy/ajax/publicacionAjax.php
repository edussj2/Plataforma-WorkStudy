<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['publicacion_estudiante_reg']) || isset($_POST['limit']) || isset($_POST['limite'])){
		
		require_once "../controladores/publicacionControlador.php";
		$insPublicacion = new publicacionControlador();

		/*AGREGAR*/
		if(isset($_POST['publicacion_estudiante_reg']) && isset($_POST['publicacion_area_reg'])){
			echo $insPublicacion->agregar_publicacion_controlador();
		}

		/*LISTAR PUBLICACIONES*/
		if(isset($_POST['limit']) && isset($_POST['start'])){
			echo $insPublicacion->listar_publicacion_controlador();
		}

		/*LISTAR COMENTARIOS*/
		if(isset($_POST['limite']) && isset($_POST['inicio'])){
			echo $insPublicacion->listar_comentarios_controlador();
		}

		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}