<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class anuncioModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_anuncio_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO anuncio(AnuTipClase, idMateria, AnuTitulo, AnuDescripcion, AnuPago, AnuPrecio, AnuPara, AnuFecha, AnuEstado, AnuNivel, idTutor) VALUES(:tipo, :materia, :titulo, :descripcion, :pago, :precio, :para, :fecha, :estado ,:nivel, :tutor)");

			$sql->bindParam(":tipo",$datos['tipo']);
			$sql->bindParam(":materia",$datos['materia']);
			$sql->bindParam(":titulo",$datos['titulo']);
			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":pago",$datos['pago']);
			$sql->bindParam(":precio",$datos['precio']);
			$sql->bindParam(":para",$datos['para']);
			$sql->bindParam(":fecha",$datos['fecha']);
			$sql->bindParam(":estado",$datos['estado']);
			$sql->bindParam(":nivel",$datos['nivel']);
			$sql->bindParam(":tutor",$datos['tutor']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_anuncio_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM anuncio WHERE idAnuncio=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_anuncio_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM anuncio WHERE idAnuncio = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idAnuncio FROM anuncio");
				$sql->execute();
			}
			return $sql;
		}

	}