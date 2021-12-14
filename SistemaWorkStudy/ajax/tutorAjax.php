<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['tutor_estudiante_reg']) || isset($_POST['tutor_id_up'])){
		
		require_once "../controladores/tutorControlador.php";
		$insAdministador = new tutorControlador();

		/*AGREGAR*/
		if(isset($_POST['tutor_experiencia_reg']) && isset($_POST['tutor_estudiante_reg'])){
			echo $insAdministador->agregar_tutor_controlador();
		}

		/*ACTUALIZAR*/
		if(isset($_POST['tutor_id_up']) && isset($_POST['tutor_experiencia_up'])){
			echo $insAdministador->actualizar_tutor_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}