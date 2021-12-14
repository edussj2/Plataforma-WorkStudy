<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class graficoControlador extends mainModel
	{
		/*DATOS USUARIOS */
        public function datos_graficos_usuarios_controlador(){

            $arreglo = array();
            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idAdministrador FROM administrador");
            $numeroAdmins = $consulta1->rowCount();

            $consulta2 = mainModel::ejecutar_consulta_simple("SELECT idEstudiante FROM estudiante");
            $numeroEstudiantes = $consulta2->rowCount();

            $consulta3 = mainModel::ejecutar_consulta_simple("SELECT idEmpresa FROM empresa");
            $numeroEmpresas = $consulta3->rowCount();

            $arreglo = [$numeroAdmins,$numeroEstudiantes,$numeroEmpresas];
        
            return $arreglo;
        }

        /*DATOS INTERACCIONES */
        public function datos_graficos_interacciones_controlador(){

            $arreglo = array();
            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idPublicacion FROM publicacion");
            $numeroAdmins = $consulta1->rowCount();

            $consulta2 = mainModel::ejecutar_consulta_simple("SELECT idOferta FROM oferta");
            $numeroEstudiantes = $consulta2->rowCount();

            $consulta3 = mainModel::ejecutar_consulta_simple("SELECT idAnuncio FROM anuncio");
            $numeroEmpresas = $consulta3->rowCount();

            $consulta4 = mainModel::ejecutar_consulta_simple("SELECT idCurso FROM curso");
            $numeroCursos = $consulta4->rowCount();

            $arreglo = [$numeroAdmins,$numeroEstudiantes,$numeroEmpresas,$numeroCursos,0];

            /*while($row = $datos->fetch()){
                $arreglo[]=$row['DepDescripcion'];
            }*/
        
            return $arreglo;
        }
	}