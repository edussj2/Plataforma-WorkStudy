<?php
	session_start(['name'=>'WS']);
	$peticionAjax = true;
	require_once "../core/configGeneral.php";

	if(isset($_POST)){

		/*************  BUSCAR AREAS  **************/
		if(isset($_POST['busqueda_area'])){
			$_SESSION['busqueda_area']= $_POST['busqueda_area'];
		}

		if(isset($_POST['eliminar_busqueda_area'])){
			unset($_SESSION['busqueda_area']);
			$url = "areaBuscar";
		}
		/*****************************************/




		/**********  BUSCAR SECTOR COMERCIAL  ***********/
		if(isset($_POST['busqueda_sectorComercial'])){
			$_SESSION['busqueda_sectorComercial']= $_POST['busqueda_sectorComercial'];
		}

		if(isset($_POST['eliminar_busqueda_sectorComercial'])){
			unset($_SESSION['busqueda_sectorComercial']);
			$url = "sectorComercialBuscar";
		}
		/*****************************************/




		/***********  BUSCAR CATEGORIA  ***********/
		if(isset($_POST['busqueda_categoria'])){
			$_SESSION['busqueda_categoria']= $_POST['busqueda_categoria'];
		}

		if(isset($_POST['eliminar_busqueda_categoria'])){
			unset($_SESSION['busqueda_categoria']);
			$url = "categoriaBuscar";
		}
		/*****************************************/




		/**********  BUSCAR MATERIA  **********/
		if(isset($_POST['busqueda_materia'])){
			$_SESSION['busqueda_materia']= $_POST['busqueda_materia'];
		}

		if(isset($_POST['eliminar_busqueda_materia'])){
			unset($_SESSION['busqueda_materia']);
			$url = "materiaBuscar";
		}
		/*****************************************/

		


		/***********  BUSCAR UNIVERSIDAD  **********/
		if(isset($_POST['busqueda_universidad'])){
			$_SESSION['busqueda_universidad']= $_POST['busqueda_universidad'];
		}

		if(isset($_POST['eliminar_busqueda_universidad'])){
			unset($_SESSION['busqueda_universidad']);
			$url = "universidadBuscar";
		}
		/*****************************************/




		/************  BUSCAR IDIOMA  **********/
		if(isset($_POST['busqueda_idioma'])){
			$_SESSION['busqueda_idioma']= $_POST['busqueda_idioma'];
		}

		if(isset($_POST['eliminar_busqueda_idioma'])){
			unset($_SESSION['busqueda_idioma']);
			$url = "idiomaBuscar";
		}
		/*****************************************/




		/************  BUSCAR CATEGORIA CURSO  **********/
		if(isset($_POST['busqueda_categoriaCurso'])){
			$_SESSION['busqueda_categoriaCurso']= $_POST['busqueda_categoriaCurso'];
		}

		if(isset($_POST['eliminar_busqueda_categoriaCurso'])){
			unset($_SESSION['busqueda_categoriaCurso']);
			$url = "categoriaCursoBuscar";
		}
		/*****************************************/





		/************  BUSCAR CATEGORIA CURSO  **********/
		if(isset($_POST['busqueda_subcategoria'])){
			$_SESSION['busqueda_subcategoria']= $_POST['busqueda_subcategoria'];
		}

		if(isset($_POST['eliminar_busqueda_subcategoria'])){
			unset($_SESSION['busqueda_subcategoria']);
			$url = "subcategoriaBuscar";
		}
		/*****************************************/






		/***********  BUSCAR ADMINISTRADORES **********/
		if(isset($_POST['busqueda_admin'])){
			$_SESSION['busqueda_admin']= $_POST['busqueda_admin'];
		}

		if(isset($_POST['eliminar_busqueda_admin'])){
			unset($_SESSION['busqueda_admin']);
			$url = "administradorBuscar";
		}
		/*****************************************/




		/***********  BUSCAR ESTUDIANTES  **********/
		if(isset($_POST['busqueda_estudiante'])){
			$_SESSION['busqueda_estudiante']= $_POST['busqueda_estudiante'];
		}

		if(isset($_POST['eliminar_busqueda_estudiante'])){
			unset($_SESSION['busqueda_estudiante']);
			$url = "estudianteBuscar";
		}
		/*****************************************/




		/***********  BUSCAR EMPRESA  *************/
		if(isset($_POST['busqueda_empresa'])){
			$_SESSION['busqueda_empresa']= $_POST['busqueda_empresa'];
		}

		if(isset($_POST['eliminar_busqueda_empresa'])){
			unset($_SESSION['busqueda_empresa']);
			$url = "empresaBuscar";
		}
		/*****************************************/




		/****** MOUDLO FILTRAR OFERTAS POR CATEGORIA *******/
		if(isset($_POST['busqueda_categoria_filtro'])){
			$_SESSION['busqueda_categoria_filtro']= $_POST['busqueda_categoria_filtro'];
		}

		if(isset($_POST['eliminar_busqueda_categoria_filtro'])){
			unset($_SESSION['busqueda_categoria_filtro']);
			$url = "ofertas/all";
		}





		/************  MODULO PARA REDICIONAR  ***************/
		if(isset($url)){
			echo '<script> window.location.href="'.SERVERURL.$url.'/"</script>';
		}else{
			echo '<script> location.reload();</script>';
		}
		/****************************************************/

	}else{
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	}