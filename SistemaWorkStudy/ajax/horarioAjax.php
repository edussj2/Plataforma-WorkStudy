<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['horario_dia_reg']) || isset($_POST['horario_id_del'])){
		
		require_once "../controladores/horarioControlador.php";
		$inshorario = new horarioControlador();

		/*AGREGAR*/
		if(isset($_POST['horario_dia_reg'])){
			echo $inshorario->agregar_horario_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['horario_id_del'])){
			echo $inshorario->eliminar_horario_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}