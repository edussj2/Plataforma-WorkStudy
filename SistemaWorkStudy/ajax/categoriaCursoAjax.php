<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['categoriaCurso_nombre_reg']) || isset($_POST['categoriaCurso_id_del'])){
		
		require_once "../controladores/categoriaCursoControlador.php";
		$inscategoriaCurso = new categoriaCursoControlador();

		/*AGREGAR*/
		if(isset($_POST['categoriaCurso_nombre_reg'])){
			echo $inscategoriaCurso->agregar_categoriaCurso_controlador();
		}

		/*ELMINAR*/
		if(isset($_POST['categoriaCurso_id_del'])){
			echo $inscategoriaCurso->eliminar_categoriaCurso_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}