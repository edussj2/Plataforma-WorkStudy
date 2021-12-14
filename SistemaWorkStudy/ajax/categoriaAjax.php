<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['categoria_nombre_reg']) || isset($_POST['categoria_id_del']) || isset($_POST['codigo-up'])){
		
		require_once "../controladores/categoriaControlador.php";
		$inscategoria = new categoriaControlador();

		/*AGREGAR*/
		if(isset($_POST['categoria_nombre_reg'])){
			echo $inscategoria->agregar_categoria_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['categoria_id_del'])){
			echo $inscategoria->eliminar_categoria_controlador();
		}

		/*ACTUALIZAR*/
		if(isset($_POST['categoria_id_up']) && isset($_POST['categoria_nombre_up'])){
			echo $inscategoria->actualizar_categoria_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}