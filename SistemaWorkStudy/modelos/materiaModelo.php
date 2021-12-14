<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class materiaModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_materia_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO materia(MatNombre,MatVigencia) 
			VALUES(:descripcion,:vigencia)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_materia_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM materia WHERE idMateria=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_materia_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM materia WHERE idMateria = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idMateria FROM materia");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idMateria, MatNombre FROM materia WHERE MatVigencia='Vigente' ORDER BY MatNombre ASC"); 
				$sql->execute();
			}

			return $sql;
		}
	}