<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class sectorComercialModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_sectorComercial_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO sectorcomercial(SecDescripcion,SecVigencia) 
			VALUES(:descripcion,:vigencia)");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_sectorComercial_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM sectorcomercial WHERE 	idSecComercial=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_sectorComercial_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM sectorcomercial WHERE 	idSecComercial = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idSecComercial FROM sectorcomercial");
				$sql->execute();
			}elseif($tipo=="Select"){
				$sql = mainModel::conectar()->prepare("SELECT idSecComercia, SecDescripcion FROM sectorcomercial WHERE SecVigencia='Vigente' ORDER BY SecDescripcion ASC"); 
				$sql->execute();
			}
			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_sectorComercial_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE sectorcomercial SET SecDescripcion=:descripcion, SecVigencia=:vigencia, WHERE idSecComercial=:codigo");

			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":vigencia",$datos['vigencia']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}