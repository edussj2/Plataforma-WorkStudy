<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['subcategoria_nombre_reg']) || isset($_POST['subcategoria_id_del'])){
		
		require_once "../controladores/subcategoriaControlador.php";
		$inssubcategoria = new subcategoriaControlador();

		/*AGREGAR*/
		if(isset($_POST['subcategoria_nombre_reg'])){
			echo $inssubcategoria->agregar_subcategoria_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['subcategoria_id_del'])){
			echo $inssubcategoria->eliminar_subcategoria_controlador();
		}

		/*ACTUALIZAR*/
		if(isset($_POST['subcategoria_id_up']) && isset($_POST['subcategoria_nombre_up'])){
			echo $inssubcategoria->actualizar_subcategoria_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}