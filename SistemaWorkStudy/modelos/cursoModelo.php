<?php 
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class cursoModelo extends mainModel
	{
		/*AGREGAR*/
		protected function agregar_curso_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO curso(CurTitulo,CurSubTitulo,CurDescripcion,CurNivel,CurImagen,CurPrecio,CurObjetivos,CurRequisitos,CurDirigido,CurFecha,CurActFecha,CurVideo,CurDuracion,idEstudiante,idIdioma,idSubCategoria) 
			VALUES(:titulo,:subtitulo,:descripcion,:nivel,:imagen,:precio,:objetivos,:requisitos,:dirigido,:fecha,:upfecha,:video,:duracion,:estudiante,:idioma,:subcategoria)");

			$sql->bindParam(":titulo",$datos['titulo']);
			$sql->bindParam(":subtitulo",$datos['subtitulo']);
			$sql->bindParam(":descripcion",$datos['descripcion']);
			$sql->bindParam(":nivel",$datos['nivel']);
			$sql->bindParam(":imagen",$datos['imagen']);
			$sql->bindParam(":precio",$datos['precio']);
			$sql->bindParam(":objetivos",$datos['objetivos']);
			$sql->bindParam(":requisitos",$datos['requisitos']);
			$sql->bindParam(":dirigido",$datos['dirigido']);
			$sql->bindParam(":fecha",$datos['fecha']);
			$sql->bindParam(":upfecha",$datos['upfecha']);
			$sql->bindParam(":video",$datos['video']);
			$sql->bindParam(":duracion",$datos['duracion']);
			$sql->bindParam(":estudiante",$datos['estudiante']);
			$sql->bindParam(":idioma",$datos['idioma']);
			$sql->bindParam(":subcategoria",$datos['subcategoria']);
			$sql->execute();

			return $sql;
		}

		/*ELIMINAR*/
		protected function eliminar_curso_modelo($codigo){
			$sql=mainModel::conectar()->prepare("DELETE FROM curso WHERE idCurso=:codigo");

			$sql->bindParam(":codigo",$codigo);
			$sql->execute();

			return $sql;
		}

		/*DATOS*/
		protected function datos_curso_modelo($tipo, $codigo){
			if($tipo=="Unico"){
				$sql = mainModel::conectar()->prepare("SELECT * FROM curso WHERE idCurso = :codigo");
				$sql->bindParam(":codigo",$codigo);
				$sql->execute();
			}elseif($tipo=="Conteo"){
				$sql = mainModel::conectar()->prepare("SELECT idCurso FROM curso");
				$sql->execute();
			}
			return $sql;
		}

	}