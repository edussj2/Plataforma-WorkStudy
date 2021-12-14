<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class universidadModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_universidad_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO universidad(UniDescripcion,UniVigencia) 
			VALUES(:descripcion,:vigencia)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_universidad_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM universidad WHERE idUniversidad=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_universidad_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM universidad WHERE idUniversidad = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idUniversidad FROM universidad");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idUniversidad, UniDescripcion FROM universidad WHERE UniVigencia='Vigente' ORDER BY UniDescripcion ASC"); 
				$sql->execute();
			}
			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_universidad_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE universidad SET UniDescripcion=:descripcion, UniVigencia=:vigencia WHERE idUniversidad=:codigo");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}