<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class idiomaModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_idioma_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO idioma(IdiDescripcion,IdiVigencia) 
			VALUES(:descripcion,:vigencia)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_idioma_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM idioma WHERE idIdioma=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_idioma_modelo($tipo, $codigo){
			if($tipo=="Idico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM idioma WHERE idIdioma = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idIdioma FROM idioma");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idIdioma, IdiDescripcion FROM idioma WHERE IdiVigencia='Vigente' ORDER BY IdiDescripcion ASC"); 
				$sql->execute();
			}
			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_idioma_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE idioma SET IdiDescripcion=:descripcion, IdiVigencia=:vigencia WHERE idIdioma=:codigo");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}