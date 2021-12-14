<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class areaModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_area_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO area(AreDescripcion, AreVigencia, AreColor) 
			VALUES(:descripcion,:vigencia,:color)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":color",$datos['color']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_area_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM area WHERE idArea=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_area_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM area WHERE idArea = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idArea FROM area");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idArea, AreDescripcion FROM area WHERE AreVigencia='Vigente' ORDER BY AreDescripcion ASC"); 
				$sql->execute();
			}

			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_area_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE area SET AreDescripcion=:descripcion, AreVigencia=:vigencia , AreColor=:color WHERE idArea=:codigo");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":color",$datos['color']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}