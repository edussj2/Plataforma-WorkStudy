<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class ubigeoModelo extends mainModel
	{
		/*DATOS*/
		protected function datos_departamento_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM departamento WHERE idDepartamento = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idDepartamento FROM departamento");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idDepartamento, DepDescripcion FROM departamento ORDER BY DepDescripcion ASC"); 
				$sql->execute();
			}

			return $sql;
		}

        /*DATOS*/
		protected function datos_provincia_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM provincia WHERE idProvincia = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idProvincia FROM provincia");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idProvincia, ProvDescripcion FROM provincia ORDER BY ProvDescripcion ASC"); 
				$sql->execute();
			}

			return $sql;
		}
	}