<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class ofertaModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_oferta_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO oferta(OfeTitulo,OfeDescripcion,OfeEduMinima,OfeExpYear,OfeDisViajar,	OfeDisCamResidencia,OfeJorLaboral,OfeTipTrabajo,OfeTipContrato,OfeSalario,OfeDisDiscapactiado,OfeFecLimite,	OfeFecPublicacion,OfeNumVacantes,OfeRelevancia,idCategoria,idEmpresa) 
			VALUES(:titulo,:descripcion,:eduMin,:expYear,:disViajar,:disCamRes,:jorLaboral,:tipTrabajo,:tipContrato,:salario,:disDiscapacitado,:fLimite,:fPublicacion,:vacantes,:relevancia,:categoria,:empresa)");

			$sql->bindParam(":titulo",$datos['titulo']);
			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":eduMin",$datos['eduMin']);
			$sql->bindParam(":expYear",$datos['expYear']);
			$sql->bindParam(":disViajar",$datos['disViajar']);
			$sql->bindParam(":disCamRes",$datos['disCamRes']);
			$sql->bindParam(":jorLaboral",$datos['jorLaboral']);
			$sql->bindParam(":tipTrabajo",$datos['tipTrabajo']);
			$sql->bindParam(":tipContrato",$datos['tipContrato']);
			$sql->bindParam(":salario",$datos['salario']);
			$sql->bindParam(":disDiscapacitado",$datos['disDiscapacitado']);
			$sql->bindParam(":fLimite",$datos['fLimite']);
			$sql->bindParam(":fPublicacion",$datos['fPublicacion']);
			$sql->bindParam(":vacantes",$datos['vacantes']);
			$sql->bindParam(":relevancia",$datos['relevancia']);
			$sql->bindParam(":categoria",$datos['categoria']);
			$sql->bindParam(":empresa",$datos['empresa']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_oferta_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM oferta WHERE idOferta=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_oferta_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM oferta WHERE idOferta = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idOferta FROM oferta");
				$sql->execute();
			}
			return $sql;
		}

	}