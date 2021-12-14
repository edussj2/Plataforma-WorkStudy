<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['sector_comercial_nombre_reg']) || isset($_POST['sector_comercial_id_del']) || isset($_POST['codigo-up'])){
		
		require_once "../controladores/sectorComercialControlador.php";
		$insSectorComercial = new sectorComercialControlador();

		/*AGREGAR*/
		if(isset($_POST['sector_comercial_nombre_reg'])){
			echo $insSectorComercial->agregar_sectorComercial_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['sector_comercial_id_del'])){
			echo $insSectorComercial->eliminar_sectorComercial_controlador();
		}

		/*ACTUALIZAR*/
		if(isset($_POST['sector_comercial_id_up']) && isset($_POST['sector_comercial_nombre_up'])){
			echo $insSectorComercial->actualizar_sectorComercial_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}