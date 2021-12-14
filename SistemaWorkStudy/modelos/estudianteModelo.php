<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class estudianteModelo extends mainModel
	{
		/*DATOS*/
		protected function datos_estudiante_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM estudiante WHERE CuentaCodigo = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idEstudiante FROM estudiante");
				$sql->execute();
			}elseif($tipo=="Unico2"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM estudiante INNER JOIN cuenta ON estudiante.CuentaCodigo = cuenta.CtaCodigo WHERE idEstudiante = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}
			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_estudiante_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE estudiante SET EstDNI=:dni, EstNombres=:nombre, EstApePaterno=:paterno, EstApeMaterno=:materno, EstCelular=:celular, EstSexo=:sexo, EstDireccion=:direccion, EstNacimiento=:nacimiento, EstBiografia=:biografia, EstEscProfesional=:escuela, idDistrito=:distrito, idUniversidad=:universidad	WHERE CuentaCodigo=:codigo");

			$sql->bindParam(":dni",$datos['dni']);
			$sql->bindParam(":nombre",$datos['nombre']);
			$sql->bindParam(":paterno",$datos['paterno']);
			$sql->bindParam(":materno",$datos['materno']);
			$sql->bindParam(":celular",$datos['celular']);
			$sql->bindParam(":sexo",$datos['sexo']);
			$sql->bindParam(":direccion",$datos['direccion']);
			$sql->bindParam(":nacimiento",$datos['nacimiento']);
			$sql->bindParam(":biografia",$datos['biografia']);
			$sql->bindParam(":escuela",$datos['escuela']);
			$sql->bindParam(":distrito",$datos['distrito']);
			$sql->bindParam(":universidad",$datos['universidad']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}