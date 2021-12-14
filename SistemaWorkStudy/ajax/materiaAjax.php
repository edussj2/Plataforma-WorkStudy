<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['materia_nombre_reg']) || isset($_POST['materia_id_del']) || isset($_POST['codigo-up'])){
		
		require_once "../controladores/materiaControlador.php";
		$insmateria = new materiaControlador();

		/*AGREGAR*/
		if(isset($_POST['materia_nombre_reg'])){
			echo $insmateria->agregar_materia_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['materia_id_del'])){
			echo $insmateria->eliminar_materia_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}