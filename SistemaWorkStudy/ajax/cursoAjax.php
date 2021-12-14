<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['curso_titulo_reg']) || isset($_POST['limit'])){
		
		require_once "../controladores/cursoControlador.php";
		$inscurso = new cursoControlador();

		/*AGREGAR*/
		if(isset($_POST['curso_titulo_reg']) && isset($_POST['curso_descripcion_reg'])){
			echo $inscurso->agregar_curso_controlador();
		}

		/*LISTAR*/
		if(isset($_POST['limit']) && isset($_POST['start'])){
			echo $inscurso->listar_curso_controlador();
		}

		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}