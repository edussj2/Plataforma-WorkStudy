<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class publicacionModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_publicacion_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO publicacion(PubDescripcion,PubImagen,PubFecha,idEstudiante,idArea) 
			VALUES(:descripcion,:imagen,:fecha,:estudiante,:area)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":imagen",$datos['imagen']);
			$sql->bindParam(":fecha",$datos['fecha']);
			$sql->bindParam(":estudiante",$datos['estudiante']);
			$sql->bindParam(":area",$datos['area']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_publicacion_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM publicacion WHERE idPublicacion=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_publicacion_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM publicacion WHERE idPublicacion = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idPublicacion FROM publicacion");
				$sql->execute();
			}elseif($tipo=="Especial"){
				$sql = mainModel::conectar()->prepare("SELECT idPublicacion, PubDescripcion, PubImagen, PubFecha, EstNombres, EstApePaterno, EstApeMaterno, AreDescripcion, CtaFoto, AreColor, estudiante.idEstudiante AS idEst
				FROM publicacion 
				INNER JOIN estudiante ON publicacion.idEstudiante = estudiante.idEstudiante
				INNER JOIN area ON publicacion.idArea = area.idArea
				INNER JOIN cuenta ON estudiante.CuentaCodigo = cuenta.CtaCodigo
				WHERE idPublicacion=:codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}
			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_publicacion_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE admin SET PubDescripcion=:descripcion,PubImagen=:imagen WHERE idPublicacion=:codigo");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":imagen",$datos['imagen']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}

		/*LIKES*/
		protected function likes_publicacion_modelo($tipo, $publicacion, $usuario){
			if($tipo=="Unico"){

				$sql = mainModel::conectar()->prepare("SELECT * FROM like_publicacion WHERE idEstudiante = :usuario AND idPublicacion = :publicacion");
				$sql->bindParam(":publicacion",$publicacion);
				$sql->bindParam(":usuario",$usuario);
				$sql->execute();

			}elseif($tipo=="Conteo"){

				$sql = mainModel::conectar()->prepare("SELECT * FROM like_publicacion WHERE idPublicacion = :publicacion");
				$sql->bindParam(":publicacion",$publicacion);
				$sql->execute();

			}
			return $sql;
		}

		/*COMENTARIOS*/
		protected function coment_publicacion_modelo($tipo, $publicacion){
			if($tipo=="Conteo"){

				$sql = mainModel::conectar()->prepare("SELECT idComPublicacion FROM comentario_publicacion WHERE idPublicacion = :publicacion");
				$sql->bindParam(":publicacion",$publicacion);
				$sql->execute();

			}
			return $sql;
		}
	}