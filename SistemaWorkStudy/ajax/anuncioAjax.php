<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['anuncio_tipo_clase_reg'])){
		
		require_once "../controladores/anuncioControlador.php";
		$insAdministador = new anuncioControlador();

		/*AGREGAR*/
		if(isset($_POST['id_cuenta']) && isset($_POST['anuncio_tipo_clase_reg']) && isset($_POST['anuncio_titulo_reg']) && isset($_POST['anuncio_materia_reg'])){
			echo $insAdministador->agregar_anuncio_controlador();
		}

		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}