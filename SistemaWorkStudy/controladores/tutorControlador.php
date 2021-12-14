<?php 
    /* HECHO */
	if($peticionAjax){
		require_once "../modelos/tutorModelo.php";
	}else{
		require_once "./modelos/tutorModelo.php";
	}

	class tutorControlador extends tutorModelo
	{
		/*AGREGAR*/
		public function agregar_tutor_controlador(){

			if(isset($_POST['tutor_domicilio_reg'])){
                $domicilio = "Clases en mi domicilio";
            }else{
                $domicilio = "";
            }

            if(isset($_POST['tutor_desplazo_reg'])){
                $desplazo = "Clases a domicilio";
            }else{
                $desplazo = "";
            }

            if(isset($_POST['tutor_internet_reg'])){
                $internet = "Clases por Internet";
            }else{
                $internet = "";
            }
			

			$descripcion = mainModel::limpiar_cadena($_POST['tutor_descripcion_reg']);
			$experiencia = mainModel::limpiar_cadena($_POST['tutor_experiencia_reg']);
			$telefono = mainModel::limpiar_cadena($_POST['tutor_telefono_reg']);
			$estudiante = mainModel::decryption($_POST['tutor_estudiante_reg']);


            /*--VALIDACIONES--*/
            if($descripcion=="" || $experiencia =="Sin Registro" || $telefono=="" || $telefono == "Sin Registro" || ($desplazo =="" && $domicilio =="" && $internet =="") || $estudiante==""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];

            }else{

                if(strlen($descripcion)>250 || strlen($descripcion)<10){

                            $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de carácteres de la descripción no es válida","Tipo"=>"warning"];
                        
                }else{

                    if(strlen($telefono)>9 || strlen($telefono)<6){

                        $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de caracteres del teléfono no es válida","Tipo"=>"warning"];
                            
                    }else{

                        if(is_numeric($telefono)== false){

                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El teléfono ingresado no es válido","Tipo"=>"warning"];

                        }else{

                            $datostutor=[
                                            "desplazo"=>$desplazo,
                                            "online"=>$internet,
                                            "domicilio"=>$domicilio,
                                            "descripcion"=>$descripcion,
                                            "experiencia"=>$experiencia,
                                            "telefono"=>$telefono,
                                            "idEstudiante"=>$estudiante
                                        ];

                            $guardartutor = tutorModelo::agregar_tutor_modelo($datostutor);

                            if($guardartutor->rowCount()>=1){

                                $alerta = ["Alerta"=>"recargar", "Titulo"=>"TUTOR REGISTRADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

                            }else{
                                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con el registro de los datos del tutor, intente nuevamente","Tipo"=>"error"];
                            }
                                    
                        }
                    }
                }      
                
            }    
            
            return mainModel::sweet_alert($alerta);
		}

        /*DATOS*/
        public function datos_tutor_controlador($tipo,$codigo){

            $codigo = mainModel::decryption($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);

            return tutorModelo::datos_tutor_modelo($tipo, $codigo);
        }

        /*ACTUALIZAR*/
		public function actualizar_tutor_controlador(){

			if(isset($_POST['tutor_domicilio_up'])){
                $domicilio = "Clases en mi domicilio";
            }else{
                $domicilio = "";
            }

            if(isset($_POST['tutor_desplazo_up'])){
                $desplazo = "Clases a domicilio";
            }else{
                $desplazo = "";
            }

            if(isset($_POST['tutor_internet_up'])){
                $internet = "Clases por Internet";
            }else{
                $internet = "";
            }
			

			$descripcion = mainModel::limpiar_cadena($_POST['tutor_descripcion_up']);
			$experiencia = mainModel::limpiar_cadena($_POST['tutor_experiencia_up']);
			$telefono = mainModel::limpiar_cadena($_POST['tutor_telefono_up']);
			$tutor = mainModel::decryption($_POST['tutor_id_up']);

            if($descripcion=="" || $experiencia =="Sin Registro" || $telefono=="" || $telefono == "Sin Registro" || ($desplazo =="" && $domicilio =="" && $internet =="") || $tutor ==""){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Complete los campos requeridos","Tipo"=>"warning"];
                return mainModel::sweet_alert($alerta);
                exit();
            }

            if(strlen( $descripcion ) > 250 || strlen( $descripcion )<10){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de la descripción no es válida","Tipo"=>"warning"];   
                return mainModel::sweet_alert($alerta);
                exit(); 

            }

            if(strlen($telefono)>9 || strlen($telefono)<6){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"La longitud de caracteres del teléfono no es válida","Tipo"=>"warning"];  
                return mainModel::sweet_alert($alerta);
                exit(); 
            }

            if(is_numeric($telefono)== false){

                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"El teléfono ingresado no es válido","Tipo"=>"warning"];  
                return mainModel::sweet_alert($alerta);
                exit(); 
            }

            $datostutor=[
                            "desplazo"=>$desplazo,
                            "online"=>$internet,
                            "domicilio"=>$domicilio,
                            "descripcion"=>$descripcion,
                            "experiencia"=>$experiencia,
                            "telefono"=>$telefono,
                            "codigo"=>$tutor
                        ];

            $actualizartutor = tutorModelo::actualizar_tutor_modelo($datostutor);

            if($actualizartutor->rowCount()>=1){

                $alerta = ["Alerta"=>"recargar", "Titulo"=>"TUTOR ACTUALIZADO","Texto"=>"Los datos se registrarón con éxito.","Tipo"=>"success"];

            }else{
                $alerta = ["Alerta"=>"simple", "Titulo"=>"Ocurrió un error","Texto"=>"Hubo un problema con la actualización de los datos del tutor, intente nuevamente","Tipo"=>"error"];
            }

            return mainModel::sweet_alert($alerta);
		}

	}
    