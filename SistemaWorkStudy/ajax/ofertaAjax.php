<?php
	/* HECHO*/
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST['oferta_empresa_reg']) ){
		
		require_once "../controladores/ofertaControlador.php";
		$insoferta = new ofertaControlador();

		/*AGREGAR*/
		if(isset($_POST['oferta_empresa_reg']) && isset($_POST['oferta_titulo_reg']) && isset($_POST['oferta_fLimite_reg']) ){
			echo $insoferta->agregar_oferta_controlador();
		}
		
	}else{
		session_start(['name'=>'WS']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}