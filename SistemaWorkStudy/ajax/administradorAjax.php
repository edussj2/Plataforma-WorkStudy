<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['administrador_dni_reg']) || isset($_POST['administrador_id_del']) || isset($_POST['administrador_id_up'])){
		
		require_once "../controladores/administradorControlador.php";
		$insAdministador = new administradorControlador();

		/*AGREGAR*/
		if(isset($_POST['administrador_dni_reg']) && isset($_POST['administrador_nombres_reg']) && isset($_POST['administrador_email_reg']) && isset($_POST['administrador_pass1_reg'])){
			echo $insAdministador->agregar_administrador_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['administrador_id_del'])){
			echo $insAdministador->eliminar_administrador_controlador();
		}

		/*ACTUALIZAR GENERAL*/
		if(isset($_POST['administrador_id_up']) && isset($_POST['administrador_dni_up'])){
			echo $insAdministador->actualizar_general_administrador_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}