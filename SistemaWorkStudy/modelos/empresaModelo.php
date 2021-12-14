<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class empresaModelo extends mainModel
	{
		/*DATOS*/
		protected function datos_empresa_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM empresa WHERE CuentaCodigo = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idempresa FROM empresa");
				$sql->execute();
			}elseif($tipo=="Unico2"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM empresa INNER JOIN cuenta ON empresa.CuentaCodigo=cuenta.CtaCodigo WHERE idEmpresa=:codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}
			return $sql;
		}

	}