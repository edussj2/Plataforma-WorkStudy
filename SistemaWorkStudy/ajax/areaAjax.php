<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['area_nombre_reg']) || isset($_POST['area_id_del']) || isset($_POST['area_id_up'])){
		
		require_once "../controladores/areaControlador.php";
		$insarea = new areaControlador();

		/*AGREGAR*/
		if(isset($_POST['area_nombre_reg']) && isset($_POST['area_estado_reg'])){
			echo $insarea->agregar_area_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['area_id_del'])){
			echo $insarea->eliminar_area_controlador();
		}

		/*ACTUALIZAR*/
		if(isset($_POST['area_id_up']) && isset($_POST['area_nombre_up'])){
			echo $insarea->actualizar_area_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}