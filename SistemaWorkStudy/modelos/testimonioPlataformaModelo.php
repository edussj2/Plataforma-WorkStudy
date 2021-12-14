<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class testimonioPlataformaModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_testimonioPlataforma_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO testimonioplataforma(idUsuario,TesDescripcion,TesFecha,TesEstado) 
			VALUES(:usuario, :descripcion, :fecha, :estado)");

            $sql->bindParam(":usuario",$datos['usuario']);
			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":fecha",$datos['fecha']);
			$sql->bindParam(":estado",$datos['estado']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_testimonioPlataforma_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM testimonioplataforma WHERE idTestimonio=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_testimonioPlataforma_modelo($tipo, $codigo, $busqueda){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM testimonioplataforma WHERE idTestimonio = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idTestimonio FROM testimonioplataforma");
				$sql->execute();
			}elseif($tipo=="Fecha"){
				$sql = mainModel::conectar()->prepare("SELECT idTestimonio FROM testimonioplataforma WHERE TesFecha = :busqueda"); 
				$sql->bindParam(":busqueda",$busqueda);
				$sql->execute();
			}elseif($tipo=="Estado"){
                $sql = mainModel::conectar()->prepare("SELECT idTestimonio FROM testimonioplataforma WHERE TesEstado = :busqueda"); 
				$sql->bindParam(":busqueda",$busqueda);
				$sql->execute();
            }

			return $sql;
		}

        /* ACTUALIZAR ESTADO */
		protected function actualizar_estado_testimonioPlataforma_modelo($datos){
			$sql=mainModel::conectar()->prepare("UPDATE testimonioplataforma SET TesEstado = :estado WHERE idTestimonio=:id");
			$sql->bindParam(":estado",$datos['estado']);
			$sql->bindParam(":id",$datos['id']);
			$sql->execute();
			return $sql;
		}
	}