<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class administradorModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_administrador_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO administrador(AdmDNI,AdmNombre,AdmApellidos,AdmTelefono,AdmDireccion,CuentaCodigo) 
			VALUES(:dni,:nombres,:apellidos,:telefono,:direccion,:codigo)");

			$sql->bindParam(":dni",$datos['dni']);
			$sql->bindParam(":nombres",$datos['nombres']);
			$sql->bindParam(":apellidos",$datos['apellidos']);
			$sql->bindParam(":telefono",$datos['telefono']);
			$sql->bindParam(":direccion",$datos['direccion']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_administrador_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM administrador WHERE CuentaCodigo=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_administrador_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM administrador WHERE CuentaCodigo = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idAdministrador FROM administrador WHERE idAdministrador!='1'");
				$sql->execute();
			}
			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_administrador_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE admin SET AdmNombre=:nombres, AdmApellidos=:apellidos, AdmTelefono=:telefono, AdmDNI = :dni, AdmDireccion=:direccion WHERE CuentaCodigo=:codigo");

			$sql->bindParam(":nombres",$datos['nombres']);
			$sql->bindParam(":apellidos",$datos['apellidos']);
			$sql->bindParam(":telefono",$datos['telefono']);
			$sql->bindParam(":dni",$datos['dni']);
			$sql->bindParam(":direccion",$datos['direccion']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}