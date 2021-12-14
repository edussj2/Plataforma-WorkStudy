<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['testimonioPlataforma_descripcion_reg']) || isset($_POST['testimonio_id_del']) || isset($_POST['testimonio-id-up'])){
		
		require_once "../controladores/testimonioPlataformaControlador.php";
		$instestimonioPlataforma = new testimonioPlataformaControlador();

		/*AGREGAR*/
		if(isset($_POST['testimonioPlataforma_descripcion_reg'])){
			echo $instestimonioPlataforma->agregar_testimonioPlataforma_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['testimonio_id_del'])){
			echo $instestimonioPlataforma->eliminar_testimonioPlataforma_controlador();
		}

        /*ACTUALIZAR*/
		if(isset($_POST['testimonio-id-up'])){
			echo $instestimonioPlataforma->actualizar_estado_testimonio_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}