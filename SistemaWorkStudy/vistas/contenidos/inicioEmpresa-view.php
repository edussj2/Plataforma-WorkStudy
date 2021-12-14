<?php
  /* HECHO */
	if($_SESSION['tipo_WS']!="Empresa"){
		echo $lc->forzar_cierre_sesion_controlador();
	}
?> 
<h1>DashBoard de la empresa</h1>