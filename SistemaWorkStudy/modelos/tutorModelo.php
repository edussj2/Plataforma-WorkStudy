<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class tutorModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_tutor_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO tutor(TutDesplazo, TutOnline, TutDomicilio, TutDescripcion, TutExperiencia, TutTelefono, idEstudiante) 
			VALUES(:desplazo, :online, :domicilio, :descripcion, :experiencia, :telefono, :idEstudiante)");

			$sql->bindParam(":desplazo",$datos['desplazo']);
			$sql->bindParam(":online",$datos['online']);
			$sql->bindParam(":domicilio",$datos['domicilio']);
			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":experiencia",$datos['experiencia']);
			$sql->bindParam(":telefono",$datos['telefono']);
			$sql->bindParam(":idEstudiante",$datos['idEstudiante']);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_tutor_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM tutor WHERE idEstudiante = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idTutor FROM tutor");
				$sql->execute();
			}elseif($tipo=="Unico2"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM tutor WHERE idTutor = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}
			return $sql;
		}

		/*ACTUALIZAR*/
		protected function actualizar_tutor_modelo($datos){
			$sql = mainModel::conectar()->prepare("UPDATE tutor SET TutDesplazo=:desplazo, TutOnline=:online, TutDomicilio=:domicilio, TutDescripcion=:descripcion, TutExperiencia=:experiencia, TutTelefono=:telefono WHERE idTutor=:codigo");

			$sql->bindParam(":desplazo",$datos['desplazo']);
			$sql->bindParam(":online",$datos['online']);
			$sql->bindParam(":domicilio",$datos['domicilio']);
			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":experiencia",$datos['experiencia']);
			$sql->bindParam(":telefono",$datos['telefono']);
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->execute();
			
			return $sql;
		}
	}