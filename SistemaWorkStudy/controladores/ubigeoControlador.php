<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/ubigeoModelo.php";
	}else{
		require_once "./modelos/ubigeoModelo.php";
	}

	class ubigeoControlador extends ubigeoModelo
	{
        /*DATOS*/
        public function datos_departamento_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return ubigeoModelo::datos_departamento_modelo($tipo, $codigo);
        }

        /*DATOS*/
        public function datos_provincia_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return ubigeoModelo::datos_provincia_modelo($tipo, $codigo);
        }

	}
    