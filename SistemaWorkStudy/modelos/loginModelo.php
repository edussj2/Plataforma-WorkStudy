<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class loginModelo extends mainModel
	{

		/**-----FUNCION PARA INICIAR SESIÓN-----**/
		protected function iniciar_sesion_modelo($datos){
			$sql = mainModel::conectar()->prepare("SELECT * FROM cuenta WHERE CtaEmail = :correo AND CtaClave = :clave AND CtaEstado='Activo'");

			$sql->bindParam(":correo",$datos['correo']);
			$sql->bindParam(":clave",$datos['clave']);
			$sql->execute();

			return $sql;
		}

		/**-----FUNCION PARA CERRAR SESIÓN-----**/
		protected function cerrar_sesion_modelo($datos){
			if ($datos['correo']!="" && $datos['token_S']==$datos['token']) {

				$Abitacora = mainModel::actualizar_bitarcora($datos['codigo'],$datos['hora']);

				if($Abitacora->rowCount()==1){
					session_unset();
					session_destroy();
					$respuesta = "true";
				}else{
					$respuesta = "false";
				}
			}else{
				$respuesta = "false";
			}

			return $respuesta;
		}
	}