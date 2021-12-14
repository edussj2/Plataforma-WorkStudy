<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class horarioModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_horario_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO horario(HorDia,HorInicio,HorFin,idTutor) 
			VALUES(:dia,:inicio,:fin,:tutor)");

			$sql->bindParam(":dia",$datos['dia']);
			$sql->bindParam(":inicio",$datos['inicio']);
			$sql->bindParam(":fin",$datos['fin']);
			$sql->bindParam(":tutor",$datos['tutor']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_horario_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM horario WHERE idHorario=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_horario_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM horario WHERE idHorario = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idHorario FROM horario");
				$sql->execute();
			}

			return $sql;
		}
	}