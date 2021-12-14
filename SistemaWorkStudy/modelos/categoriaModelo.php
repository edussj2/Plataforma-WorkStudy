<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class categoriaModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_categoria_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO categoria(CatDescripcion,CatVigencia) 
			VALUES(:descripcion,:vigencia)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_categoria_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM categoria WHERE idCategoria=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_categoria_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM categoria WHERE idCategoria = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idCategoria FROM categoria");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idCategoria, CatDescripcion FROM categoria WHERE CatVigencia='Vigente' ORDER BY CatDescripcion ASC"); 
				$sql->execute();
			}
			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_categoria_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE categoria SET CatDescripcion=:descripcion, CatVigencia=:vigencia WHERE idCategoria=:codigo");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}