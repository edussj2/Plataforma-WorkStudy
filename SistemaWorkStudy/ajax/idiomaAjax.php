<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['idioma_nombre_reg']) || isset($_POST['idioma_id_del']) || isset($_POST['codigo-up'])){
		
		require_once "../controladores/idiomaControlador.php";
		$insidioma = new idiomaControlador();

		/*AGREGAR*/
		if(isset($_POST['idioma_nombre_reg'])){
			echo $insidioma->agregar_idioma_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['idioma_id_del'])){
			echo $insidioma->eliminar_idioma_controlador();
		}

		/*ACTUALIZAR*/
		if(isset($_POST['idioma_id_up']) && isset($_POST['idioma_nombre_up'])){
			echo $insidioma->actualizar_idioma_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}