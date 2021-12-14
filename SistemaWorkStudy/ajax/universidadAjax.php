<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['universidad_nombre_reg']) || isset($_POST['universidad_id_del']) || isset($_POST['codigo-up'])){
		
		require_once "../controladores/universidadControlador.php";
		$insuniversidad = new universidadControlador();

		/*AGREGAR*/
		if(isset($_POST['universidad_nombre_reg'])){
			echo $insuniversidad->agregar_universidad_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['universidad_id_del'])){
			echo $insuniversidad->eliminar_universidad_controlador();
		}

		/*ACTUALIZAR*/
		if(isset($_POST['universidad_id_up']) && isset($_POST['universidad_nombre_up'])){
			echo $insuniversidad->actualizar_universidad_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}