<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class subcategoriaModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_subcategoria_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO subcategoria(SubDescripcion, SubIcono, SubVigencia, idCatCurso) 
			VALUES(:descripcion,:icono,:vigencia,:catCurso)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":icono",$datos['icono']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":catCurso",$datos['catCurso']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_subcategoria_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM subcategoria WHERE idSubcategoria=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_subcategoria_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM subcategoria WHERE idSubCategoria = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idSubcategoria FROM subcategoria");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idSubCategoria, SubDescripcion FROM subcategoria WHERE SubVigencia='Vigente' ORDER BY SubDescripcion ASC"); 
				$sql->execute();
			}
			return $sql;
		}
	}