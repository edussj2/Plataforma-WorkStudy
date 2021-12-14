<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class categoriaCursoModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_categoriaCurso_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO categoriacurso(CatCursoDescripcion, CatCursoImagen, CatCursoVigencia) 
			VALUES(:descripcion, :imagen, :vigencia)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":imagen",$datos['imagen']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_categoriaCurso_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM categoriacurso WHERE idCategoriaCurso=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_categoriaCurso_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM categoriacurso WHERE idCategoriaCurso = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idCategoriaCurso FROM categoriacurso");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idCategoriaCurso, CatCursoDescripcion, CatCursoImagen FROM categoriacurso WHERE CatCursoVigencia='Vigente' ORDER BY CatCursoDescripcion ASC"); 
				$sql->execute();
			}
			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_categoriaCurso_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE categoriacurso SET CatCursoDescripcion=:descripcion, CatCursoVigencia=:vigencia WHERE idCategoriaCurso=:codigo");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}